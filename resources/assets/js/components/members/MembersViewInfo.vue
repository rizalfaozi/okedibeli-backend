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
        <div class="mb20">
            <center><img class="img-responsive img-circle" :src="dataProfile.avatar" style="width:20%;"></center>
        </div>
        <div class="panel panel-sky">
          <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane active" id="domvertical">
                    <div>
                        <table class="table table-striped">
                            <tbody>
                                <tr><td align="left"><strong>ID </strong></td><td align="left">: {{ dataProfile.id }}</td></tr>
                                <tr><td align="left"><strong>Bergabung </strong></td><td align="left">: {{ dataProfile.created_at }}</td></tr>
                                <tr><td align="left"><strong>Username </strong></td><td align="left">: {{ dataProfile.username }}</td></tr>
                                <tr><td align="left"><strong>Email </strong></td><td align="left">: {{ dataProfile.email }}</td></tr>
                                <tr><td align="left"><strong>Nama Lengkap </strong></td><td align="left">: {{ dataProfile.fullname }}</td></tr>
                                <tr><td align="left"><strong>Tanggal Lahir </strong></td><td align="left">: {{ dataProfile.brithday }}</td></tr>
                                <tr><td align="left"><strong>Handphone </strong></td><td align="left">: {{ dataProfile.phone }}</td></tr>
                                <tr><td align="left"><strong>Alamat </strong></td><td align="left">: {{ dataProfile.address }}</td></tr>
                                <tr><td align="left"><strong>Pekerjaan </strong></td><td align="left">: {{ dataProfile.work }}</td></tr>
                                <tr><td align="left"><strong>Facebook </strong></td><td align="left">: {{ dataProfile.facebook }}</td></tr>
                                <tr><td align="left"><strong>Instagram </strong></td><td align="left">: {{ dataProfile.instagram }}</td></tr>
                                <tr><td align="left"><strong>Twitter </strong></td><td align="left">: {{ dataProfile.twitter }}</td></tr>
                                <tr>
                                    <td align="left"><strong>Jenis Kelamin </strong></td>
                                    <td align="left">: <span><i v-if="dataProfile.gender === 'Female'" class="fa fa-female text-success ws-size-font"></i><i v-if="dataProfile.gender === 'Male'" class="fa fa-male text-success ws-size-font"></i></span>
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


