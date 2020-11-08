<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dokumentasi SSO Member Arkadia</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  

<style type="text/css">

.nav{
  margin:0px 0px;
}

.nav-tabs>li>a {
    color: #000;
   padding: 15px 15px;
}



.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: #fff;
    cursor: pointer;
    background-color: #ff1717; 
    border: none;
    border-right: 1px solid #ddd;
    border-bottom-color: transparent;
        padding: 16px 15px;
}
.nav-tabs>li>a:hover{
  border-color:#c50e0e #c50e0e #ff1717;
  background: #c50e0e;
  border-bottom-color: transparent;
   cursor: pointer;
  padding: 15px 15px;
  color: #fff;
}

#menu2{
border: 1px solid #ddd;
    margin: 10px 0px;
    border-radius: 5px


}


pre {
    display: block;
    padding: 9.5px;
    margin: 0 0 10px;
    font-size: 13px;
    line-height: 1.42857143;
    color: #333;
    word-break: break-all;
    word-wrap: break-word;
    background-color: #f5f5f5;
    border: none;
    border-bottom:1px solid #ccc;
    border-top: 1px solid #ccc;
    border-radius: 0px;
  }



  </style>
</head>
<body>

<div class="container">
   <h2>Dokumentasi API Akun SSO</h2>
  <p>Dokumentasi ini menjelaskan cara mengakses layanan SSO </p>


  <h2>Request</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a id="url" data-toggle="tab" href="#home">URL</a></li>
    <li><a id="param" data-toggle="tab" href="#menu1">Parameter</a></li>
    <li><a id="cth" data-toggle="tab" href="#menu2">Contoh Request</a></li>

  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
     <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Method</td>
                                    <td>URL</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>GET</td>
                                    <td>{!! url('auth') !!}</td>
                                </tr>
                            </tbody>
      </table>
    </div>
    <div id="menu1" class="tab-pane fade">
     <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Method</td>
                                    <td>Parameter</td>
                                    <td>Wajib</td>
                                    <td>Tipe</td>
                                    <td>Keterangan</td>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr>
                                    <td>GET</td>
                                    <td>Auth</td>
                                    <td>Ya</td>
                                    <td>String</td>
                                    <td>Login akses SSO</td>
                                </tr>
                            </tbody>
                        </table>
    </div>



    <div id="menu2" class="tab-pane fade">
      <ul class="nav nav-tabs">
        <li class="" style="">
          <li  class="active" style="">
            <a id="php-curl" href="#php-curl" data-toggle="tab" aria-expanded="true">PHP</a>
          </li>
          <li  style="">
            <a id="java-okhttp"  href="#java-okhttp" data-toggle="tab">Javascript</a>
          </li>
          
        </ul>
        
        <div class="class="tab-content"  style"height: 404px;">

        <div id="php-curl1" class="tab-pane fade in">
       
       <pre><code id="php-curl-code" class="php hljs"><span class="hljs-preprocessor">&lt;?php</span>

<span class="hljs-variable">$curl</span> = curl_init();

curl_setopt_array(<span class="hljs-variable">$curl</span>, <span class="hljs-keyword">array</span>(
  CURLOPT_URL =&gt; <span class="hljs-string">"https://api.rajaongkir.com/starter/province?id=12"</span>,
  CURLOPT_RETURNTRANSFER =&gt; <span class="hljs-keyword">true</span>,
  CURLOPT_ENCODING =&gt; <span class="hljs-string">""</span>,
  CURLOPT_MAXREDIRS =&gt; <span class="hljs-number">10</span>,
  CURLOPT_TIMEOUT =&gt; <span class="hljs-number">30</span>,
  CURLOPT_HTTP_VERSION =&gt; CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST =&gt; <span class="hljs-string">"GET"</span>,
  CURLOPT_HTTPHEADER =&gt; <span class="hljs-keyword">array</span>(
    <span class="hljs-string">"key: your-api-key"</span>
  ),
));

<span class="hljs-variable">$response</span> = curl_exec(<span class="hljs-variable">$curl</span>);
<span class="hljs-variable">$err</span> = curl_error(<span class="hljs-variable">$curl</span>);

curl_close(<span class="hljs-variable">$curl</span>);

<span class="hljs-keyword">if</span> (<span class="hljs-variable">$err</span>) {
  <span class="hljs-keyword">echo</span> <span class="hljs-string">"cURL Error #:"</span> . <span class="hljs-variable">$err</span>;
} <span class="hljs-keyword">else</span> {
  <span class="hljs-keyword">echo</span> <span class="hljs-variable">$response</span>;
}</code></pre>

        </div>


<div id="java-okhttp1" class="tab-pane fade">

   <pre>{
    "id": 187881,
    "username": "rizal01",
    "email": "ryzal_aditya@rocketmail.com",
    "fullname": "Rizal Faozi",
    "active": true,
    "avatar": null,
    "birthdate": null,
    "join_date": "2018-06-18 09:10:24",
    "last_login": "2018-06-18 09:11:08",
    "is_staff": false,
    "gender": null,
    "address": null,
    "city": null,
    "phone": null,
    "total_follower": 0,
    "total_following": 0
}</pre>
</div>



    </div>
   
  </div>

<h2>Response</h2>
<ul class="nav nav-tabs ro-doc-tabs">
    <li class="active"><a data-toggle="tab" href="#province-success-response">Response sukses</a></li>
    <li class=""><a data-toggle="tab" href="#province-error-response">Response gagal</a></li>
    <li ><a data-toggle="tab" href="#province-penjelasan-response">Penjelasan response</a></li>
</ul>

  <div class="tab-content">

        <div class="tab-pane fade in active" id="city-success-response">

                       
tes1



                    </div>
        <div class="tab-pane fade" id="province-error-response">
tes2
        </div>

         <div class="tab-pane fade" id="province-penjelasan-response">
             <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Komponen</td>
                                    <td>Tipe</td>
                                    <td>Keterangan</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>id</td>
                                    <td>String</td>
                                    <td>ID propinsi</td>
                                </tr>
                                <tr>
                                    <td>code</td>
                                    <td>Int</td>
                                    <td>Code status response</td>
                                </tr>
                                <tr>
                                    <td>description</td>
                                    <td>String</td>
                                    <td>Penjelasan dari kode status</td>
                                </tr>
                                <tr>
                                    <td>province_id</td>
                                    <td>String</td>
                                    <td>ID propinsi</td>
                                </tr>
                                <tr>
                                    <td>province_name</td>
                                    <td>String</td>
                                    <td>Nama propinsi</td>
                                </tr>
                            </tbody>
                        </table>
         </div> 
  </div>                 
  



                    
               

</div>

<script>

$( "#cth" ).click(function() {
   $("#php-curl1").show().addClass('in');;
    $("#java-okhttp1").hide().removeClass('in');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
});

$( "#php-curl" ).click(function() {
   $("#php-curl1").show().addClass('in');;
    $("#java-okhttp1").hide().removeClass('in');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
});

$( "#java-okhttp" ).click(function() {
    $("#php-curl1").hide().removeClass('in');
    $("#java-okhttp1").show().addClass('in');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
});

$( "#param" ).click(function() {
    $("#php-curl1").removeClass('in');
    
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
});

$( "#url" ).click(function() {
    $("#php-curl1").removeClass('in');
    
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
});

</script>







<h2>tes</h2>


<?php

$url = 'localhost/auth';

return $url;
?>
</body>
</html>
