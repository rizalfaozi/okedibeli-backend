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
                            <label class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-8">
                                <input type="text" v-model="titleredeem" name="titleredeem" class="form-control" placeholder="Title">
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
    export default {
        data() {
            return {
                titleredeem: '',
                order: '_id',
                sort: 'desc',
                loading: false,
            }
        },
        computed: {
            buildOrderStr() {
                return this.order + ',' + this.sort;
            },
        },
        components: {},
        methods: {
            findContent() {
                let searchParams = {
                    titleredeem: this.titleredeem,
                    orderBy: this.buildOrderStr,
                };
                console.log(searchParams);
                this.$emit('search', searchParams);
                this.$emit('close');
            },
        }
    }
</script>
