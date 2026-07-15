<footer class="app-footer">
      <div class="row">
        <div class="col-xs-12">
          <div class="footer-copyright">Copyright © <?php echo date('Y');?> <a href="http://www.viaviweb.com" target="_blank">Viaviweb.com</a>. All Rights Reserved.</div>
        </div>
      </div>
    </footer>
  </div>
</div>
<script type="text/javascript" src="assets/js/vendor.js"></script> 
<script type="text/javascript" src="assets/js/app.js"></script>

<script src="assets/js/notify.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="assets/sweetalert/sweetalert.min.js"></script>

<?php if(isset($_SESSION['msg'])){?>
<script type="text/javascript">
  $('.notifyjs-corner').empty();
  $.notify(
    '<?php echo $client_lang[$_SESSION["msg"]];?>',
    { position:"top center",className: '<?=$_SESSION["class"]?>'}
  );
</script>
<?php
  unset($_SESSION['msg']);
  unset($_SESSION['class']); 
  } 
?>

</body>

<script type="text/javascript">

  function isImage(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
    case 'jpg':
    case 'jpeg':
    case 'png':
    case 'svg':
    case 'gif':
        return true;
    }
    return false;
  }

  function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
  }

  if($(".dropdown-li").hasClass("active")){
    var _test='<?php echo $active_page; ?>';
    $("."+_test).next(".cust-dropdown-container").show();
    $("."+_test).find(".title").next("i").removeClass("fa-angle-right");
    $("."+_test).find(".title").next("i").addClass("fa-angle-down");
  }

  $(document).ready(function(e){
    var _flag=false;

    $(".dropdown-a").click(function(e){

      $(this).parents("ul").find(".cust-dropdown-container").slideUp();

      $(this).parents("ul").find(".title").next("i").addClass("fa-angle-right");
      $(this).parents("ul").find(".title").next("i").removeClass("fa-angle-down");

      if($(this).parent("li").next(".cust-dropdown-container").css('display') !='none'){
          $(this).parent("li").next(".cust-dropdown-container").slideUp();
          $(this).find(".title").next("i").addClass("fa-angle-right");
          $(this).find(".title").next("i").removeClass("fa-angle-down");
      }else{
        $(this).parent("li").next(".cust-dropdown-container").slideDown();
        $(this).find(".title").next("i").removeClass("fa-angle-right");
        $(this).find(".title").next("i").addClass("fa-angle-down");
      }

    });
  });
</script>

</body>
</html>