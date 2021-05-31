<template>
    <div>
        <div class="content">
			<div class="container-fluid">

				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Tags <Button @click="addModal=true"><Icon type="ios-add" />Add tag</Button></p>

					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>ID</th>
								<th>Tag Name</th>
								<th>Created at</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(tag, i) in tags" :key="i" v-if="tags.length">
								<td>{{ tag.id }}</td>
								<td class="_table_name">{{ tag.tagName }}</td>
								<td>{{ tag.created_at }}</td>
								<td>
                                    <Button type="info" size="small" @click="showEditModal(tag, i)">Edit</Button>
                                    <Button type="error" size="small" @click="showDeletingModal(tag, i)" :loading="tag.isDeleting">Delete</Button>
                                </td>
							</tr>
								<!-- ITEMS -->

						</table>
					</div>
				</div>

                <!-- tag adding modal -->
                <Modal
                    v-model="addModal"
                    title="Add tag"
                    :mask_closable="false"
                    :closable="false"

                    >
                    <Input v-model="data.tagName" placeholder="Add tag name..."/>
                    <div slot="footer">
                        <Button type="default" @click="addModal=false">Close</Button>
                        <Button type="primary" @click="addTag()" :disabled="isAdding" :loading="isAdding">{{ isAdding ? 'Adding...' : 'Add Tag' }}</Button>
                    </div>
                </Modal>

                <!-- tag Editting modal -->
                <Modal
                    v-model="editModal"
                    title="Edit tag"
                    :mask_closable="false"
                    :closable="false"

                    >
                    <Input v-model="editData.tagName" placeholder="Edit tag name..."/>
                    <div slot="footer">
                        <Button type="default" @click="editModal=false">Close</Button>
                        <Button type="primary" @click="editTag()" :disabled="isAdding" :loading="isAdding">{{ isAdding ? 'Editting...' : 'Edit Tag' }}</Button>
                    </div>
                </Modal>

                <!-- tag Deleting modal -->
                <Modal v-model="showDeleteModal" width="360">
                    <p slot="header" style="color:#f60;text-align:center">
                        <Icon type="ios-information-circle"></Icon>
                        <span>Delete confirmation</span>
                    </p>
                    <div style="text-align:center">
                        <p>Are you sure tou want to delete the Tag?</p>
                        <p>Will you delete it?</p>
                    </div>
                    <div slot="footer">
                        <Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="deleteTag">Delete</Button>
                    </div>
                </Modal>
			</div>
		</div>
    </div>
</template>

<script>

export default ({
    // memory / local data property
    data(){
        return{
            data : {
                tagName : ''
            }, 
            addModal : false,
            editModal : false,
            isAdding : false,
            tags : [],
            // Edit
            editData : {
                tagName : ''
            },
            index : -1,
            // Delete
            showDeleteModal : false,
            isDeleting : false,
            deleteItem : {},
            deletingIndex : -1
        }
    },
    methods : {
        async addTag(){
            // Front end required validation
            if(this.data.tagName.trim()=='') return this.e('Tag Name is required');

            const res = await this.callApi('post', 'app/create_tag', this.data)
            if(res.status===201){ // creation successful = 201
                this.tags.unshift(res.data);
                this.s('Tag has been added successfully!')
                this.addModal = false;
                this.isAdding = false;
                this.data.tagName ='';
            }else{
                if(res.status==422){
                    if(res.data.errors.tagName){
                        this.i(res.data.errors.tagName[0]);
                    }
                }else{
                    this.swr();
                }
            }
        },
        async editTag(){
            // Front end required validation
            if(this.editData.tagName.trim()=='') return this.e('Tag Name is required');

            const res = await this.callApi('post', 'app/edit_tag', this.editData)

            if(res.status===200){ // Edit successful = 200
            this.tags[this.index].tagName = this.editData.tagName
                this.s('Tag has been editted successfully!')
                this.editModal = false;
            }else{
                if(res.status==422){
                    if(res.editData.errors.tagName){
                        this.i(res.editData.errors.tagName[0]);
                    }
                }else{
                    this.swr();
                }
            }
        },
        showEditModal(tag, index){
            // way to disable real time changing at the back
            let obj = {
                id : tag.id,
                tagName : tag.tagName
            }
            this.editData = obj;
            this.editModal = true;
            this.index = index;
        },
        // Delete by server call
        async deleteTag(){
            // if(!confirm("Are you sure you want to delete this ?")) return
            // // add a new property that does not exist (Deleing loader)
            // this.$set(tag, 'isDeleting', true);

            this.isDeleting = true

            const res = await this.callApi('post', 'app/delete_tag', this.deleteItem)
            if (res.status==200){
                // remove local data
                this.tags.splice(this.deletingIndex, 1)
                this.s('Tag has been deleted successfully!')
            }else{
                this.swr();
            }

            this.isDeleting = false
            this.showDeleteModal = false
        },
        showDeletingModal(tag, i){
            this.deleteItem = tag
            this.deletingIndex = i
            this.showDeleteModal = true
        }
    },
    async created(){
        const res = await this.callApi('get', 'app/get_tags')
        if(res.status==200){
            this.tags = res.data;
        }else{
            this.swr();
        }
    }

})
</script>
