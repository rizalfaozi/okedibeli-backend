
<script type="text/javascript" src="{{ mix('/vue/js/bundle.js') }}"></script>                           <!-- Load jQuery -->

 

@isset($vuejs)
<script type="text/javascript" src="{{ mix('/vue/js/'.$vuejs.'.js') }}"></script>
@endisset

<!-- <script type="text/javascript">
    $('.date').datepicker({
      autoclose: true,
       format: 'yyyy-mm-dd'
    });               
</script> -->


