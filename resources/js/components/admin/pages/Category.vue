<template>
    <div class="container-fluid">
                <h3 class="text-dark mb-4">Category</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold"><Button @click="addModal=true"><Icon type="md-add" size="20" />Add Category</Button></p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>CategoryImg</th>
                                        <th>Category Name</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody v-if="categories.length">
                                    <tr v-for="(category, i) in categories" :key="i">
                                        <td>{{ category.id }}</td>
                                        <td><img class="rounded-circle" width="60px" height="60px" :src="category.iconImg"></td>
                                        <td>{{ category.categoryName }}</td>
                                        <td>{{ category.created_at }}</td>
                                        <td>
                                            <Button type="info" @click="showEditData(category, i)">Edit</Button>
                                            <Button type="error" @click="showDeleteData(category, i)">Delete</Button>
                                        </td>
                                    </tr>                                                                    
                                </tbody>
                            </table>
                        </div>
                       
                        <!---   Add Categorys Modal   -->
                        <Modal v-model="addModal" title="Add Categorys" :mask-closable="false" :closable="false">
                            <Input v-model="data.categoryName" placeholder="Enter Category Name" />

                            <div class="pt-2">
                                <Upload ref="uploads" action="/category/upload" :headers="{'x-csrf-token': token, 'X-Requested-With': 'XMLHttpRequest'}" 
                                :max-size="1048" :on-error="handleError" :on-success="handleSuccess" :format="['jpg', 'jpeg', 'png']" :on-format-error="handleFormatError" :on-exceeded-size="handleMaxSize">
                                    <Button icon="ios-cloud-upload-outline">Upload files</Button>
                                </Upload>
                                <div class="img-preview pt-3 rounded-circle" v-if="data.iconImg">
                                    <img :src="`${data.iconImg}`">
                                    <div class="img-preview-cover">
                                        <Icon type="ios-trash-outline" @click="deleteImg"></Icon>
                                    </div>
                                </div>
                            </div>
                            <div slot="footer">
                                <Button type="default" @click="addModal=false">Close</Button>
                                <Button type="primary" @click="addCategory" :disabled="isAdding" :loading="isAdding">{{ isAdding ? 'Adding...' : 'Add Category' }}</Button>
                            </div>
                        </Modal>

                        <!---   Edit Categorys Modal   -->
                        <Modal v-model="editModal" title="Edit Categorys" :mask-closable="false" :closable="false">
                            <Input v-model="editData.categoryName" placeholder="Edit Category Name" />

                            <div class="pt-2">
                                <Upload v-show="isIconImgNew" ref="editDataUpload" action="/category/upload" :headers="{'x-csrf-token': token, 'X-Requested-With': 'XMLHttpRequest'}" 
                                :max-size="1048" :on-error="handleError" :on-success="handleSuccess" :format="['jpg', 'jpeg', 'png']" :on-format-error="handleFormatError" :on-exceeded-size="handleMaxSize">
                                    <Button icon="ios-cloud-upload-outline">Upload files</Button>
                                </Upload>
                                <div class="img-preview pt-3 rounded-circle" v-if="editData.iconImg">
                                    <img :src="`${editData.iconImg}`">
                                    <div class="img-preview-cover">
                                        <Icon type="ios-trash-outline" @click="deleteImg(false)"></Icon>
                                    </div>
                                </div>
                            </div>

                            <div slot="footer">
                                <Button type="default" @click="closeEditModal">Close</Button>
                                <Button type="primary" @click="editCategory" :disabled="isEditing" :loading="isEditing">{{ isEditing ? 'Editing...' : 'Edit Category' }}</Button>
                            </div>
                        </Modal>

                        <!---   Delete Categorys Modal   -->
                        <Modal v-model="deleteModal" width="360" :mask-closable="false" :closable="false">
                           <p slot="header" style="color:#f60;text-align:center">
                                <Icon type="iso-information-circle"></Icon>
                                <span>Delete Conformation</span>
                           </p>
                           <div style="text-align:center">
                                <span>Are you sure you want to delete this category?</span>
                           </div>
                            <div slot="footer">
                                <Button type="primary" @click="deleteCategory()" :disabled="isDeleting" long :loading="isDeleting">{{ isDeleting ? 'Deleting...' : 'Delete Category' }}</Button>
                            </div>
                        </Modal> 

                    </div>
                </div>
            </div>
</template>
<script>
    export default {
        data() {
            return {
                data: {
                    iconImg: '',
                    categoryName: ''
                },
                addModal: false,
                editModal: false,
                deleteModal: false,
                isAdding: false,
                isEditing: false,
                isDeleting: false,
                categories: [],
                editData: {
                    iconImg: '',
                    categoryName: ''
                },
                deleteData: {},
                index: -1,
                token: '',
                isIconImgNew: false,
                isEditingIconImg: false
            }
        },
        methods: {
            async addCategory() {
                if(this.data.categoryName.trim() == '') return this.error('Category Name is required!!');
                if(this.data.iconImg.trim() == '') return this.error('Category Image is required!!');
                const res = await this.callApi('post', '/category/add_category', this.data);
                if(res.status == 201) {
                    this.categories.unshift(res.data);
                    this.success('Category has been added sucessfully!');
                    this.addModal = false;
                    this.data.categoryName = '';
                    this.data.iconImg = '';
                    this.$refs.uploads.clearFiles();
                }else {
                    if(res.status == 422){
                        if(res.data.errors.categoryName){
                            this.error(res.data.errors.categoryName[0]);
                        }
                    } else {
                        this.swrong();
                    }                    
                }
            },

            async editCategory() {
                if(this.editData.categoryName.trim() == '') return this.error('Category Name is required!!')
                if(this.editData.iconImg.trim() == '') return this.error('Category Image is required!!');
                const res = await this.callApi('post', '/category/edit_category', this.editData);
                if(res.status == 200) {
                    this.categories[this.index].categoryName = this.editData.categoryName;
                    this.success('Category has been edited sucessfully!');
                    this.editModal = false;
                }else {
                    if(res.status == 422){
                        if(res.data.errors.categoryName){
                            this.error(res.data.errors.categoryName[0]);
                        }
                    } else {
                        this.swrong();
                    }                    
                }
            },

            showEditData(category, index) {
                this.editData = category;
                this.editModal = true;
                this.index = index;
                this.isEditingIconImg = true;
            },

            closeEditModal(){
                this.editModal = false;
                this.isEditingIconImg = false;
            },

            async deleteCategory() {
                // if(!confirm('Are you sure you want to delete this category?')) return
                // this.$set(category, 'isDeleting', true);  // add new property which is doesn't before redenering 
                this.isDeleting = true;
                const res = await this.callApi('post', '/category/delete_category', this.deleteData);
                if(res.status == 200) {
                    this.categories.splice(this.index, 1);
                    this.success('Category has been deleted sucessfully!');
                }else {
                    this.swrong();             
                }
                this.isDeleting = false;
                this.deleteModal = false;
            },

            showDeleteData(category, index) {
                this.deleteData = category;
                this.index = index;
                this.deleteModal = true;                
            },

            async deleteImg(isAdding=true) {
                let img = '';
                if(!isAdding){ //for Editing
                    img = this.editData.iconImg;
                    this.editData.iconImg = '';
                    this.isIconImgNew = true;
                    this.$refs.editDataUpload.clearFiles();
                }else {
                    img = this.data.iconImg;
                    this.data.iconImg = '';
                    this.$refs.uploads.clearFiles();
                }

                if(img != null) {
                    const res = await this.callApi('post', '/category/delete_img', {imageName: img});
                    if(res.status !=200 ) {
                        this.data.iconImg = image;
                        this.swrong();
                    }
                }
            },

            handleSuccess (res) {
                res = `/uploads/category/${res}`;
                if(this.isEditingIconImg){
                    return this.editData.iconImg = res;
                }
                this.data.iconImg = res;
            },

            handleError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: `${file.errors.file.length ? file.errors.file[0] : 'Something Went Wrong! Please try again'}`
                });
            },

            handleFormatError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: 'File format of' + file.name + 'is incorrect, Please Select jpg or png.'
                });
            },

            handleMaxSize (file) {
                this.$Notice.warning({
                    title: 'Exceeding file size limit',
                    desc: file.name + 'is too large, File should less 1MB.'
                });
            },
        },
        
        async created() {
            this.token = window.Laravel.csrfToken;
            const res = await this.callApi('get', '/category/get_category');
            if(res.status == 200) {
                this.categories = res.data;
            }else {
                this.swrong();
            }
        }
    }
</script>