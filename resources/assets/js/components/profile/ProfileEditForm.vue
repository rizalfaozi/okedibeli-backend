<template>
    <div ref="listForm">
        <div class="ws-loading" v-show="loading"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                       
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Edit Profile</h2>
            </div>
            <div class="panel-body">
                <form role="form" enctype="multipart/form-data" method="post" class="form-horizontal" @submit.prevent="postData">
                    <div class="form-group" :class="results.messages.title ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Title</label>
                        <div class="col-md-8">
                            <input type="text" v-model="title" class="form-control" placeholder="Title">
                            <label v-if="results.messages.title !== ''" for class="control-label">{{ results.messages.title }}</label>
                        </div>
                    </div>
                 
                  

                    <div class="form-group" :class="results.messages.description ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Description</label>
                        <div class="col-md-8">
                            <template>
                               <div id="app">
                                 <editor v-model="description" 
                                    api-key="05sg9fc5lueja202xjhd7alfn69aahyux8r3w6rbgpl9cg6g"
                                    :init="{
                                     height: 500,
                                     menubar: false,
                                     icons: 'small',
                                     plugins: [
                                       'advlist autolink lists link image charmap print preview anchor',
                                       'searchreplace visualblocks code fullscreen',
                                       'insertdatetime media table paste code help wordcount'
                                     ],
                                     toolbar1:'undo redo | fontselect fontsizeselect formatselect | link',
                                     toolbar2:'bold italic underline |forecolor backcolor| alignleft aligncenter alignright alignjustify | preview help',
                                     toolbar3:'bullist numlist outdent indent | table charmap',
                                   }"
                                 />
                               </div>
                             </template>
                            <label v-if="results.messages.description !== ''" for class="control-label">{{ results.messages.description }}</label>
                        </div>
                    </div>

                   
                          
                    <div class="form-group" :class="results.messages.uploadimage ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Upload Image</label>
                        <div class="col-md-8">
                            <input type="file" @change="previewImage" class="form-control" placeholder="uploadimage">
                            <label v-if="results.messages.uploadimage !== ''" for class="control-label">{{ results.messages.uploadimage }}</label>
                            <div class="image-preview" v-if="imageData.length > 0">
                                <img class="preview mt15" :src="imageData" width="100%">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-8">
                                <label class="container-checkbox" style="top:7px;">
                                  <input type="checkbox" :checked="status" v-model="status">
                                  <span class="checkmark-checkbox"></span>
                                </label>
                                <span class="fa-stack fa-lg" v-if="status === true" style="margin-left:30px; top:-9px;"><i class="fa fa-circle-o fa-stack-2x text-success"></i><i class="fa fa-check fa-stack-1x fa-inverse text-success"></i></span>

                                <span style="margin-left:30px; top:-9px;" class="fa-stack fa-lg" v-else ><i class="fa fa-times-circle-o fa-stack-2x text-danger"></i></span>
                        </div>
                    </div> 
                    
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                                                
                                <input type="hidden" v-model="file" v-if="file !== ''">
                                <button v-show="btnSubmit" type="submit" class="btn-primary btn">Submit</button>
                                <button v-show="btnLoading" type="button" class="btn-primary btn"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>
                                
                                <router-link :to="{path: '/'}">
                                    <button class="btn-default btn" v-show="btnCancel">Cancel</button>
                                </router-link>
                            </div>
                        </div>
                    </div>

                </form>
                
            </div>
        </div>





                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import localforage from 'localforage';
    
    localforage.config({
        name: 'event'
    });

    export default {
        data() {
            return {
                results: {
                    messages: {
                        title:"",

                        description:"",
                        uploadimage:"",
                      
                        
                    },
                },
                id:"",
                title:"",
              
                description:"",
                uploadimage:"",
                file:"",
                imageurl:"",
                status:false,
               
               
                
                btnLoading:false,
                btnCancel:true,
                btnSubmit:true,
                
                loading:false,
                edit:false,
                userID:"",
                imageData:"",
            }
        },
      
        mounted() {
            new Switchery(this.$refs.wan);
            this.editData();
            if(this.$route.params.id){
                console.log("aaaaa");
            }else{
                console.log("bbbbb");
            }
        },
        computed: {
            base_url() {
                return BASE_URL;
            },
        },
        components: {},
        methods: {

            previewImage: function(event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = (e) => {
                        this.imageData = e.target.result;
                    }
                    // Start the reader job - read file as a data url (base64 format)
                    reader.readAsDataURL(input.files[0]);
                    this.uploadimage = input.files[0];
                }
            },

            editData(){
                this.loading = true; 
                console.log("edit");
                this.userID = this.$route.params.id;
                console.log(this.userID);
                if(this.$route.params.id){
                    console.log("masuk");
                    axios.get(BASE_URL+'/api/profile/edit/'+this.userID)
                    .then((response) => {
                        if(response.data.id){
                            this.edit = true;
                            this.loading = false;
                            this.id=response.data.id;
                            this.title=response.data.title;
                            
                            this.description=response.data.description;
                           
                            this.status=response.data.status;
                            this.imageData = response.data.imageurl;
                            this.file = response.data.file;
                            console.log(response.data.status);
                            if(response.data.status === "Y"){
                                console.log("actived");
                                this.status = true;
                            }else{
                                this.status = false;
                            }
                        }else{
                            this.loading = false; 
                            this.$swal({
                                title: "Data Tidak Ditemukan",
                                icon: "warning"
                            }).then((result) => {
                                if (result) {
                                    this.$router.push({path:'/'})
                                }
                            });  
                        }
                    
                    }).catch((error) => {
                        console.log(error);
                        this.loading = false;
                    });
                }else{
                    this.loading = false; 
                    return false;
                }
            },

            editPostData(){
                console.log("editData");
            },

            postData() {
                console.log("postSlide");
                this.btnLoading=true;
                this.btnCancel=false;
                this.btnSubmit=false;

                let urlBase="";
        
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                
                formData.append('title', this.title);
               
                formData.append('description', this.description);
                formData.append('uploadimage', this.uploadimage);
                formData.append('file', this.file);
                formData.append('status', this.status);
             
                // for (var key of formData.entries()) {
                //     console.log(key[0] + ', ' + key[1]);
                // }

              
                    formData.append('_method', 'PUT')
                    urlBase = axios.post(BASE_URL+'/api/profile/update/'+this.userID, formData, config);
               
                
                urlBase
                .then((response) => {
                    if(response.data.id){
                        console.log("save");
                        this.$swal({
                            title: "Berhasil Di Simpan",
                            icon: "success"
                        }).then((result) => {
                            if (result) {
                                this.$router.push({path:'/'})
                            }
                        });

                    }else{
                        this.results = response.data;    
                    }
                    
                    this.btnLoading=false;
                    this.btnCancel=true;
                    this.btnSubmit=true;
                
                }).catch((error) => {
                    console.log(error);
                    this.loading = false;
                });
            },
        }
    }
</script>
