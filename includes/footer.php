<footer class="app-footer">
      <div class="row">
        <div class="col-xs-12">
          <div class="footer-copyright">Copyright © <?php echo date('Y');?> Todos os direitos reservados.</div>
        </div>
      </div>
    </footer>
  </div>
</div>
<script type="text/javascript" src="assets/js/vendor.js"></script> 
<script type="text/javascript" src="assets/js/app.js"></script>

<script type="text/javascript">
  /* Menu mobile: cria um fundo escuro e o mantem em sincronia com o estado
     do #sidebar (o app.js ja alterna a classe .active ao clicar no botao).
     Clicar no fundo ou em um item do menu fecha o menu. */
  (function () {
    var sb = document.getElementById('sidebar');
    if (!sb) return;

    var bd = document.createElement('div');
    bd.className = 'gc-backdrop';
    document.body.appendChild(bd);

    function sync() {
      if (sb.classList.contains('active')) { bd.classList.add('show'); }
      else { bd.classList.remove('show'); }
    }

    if (window.MutationObserver) {
      new MutationObserver(sync).observe(sb, { attributes: true, attributeFilter: ['class'] });
    }

    bd.addEventListener('click', function () {
      sb.classList.remove('active');
      sync();
    });

    // Fecha ao navegar por um item do menu
    var links = sb.querySelectorAll('.gc-nav-link, .gc-user-link, .gc-user-out');
    for (var i = 0; i < links.length; i++) {
      links[i].addEventListener('click', function () {
        sb.classList.remove('active');
        sync();
      });
    }
  })();
</script>

<script src="assets/js/notify.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="assets/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="assets/js/admin-pt-BR.js"></script>

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

</script>

</body>
</html>
