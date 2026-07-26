<?php
  $page_title="Jogos";
  $current_page="matches";

  include("includes/header.php");
  require("includes/function.php");
  require("language/language.php");

  // ---- Salvar (adicionar / editar) ----
  if(isset($_POST['save_match']))
  {
    $id         = (int)$_POST['match_id'];
    $league     = trim($_POST['league']);
    $team1_name = trim($_POST['team1_name']);
    $team1_logo = trim($_POST['team1_logo']);
    $team2_name = trim($_POST['team2_name']);
    $team2_logo = trim($_POST['team2_logo']);
    $stream_url = trim($_POST['stream_url']);
    $match_dt   = str_replace('T', ' ', trim($_POST['match_time']));
    if(strlen($match_dt) == 16){ $match_dt .= ':00'; }

    if($id > 0){
      $stmt = mysqli_prepare($mysqli, "UPDATE tbl_matches SET league=?, team1_name=?, team1_logo=?, team2_name=?, team2_logo=?, match_time=?, stream_url=? WHERE id=?");
      mysqli_stmt_bind_param($stmt, "sssssssi", $league, $team1_name, $team1_logo, $team2_name, $team2_logo, $match_dt, $stream_url, $id);
    } else {
      $stmt = mysqli_prepare($mysqli, "INSERT INTO tbl_matches (league, team1_name, team1_logo, team2_name, team2_logo, match_time, stream_url) VALUES (?,?,?,?,?,?,?)");
      mysqli_stmt_bind_param($stmt, "sssssss", $league, $team1_name, $team1_logo, $team2_name, $team2_logo, $match_dt, $stream_url);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location:jogos");
    exit;
  }

  // ---- Excluir ----
  if(isset($_GET['remove']))
  {
    $rid = (int)$_GET['remove'];
    $stmt = mysqli_prepare($mysqli, "DELETE FROM tbl_matches WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $rid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location:jogos");
    exit;
  }

  // ---- Carregar para edicao ----
  $edit = null;
  if(isset($_GET['edit']))
  {
    $eid = (int)$_GET['edit'];
    $r = mysqli_query($mysqli, "SELECT * FROM tbl_matches WHERE id='".$eid."' LIMIT 1");
    $edit = mysqli_fetch_assoc($r);
  }

  $result = mysqli_query($mysqli, "SELECT * FROM tbl_matches ORDER BY match_time DESC");
?>

<div class="row">
  <div class="col-xs-12">
    <div class="card mrg_bottom">
      <div class="page_title_block">
        <div class="col-md-6 col-xs-12">
          <div class="page_title"><?=$page_title?></div>
        </div>
      </div>
      <div class="clearfix"></div>

      <div class="col-md-12 mrg-top" style="padding:18px 21px;">

        <!-- Formulario adicionar / editar -->
        <form method="post" action="" class="form form-horizontal" style="margin-bottom:26px;">
          <input type="hidden" name="match_id" value="<?=$edit ? (int)$edit['id'] : 0?>">

          <div class="form-group">
            <label class="col-md-3 control-label">Campeonato / Liga :-</label>
            <div class="col-md-7">
              <input type="text" name="league" class="form-control" placeholder="Ex.: Brasileiro Série A" value="<?=$edit ? htmlspecialchars($edit['league'], ENT_QUOTES, 'UTF-8') : ''?>" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">Time 1 (nome) :-</label>
            <div class="col-md-7">
              <input type="text" name="team1_name" class="form-control" placeholder="Ex.: Flamengo" value="<?=$edit ? htmlspecialchars($edit['team1_name'], ENT_QUOTES, 'UTF-8') : ''?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Time 1 (URL do escudo) :-</label>
            <div class="col-md-7">
              <input type="text" name="team1_logo" class="form-control" placeholder="https://... (logo do time 1)" value="<?=$edit ? htmlspecialchars($edit['team1_logo'], ENT_QUOTES, 'UTF-8') : ''?>">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">Time 2 (nome) :-</label>
            <div class="col-md-7">
              <input type="text" name="team2_name" class="form-control" placeholder="Ex.: Palmeiras" value="<?=$edit ? htmlspecialchars($edit['team2_name'], ENT_QUOTES, 'UTF-8') : ''?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Time 2 (URL do escudo) :-</label>
            <div class="col-md-7">
              <input type="text" name="team2_logo" class="form-control" placeholder="https://... (logo do time 2)" value="<?=$edit ? htmlspecialchars($edit['team2_logo'], ENT_QUOTES, 'UTF-8') : ''?>">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">Data e hora do jogo :-</label>
            <div class="col-md-7">
              <input type="datetime-local" name="match_time" class="form-control" value="<?=$edit ? date('Y-m-d\TH:i', strtotime($edit['match_time'])) : ''?>" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">Link da transmissão :-</label>
            <div class="col-md-7">
              <input type="text" name="stream_url" class="form-control" placeholder="URL do stream (m3u8/mp4) ou link do canal" value="<?=$edit ? htmlspecialchars($edit['stream_url'], ENT_QUOTES, 'UTF-8') : ''?>">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
              <button type="submit" name="save_match" class="btn btn-primary"><?=$edit ? 'Salvar alterações' : 'Adicionar jogo'?></button>
              <?php if($edit){ ?><a href="jogos" class="btn btn-default">Cancelar</a><?php } ?>
            </div>
          </div>
        </form>

        <!-- Lista de jogos -->
        <div class="table-responsive">
          <table class="table table-striped" style="width:100%;">
            <thead>
              <tr>
                <th>Campeonato</th>
                <th>Jogo</th>
                <th>Data / Hora</th>
                <th style="width:110px;">Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php if(mysqli_num_rows($result) > 0){ while($row=mysqli_fetch_assoc($result)){ ?>
              <tr>
                <td><?=htmlspecialchars($row['league'], ENT_QUOTES, 'UTF-8')?></td>
                <td><?=htmlspecialchars($row['team1_name'], ENT_QUOTES, 'UTF-8')?> <strong>x</strong> <?=htmlspecialchars($row['team2_name'], ENT_QUOTES, 'UTF-8')?></td>
                <td><?=date('d/m/Y H:i', strtotime($row['match_time']))?></td>
                <td>
                  <a href="jogos?edit=<?=$row['id']?>" class="btn btn-primary btn-xs" title="Editar"><i class="fa fa-edit"></i></a>
                  <a href="jogos?remove=<?=$row['id']?>" class="btn btn-danger btn-xs" title="Excluir" onclick="return confirm('Excluir este jogo?');"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              <?php }} else { ?>
              <tr><td colspan="4" style="text-align:center;padding:22px;">Nenhum jogo cadastrado.</td></tr>
              <?php } ?>
            </tbody>
          </table>
        </div>

      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>

<?php include("includes/footer.php");?>
