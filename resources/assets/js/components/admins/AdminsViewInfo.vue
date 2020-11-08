<template>
      <transition name="modal">
        <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block;"><div class="modal-backdrop fade in" style="height: 1282px;"></div>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" @click="$emit('close')" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                        <h2 class="modal-title">Info Profile</h2>
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
                                <tr><td align="left"><strong>ID </strong></td><td align="left">: {{ dataProfile.id }}</td></tr>
                                <tr><td align="left"><strong>Username </strong></td><td align="left">: {{ dataProfile.username }}</td></tr>
                                <tr><td align="left"><strong>Email </strong></td><td align="left">: {{ dataProfile.email }}</td></tr>
                                <tr><td align="left"><strong>Nama Lengkap </strong></td><td align="left">: {{ dataProfile.fullname }}</td></tr>
                                <tr>
                                    <td align="left"><strong>Status </strong></td><td align="left">: 
                                        <span class="fa-stack fa-lg" v-if="dataProfile.status === 'Y'"><i class="fa fa-circle-o fa-stack-2x text-success"></i><i class="fa fa-check fa-stack-1x fa-inverse text-success"></i></span>
                                        <span class="fa-stack fa-lg" v-if="dataProfile.status === 'N'"><i class="fa fa-times-circle-o fa-stack-2x text-danger"></i></span>
                                    </td>
                                </tr>
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
        props:["dataProfile"],
        data() {
            return {}
        },
        computed: {},
        components: {},
        methods: {}
    }

</script>


