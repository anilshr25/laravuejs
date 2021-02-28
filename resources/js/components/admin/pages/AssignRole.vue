<template>
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Assign Roles</h3>
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">
                    <Select
                        style="width:300px"
                        v-if="roles.length"
                        class="pb-3"
                        v-model="data.id"
                        placeholder="Select a Admin Type"
                        @on-change="chanageRole"
                    >
                        <Option
                            v-for="(role, i) in roles"
                            :key="i"
                            :value="role.id"
                            >{{ role.roleName }}</Option
                        >
                    </Select>
                </p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-nowrap">
                        <div
                            id="dataTable_length"
                            class="dataTables_length"
                            aria-controls="dataTable"
                        >
                            <label
                                >Show&nbsp;<select
                                    class="form-control form-control-sm custom-select custom-select-sm"
                                    ><option value="10" selected="">10</option
                                    ><option value="25">25</option
                                    ><option value="50">50</option
                                    ><option value="100">100</option></select
                                >&nbsp;</label
                            >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div
                            class="text-md-right dataTables_filter"
                            id="dataTable_filter"
                        >
                            <label
                                ><input
                                    type="search"
                                    class="form-control form-control-sm"
                                    aria-controls="dataTable"
                                    placeholder="Search"
                            /></label>
                        </div>
                    </div>
                </div>
                <div
                    class="table-responsive table mt-2"
                    id="dataTable"
                    role="grid"
                    aria-describedby="dataTable_info"
                >
                    <table class="table my-0" id="dataTable">
                        <thead>
                            <tr>
                                <th>Resource Name</th>
                                <th>Read</th>
                                <th>Write</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(r, i) in resources" :key="i">
                                <td>{{ r.resourceName }}</td>
                                <td><Checkbox v-model="r.read"></Checkbox></td>
                                <td><Checkbox v-model="r.write"></Checkbox></td>
                                <td>
                                    <Checkbox v-model="r.update"></Checkbox>
                                </td>
                                <td>
                                    <Checkbox v-model="r.delete"></Checkbox>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <Button
                            type="primary"
                            :loading="isAssign"
                            :disabled="isAssign"
                            @click="assignRole"
                            >{{ isAssign ? "Assigning" : "Assign" }}</Button
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            data: {
                roleName: "",
                permission: "",
                id: ""
            },
            isAssign: false,
            roles: [],
            permissions: [],
            defaultResources: [
                {
                    resourceName: "Users",
                    read: false,
                    write: false,
                    update: false,
                    delete: false,
                    name: "users"
                },
                {
                    resourceName: "Role",
                    read: false,
                    write: false,
                    update: false,
                    delete: false,
                    name: "role"
                },
                {
                    resourceName: "Assign Role",
                    read: false,
                    write: false,
                    update: false,
                    delete: false,
                    name: "assignRole"
                },
                {
                    resourceName: "Dashboard",
                    read: false,
                    write: false,
                    update: false,
                    delete: false,
                    name: "dashboard"
                },
                {
                    resourceName: "Tags",
                    read: false,
                    write: false,
                    update: false,
                    delete: false,
                    name: "tag"
                },
                {
                    resourceName: "Category",
                    read: false,
                    write: false,
                    update: false,
                    delete: false,
                    name: "category"
                }
            ],
            resources: [
                {
                    resourceName: "Users",
                    read: false,
                    write: false,
                    update: false,
                    delete: false,
                    name: "users"
                },
                {
                    resourceName: "Role",
                    read: false,
                    write: false,
                    update: false,
                    delete: false,
                    name: "role"
                },
                {
                    resourceName: "Assign Role",
                    read: false,
                    write: false,
                    update: false,
                    delete: false,
                    name: "assignRole"
                },
                {
                    resourceName: "Dashboard",
                    read: false,
                    write: false,
                    update: false,
                    delete: false,
                    name: "dashboard"
                },
                {
                    resourceName: "Tags",
                    read: false,
                    write: false,
                    update: false,
                    delete: false,
                    name: "tag"
                },
                {
                    resourceName: "Category",
                    read: false,
                    write: false,
                    update: false,
                    delete: false,
                    name: "category"
                }
            ]
        };
    },

    methods: {
        async assignRole() {
            let data = JSON.stringify(this.resources);

            const res = await this.callApi("post", "/role/assign", {
                permission: data,
                id: this.data.id
            });
            if (res.status == 200) {
                let index = this.roles.findIndex(
                    role => role.id == this.data.id
                );
                this.roles[index].permission = data;
                this.success("Role has been assigned sucessfully!");
            } else {
                this.swrong();
            }
        },

        async chanageRole() {
            let index = this.roles.findIndex(role => role.id == this.data.id);
            let permission = this.roles[index].permission;
            if (!permission) {
                this.resources = this.defaultResources;
            } else {
                this.resources = JSON.parse(permission);
            }
        }
    },

    async created() {
        const res = await this.callApi("get", "/role/get");
        if (res.status == 200) {
            if (res.data.length) {
                this.roles = res.data;
                let index = this.roles.findIndex(role => role.id == 1);
                this.data.id = res.data[index].id;
                if (res.data[index].permission) {
                    this.resources = JSON.parse(res.data[index].permission);
                }
            }
        } else {
            this.swrong();
        }
    }
};
</script>
