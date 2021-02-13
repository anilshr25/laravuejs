<template>
    <!---   Delete Categorys Modal   -->
    <Modal
        :value="getDeleteModelObj.deleteModal"
        width="360"
        :mask-closable="false"
        :closable="false"
    >
        <p slot="header" style="color:#f60;text-align:center">
            <Icon type="iso-information-circle"></Icon>
            <span>Delete Conformation</span>
        </p>
        <div style="text-align:center">
            <span>Are you sure you want to delete this category?</span>
        </div>
        <div slot="footer">
            <Button type="default" @click="closeDeleteModal"
                            >Close</Button
                        >
            <Button
                type="primary"
                @click="deleteTag"
                :disabled="getDeleteModelObj.isDeleting"
                :loading="getDeleteModelObj.isDeleting"
                >{{ getDeleteModelObj.isDeleting ? "Deleting..." : "Delete Category" }}</Button
            >
        </div>
    </Modal>
</template>
<script>
    import {mapGetters} from 'vuex'

    export default {
        data() {
            return {

            }
        },
        computed: {
            ...mapGetters(['getDeleteModelObj'])
        },
        methods: {
            async deleteTag() {
                // if(!confirm('Are you sure you want to delete this tag?')) return
                // this.$set(tag, 'isDeleting', true);  // add new property which is doesn't before redenering
                this.getDeleteModelObj.isDeleting = true;
                const res = await this.callApi('post', this.getDeleteModelObj.deleteUrl, this.getDeleteModelObj.deleteData);
                if(res.status == 200) {
                    this.success('Tag has been deleted sucessfully!');
                    this.$store.commit('setDeleteModal', true);
                }else {
                    this.swrong();
                    this.$store.commit('setDeleteModal', true);
                }
                this.getDeleteModelObj.isDeleting = false;
            },
            closeDeleteModal(){
                this.$store.commit('setDeleteModal', false);
            }
        }
    }
</script>
