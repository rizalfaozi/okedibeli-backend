<template>
    <div ref="listForm">
        <div class="ws-loading" v-show="loading"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                       
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Add Slide</h2>
            </div>
            <div class="panel-body">
                <form role="form" enctype="multipart/form-data" method="post" class="form-horizontal" @submit.prevent="postRedeem">
                    <div class="form-group" :class="results.messages.titleredeem ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Title</label>
                        <div class="col-md-8">
                            <input type="text" v-model="titleredeem" class="form-control" placeholder="Title">
                            <label v-if="results.messages.titleredeem !== ''" for class="control-label">{{ results.messages.titleredeem }}</label>
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

                    <div class="form-group" :class="results.messages.position ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Position</label>
                        <div class="col-md-8">
                            <select v-model="position" class="form-control">
                                 <option v-for="pos in 10" :selected="pos === position">{{ pos }}</option>
                            </select>
                             <label v-if="results.messages.position !== ''" for class="control-label">{{ results.messages.position }}</label>
                        </div>
                    </div>
                    
                    <div class="form-group" :class="results.messages.type ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Type</label>
                        <div class="col-md-8">
                            <div class="col-sm-3 mt15 n">
                                <label class="container-radio">    
                                  <input type="radio" :checked="type" value="article" v-model="type">
                                  <span class="checkmark-radio"></span>
                                  <h5>Article</h5>
                                </label>
                            </div>
                            <div class="col-sm-3 mt15 n">
                                <label class="container-radio">
                                  <input type="radio" :checked="type" value="point" v-model="type">
                                  <span class="checkmark-radio"></span>
                                  <h5>Point</h5>
                                </label>
                            </div>
                            <div class="mt40 ws-clearfix">
                                <label v-if="results.messages.type !== ''" for class="control-label">{{ results.messages.type }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" :class="results.messages.point ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Point</label>
                        <div class="col-md-8">
                            <input type="text" v-model="point" class="form-control" placeholder="Point">
                            <label v-if="results.messages.point !== ''" for class="control-label">{{ results.messages.point }}</label>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-8">
                                <label class="container-checkbox" style="top:7px;">
                                  <input type="checkbox" :checked="actived" v-model="actived">
                                  <span class="checkmark-checkbox"></span>
                                </label>
                                <span class="fa-stack fa-lg" v-if="actived === true" style="margin-left:30px; top:-9px;"><i class="fa fa-circle-o fa-stack-2x text-success"></i><i class="fa fa-check fa-stack-1x fa-inverse text-success"></i></span>
                                <span style="margin-left:30px; top:-9px;" class="fa-stack fa-lg" v-else ><i class="fa fa-times-circle-o fa-stack-2x text-danger"></i></span>
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
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                                                
                                <input type="hidden" v-model="image" v-if="image !== ''">
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
    import Editor from '@tinymce/tinymce-vue'
    
    localforage.config({
        name: 'redeem'
    });

    export default {
        data() {
            return {
                editorConfig: {
                    height:'250',
                },
                results: {
                    messages: {
                        titleredeem:"",
                        description:"",
                        type:"",
                        point:"",
                        uploadimage:"",
                        position:"",
                    },
                },
                id:"",
                titleredeem:"",
                description:"",
                type:"",
                point:"",
                uploadimage:"",
                image:"",
                imageurl:"",
                actived:false,
                position:"",
                
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
            this.editRedeem();
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
        components: {
            'editor': Editor
        },
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

            editRedeem(){
                this.loading = true; 
                console.log("edit");
                this.userID = this.$route.params.id;
                console.log(this.userID);
                if(this.$route.params.id){
                    console.log("masuk");
                    axios.get(BASE_URL+'/api/redeem/edit/'+this.userID)
                    .then((response) => {
                        if(response.data.id){
                            this.edit = true;
                            this.loading = false;
                            this.id=response.data.id;
                            this.titleredeem=response.data.titleredeem;
                            this.description=tinymce.activeEditor.setContent(response.data.description);
                            this.type=response.data.type;
                            this.point=response.data.point;
                            this.position=response.data.position;
                            this.active=response.data.active;
                            this.imageData = response.data.imageurl;
                            this.image = response.data.image;
                            console.log(response.data.active);
                            if(response.data.active === "Y"){
                                console.log("actived");
                                this.actived = true;
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

            editPostRedeem(){
                console.log("editPostRedeem");
            },

            postRedeem() {
                console.log("postRedeem");
                this.btnLoading=true;
                this.btnCancel=false;
                this.btnSubmit=false;

                let urlBase="";
        
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                
                formData.append('titleredeem', this.titleredeem);
                formData.append('description', this.description);
                formData.append('type', this.type);
                formData.append('point', this.point);
                formData.append('uploadimage', this.uploadimage);
                formData.append('image', this.image);
                formData.append('actived', this.actived);
                formData.append('position', this.position);
              
                // for (var key of formData.entries()) {
                //     console.log(key[0] + ', ' + key[1]);
                // }

                if(this.edit){
                    formData.append('_method', 'PUT')
                    urlBase = axios.post(BASE_URL+'/api/redeem/update/'+this.userID, formData, config);
                }else{
                    urlBase = axios.post(BASE_URL+'/api/redeem/postsredeem', formData, config);
                }
                
                urlBase
                .then((response) => {
                    if(response.data.id){
                        console.log("save");
                        this.$swal({
                            title: "Berhasi Di Simpan",
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
