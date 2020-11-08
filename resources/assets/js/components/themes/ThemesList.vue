<template>
    <div ref="listIndex">
        <div class="ws-loading" v-show="loading"></div>
        <button class="btn btn-default pull-right mb10 mtn10" @click="refreshCache"><i class="fa fa-refresh"></i> Refresh</button>
        <button class="btn btn-default pull-right mb10 mtn10" @click="showModalSearch = true"><i class="fa fa-search"></i> Search</button>

        <router-link :to="{path: '/add'}">
            <button class="btn btn-info pull-right mb10 mtn10"><i class="fa fa-plus-circle"></i> Add</button>
        </router-link>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>List Data</h2>
                    </div>
                    <div class="panel-body table-vertical">
                        <table class="table table-striped" id="members-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th class="text-center" style="width:20%">Image</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Option</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr @getListData="getListData" is="ListIndex" v-for="(list,index) in lists.data" v-bind:key="list.id" :data="list"></tr>
                        </tbody>
                        </table>
                        <Pagination @change="getListData" v-model="halaman" :page-count="total" style="float: right"></Pagination>
                    </div>
                </div>
            </div>
        </div>

        <SearchBox v-if="showModalSearch" @close="showModalSearch=false" @search="searchData"></SearchBox>
       <ViewBox v-if="showModalView" @close="showModalView=false" :detail="viewDetail"></ViewBox>
    </div>
</template>
<script>
    import localforage from 'localforage';
  
    localforage.config({
        name: 'themes'
    });

    export default {
        data() {
            return {
                lists: {},
                viewDetail: {},
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
            'ListIndex': require('./ThemesListIndex.vue').default,
            'SearchBox': require('./ThemesListSearch.vue').default,
            'Pagination': require('vue-plain-pagination'),
            'ViewBox': require('./ThemesViewInfo.vue').default,
        },
        methods: {
            prosesloading(val){
                this.loading = val;
            },
            refreshCache(){
                this.isSearch = false;
                this.getListData();
            },
            showViewDetail(data) {
                this.viewDetail = data;
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
                    params_data += "_id = " + params._id;
                }
                if(params.title != "") {
                    params_data += "title = " + params.title;
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
                        _id: this.searchParams._id,
                        title: this.searchParams.title,
                        order: this.searchParams.buildOrderStr,
                        page: self.halaman
                    }
                    listUrl = BASE_URL + '/api/themes/search';
                }else{
                    q = {page: self.halaman}
                    listUrl = BASE_URL + '/api/themes/lists';    
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
