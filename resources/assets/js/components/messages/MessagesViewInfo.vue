<template>
      <transition name="modal">
        <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block;"><div class="modal-backdrop fade in" style="height: 1282px;"></div>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" @click="$emit('close')" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                        <h2 class="modal-title">Member Sending Blast</h2>
                    </div>
                    <div class="modal-body">
                        

<div class="row">    
    <div>
           
          <div id="countSend" class="pull-left"></div>
          <button id="play"  @click="getPlay" class="btn btn-danger mr10 mt5 mb5 pull-right" >
          <i class="fa fa-play"></i> Mulai 
          </button>
          
          <div id="btn-tombol">
              <button id="pause" style="display:none;"  @click="getPause" class="btn btn-danger mr10 mt5 mb5 pull-right" >
              <i class="fa fa-pause"></i> Pause
              </button> 

              <button id="next" style="display:none;"  @click="getNext" class="btn btn-danger mr10 mt5 mb5 pull-right" >
                <i class="fa fa-play"></i> Mulai 
              </button>

               <button id="reload" style="display:none;"  @click="getReload" class="btn btn-danger mr10 mt5 mb5 pull-right" >
                <i class="fa fa-play"></i> Mulai 
              </button>
          </div>
          
        <div class="panel panel-sky pull-left col-md-12">
          <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane active" id="domvertical">
                    <div>
                        

                        <table class="table table-striped" id="members-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th> 
                                <th class="text-center">Status</th>
                                <th class="text-center">Option</th>
                            </tr>
                        </thead>

                        <tbody id="ListDataEmail">
                      
                           
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
    import localforage from 'localforage';
  
    localforage.config({
        name: 'messages'
    });

    export default {
        props:["dataMess"],
        data() {
            return {
                lists: {},
                viewProfile: {},
                total: 20,
                halaman: 1,
                loading: false,
                urlID: '',
                isCircle: false,
                isSpinner: false,
                isPlay:true,
                isPause:false,
                isNumber:'',
                
            }
        },
        mounted() {
              
        },
        computed: {
            base_url() {
                return BASE_URL;
            },
        },
        
        methods: {

            getPlay(){
              $('#play').remove(); 
              $('#pause').show();   
              const self = this;
             
              
               
               let messages    = this.dataMess;
               var max_kode = messages.kode;
               var max_fields  = messages.total_member;

               var x = max_kode; 
              let i = x+1;
              
                axios.get(BASE_URL + '/api/messages/send/'+messages.id+'/'+ i +'').then((response) => {
                      
                    self.lists = response.data; 
                           
                    self.TableDataEmail(self.lists.data,x,max_fields);

                    setTimeout(()=>{
                      console.log(i);
                      if(self.isPlay ==true)
                      {
                        this.ReloadData(i,max_fields);
                        
                      }
                     
                    },1500);

                 
                }).catch((error) => {
                    console.log(error);
                    self.isSpinner = false;
                    self.isCircle = true;
                });

                 

            },
            ReloadData(i,max_fields){
                const self = this;
                let messages = this.dataMess;
                let x = i+1;   
                let max = max_fields+1;
                if(x < max)
                {

                    
                    axios.get(BASE_URL + '/api/messages/send/'+messages.id+'/'+ x +'').then((response) => {
                      
                    self.lists = response.data;         
                    self.TableDataEmail(self.lists.data,i,max_fields);
                            
                            setTimeout(()=>{
                              console.log(x);
                              if(self.isPlay ==true)
                              {
                                
                                this.ReloadData(x,max_fields);
                              }
                            },1500);

                 
                    }).catch((error) => {
                        console.log(error);
                        self.isSpinner = false;
                        self.isCircle = true;
                    });


                    
                }else{
                    $('#pause').hide();
                    $('#reload').show();
                }    
            },
            TableDataEmail(data,x,max_fields){
                   

                    let i = x;
                    let s = x+1;
                    this.isNumber = s;
                    let view ='';

                    view +='<tr id="no'+ s +'">';
                    view +='<td><h6> '+ data[i].number +'</h6></td>';
                    view +='<td><h6> '+ data[i].fullname +'</h6></td>';
                    view +='<td><h6>'+ data[i].email +'</h6></td>';

                    view +='<td id="'+ s +'status1" class="text-center"><h6>Proses</h6></td> <td style="display:none;" id="'+ s +'status2" class="text-center"><h6>Terkirim</h6></td>';
                                                                
                    view +='<td id="'+ s +'status3" class="text-center"> <span  class="fa-stack fa-lg"><i class="fa fa-circle-o fa-stack-2x text-danger"></i><i class="fa fa-check fa-stack-1x fa-spinner fa-spin text-danger"></i> </span></td>';

                    view +='<td id="'+ s +'status4" style="display:none;" class="text-center"> <span  class="fa-stack fa-lg"> <i class="fa fa-circle-o fa-stack-2x text-success"></i> <i class="fa fa-check fa-stack-1x fa-inverse text-success"></i> </span></td>';
                    
                    view +='</tr>';


                    setTimeout(()=>{
                
                        $('#'+ s +'status1').remove();
                        $('#'+ s +'status2').show();
                        $('#'+ s +'status3').remove();
                        $('#'+ s +'status4').show();
                        
                          
                    },1500);

                    $('#ListDataEmail').append(view);
                    
                    $('#countSend').html('<button class=" btn btn-primary mr10 mt5 mb5"><span style="color:#fff;"> Total <b>'+ s +'</b> terkirim dari <b>'+ max_fields +'</b> member </span></button>');
                    let minus = 5;
                   
                    if(s > minus)
                    {
                       let hapus = parseInt(s) - parseInt(minus);    
                       $('#no'+ hapus +'').toggle('slow');

                    } 
            },
            getPause(){
               this.isPlay = false;
               this.isPause = true;
                $('#pause').hide();
               $('#next').show();

            },
            getNext(){
                $('#pause').show();
                $('#next').hide();
                this.isPlay = true;
                this.isPause = false;
                let x = this.isNumber;
                let messages = this.dataMess;
                var max_fields  = messages.total_member;
                this.ReloadData(x,max_fields);

            },
            getReload(){
               location.reload();
            },


        }
    }
</script>


