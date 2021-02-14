<template>
    <div class="container-fluid">
                <h3 class="text-dark mb-4">Tags</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold"><Button @click="addModal=true"><Icon type="md-add" size="20" />Add Tag</Button></p>
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
                                        <th>Tag Name</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody v-if="tags.length">
                                    <tr v-for="(tag, i) in tags" :key="i">
                                        <td>{{ tag.id }}</td>
                                        <td>{{ tag.tagName }}</td>
                                        <td>{{ tag.created_at }}</td>
                                        <td>
                                            <Button type="info" @click="showEditData(tag, i)">Edit</Button>
                                            <Button type="error" @click="showDeleteData(tag, i)">Delete</Button>
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

                        <!---   Add Tags Modal   -->
                        <Modal v-model="addModal" title="Add Tags" :mask-closable="false" :closable="false">
                            <Input v-model="data.tagName" placeholder="Enter Tag Name" />
                            <div slot="footer">
                                <Button type="default" @click="addModal=false">Close</Button>
                                <Button type="primary" @click="addTag" :disabled="isAdding" :loading="isAdding">{{ isAdding ? 'Adding...' : 'Add Tag' }}</Button>
                            </div>
                        </Modal>

                        <!---   Edit Tags Modal   -->
                        <Modal v-model="editModal" title="Edit Tags" :mask-closable="false" :closable="false">
                            <Input v-model="editData.tagName" placeholder="Edit Tag Name" />
                            <div slot="footer">
                                <Button type="default" @click="editModal=false">Close</Button>
                                <Button type="primary" @click="editTag" :disabled="isEditing" :loading="isEditing">{{ isEditing ? 'Editing...' : 'Edit Tag' }}</Button>
                            </div>
                        </Modal>

                        <!---   Delete Tags Modal
                        <Modal v-model="deleteModal" width="360" :mask-closable="false" :closable="false">
                           <p slot="header" style="color:#f60;text-align:center">
                                <Icon type="iso-information-circle"></Icon>
                                <span>Delete Conformation</span>
                           </p>
                           <div style="text-align:center">
                                <span>Are you sure you want to delete this tag?</span>
                           </div>
                            <div slot="footer">
                                <Button type="default" @click="deleteModal=false">Close</Button>s
                                <Button type="primary" @click="deleteTag()" :disabled="isDeleting" long :loading="isDeleting">{{ isDeleting ? 'Deleting...' : 'Delete Tag' }}</Button>
                            </div>
                        </Modal>  -->

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
                    tagName: ''
                },
                addModal: false,
                editModal: false,
                isAdding: false,
                isEditing: false,
                isDeleting: false,
                tags: [],
                editData: {
                    tagName: ''
                },
                deleteData: {},
                index: -1
            }
        },
        methods: {
            async addTag() {
                if(this.data.tagName.trim() == '') return this.error('Tag Name is required!!')
                const res = await this.callApi('post', '/tag/add', this.data);
                if(res.status == 201) {
                    this.tags.unshift(res.data);
                    this.success('Tag has been added sucessfully!');
                    this.addModal = false;
                    this.data.tagName = '';
                }else {
                    if(res.status == 422){
                        if(res.data.errors.tagName){
                            this.error(res.data.errors.tagName[0]);
                        }
                    } else {
                        this.swrong();
                    }
                }
            },

            async editTag() {
                if(this.editData.tagName.trim() == '') return this.error('Tag Name is required!!')
                const res = await this.callApi('post', '/tag/edit', this.editData);
                if(res.status == 200) {
                    this.tags[this.index].tagName = this.editData.tagName;
                    this.success('Tag has been edited sucessfully!');
                    this.editModal = false;
                }else {
                    if(res.status == 422){
                        if(res.data.errors.tagName){
                            this.error(res.data.errors.tagName[0]);
                        }
                    } else {
                        this.swrong();
                    }
                }
            },

            showEditData(tag, index) {
                let obj = {
                    id: tag.id,
                    tagName: tag.tagName
                }
                this.editData = obj;
                this.editModal = true;
                this.index = index;
            },

            // async deleteTag() {
            //     // if(!confirm('Are you sure you want to delete this tag?')) return
            //     // this.$set(tag, 'isDeleting', true);  // add new property which is doesn't before redenering
            //     this.isDeleting = true;
            //     const res = await this.callApi('post', '/tag/delete', this.deleteData);
            //     if(res.status == 200) {
            //         this.tags.splice(this.index, 1);
            //         this.success('Tag has been deleted sucessfully!');
            //     }else {
            //         this.swrong();
            //     }
            //     this.isDeleting = false;
            // },

            showDeleteData(tag, index) {
                const deleteModalObj = {
                    deleteModal: true,
                    isDeleting: false,
                    deleteUrl: '/tag/delete',
                    deleteData: tag,
                    index: index
                }
                this.$store.commit('setDeleteData', deleteModalObj);
            }
        },

        async created() {
            const res = await this.callApi('get', '/tag/get');
            if(res.status == 200) {
                this.tags = res.data;
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
                    this.tags.splice(obj.index,1);
                }
            }

        },
    }
</script>
