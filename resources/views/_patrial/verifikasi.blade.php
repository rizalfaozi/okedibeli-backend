<html style="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Suara.com">
    <meta name="robots" content="noindex,nofollow">
    <!-- App Favicon icon -->
  
    <!-- App Title -->
    <title><?php echo $title;?> |  <?php echo $name;?> </title>

  <style type="text/css">
html{
 background-color: #fff;   
}
body {
    font-family: "Arial", sans-serif;
    letter-spacing: 0.4px;
    padding-bottom: 65px;
    background-color: #fff;
    max-width: 100%;
}
.panel-heading {
    border: none !important;
    padding: 10px 20px 0px 20px;
}

.panel-heading h3{
        color: #505458;
    font-family: "Oswald", sans-serif;
}

.panel-body {
    padding: 15px;
}

.alert-danger {
    background-color: rgba(240, 80, 80, 0.2);
    border-color: rgba(240, 80, 80, 0.3);
    color: #f05050;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    text-transform: none;
}

.btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}

.btn-red{
    background-color: #EC1B23 !important;
    border: 1px solid #EC1B23 !important;
    color: #ffffff;
    font-family: "Oswald", sans-serif;
    text-decoration: none;
    padding: 19px 12px;
}
.nfr{
    text-align: center;
}

.cde{
  color: #fff;
  text-decoration: none;
  font-family: "Oswald", sans-serif;
  font-size: 16px;
    
    font-weight: bold;   
}


  </style> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>



<body>



@if($status->active =="Y")
<div class="panel-heading">
    <h3>Aktivasi Email</h3>
</div>
<div id="sukses" class="panel-body">
    <div class="alert btn-success" role="alert">Aktivasi Email sukses, anda akan di alihkan dalam waktu 5 detik </div>
</div>

<?php 
$urlset = 'http://'.$_SERVER['HTTP_HOST'].'/login';

?>
<script>

setInterval(function() 
{        
    window.location.href = "{{  $urlset }}";     
}, 1000);

</script>


@elseif($status->active =="N")
<div class="panel-heading">
    <h3>Aktivasi Email</h3>
</div>
<div class="panel-body">
            <div class="alert alert-danger" role="alert">
            Anda sudah pernah aktivasi akun di portal arkadia.me , link sudah tidak valid.
            </div>
</div>


@endif



@if($status->active =="NV")

<div class="panel-heading">
    <h3>Registrasi berhasil</h3>
</div>
<div class="panel-body">
            <div class="nfr alert btn-success" role="alert">
          Silahkan periksa email anda, kami telah mengirimkan link aktivasi akun portal arkadia.me.
            </div>

            <div class="nfr alert btn-red">
                   
                    <a href="<?php echo $url.'/login'?>" class="cde">
                        Kembali ke halaman login
                    </a>
                   
             </div>       
</div>


@endif






  @if($status->active =="IV")         
<div class="panel-heading">
    <h3>Aktivasi Email</h3>
</div>
<div class="panel-body">
            <div class="alert alert-danger" role="alert">
            link sudah tidak valid
            </div>
</div>

@endif





@if($status->active =="LP")

<div class="panel-heading">
    <h3>Forgot Password Berhasil</h3>
</div>
<div class="panel-body">
            <div class="nfr alert btn-success" role="alert">
          Silahkan periksa email anda, kami telah mengirimkan link aktivasi lupa password akun portal arkadia.me.
            </div>

            <div class="nfr alert btn-red">
                   
                    <a href="<?php echo $url.'/login'?>" class="cde">
                        Kembali ke halaman login
                    </a>
                   
             </div>       
</div>


@endif


@if($status->active =="EK")

<div class="panel-heading">
    <h3>Forgot Password Gagal</h3>
</div>
<div class="panel-body">
            <div class="nfr alert btn-success" role="alert">
          Silahkan periksa email anda, email yang anda kirimkan tidak valid!!
            </div>

            <div class="nfr alert btn-red">
                   
                    <a href="<?php echo $url.'/login'?>" class="cde">
                        Kembali ke halaman login
                    </a>
                   
             </div>       
</div>


@endif



@if($status->active =="DUE")

<div class="panel-heading">
    <h3>Register Gagal</h3>
</div>
<div class="panel-body">
            <div class="nfr alert btn-success" role="alert">
          Akun sudah terdaftar!!
            </div>

            <div class="nfr alert btn-red">
                   
                    <a href="<?php echo $url.'/login'?>" class="cde">
                        Kembali ke halaman login
                    </a>
                   
             </div>       
</div>


@endif

      
    </body></html>