<template>
      <transition name="modal">
        <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block;"><div class="modal-backdrop fade in" style="height: 1282px;"></div>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" @click="$emit('close')" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                        <h2 class="modal-title">Detail Profile</h2>
                    </div>
                    <div class="modal-body">
                        

<div class="row">    
    <div>
       
        <div class="panel panel-sky">
          <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane active" id="domvertical">
                    <div>
                        <table class="table table-striped">
                            <tbody>
                                <tr><td align="left"><strong>ID </strong></td><td align="left"> </td></tr>

                                 <tr><td align="left"> {{ detail.id }}</td></tr>               

                                <tr><td align="left"><strong>Title </strong></td><td align="left"> </td></tr>

                                <tr><td align="left"> {{ detail.title }}</td></tr> 
                                 <tr><td align="left"><strong>Description </strong></td><td align="left"></td></tr>  
                                <tr><td align="left"> {{ detail.description }}</td></tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>



                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

      </transition>
</template>

<script>
    
    export default {
        props:["detail"],
        data() {
            return {}
           
        },

        computed: {},
        components: {},
        methods: {}
    }

</script>


