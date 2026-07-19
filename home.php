<?php 
    $page_title="Visão geral";
    $active_page="dashboard";

    include("includes/header.php");
    include("includes/function.php");

    $qry_cat="SELECT COUNT(*) as num FROM tbl_category";
    $total_category= mysqli_fetch_array(mysqli_query($mysqli,$qry_cat));
    $total_category = $total_category['num'];

    $qry_channels="SELECT COUNT(*) as num FROM tbl_channels";
    $total_channels = mysqli_fetch_array(mysqli_query($mysqli,$qry_channels));
    $total_channels = $total_channels['num'];

    $qry_comments="SELECT COUNT(*) as num FROM tbl_comments";
    $total_comments = mysqli_fetch_array(mysqli_query($mysqli,$qry_comments));
    $total_comments = $total_comments['num'];

    $qry_reports="SELECT COUNT(*) as num FROM tbl_reports";
    $total_reports = mysqli_fetch_array(mysqli_query($mysqli,$qry_reports));
    $total_reports = $total_reports['num'];


    $qry_movie="SELECT COUNT(*) as num FROM tbl_movies";
    $total_movies = mysqli_fetch_array(mysqli_query($mysqli,$qry_movie));
    $total_movies = $total_movies['num'];

    $qry_series="SELECT COUNT(*) as num FROM tbl_series";
    $total_series = mysqli_fetch_array(mysqli_query($mysqli,$qry_series));
    $total_series = $total_series['num'];

    $qry_users="SELECT COUNT(*) as num FROM tbl_users";
    $total_users = mysqli_fetch_array(mysqli_query($mysqli,$qry_users));
    $total_users = $total_users['num'];

    $countStr='';
    $no_data_status=false;
    $count=$monthCount=0;

    $month_names = array(1 => 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');

    for ($mon=1; $mon<=12; $mon++) {

        if(date('n') < $mon){
          break;
        }
        
        if(isset($_GET['filterByYear'])){

          $year=$_GET['filterByYear'];

          $month = $month_names[$mon];

          $sql_user="SELECT `id` FROM tbl_users WHERE DATE_FORMAT(FROM_UNIXTIME(`register_on`), '%c') = '$mon' AND DATE_FORMAT(FROM_UNIXTIME(`register_on`), '%Y') = '$year'";
        }
        else{

          $month = $month_names[$mon];

          $sql_user="SELECT `id` FROM tbl_users WHERE DATE_FORMAT(FROM_UNIXTIME(`register_on`), '%c') = '$mon'";
        }

        $count=mysqli_num_rows(mysqli_query($mysqli, $sql_user));

        $countStr.="['".$month."', ".$count."], ";

        if($count!=0){
          $monthCount++;
        }

    }

    if($monthCount!=0){
      $no_data_status=false;
    }
    else{
      $no_data_status=true;
    }

    $countStr=rtrim($countStr, ", ");

?>

<div class="dash-heading">
  <div>
    <h1>Visão geral</h1>
    <p>Resumo do catálogo, engajamento e usuários do GetCine.</p>
  </div>
</div>

<div class="stat-grid">

    <a href="categorias" class="stat-card stat-orange">
      <div class="stat-icon"><i class="bi bi-diagram-3-fill"></i></div>
      <div class="stat-value"><?php echo thousandsNumberFormat($total_category);?></div>
      <div class="stat-label">Categorias</div>
    </a>

    <a href="filmes" class="stat-card stat-gold">
      <div class="stat-icon"><i class="bi bi-film"></i></div>
      <div class="stat-value"><?php echo thousandsNumberFormat($total_movies);?></div>
      <div class="stat-label">Filmes</div>
    </a>

    <a href="series" class="stat-card stat-blue">
      <div class="stat-icon"><i class="bi bi-collection-play-fill"></i></div>
      <div class="stat-value"><?php echo thousandsNumberFormat($total_series);?></div>
      <div class="stat-label">Séries</div>
    </a>

    <a href="canais" class="stat-card stat-pink">
      <div class="stat-icon"><i class="bi bi-broadcast"></i></div>
      <div class="stat-value"><?php echo thousandsNumberFormat($total_channels);?></div>
      <div class="stat-label">Canais</div>
    </a>

    <a href="comentarios" class="stat-card stat-red">
      <div class="stat-icon"><i class="bi bi-chat-square-text-fill"></i></div>
      <div class="stat-value"><?php echo thousandsNumberFormat($total_comments);?></div>
      <div class="stat-label">Comentários</div>
    </a>

    <a href="denuncias" class="stat-card stat-red">
      <div class="stat-icon"><i class="bi bi-flag-fill"></i></div>
      <div class="stat-value"><?php echo thousandsNumberFormat($total_reports);?></div>
      <div class="stat-label">Denúncias</div>
    </a>

    <a href="usuarios" class="stat-card stat-green">
      <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
      <div class="stat-value"><?php echo thousandsNumberFormat($total_users);?></div>
      <div class="stat-label">Usuários</div>
    </a>

</div>

<div class="panel-card">
  <div class="panel-head">
    <div>
      <h3>Análise de usuários</h3>
      <p>Novos cadastros por mês</p>
    </div>
    <form method="get" id="graphFilter">
      <select class="form-control" name="filterByYear">
        <?php 
          $currentYear=date('Y');
          $minYear=2020;

          for ($i=$currentYear; $i >= $minYear ; $i--) { 
            ?>
            <option value="<?=$i?>" <?=(isset($_GET['filterByYear']) && $_GET['filterByYear']==$i) ? 'selected' : ''?>><?=$i?></option>
            <?php
          }
        ?>
      </select>
    </form>
  </div>
  <div>
    <?php 
      if($no_data_status){
        ?>
        <p class="empty-state"><i class="bi bi-bar-chart" style="font-size:2em;display:block;margin-bottom:10px;"></i>Nenhum dado encontrado!</p>
        <?php
      }
      else{
        ?>
        <div id="registerChart">
          <p style="text-align: center;"><i class="fa fa-spinner fa-spin" style="font-size:3em;color:#ccc;margin-bottom:50px" aria-hidden="true"></i></p>
        </div>
        <?php    
      }
    ?>
  </div>
</div>

<div class="row">
  <div class="col-lg-4">
    <div class="panel-card">
      <div class="panel-head">
        <div>
          <h3>Séries mais assistidas</h3>
          <p>Conteúdos com mais visualizações</p>
        </div>
      </div>
      <ul class="top-list">
        <?php 
          $sql="SELECT * FROM tbl_series WHERE `total_views` > 5 ORDER BY `total_views` DESC LIMIT 10";
          $res=mysqli_query($mysqli, $sql);
          if(mysqli_num_rows($res) > 0)
          {
            $rank=0;
            while ($row=mysqli_fetch_assoc($res)) {
              $rank++;
            ?>
            <li>
              <span class="top-rank"><?=$rank?></span>
              <?php if($row['series_cover']!='' OR !file_exists('images/series/'.$row['series_cover'])){ ?>
                <img src="<?='images/series/'.$row['series_cover']?>" alt="">
              <?php }else{ ?>
                <img src="<?='images/'.APP_LOGO?>" alt="">
              <?php } ?>
              <div class="top-info">
                <a href="javascript:void(0)" title="<?=$row['series_name']?>" style="text-decoration:none;">
                  <span class="top-title">
                    <?php 
                      if(strlen($row['series_name']) > 25){
                        echo substr(stripslashes($row['series_name']), 0, 25).'...';  
                      }else{
                        echo $row['series_name'];
                      }
                    ?>
                  </span>
                </a>
              </div>
              <span class="top-views"><i class="bi bi-eye-fill"></i> <?=thousandsNumberFormat($row['total_views'])?></span>
            </li>
            <?php }
              mysqli_free_result($res);
            }
            else{
              ?>
              <p class="empty-state">Nenhum dado disponível.</p>
              <?php
            }
        ?>
      </ul>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="panel-card">
      <div class="panel-head">
        <div>
          <h3>Filmes mais assistidos</h3>
          <p>Conteúdos com mais visualizações</p>
        </div>
      </div>
      <ul class="top-list">
        <?php 
          $sql="SELECT * FROM tbl_movies WHERE `total_views` > 5 ORDER BY `total_views` DESC LIMIT 10";
          $res=mysqli_query($mysqli, $sql);

          if(mysqli_num_rows($res) > 0)
          {
            $rank=0;
            while ($row=mysqli_fetch_assoc($res)) {
              $rank++;
            ?>
            <li>
              <span class="top-rank"><?=$rank?></span>
              <?php if($row['movie_cover']!='' OR !file_exists('images/movies/'.$row['movie_cover'])){ ?>
                <img src="<?='images/movies/'.$row['movie_cover']?>" alt="">
              <?php }else{ ?>
                <img src="<?='images/'.APP_LOGO?>" alt="">
              <?php } ?>
              <div class="top-info">
                <a href="javascript:void(0)" title="<?=$row['movie_title']?>" style="text-decoration:none;">
                  <span class="top-title">
                    <?php 
                      if(strlen($row['movie_title']) > 25){
                        echo substr(stripslashes($row['movie_title']), 0, 25).'...';  
                      }else{
                        echo $row['movie_title'];
                      }
                    ?>
                  </span>
                </a>
              </div>
              <span class="top-views"><i class="bi bi-eye-fill"></i> <?=thousandsNumberFormat($row['total_views'])?></span>
            </li>
            <?php }
              mysqli_free_result($res);

            }
            else{
              ?>
              <p class="empty-state">Nenhum dado disponível.</p>
              <?php
            }
        ?>
      </ul>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="panel-card">
      <div class="panel-head">
        <div>
          <h3>Canais mais assistidos</h3>
          <p>Conteúdos com mais visualizações</p>
        </div>
      </div>
      <ul class="top-list">
        <?php 
          $sql="SELECT * FROM tbl_channels WHERE `total_views` > 5 ORDER BY `total_views` DESC LIMIT 10";
          $res=mysqli_query($mysqli, $sql);

          if(mysqli_num_rows($res) > 0)
          {
            $rank=0;
            while ($row=mysqli_fetch_assoc($res)) {
              $rank++;
            ?>
            <li>
              <span class="top-rank"><?=$rank?></span>
              <?php if($row['channel_thumbnail']!='' OR !file_exists('images/'.$row['channel_thumbnail'])){ ?>
                <img src="<?='images/'.$row['channel_thumbnail']?>" alt="">
              <?php }else{ ?>
                <img src="<?='images/'.APP_LOGO?>" alt="">
              <?php } ?>
              <div class="top-info">
                <a href="javascript:void(0)" title="<?=$row['channel_title']?>" style="text-decoration:none;">
                  <span class="top-title">
                    <?php 
                      if(strlen($row['channel_title']) > 25){
                        echo substr(stripslashes($row['channel_title']), 0, 25).'...';  
                      }else{
                        echo $row['channel_title'];
                      }
                    ?>
                  </span>
                </a>
              </div>
              <span class="top-views"><i class="bi bi-eye-fill"></i> <?=thousandsNumberFormat($row['total_views'])?></span>
            </li>
            <?php }
              mysqli_free_result($res);

            }
            else{
              ?>
              <p class="empty-state">Nenhum dado disponível.</p>
              <?php
            }
        ?>
      </ul>
    </div>
  </div>
</div>

        
<?php include("includes/footer.php");?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Mês');
      data.addColumn('number', 'Usuários');

      data.addRows([<?=$countStr?>]);

      var options = {
        curveType: 'function',
        fontName: 'Lexend Deca',
        fontSize: 13,
        colors: ['#e4470f'],
        hAxis: {
          title: "Meses de <?=(isset($_GET['filterByYear'])) ? (int)$_GET['filterByYear'] : date('Y')?>",
          titleTextStyle: {
            color: '#8a7a70',
            bold:'true',
            italic: false
          },
          textStyle: { color: '#8a7a70' }
        },
        vAxis: {
          title: "Novos usuários",
          titleTextStyle: {
            color: '#8a7a70',
            bold:'true',
            italic: false,
          },
          textStyle: { color: '#8a7a70' },
          gridlines: { count: 5, color: '#ece3dc' },
          format: '#',
          viewWindowMode: "explicit", viewWindow:{ min: 0 },
        },
        height: 300,
        chartArea:{
          left:70,top:14,width:'93%',height:'auto'
        },
        legend: {
            position: 'none'
        },
        lineWidth:4,
        animation: {
          startup: true,
          duration: 1200,
          easing: 'out',
        },
        pointSize: 5,
        pointShape: "circle",
        backgroundColor: 'transparent',

      };
      var chart = new google.visualization.LineChart(document.getElementById('registerChart'));

      chart.draw(data, options);
    }

    $(document).ready(function () {
        $(window).resize(function(){
            drawChart();
        });
    });
</script>

<script type="text/javascript">
  
  // filter of graph
  $("select[name='filterByYear']").on("change",function(e){
    $("#graphFilter").submit();
  });

</script>
