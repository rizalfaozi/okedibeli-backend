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
                <form role="form" enctype="multipart/form-data" method="post" class="form-horizontal" @submit.prevent="postSlide">
                    <div class="form-group" :class="results.messages.titleslide ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Title</label>
                        <div class="col-md-8">
                            <input type="text" v-model="titleslide" class="form-control" placeholder="Title">
                            <label v-if="results.messages.titleslide !== ''" for class="control-label">{{ results.messages.titleslide }}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="results.messages.url ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Url</label>
                        <div class="col-md-8">
                            <input type="text" v-model="url" class="form-control" placeholder="Url">
                            <label v-if="results.messages.url !== ''" for class="control-label">{{ results.messages.url }}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="results.messages.position ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Position</label>
                        <div class="col-md-8">
                            <input type="text" v-model="position" class="form-control" placeholder="Position">
                            <label v-if="results.messages.position !== ''" for class="control-label">{{ results.messages.position }}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="results.messages.startdate ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Strat Date</label>
                        <div class="col-md-8">
                            <datetime type="datetime" v-model="startdate" value-zone="Asia/Jakarta" format="yyyy-MM-dd HH:mm:ss"></datetime>
                            <label v-if="results.messages.startdate !== ''" for class="control-label">{{ results.messages.startdate }}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="results.messages.enddate ? 'has-error' : ''">
                        <label class="col-md-2 control-label">End Date</label>
                        <div class="col-md-8">
                            <datetime type="datetime" v-model="enddate" value-zone="Asia/Jakarta" format="yyyy-MM-dd HH:mm:ss"></datetime>
                            <label v-if="results.messages.enddate !== ''" for class="control-label">{{ results.messages.enddate }}</label>
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
    
    localforage.config({
        name: 'slide'
    });

    export default {
        data() {
            return {
                results: {
                    messages: {
                        titleslide:"",
                        url:"",
                        uploadimage:"",
                        position:"",
                        startdate:"",
                        enddate:"",
                    },
                },
                id:"",
                titleslide:"",
                url:"",
                uploadimage:"",
                image:"",
                imageurl:"",
                actived:false,
                position:"",
                startdate:"",
                enddate:"",
                
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
            this.editSlide();
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

            editSlide(){
                this.loading = true; 
                console.log("edit");
                this.userID = this.$route.params.id;
                console.log(this.userID);
                if(this.$route.params.id){
                    console.log("masuk");
                    axios.get(BASE_URL+'/api/slide/edit/'+this.userID)
                    .then((response) => {
                        if(response.data.id){
                            this.edit = true;
                            this.loading = false;
                            this.id=response.data.id;
                            this.titleslide=response.data.titleslide;
                            this.url=response.data.url;
                            this.position=response.data.position;
                            this.startdate=response.data.startdateiso;
                            this.enddate=response.data.enddateiso;
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

            editPostSlide(){
                console.log("editPostSlide");
            },

            postSlide() {
                console.log("postSlide");
                this.btnLoading=true;
                this.btnCancel=false;
                this.btnSubmit=false;

                let urlBase="";
        
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                
                formData.append('titleslide', this.titleslide);
                formData.append('url', this.url);
                formData.append('uploadimage', this.uploadimage);
                formData.append('image', this.image);
                formData.append('actived', this.actived);
                formData.append('position', this.position);
                formData.append('startdate', this.startdate);
                formData.append('enddate', this.enddate);

                // for (var key of formData.entries()) {
                //     console.log(key[0] + ', ' + key[1]);
                // }

                if(this.edit){
                    formData.append('_method', 'PUT')
                    urlBase = axios.post(BASE_URL+'/api/slide/update/'+this.userID, formData, config);
                }else{
                    urlBase = axios.post(BASE_URL+'/api/slide/postslide', formData, config);
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
