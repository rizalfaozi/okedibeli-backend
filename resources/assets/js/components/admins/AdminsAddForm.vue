<template>
    <div>
        <div class="ws-loading" v-show="loading"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                       

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Add Admin</h2>
            </div>
            <div class="panel-body">
                <form role="form" method="post" class="form-horizontal" @submit.prevent="postUser">
                   
                    
                    <div class="form-group" :class="results.messages.name ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Username</label>
                        <div class="col-md-8">
                            <div class="input-group">                           
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="name" v-model="name" class="form-control" placeholder="username">
                            </div>
                            <label v-if="results.messages.name !== ''" for class="control-label">{{ results.messages.name }}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="results.messages.phone ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Phone</label>
                        <div class="col-md-8">
                            <div class="input-group">                           
                                <span class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <input type="number" v-model="phone" class="form-control" placeholder="Phone">
                            </div>
                            <label v-if="results.messages.phone !== ''" for class="control-label">{{ results.messages.phone }}</label>
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
                                      <input type="checkbox" :checked="actived" v-model="status">
                                      <span class="checkmark-checkbox"></span>
                                    </label>

                                    <span class="fa-stack fa-lg" v-if="status === true" style="margin-left:30px; top:-9px;"><i class="fa fa-circle-o fa-stack-2x text-success"></i><i class="fa fa-check fa-stack-1x fa-inverse text-success"></i></span>
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
        name: 'admin'
    });

    export default {
        data() {
            return {
                results: {
                    messages: {
                        name:"",
                        phone:"",
                        password:"",
                        password_confirmation:"",
                        status:"",
                    },
                },

                id:"",
               
                name:"",
                phone:"",
                password:"",
                password_confirmation:"",
                status:"",
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
           
        },
        computed: {
            base_url() {
                return BASE_URL;
            },
        },
        components: {},
        methods: {
           

            postUser() {
                this.btnLoading=true;
                this.btnCancel=false;
                this.btnSubmit=false;
                let urlBase="";

                const postData = {
                        name:this.name,
                        phone:this.phone,
                        password:this.password,
                        password_confirmation:this.password_confirmation,
                        status:this.status
                    };

                urlBase = axios.post(BASE_URL+'/api/users/postuser', postData);
                
                
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
