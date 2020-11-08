<template>
        <tr>
            <td data-title="No"><h6>{{ data.number }}</h6></td>
            <td data-title="Fullname">
                <h6> {{ data.fullname }}</h6>
            </td>
            <td data-title="Email">
                <h6> {{ data.email }}</h6>
            </td>
           
            <td data-title="Status" class="text-center">
               <h6 v-if="isCircle === false"> Proses</h6>
                <h6 v-if="isCircle === true"> Terkirim</h6>

            </td>

            <td data-title="Option" class="text-center">


                  <span  class="fa-stack fa-lg">
                <i v-bind:class="{'fa fa-circle-o fa-stack-2x text-success':isCircle, 'fa fa-circle-o fa-stack-2x text-danger':isSpinner }" ></i>
                <i v-bind:class="{'fa fa-check fa-stack-1x fa-inverse text-success':isCircle, 'fa fa-check fa-stack-1x fa-spinner fa-spin text-danger':isSpinner }" ></i>
             </span>
                  
                
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
                isCircle: false,
                isSpinner: true,
            }
        },
        mounted() {
           
            this.TimeOut();
        },
        computed: {
            base_url() {
                return BASE_URL;
            },
        },
        components: {
        },
        methods: {
        TimeOut() {
              var test; 
              const self = this;     
              test = setTimeout(function() {
             
                   
                  self.isCircle = true;
                  self.isSpinner = false;
                  
              }, 1000);

         },
         getListData() {
              
                const self = this; 
                self.isCircle = false;
                self.isSpinner = true;
                axios.get(BASE_URL + '/api/messages/send/'+dataMess.id+'/2').then((response) => {
                  self.lists = response.data;
                    self.isSpinner = true;
                    self.isCircle = false;
                }).catch((error) => {
                    console.log(error);
                    self.isSpinner = false;
                    self.isCircle = true;
                });
             
          }
            
                

          
           
        }
    }

</script>