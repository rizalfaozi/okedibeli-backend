<template>
    <div>
        <div class="ws-loading" v-show="loading"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                       

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Add User Admin</h2>
            </div>
            <div class="panel-body">
                <form role="form" method="post" class="form-horizontal" @submit.prevent="postUser">
                    <div class="form-group" :class="results.messages.email ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Email</label>
                        <div class="col-md-8">
                            <div class="input-group">                           
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope-o"></i>
                                </span>
                                <input type="email" v-model="email" class="form-control" placeholder="Email">
                            </div>
                            <label v-if="results.messages.email !== ''" for class="control-label">{{ results.messages.email }}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="results.messages.fullname ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Name</label>
                        <div class="col-md-8">
                            <div class="input-group">                           
                                <span class="input-group-addon">
                                    <i class="fa fa-users"></i>
                                </span>
                                <input type="text" v-model="fullname" class="form-control" placeholder="Name">
                            </div>
                            <label v-if="results.messages.fullname !== ''" for class="control-label">{{ results.messages.fullname }}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="results.messages.username ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Username</label>
                        <div class="col-md-8">
                            <div class="input-group">                           
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="username" v-model="username" class="form-control" placeholder="username">
                            </div>
                            <label v-if="results.messages.username !== ''" for class="control-label">{{ results.messages.username }}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="results.messages.password ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Password</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="password" v-model="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <label v-if="results.messages.password !== ''" for class="control-label">{{ results.messages.password }}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="results.messages.password_confirmation ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Confirm Password</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="password" v-model="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password">
                            </div>
                            <label v-if="results.messages.password_confirmation !== ''" for class="control-label">{{ results.messages.password_confirmation }}</label>
                        </div>
                    </div>
                    
                   
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-8">
                                <div class="input-group">

                                    <label class="container-checkbox" style="top:7px;">
                                      <input type="checkbox" :checked="actived" v-model="actived">
                                      <span class="checkmark-checkbox"></span>
                                    </label>

                                    <span class="fa-stack fa-lg" v-if="actived === true" style="margin-left:30px; top:-9px;"><i class="fa fa-circle-o fa-stack-2x text-success"></i><i class="fa fa-check fa-stack-1x fa-inverse text-success"></i></span>
                                    <span style="margin-left:30px; top:-9px;" class="fa-stack fa-lg" v-else ><i class="fa fa-times-circle-o fa-stack-2x text-danger"></i></span>
                                </div>
                        </div>
                    </div>       

                    
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
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
        name: 'users'
    });

    export default {
        data() {
            return {
                results: {
                    messages: {
                        email:"",
                        fullname:"",
                        username:"",
                        password:"",
                        password_confirmation:""
                    },
                },

                id:"",
                email:"",
                fullname:"",
                username:"",
                password:"",
                password_confirmation:"",
                actived:false,
                
                btnLoading:false,
                btnCancel:true,
                btnSubmit:true,
                
                loading:false,
                edit:false,
                userID:"",
            }
        },
        mounted() {
            new Switchery(this.$refs.wan);
            this.editUser();
            console.log("query");
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
            editUser(){
                this.loading = true; 
                console.log("pppppppppp");
                this.userID = this.$route.params.id;
                console.log(this.userID);
                if(this.$route.params.id){
                    console.log("masuk");
                    axios.get(BASE_URL+'/api/users/edituser/'+this.userID)
                    .then((response) => {
                        if(response.data.id){
                            this.edit = true;
                            this.loading = false;
                            this.id=response.data.id;
                            this.email=response.data.email;
                            this.fullname=response.data.fullname;
                            this.username=response.data.username;
                            this.active=response.data.active;
                            console.log(response.data.active);
                            if(response.data.active === "Y"){
                                console.log("actived");
                                this.actived=true;
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

            editPostUser(){
                console.log("editPostUser");
            },

            postUser() {
                console.log("postUser");
                this.btnLoading=true;
                this.btnCancel=false;
                this.btnSubmit=false;

                let urlBase="";
                const postData = {
                        email:this.email,
                        name:this.fullname,
                        username:this.username,
                        password:this.password,
                        password_confirmation:this.password_confirmation,
                        actived:this.actived
                    };


                if(this.edit){
                    console.log("update");
                    urlBase = axios.put(BASE_URL+'/api/users/updateuser/'+this.userID, postData);
                }else{
                    urlBase = axios.post(BASE_URL+'/api/users/postuser', postData);
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
