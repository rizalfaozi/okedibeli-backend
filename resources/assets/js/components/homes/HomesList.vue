<template>
    <div>

    <section class="content" style="height: auto !important; min-height: 0px !important;">
              <div class="row">
            <div class="col-md-3">
                <div class="amazo-tile tile-white">
                    <div class="tile-heading">
                        <div class="title">Member Perhari</div>
                        
                    </div>
                    <div class="tile-body">
                        <div class="content"><i class="fa fa-user"></i> {{ lists.total_day }} </div>
                    </div>
                    <div class="tile-footer">
                        
                        <div id="sparkline-revenue" class="sparkline-line"><canvas width="153" height="32" style="display: inline-block; width: 153px; height: 32px; vertical-align: top;"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="amazo-tile tile-white" href="#"> 
                    <div class="tile-heading">
                        <div class="title">Member Perbulan </div>
                      
                    </div>
                    <div class="tile-body">
                        <div class="content"><i class="fa fa-user"></i> {{ lists.total_month }} </div>
                    </div>
                    <div class="tile-footer text-center">
                        
                        <div id="sparkline-item" class="sparkline-bar"><canvas width="164" height="32" style="display: inline-block; width: 164px; height: 32px; vertical-align: top;"></canvas></div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="amazo-tile tile-white">
                    <div class="tile-heading">
                        <div class="title">Total Konten Pending</div>
                    
                    </div>
                    <div class="tile-body">
                        <span class="content"><i class="fa fa-info-circle"></i> {{ lists.content_pending }}</span>
                    </div>
                    <div class="tile-footer text-center">
                        
                        <div id="sparkline-item" class="sparkline-bar"><canvas width="164" height="32" style="display: inline-block; width: 164px; height: 32px; vertical-align: top;"></canvas></div>
                    </div>
                </div>
            </div>
            

            
            <div class="col-md-3">
                <div class="amazo-tile tile-white">
                    <div class="tile-heading">
                        <span class="title">Total Konten Publish</span>
                        
                    </div>
                    <div class="tile-body">
                        <span class="content"><i class="fa fa-check"></i> {{ lists.content_publish }}</span>
                    </div>
                    <div class="tile-footer">
                        
                        <div id="sparkline-commission" class="sparkline"><canvas width="153" height="32" style="display: inline-block; width: 153px; height: 32px; vertical-align: top;"></canvas></div>
                    </div>
                </div>
            </div>



        </div>
           </section>
        <div class="ws-loading" v-show="loading"></div>
        
      
        
        <div class="row">
            <div class="col-xs-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Top Member Poin</h2>
                    </div>
                    <div class="panel-body table-vertical">
                        <table class="table table-striped" id="members-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                               
                                <th>Poin</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <tr @getListData="getListData" is="ListIndex" v-for="(list,index) in lists.data" v-bind:key="list.id" :data="list"></tr>
                        </tbody>
                        </table>
                       
                    </div>
                </div>
            </div>

            <div class="col-xs-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Member Redem</h2>
                    </div>
                    <div class="panel-body table-vertical">
                        <table class="table table-striped" id="members-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                               
                                <th>Total Redem</th>
                                 <th width="200">Deksripsi</th>
                                  <th>Status</th> 
                            </tr>
                        </thead>

                        <tbody>
                            <tr @getListData="getListData" is="ListHistory" v-for="(list,history) in lists.history" v-bind:key="list.id" :history="list"></tr>
                        </tbody>
                        </table>
                       
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
                lists: {},
                viewProfile: {},
                total: 20,
                halaman: 1,
                loading: false,
                urlID: '',
                isCircle: true,
                isSpinner: false,
                showModalSearch: false,
                showModalView: false,
                isSearch: false,
                searchMessage: '',
            }
        },
        mounted() {
            console.log('mounted');
            this.getListData();
        },
        computed: {
            base_url() {
                return BASE_URL;
            },
        },
        components: {
            'ListIndex': require('./HomesListIndex.vue').default,
            'ListHistory': require('./HomesListHistory.vue').default,
        },
        methods: {
            refreshCache(){
                this.isSearch = false;
                this.getListData();
            },
            showViewProfile(data) {
                this.viewProfile = data;
                this.showModalView = true;
            },
            searchData(data) {
                
                this.isSearch = true;
                this.searchMessage = this.buildSearchMessage(data);
                this.searchParams = data;
                this.getListData();
            },
            buildSearchMessage(params) {
                let params_data = "";
                if(params.id != "") {
                    params_data += "id = " + params.id;
                }
                if(params.username != "") {
                    params_data += "username = " + params.username;
                }
                if(params.email != "") {
                    params_data += "email = " + params.email;
                }
                if(params.fullname != "") {
                    params_data += "fullname = " + params.fullname;
                }
                
                return "Search result for " + params_data;
            },
            getListData() {
                const self = this;
                let q = {};
                let listUrl = "";
                //save page number
                self.loading = true;
                if (this.isSearch) {
                    q = {
                        id: this.searchParams.id,
                        username: this.searchParams.username,
                        email: this.searchParams.email,
                        fullname: this.searchParams.fullname,
                        order: this.searchParams.buildOrderStr,
                        page: self.halaman
                    }
                    listUrl = BASE_URL + '/api/homes/search';
                }else{
                    q = {page: self.halaman}
                    listUrl = BASE_URL + '/api/homes/lists';    
                }

                axios.get(listUrl, {
                    params: q
                }).then((response) => {
                    self.lists = response.data;
                    self.halaman = response.data.currentPage;
                    self.total = response.data.lastPage;
                    self.loading = false;
                }).catch((error) => {
                    console.log(error);
                    self.loading = false;
                });
            },
        }
    }
</script>
