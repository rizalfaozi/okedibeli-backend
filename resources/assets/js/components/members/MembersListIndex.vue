<template>
		<tr>
			<td data-title="No">{{ data.number }}</td>
		    <td data-title="Name">
		    	<span>{{ data.name }}</span>
		    </td>
            <td data-title="Phone">
                <span>{{ data.phone }}</span>
            </td>
		   
            <td data-title="Status" class="text-center">
                {{ data.status }}
            </td>
                

		    <td data-title="Action" class="text-center">

            <div class="btn-group" >

             <button type="button" class="pull-left btn  btn-danger" @click.prevent="someMethod(data)"><i class="fa fa-eye"></i></button>

              <button v-if="data.status === 'Y'" @click="btnActive()" type="button" class="pull-left btn btn-danger"><i v-bind:class="{'fa fa-times':isCircle, 'fa fa-spinner fa-spin':isSpinner }"></i></button>
              
              <button v-else @click="btnActive()" type="button" class="pull-left btn  btn-danger"><i v-bind:class="{'fa fa-check':isCircle, 'fa fa-spinner fa-spin':isSpinner }"></i></button>


                <router-link :to="{path: '/edit/'+data.id}" class="pull-left btn btn-danger">
                 <i class="fa fa-pencil"></i>
               </router-link>

             

              <button type="button" class="pull-left btn btn-danger" @click.prevent="someDelete(data)"><i class="fa fa-trash"></i></button>
            </div>


               

	        </td>
    	</tr>	
</template>


<script>
	
	export default {
		props:["data"],
        data() {
            return {
                loading: false,
                urlID: '',
                isCircle: true,
                isSpinner: false,
            }
        },
        computed: {
            base_url() {
                return BASE_URL;
            },
        },
        components: {
        },
        methods: {
        	someMethod(data){
        		this.$parent.showViewProfile(data);
    		},
        	btnActive() {
                const self = this;
                if(self.data.status == 'Y'){
                    self.urlID = self.data.id+'/N';
                }else{
                    self.urlID = self.data.id+'/Y';
                }
                self.isCircle = false;
                self.isSpinner = true;
                axios.post(BASE_URL + '/api/members/active/'+self.urlID).then((response) => {
                    self.$emit('getListData');
                    self.isSpinner = false;
                    self.isCircle = true;
                }).catch((error) => {
                    console.log(error);
                    self.isSpinner = false;
                    self.isCircle = true;
                });
            },
            someDelete(data){

                this.$swal({
                    buttons:true,
                    dangerMode:true,
                    title: "Apakah Anda Yakin Hapus ?",
                    icon: "warning",
                }).then((result) => {
                    if (result) {
                        this.$parent.prosesloading(true);  
                        axios.get(BASE_URL + '/api/members/delete/'+this.data.id)
                        .then((response) => {
                            console.log(response);
                            if(response.data.messages == true){
                                this.$parent.prosesloading(false);
                                this.$swal({
                                    title: "Berhasil Di Hapus",
                                    icon: "success"
                                }).then((results) => {
                                    if (results) {
                                        this.$parent.getListData();
                                    }
                                });
                            }else{
                                this.$parent.prosesloading(false);
                                this.$swal({
                                    title: "Gagal Di Hapus",
                                    icon: "error"
                                }).then((results) => {
                                    if (results) {
                                        this.$parent.getListData();
                                    }
                                });
                            }
                        }).catch((error) => {
                            console.log(error);
                        });



                        // this.$parent.loading(true);     
                                
                        // this.$swal({
                        //     title: "Berhasi Di Hapus",
                        //     icon: "success"
                        // }).then((results) => {
                        //     if (results) {
                        //         alert("berhasil");
                        //     }
                        // });

                    }
                });

            },
        }
    }

</script>