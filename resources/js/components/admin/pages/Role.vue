<template>
    <div class="container-fluid">
                <h3 class="text-dark mb-4">Roles</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold"><Button @click="addModal=true"><Icon type="md-add" size="20" />Add Role</Button></p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-nowrap">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Role Name</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody v-if="roles.length">
                                    <tr v-for="(role, i) in roles" :key="i">
                                        <td>{{ role.id }}</td>
                                        <td>{{ role.roleName }}</td>
                                        <td>{{ role.created_at }}</td>
                                        <td>
                                            <Button type="info" @click="showEditData(role, i)">Edit</Button>
                                            <Button type="error" @click="showDeleteData(role, i)">Delete</Button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                            </div>
                            <div class="col-md-6">
                                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <!---   Add Roles Modal   -->
                        <Modal v-model="addModal" title="Add Roles" :mask-closable="false" :closable="false">
                            <Input v-model="data.roleName" placeholder="Enter Role Name" />
                            <div slot="footer">
                                <Button type="default" @click="addModal=false">Close</Button>
                                <Button type="primary" @click="addRole" :disabled="isAdding" :loading="isAdding">{{ isAdding ? 'Adding...' : 'Add Role' }}</Button>
                            </div>
                        </Modal>

                        <!---   Edit Roles Modal   -->
                        <Modal v-model="editModal" title="Edit Roles" :mask-closable="false" :closable="false">
                            <Input v-model="editData.roleName" placeholder="Edit Role Name" />
                            <div slot="footer">
                                <Button type="default" @click="editModal=false">Close</Button>
                                <Button type="primary" @click="editRole" :disabled="isEditing" :loading="isEditing">{{ isEditing ? 'Editing...' : 'Edit Role' }}</Button>
                            </div>
                        </Modal>

                        <DeleteModal></DeleteModal>

                    </div>
                </div>
            </div>
</template>
<script>
    import { mapGetters } from 'vuex';
    import DeleteModal from '../layout/DeleteModal.vue';

    export default {
        components: {
            DeleteModal
        },
        data() {
            return {
                data: {
                    roleName: '',
                    permission: ''
                },
                addModal: false,
                editModal: false,
                isAdding: false,
                isEditing: false,
                isDeleting: false,
                roles: [],
                editData: {
                    roleName: '',
                    permission: ''
                },
                deleteData: {},
                index: -1
            }
        },
        methods: {
            async addRole() {
                if(this.data.roleName.trim() == '') return this.error('Role Name is required!!')
                const res = await this.callApi('post', '/role/add', this.data);
                if(res.status == 201) {
                    this.roles.unshift(res.data);
                    this.success('Role has been added sucessfully!');
                    this.addModal = false;
                    this.data.roleName = '';
                }else {
                    if(res.status == 422){
                        if(res.data.errors.roleName){
                            this.error(res.data.errors.roleName[0]);
                        }
                    } else {
                        this.swrong();
                    }
                }
            },

            async editRole() {
                if(this.editData.roleName.trim() == '') return this.error('Role Name is required!!')
                const res = await this.callApi('post', '/role/edit', this.editData);
                if(res.status == 200) {
                    this.roles[this.index].roleName = this.editData.roleName;
                    this.success('Role has been edited sucessfully!');
                    this.editModal = false;
                }else {
                    if(res.status == 422){
                        if(res.data.errors.roleName){
                            this.error(res.data.errors.roleName[0]);
                        }
                    } else {
                        this.swrong();
                    }
                }
            },

            showEditData(role, index) {
                let obj = {
                    id: role.id,
                    roleName: role.roleName
                }
                this.editData = obj;
                this.editModal = true;
                this.index = index;
            },

            showDeleteData(role, index) {
                const deleteModalObj = {
                    deleteModal: true,
                    isDeleting: false,
                    deleteUrl: '/role/delete',
                    deleteData: role,
                    index: index
                }
                this.$store.commit('setDeleteData', deleteModalObj);
            }
        },

        async created() {
            const res = await this.callApi('get', '/role/get');
            if(res.status == 200) {
                this.roles = res.data;
            }else {
                this.swrong();
            }
        },

        computed: {
            ...mapGetters(['getDeleteModelObj'])
        },

        watch: {
            getDeleteModelObj(obj){
                if(obj.isDeleted) {
                    this.roles.splice(obj.index,1);
                }
            }

        },
    }
</script>
