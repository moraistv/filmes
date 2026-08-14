<?php
  $page_title = "Atualizações";
  $current_page = "app_updates";

  include("includes/header.php");
  require("includes/function.php");
  require("language/language.php");

  mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS tbl_app_updates (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    version_code INT NOT NULL UNIQUE,
    version_name VARCHAR(50) NOT NULL,
    title VARCHAR(160) NOT NULL,
    release_notes TEXT NOT NULL,
    is_required TINYINT(1) NOT NULL DEFAULT 0,
    source_type VARCHAR(20) NOT NULL DEFAULT 'apk',
    update_url TEXT NOT NULL,
    apk_file VARCHAR(255) NOT NULL DEFAULT '',
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_app_update_active_version (is_active, version_code)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

  $uploadDir = __DIR__.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'updates';
  if(!is_dir($uploadDir)){ @mkdir($uploadDir, 0775, true); }
  $error = '';

  if(isset($_GET['activate'])) {
    $id = (int)$_GET['activate'];
    mysqli_query($mysqli, "UPDATE tbl_app_updates SET is_active=0");
    $stmt = mysqli_prepare($mysqli, "UPDATE tbl_app_updates SET is_active=1 WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location:atualizacoes"); exit;
  }

  if(isset($_GET['deactivate'])) {
    $id = (int)$_GET['deactivate'];
    $stmt = mysqli_prepare($mysqli, "UPDATE tbl_app_updates SET is_active=0 WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location:atualizacoes"); exit;
  }

  if(isset($_GET['remove'])) {
    $id = (int)$_GET['remove'];
    $stmt = mysqli_prepare($mysqli, "SELECT apk_file FROM tbl_app_updates WHERE id=? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "i", $id); mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt); $old = mysqli_fetch_assoc($res); mysqli_stmt_close($stmt);
    $stmt = mysqli_prepare($mysqli, "DELETE FROM tbl_app_updates WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id); mysqli_stmt_execute($stmt); mysqli_stmt_close($stmt);
    if(!empty($old['apk_file'])) {
      $oldPath = $uploadDir.DIRECTORY_SEPARATOR.basename($old['apk_file']);
      if(is_file($oldPath)){ @unlink($oldPath); }
    }
    header("Location:atualizacoes"); exit;
  }

  $edit = null;
  if(isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = mysqli_prepare($mysqli, "SELECT * FROM tbl_app_updates WHERE id=? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "i", $id); mysqli_stmt_execute($stmt);
    $edit = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt)); mysqli_stmt_close($stmt);
  }

  if(isset($_POST['save_update'])) {
    $id = (int)($_POST['update_id'] ?? 0);
    $versionCode = max(1, (int)($_POST['version_code'] ?? 0));
    $versionName = trim($_POST['version_name'] ?? '');
    $title = trim($_POST['title'] ?? 'Nova atualização disponível');
    $notes = trim($_POST['release_notes'] ?? '');
    $required = isset($_POST['is_required']) ? 1 : 0;
    $source = ($_POST['source_type'] ?? 'apk') === 'play_store' ? 'play_store' : 'apk';
    $url = trim($_POST['update_url'] ?? '');
    $apkFile = trim($_POST['existing_apk_file'] ?? '');

    if($versionName === '' || $notes === '') {
      $error = 'Informe o nome da versão e as novidades da atualização.';
    }

    if(!$error && $source === 'apk' && isset($_FILES['apk_file']) && $_FILES['apk_file']['error'] !== UPLOAD_ERR_NO_FILE) {
      if($_FILES['apk_file']['error'] !== UPLOAD_ERR_OK) {
        $error = 'Não foi possível receber o APK. Verifique o limite de upload do servidor.';
      } else if(strtolower(pathinfo($_FILES['apk_file']['name'], PATHINFO_EXTENSION)) !== 'apk') {
        $error = 'Envie um arquivo com extensão .apk.';
      } else {
        $apkFile = 'getcine-v'.$versionCode.'-'.time().'.apk';
        if(!move_uploaded_file($_FILES['apk_file']['tmp_name'], $uploadDir.DIRECTORY_SEPARATOR.$apkFile)) {
          $error = 'Falha ao salvar o APK no servidor.';
        }
      }
    }

    if(!$error && $source === 'apk' && $apkFile === '' && $url === '') {
      $error = 'Envie o APK ou informe uma URL externa para ele.';
    }
    if(!$error && $source === 'play_store' && $url === '') {
      $error = 'Informe o link do aplicativo na Google Play.';
    }

    if(!$error) {
      mysqli_query($mysqli, "UPDATE tbl_app_updates SET is_active=0");
      if($id > 0) {
        $stmt = mysqli_prepare($mysqli, "UPDATE tbl_app_updates SET version_code=?,version_name=?,title=?,release_notes=?,is_required=?,source_type=?,update_url=?,apk_file=?,is_active=1 WHERE id=?");
        mysqli_stmt_bind_param($stmt, "isssisssi", $versionCode, $versionName, $title, $notes, $required, $source, $url, $apkFile, $id);
      } else {
        $stmt = mysqli_prepare($mysqli, "INSERT INTO tbl_app_updates (version_code,version_name,title,release_notes,is_required,source_type,update_url,apk_file,is_active) VALUES (?,?,?,?,?,?,?,?,1)");
        mysqli_stmt_bind_param($stmt, "isssisss", $versionCode, $versionName, $title, $notes, $required, $source, $url, $apkFile);
      }
      if(mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location:atualizacoes?saved=1"); exit;
      }
      $error = mysqli_errno($mysqli) === 1062
        ? 'Já existe uma atualização com esse código de versão.'
        : 'Não foi possível salvar: '.mysqli_error($mysqli);
      mysqli_stmt_close($stmt);
    }
  }

  $history = mysqli_query($mysqli, "SELECT * FROM tbl_app_updates ORDER BY version_code DESC, id DESC");
  $summary = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(*) total, SUM(is_active=1) active, MAX(version_code) latest FROM tbl_app_updates"));
?>

<style>
  .update-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;margin-bottom:22px}
  .update-stat{background:#151515;border:1px solid #292929;border-radius:14px;padding:18px;color:#fff}.update-stat small{display:block;color:#8f98a3;text-transform:uppercase;font-weight:700;letter-spacing:.08em}.update-stat strong{display:block;font-size:28px;margin-top:5px;color:#41c2ff}
  .update-help{background:rgba(65,194,255,.08);border:1px solid rgba(65,194,255,.25);border-radius:12px;padding:14px 16px;margin-bottom:20px;color:#0f0f0f}
  .update-help code{color:#0f0f0f;font-weight:700}
  .update-success{background:#e8f8ee;border:1px solid #9edcb5;border-radius:12px;color:#176b37;padding:14px 18px;margin-bottom:15px;font-weight:700}
  .update-badge{display:inline-flex;padding:5px 9px;border-radius:999px;font-size:11px;font-weight:800}.is-live{background:#173d2b;color:#66e49a}.is-off{background:#292929;color:#9ea5ad}.is-required{background:#481e24;color:#ff7b88}.is-optional{background:#1c3442;color:#69cffd}
  .update-actions{display:flex;flex-wrap:wrap;gap:6px}.update-actions .btn{min-width:auto;padding:6px 10px;font-size:12px;font-weight:700;border-radius:8px}
  @media(max-width:760px){.update-grid{grid-template-columns:1fr}}
</style>

<div class="row"><div class="col-xs-12">
  <div class="update-grid">
    <div class="update-stat"><small>Publicações</small><strong><?=intval($summary['total'] ?? 0)?></strong></div>
    <div class="update-stat"><small>Atualização ativa</small><strong><?=intval($summary['active'] ?? 0) ? 'Sim' : 'Não'?></strong></div>
    <div class="update-stat"><small>Maior versionCode</small><strong><?=intval($summary['latest'] ?? 0)?></strong></div>
  </div>

  <div class="card mrg_bottom">
    <div class="page_title_block"><div class="col-md-8 col-xs-12"><div class="page_title"><?=$edit ? 'Editar atualização' : 'Publicar atualização'?></div></div></div><div class="clearfix"></div>
    <div class="card-body" style="padding:22px">
      <div class="update-help"><strong>Como funciona:</strong> o aplicativo compara o <code>versionCode</code> instalado com o publicado aqui. Use sempre um número maior a cada APK. Atualização obrigatória bloqueia o aplicativo; opcional permite escolher “Agora não”.</div>
      <?php if($error){ ?><div class="alert alert-danger"><?=htmlspecialchars($error, ENT_QUOTES, 'UTF-8')?></div><?php } ?>
      <?php if(isset($_GET['saved'])){ ?><div class="update-success">Atualização publicada com sucesso.</div><?php } ?>
      <form method="post" enctype="multipart/form-data" class="form form-horizontal">
        <input type="hidden" name="update_id" value="<?=intval($edit['id'] ?? 0)?>"><input type="hidden" name="existing_apk_file" value="<?=htmlspecialchars($edit['apk_file'] ?? '', ENT_QUOTES, 'UTF-8')?>">
        <div class="form-group"><label class="col-md-3 control-label">Código da versão</label><div class="col-md-3"><input type="number" min="1" name="version_code" class="form-control" value="<?=htmlspecialchars($edit['version_code'] ?? '', ENT_QUOTES, 'UTF-8')?>" placeholder="Ex.: 3" required></div><div class="col-md-5"><p class="help-block">Número interno crescente. A versão atual deste APK será 2.</p></div></div>
        <div class="form-group"><label class="col-md-3 control-label">Nome da versão</label><div class="col-md-6"><input type="text" name="version_name" class="form-control" value="<?=htmlspecialchars($edit['version_name'] ?? '', ENT_QUOTES, 'UTF-8')?>" placeholder="Ex.: 1.2.0" required></div></div>
        <div class="form-group"><label class="col-md-3 control-label">Título do aviso</label><div class="col-md-6"><input type="text" name="title" class="form-control" value="<?=htmlspecialchars($edit['title'] ?? 'Nova atualização disponível', ENT_QUOTES, 'UTF-8')?>" required></div></div>
        <div class="form-group"><label class="col-md-3 control-label">Novidades</label><div class="col-md-7"><textarea name="release_notes" class="form-control" rows="5" placeholder="Liste melhorias e correções..." required><?=htmlspecialchars($edit['release_notes'] ?? '', ENT_QUOTES, 'UTF-8')?></textarea></div></div>
        <div class="form-group"><label class="col-md-3 control-label">Obrigatoriedade</label><div class="col-md-7"><label style="display:flex;gap:10px;align-items:center;padding-top:8px"><input type="checkbox" name="is_required" value="1" <?=!empty($edit['is_required'])?'checked':''?>> <strong>Forçar atualização</strong> — ninguém acessa o app sem atualizar</label></div></div>
        <div class="form-group"><label class="col-md-3 control-label">Origem</label><div class="col-md-6"><select name="source_type" id="source_type" class="form-control"><option value="apk" <?=($edit['source_type'] ?? 'apk')==='apk'?'selected':''?>>APK direto / URL externa</option><option value="play_store" <?=($edit['source_type'] ?? '')==='play_store'?'selected':''?>>Google Play</option></select></div></div>
        <div class="form-group" id="apk_upload_row"><label class="col-md-3 control-label">Enviar APK</label><div class="col-md-6"><input type="file" name="apk_file" accept=".apk,application/vnd.android.package-archive" class="form-control"><?php if(!empty($edit['apk_file'])){ ?><p class="help-block">Arquivo atual: <?=htmlspecialchars($edit['apk_file'], ENT_QUOTES, 'UTF-8')?></p><?php } ?></div></div>
        <div class="form-group"><label class="col-md-3 control-label" id="url_label">URL alternativa do APK</label><div class="col-md-7"><input type="url" name="update_url" class="form-control" value="<?=htmlspecialchars($edit['update_url'] ?? '', ENT_QUOTES, 'UTF-8')?>" placeholder="https://..."><p class="help-block">No modo APK, deixe vazio se enviou o arquivo acima.</p></div></div>
        <div class="form-group"><div class="col-md-9 col-md-offset-3"><button type="submit" name="save_update" class="btn btn-primary"><i class="bi bi-cloud-arrow-up-fill"></i> <?=$edit?'Salvar e publicar':'Publicar atualização'?></button><?php if($edit){ ?> <a href="atualizacoes" class="btn btn-default">Cancelar</a><?php } ?></div></div>
      </form>
    </div>
  </div>

  <div class="card"><div class="page_title_block"><div class="col-md-8 col-xs-12"><div class="page_title">Histórico de atualizações</div></div></div><div class="clearfix"></div>
    <div class="card-body" style="padding:20px"><div class="table-responsive"><table class="table table-striped"><thead><tr><th>Versão</th><th>Publicação</th><th>Tipo</th><th>Origem</th><th>Status</th><th style="width:150px">Ações</th></tr></thead><tbody>
    <?php if($history && mysqli_num_rows($history)){ while($row=mysqli_fetch_assoc($history)){ ?><tr>
      <td><strong><?=htmlspecialchars($row['version_name'], ENT_QUOTES, 'UTF-8')?></strong><br><small>versionCode <?=intval($row['version_code'])?></small></td>
      <td><?=date('d/m/Y H:i', strtotime($row['created_at']))?><br><small><?=htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8')?></small></td>
      <td><span class="update-badge <?=$row['is_required']?'is-required':'is-optional'?>"><?=$row['is_required']?'Obrigatória':'Opcional'?></span></td>
      <td><?=$row['source_type']==='play_store'?'Google Play':'APK direto'?></td>
      <td><span class="update-badge <?=$row['is_active']?'is-live':'is-off'?>"><?=$row['is_active']?'Ativa':'Arquivada'?></span></td>
      <td><div class="update-actions"><a href="atualizacoes?edit=<?=$row['id']?>" class="btn btn-primary btn-xs">Editar</a><?php if($row['is_active']){ ?><a href="atualizacoes?deactivate=<?=$row['id']?>" class="btn btn-warning btn-xs">Desativar</a><?php }else{ ?><a href="atualizacoes?activate=<?=$row['id']?>" class="btn btn-success btn-xs">Ativar</a><?php } ?><a href="atualizacoes?remove=<?=$row['id']?>" class="btn btn-danger btn-xs" onclick="return confirm('Excluir esta atualização do histórico?')">Excluir</a></div></td>
    </tr><?php }}else{ ?><tr><td colspan="6" style="text-align:center;padding:28px">Nenhuma atualização publicada.</td></tr><?php } ?>
    </tbody></table></div></div>
  </div>
</div></div>
<script>document.addEventListener('DOMContentLoaded',function(){var s=document.getElementById('source_type'),r=document.getElementById('apk_upload_row'),l=document.getElementById('url_label');function sync(){var p=s.value==='play_store';r.style.display=p?'none':'';l.textContent=p?'URL da Google Play':'URL alternativa do APK';}s.addEventListener('change',sync);sync();});</script>
<?php include("includes/footer.php"); ?>
