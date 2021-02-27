<template>
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Admin User</h3>
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">
                    <Button @click="addModal = true"
                        ><Icon type="md-add" size="20" />Add Admin User</Button
                    >
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
                                >
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option></select
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
                                <th>Id</th>
                                <th>Admin Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody v-if="users.length">
                            <tr v-for="(user, i) in users" :key="i">
                                <td>{{ user.id }}</td>
                                <td>{{ user.fullname }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.role_id }}</td>
                                <td>{{ user.created_at }}</td>
                                <td>
                                    <Button
                                        type="info"
                                        @click="showEditData(user, i)"
                                        >Edit</Button
                                    >
                                    <Button
                                        type="error"
                                        @click="showDeleteData(user, i)"
                                        >Delete</Button
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <p
                            id="dataTable_info"
                            class="dataTables_info"
                            role="status"
                            aria-live="polite"
                        >
                            Showing 1 to 10 of 27
                        </p>
                    </div>
                    <div class="col-md-6">
                        <nav
                            class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers"
                        >
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a
                                        class="page-link"
                                        href="#"
                                        aria-label="Previous"
                                        ><span aria-hidden="true">«</span></a
                                    >
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a
                                        class="page-link"
                                        href="#"
                                        aria-label="Next"
                                        ><span aria-hidden="true">»</span></a
                                    >
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!---   Add Admin Users Modal   -->
                <Modal
                    v-model="addModal"
                    title="Add Admin User"
                    :mask-closable="false"
                    :closable="false"
                >
                    <Input
                        class="pb-3"
                        type="text"
                        v-model="data.fullname"
                        placeholder="Enter Full Name"
                    />
                    <Input
                        class="pb-3"
                        type="email"
                        v-model="data.email"
                        placeholder="Enter Email "
                    />
                    <Input
                        class="pb-3"
                        type="password"
                        v-model="data.password"
                        placeholder="Enter Password"
                    />
                    <Select v-if="roles.length"
                        class="pb-3"
                        v-model="data.role_id"
                        placeholder="Select a User Type"
                    >
                        <Option v-for="(role,i) in roles" :key="i" :value="role.id">{{ role.roleName }}</Option>
                    </Select>
                    <div slot="footer">
                        <Button type="default" @click="addModal = false"
                            >Close</Button
                        >
                        <Button
                            type="primary"
                            @click="addUser"
                            :disabled="isAdding"
                            :loading="isAdding"
                            >{{ isAdding ? "Adding..." : "Add User" }}</Button
                        >
                    </div>
                </Modal>

                <!---   Edit Users Modal   -->
                <Modal
                    v-model="editModal"
                    title="Edit Users"
                    :mask-closable="false"
                    :closable="false"
                >
                    <Input
                        class="pb-3"
                        type="text"
                        v-model="editData.fullname"
                        placeholder="Enter Full Name"
                    />
                    <Input
                        class="pb-3"
                        type="email"
                        v-model="editData.email"
                        placeholder="Enter Email "
                    />
                    <Select v-if="roles.length"
                        class="pb-3"
                        v-model="data.role_id"
                        placeholder="Select a Role Type"
                    >
                        <Option v-for="(role,i) in roles" :key="i" value="role.id">{{ role.roleName }}</Option>
                    </Select>
                    <div slot="footer">
                        <Button type="default" @click="editModal = false"
                            >Close</Button
                        >
                        <Button
                            type="primary"
                            @click="editUser"
                            :disabled="isEditing"
                            :loading="isEditing"
                            >{{
                                isEditing ? "Editing..." : "Edit User"
                            }}</Button
                        >
                    </div>
                </Modal>

                <DeleteModal></DeleteModal>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import DeleteModal from "../layout/DeleteModal.vue";

export default {
    components: {
        DeleteModal
    },
    data() {
        return {
            data: {
                fullname: "",
                email: "",
                password: "",
                role_id: ""
            },
            addModal: false,
            editModal: false,
            isAdding: false,
            isEditing: false,
            isDeleting: false,
            users: [],
            roles: [],
            editData: {
                fullname: "",
                email: "",
                password: "",
                role_id: ""
            },
            deleteData: {},
            index: -1
        };
    },
    methods: {
        async addUser() {
            if (this.data.fullname.trim() == "")
                return this.error("Admin Name is required!!");
            if (this.data.email.trim() == "")
                return this.error("Emailis required!!");
            if (this.data.password.trim() == "")
                return this.error("Password is required!!");
            if (!this.data.role_id)
                return this.error("Role is required!!");
            const res = await this.callApi("post", "/user/add", this.data);

            if (res.status == 201) {
                this.users.unshift(res.data);
                this.success("Admin User has been added sucessfully!");
                this.addModal = false;
                this.data.fullname = "";
                this.data.email = "";
                this.data.password = "";
                this.data.role_id = "Admin";
            } else {
                if (res.status == 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                } else {
                    this.swrong();
                }
            }
        },

        async editUser() {
            if (this.editData.fullname.trim() == "")
                return this.error("Admin Name is required!!");
            if (this.editData.email.trim() == "")
                return this.error("Emailis required!!");
            if (!this.editData.role_id)
                return this.error("Role is required!!");
            const res = await this.callApi("post", "/user/edit", this.editData);
            if (res.status == 200) {
                this.users[this.index]= this.editData;
                this.success("Admin has been edited sucessfully!");
                this.editModal = false;
            } else {
                if (res.status == 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                } else {
                    this.swrong();
                }
            }
        },

        showEditData(user, index) {
            let obj = {
                id: user.id,
                fullname: user.fullname,
                email: user.email,
                role_id: user.role_id
            };
            this.editData = obj;
            this.editModal = true;
            this.index = index;
        },

        showDeleteData(user, index) {
            const deleteModalObj = {
                deleteModal: true,
                isDeleting: false,
                deleteUrl: "/user/delete",
                deleteData: user,
                index: index
            };
            this.$store.commit("setDeleteData", deleteModalObj);
        }
    },

    async created() {
        const [res, roles] = await Promise.all([
            this.callApi("get", "/user/get"),
            this.callApi("get", "/role/get")
        ]);
        if (res.status == 200) {
            this.users = res.data;
        } else {
            this.swrong();
        }
        if (roles.status == 200) {
            this.roles = roles.data;
        } else {
            this.swrong();
        }
    },

    computed: {
        ...mapGetters(["getDeleteModelObj"])
    },

    watch: {
        getDeleteModelObj(obj) {
            if (obj.isDeleted) {
                this.users.splice(obj.index, 1);
            }
        }
    }
};
</script>
