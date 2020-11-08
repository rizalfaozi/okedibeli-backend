<template>
    <div>
        <div class="ws-loading" v-show="loading"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                       

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Add Member</h2>
            </div>
            <div class="panel-body">
                <form role="form" method="post" class="form-horizontal" @submit.prevent="postData">

                   <div class="form-group" :class="results.messages.office_name ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Office Name</label>
                        <div class="col-md-8">
                                                      
                               
                                <input type="text" v-model="office_name" class="form-control" placeholder="Office Name">
                          
                            <label v-if="results.messages.office_name !== ''" for class="control-label">{{ results.messages.office_name }}</label>
                        </div>
                    </div>

                    <div class="form-group" :class="results.messages.email ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Email</label>
                        <div class="col-md-8">
                                                     
                               
                                <input type="email" v-model="email" class="form-control" placeholder="Email">
                          
                            <label v-if="results.messages.email !== ''" for class="control-label">{{ results.messages.email }}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="results.messages.username ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Username</label>
                        <div class="col-md-8">
                                                      
                              
                                <input type="username" v-model="username" class="form-control" placeholder="username">
                           
                            <label v-if="results.messages.username !== ''" for class="control-label">{{ results.messages.username }}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="results.messages.fullname ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Fullname</label>
                        <div class="col-md-8">
                                                     
                               
                                <input type="text" v-model="fullname" class="form-control" placeholder="Fullname">
                            
                            <label v-if="results.messages.fullname !== ''" for class="control-label">{{ results.messages.fullname }}</label>
                        </div>
                    </div>

                    <div class="form-group" :class="results.messages.address ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Address</label>
                        <div class="col-md-8">
                                                       
                               
                                <textarea v-model="address" class="form-control" style="width:448px;height:250px;"></textarea>
                           
                            <label v-if="results.messages.address !== ''" for class="control-label">{{ results.messages.address }}</label>
                        </div>
                    </div>


                   <div class="form-group" :class="results.messages.domain ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Domain</label>
                        <div class="col-md-8">
                                                      
                               
                                <input type="text" v-model="domain" class="form-control" placeholder="Domain">
                            
                            <label v-if="results.messages.domain !== ''" for class="control-label">{{ results.messages.domain }}</label>
                        </div>
                    </div>

                    <div class="form-group" :class="results.messages.packet ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Packet</label>
                        <div class="col-md-8">
                                                     
                               
                                <input type="text" v-model="packet" class="form-control" placeholder="Packet">
                           
                            <label v-if="results.messages.packet !== ''" for class="control-label">{{ results.messages.packet }}</label>
                        </div>
                    </div>

                    <div class="form-group" :class="results.messages.date_start ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Date Start</label>
                        <div class="col-md-8">


                            <datetime type="datetime" v-model="date_start" value-zone="Asia/Jakarta" format="yyyy-MM-dd HH:mm:ss"></datetime>
                            
                           
                            <label v-if="results.messages.date_start !== ''" for class="control-label">{{ results.messages.date_start }}</label>
                        </div>
                    </div>

                    <div class="form-group" :class="results.messages.date_end ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Date End</label>
                        <div class="col-md-8">
                                                      
                               
                            <datetime type="datetime" v-model="date_end" value-zone="Asia/Jakarta" format="yyyy-MM-dd HH:mm:ss"></datetime>

                            <label v-if="results.messages.date_end !== ''" for class="control-label">{{ results.messages.date_end }}</label>
                        </div>
                    </div>

                    <div class="form-group" :class="results.messages.password ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Password</label>
                        <div class="col-md-8">
                           
                                
                                <input type="password" v-model="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          
                            <label v-if="results.messages.password !== ''" for class="control-label">{{ results.messages.password }}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="results.messages.password_confirmation ? 'has-error' : ''">
                        <label class="col-md-2 control-label">Confirm Password</label>
                        <div class="col-md-8">
                          
                               
                                <input type="password" v-model="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password">
                            
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
        name: 'members'
    });

    export default {
        data() {
            return {
                results: {
                    messages: {
                        office_name:"",
                        email:"",
                        fullname:"",
                        username:"",
                        address:"",
                        domain:"",
                        packet:"",
                        date_start:"",
                        date_end:"",
                        password:"",
                        password_confirmation:""
                    },
                },

                id:"",
                office_name:"",
                email:"",
                fullname:"",
                username:"",
                address:"",
                domain:"",
                packet:"",
                date_start:"",
                date_end:"",
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
            this.editData();
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
            editData(){
                this.loading = true; 
                console.log("pppppppppp");
                this.userID = this.$route.params.id;
                console.log(this.userID);
                if(this.$route.params.id){
                    console.log("masuk");
                    axios.get(BASE_URL+'/api/members/edituser/'+this.userID)
                    .then((response) => {
                        if(response.data.id){
                            this.edit = true;
                            this.loading = false;
                            this.id=response.data.id;
                            this.office_name=response.data.office_name;
                            this.email=response.data.email;
                            this.fullname=response.data.fullname;
                            this.username=response.data.username;
                            this.address=response.data.address;
                            this.domain=response.data.domain;
                            this.packet=response.data.packet;
                            this.date_start=response.data.date_start;
                            this.date_end=response.data.date_end;
                            this.status=response.data.status;
                            console.log(response.data.status);
                            if(response.data.status === "Y"){
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

            editPostData(){
                console.log("editPostUser");
            },

            postData() {
                console.log("postUser");
                this.btnLoading=true;
                this.btnCancel=false;
                this.btnSubmit=false;

                let urlBase="";
                const postData = {
                        office_name:this.office_name,
                        email:this.email,
                        fullname:this.fullname,
                        username:this.username,
                        address:this.address,
                        domain:this.domain,
                        packet:this.packet,
                        date_start:this.date_start,
                        date_end:this.date_end,
                        password:this.password,
                        password_confirmation:this.password_confirmation,
                        status:this.actived
                    };


                if(this.edit){
                    console.log("update");
                    urlBase = axios.put(BASE_URL+'/api/members/update/'+this.userID, postData);
                }else{
                    urlBase = axios.post(BASE_URL+'/api/members/post', postData);
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
