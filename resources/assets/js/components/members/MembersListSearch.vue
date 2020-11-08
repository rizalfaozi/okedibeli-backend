<template>
      <transition name="modal">
        <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block;"><div class="modal-backdrop fade in" style="height: 1282px;"></div>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" @click="$emit('close')" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                        <h2 class="modal-title">Search</h2>
                    </div>
                    <form action="" class="form-horizontal" @submit.prevent="findContent">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ID</label>
                            <div class="col-sm-8">
                                <input type="text" v-model="id" name="id" class="form-control" placeholder="ID">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" v-model="username" name="username" class="form-control" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" v-model="email" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>   
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fullname</label>
                            <div class="col-sm-8">
                                <input type="text" v-model="fullname" name="fullname" class="form-control" placeholder="Fullname">
                            </div>
                        </div>  

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-8">
                            
                              <date-picker v-model="dates" type="date"  lang="en"  range  valueType="format" placeholder="Date" name="dates"></date-picker>

                           
                            </div>
                        </div> 

                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="$emit('close')" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

      </transition>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';

    export default {
        data() {
            return {
                id: '',
                username: '',
                email: '',
                fullname: '',
                dates:'',
                startdate:'',
                enddate:'',
                order: 'id',
                sort: 'desc',
                loading: false,
            }
        },
        computed: {
            buildOrderStr() {
                return this.order + ',' + this.sort;
            },
        },
        components: {DatePicker},
        methods: {
            findContent() {

                if(this.dates !="")
                {
                   this.startdate = this.dates[0];
                   this.enddate = this.dates[1];
                }else{
                   this.startdate = "";
                   this.enddate = "";
                }

                let srcParams = {
                    id: this.id,
                    username: this.username,
                    email: this.email,
                    fullname: this.fullname,
                    startdate:this.startdate,
                    enddate:this.enddate,
                    orderBy: this.buildOrderStr,
                };
                this.$emit('search', srcParams);
                this.$emit('close');
            },
        }
    }
</script>
