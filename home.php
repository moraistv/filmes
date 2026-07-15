<?php 
    $page_title="Dashboard";
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

    for ($mon=1; $mon<=12; $mon++) {

        if(date('n') < $mon){
          break;
        }
        
        if(isset($_GET['filterByYear'])){

          $year=$_GET['filterByYear'];

          $month = date('M', mktime(0,0,0,$mon, 1, $year));

          $sql_user="SELECT `id` FROM tbl_users WHERE DATE_FORMAT(FROM_UNIXTIME(`register_on`), '%c') = '$mon' AND DATE_FORMAT(FROM_UNIXTIME(`register_on`), '%Y') = '$year'";
        }
        else{

          $month = date('M', mktime(0,0,0,$mon, 1, date('Y')));

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


<div class="btn-floating" id="help-actions">
  <div class="btn-bg"></div>
  <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions"> <i class="icon fa fa-plus"></i> <span class="help-text">Shortcut</span> </button>
  <div class="toggle-content">
    <ul class="actions">
      <li><a href="http://www.viaviweb.com" target="_blank">Website</a></li>
       <li><a href="https://codecanyon.net/user/viaviwebtech?ref=viaviwebtech" target="_blank">About</a></li>
    </ul>
  </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_category.php" class="card card-banner card-green-light">
      <div class="card-body"> <i class="icon fa fa-sitemap fa-4x"></i>
        <div class="content">
          <div class="title">Categories</div>
          <div class="value"><span class="sign"></span><?php echo thousandsNumberFormat($total_category);?></div>
        </div>
      </div>
      </a> 
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_movies.php" class="card card-banner card-yellow-light">
      <div class="card-body"> <i class="icon fa fa-video-camera fa-4x"></i>
        <div class="content">
          <div class="title">Movies</div>
          <div class="value"><span class="sign"></span><?php echo thousandsNumberFormat($total_movies);?></div>
        </div>
      </div>
      </a> 
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_series.php" class="card card-banner card-blue-light">
      <div class="card-body"> <i class="icon fa fa-list fa-4x"></i>
        <div class="content">
          <div class="title">TV Series</div>
          <div class="value"><span class="sign"></span><?php echo thousandsNumberFormat($total_series);?></div>
        </div>
      </div>
      </a> 
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_channels.php" class="card card-banner card-pink-light">
      <div class="card-body"> <i class="icon fa fa-tv fa-4x"></i>
        <div class="content">
          <div class="title">Channels</div>
          <div class="value"><span class="sign"></span><?php echo thousandsNumberFormat($total_channels);?></div>
        </div>
      </div>
      </a> 
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_comments.php" class="card card-banner card-alicerose-light">
      <div class="card-body"> <i class="icon fa fa-comments fa-4x"></i>
        <div class="content">
          <div class="title">Comments</div>
          <div class="value"><span class="sign"></span><?php echo thousandsNumberFormat($total_comments);?></div>
        </div>
      </div>
      </a>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_reports.php" class="card card-banner card-pink-light">
      <div class="card-body"> <i class="icon fa fa-bug fa-4x"></i>
        <div class="content">
          <div class="title">Reports</div>
          <div class="value"><span class="sign"></span><?php echo thousandsNumberFormat($total_reports);?></div>
        </div>
      </div>
      </a>
    </div>  

    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_users.php" class="card card-banner card-orange-light">
      <div class="card-body"> <i class="icon fa fa-users fa-4x"></i>
        <div class="content">
          <div class="title">Users</div>
          <div class="value"><span class="sign"></span><?php echo thousandsNumberFormat($total_users);?></div>
        </div>
      </div>
      </a> 
    </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="container-fluid" style="background: #FFF;box-shadow: 0px 5px 10px 0px #CCC;border-radius: 2px;">
      <div class="col-lg-10">
        <h3>Users Analysis</h3>
        <p>New registrations</p>
      </div>
      <div class="col-lg-2" style="padding-top: 20px">
        <form method="get" id="graphFilter">
          <select class="form-control" name="filterByYear" style="box-shadow: none;height: auto;border-radius: 0px;font-size: 16px;">
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
      <div class="col-lg-12">
        <?php 
          if($no_data_status){
            ?>
            <h3 class="text-muted text-center" style="padding-bottom: 2em">No data found !</h3>
            <?php
          }
          else{
            ?>
            <div id="registerChart">
              <p style="text-align: center;"><i class="fa fa-spinner fa-spin" style="font-size:3em;color:#aaa;margin-bottom:50px" aria-hidden="true"></i></p>
            </div>
            <?php    
          }
        ?>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-4">
    <div class="container-fluid" style="background: #FFF;box-shadow: 0px 5px 10px 0px #CCC;border-radius: 2px">
      <h3>Most viewed series</h3>
      <p>Series with more views.</p>
      <table class="table table-hover">
        <?php 
          $sql="SELECT * FROM tbl_series WHERE `total_views` > 5 ORDER BY `total_views` DESC LIMIT 10";
          $res=mysqli_query($mysqli, $sql);
          if(mysqli_num_rows($res) > 0)
          {

            while ($row=mysqli_fetch_assoc($res)) {
            ?>
            <tr>
              <td>
                <div style="float: left;padding-right: 20px">
                  <?php if($row['series_cover']!='' OR !file_exists('images/series/'.$row['series_cover'])){ ?>
                    <img src="<?='images/series/'.$row['series_cover']?>" style="width: 40px;height: 40px;border-radius: 50%"/>  
                  <?php }else{ ?>
                    <img src="<?='images/'.APP_LOGO?>" style="width: 40px;height: 40px;border-radius: 50%"/>  
                  <?php } ?>
                </div>
                <div>
                  <a href="javascript:void(0)" title="<?=$row['series_name']?>" style="color: inherit;">
                    <?php 
                      if(strlen($row['series_name']) > 25){
                        echo substr(stripslashes($row['series_name']), 0, 25).'...';  
                      }else{
                        echo $row['series_name'];
                      }
                    ?>
                    <p style="font-weight: 500"><span class="label label-default" style="font-size: 10px;padding: 2px 8px;">Views: <?=thousandsNumberFormat($row['total_views'])?></p> 
                  </a>
                </div>
              </td>
            </tr>
            <?php }
              mysqli_free_result($res);
            }
            else{
              ?>
              <tr>
                <td class="text-center">No data available !</td>
              </tr>
              <?php
            }
        ?>
      </table>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="container-fluid" style="background: #FFF;box-shadow: 0px 5px 10px 0px #CCC;border-radius: 2px">
      <h3>Most viewed movies</h3>
      <p>Movies with more views.</p>
      <table class="table table-hover">
        <?php 
          $sql="SELECT * FROM tbl_movies WHERE `total_views` > 5 ORDER BY `total_views` DESC LIMIT 10";
          $res=mysqli_query($mysqli, $sql);

          if(mysqli_num_rows($res) > 0)
          {

            while ($row=mysqli_fetch_assoc($res)) {
            ?>
            <tr>
              <td>
                <div style="float: left;padding-right: 20px">
                  <?php if($row['movie_cover']!='' OR !file_exists('images/movies/'.$row['movie_cover'])){ ?>
                    <img src="<?='images/movies/'.$row['movie_cover']?>" style="width: 40px;height: 40px;border-radius: 50%"/>  
                  <?php }else{ ?>
                    <img src="<?='images/'.APP_LOGO?>" style="width: 40px;height: 40px;border-radius: 50%"/>  
                  <?php } ?>
                </div>
                <div>
                  <a href="javascript:void(0)" title="<?=$row['movie_title']?>" style="color: inherit;">
                    <?php 
                      if(strlen($row['movie_title']) > 25){
                        echo substr(stripslashes($row['movie_title']), 0, 25).'...';  
                      }else{
                        echo $row['movie_title'];
                      }
                    ?>
                    <p style="font-weight: 500"><span class="label label-default" style="font-size: 10px;padding: 2px 8px;">Views: <?=thousandsNumberFormat($row['total_views'])?></p> 
                  </a>
                </div>
              </td>
            </tr>
            <?php }
              mysqli_free_result($res);

            }
            else{
              ?>
              <tr>
                <td class="text-center">No data available !</td>
              </tr>
              <?php
            }
        ?>
      </table>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="container-fluid" style="background: #FFF;box-shadow: 0px 5px 10px 0px #CCC;border-radius: 2px">
      <h3>Most viewed channels</h3>
      <p>Channels with more views.</p>
      <table class="table table-hover">
        <?php 
          $sql="SELECT * FROM tbl_channels WHERE `total_views` > 5 ORDER BY `total_views` DESC LIMIT 10";
          $res=mysqli_query($mysqli, $sql);

          if(mysqli_num_rows($res) > 0)
          {

            while ($row=mysqli_fetch_assoc($res)) {
            ?>
            <tr>
              <td>
                <div style="float: left;padding-right: 20px">
                  <?php if($row['channel_thumbnail']!='' OR !file_exists('images/'.$row['channel_thumbnail'])){ ?>
                    <img src="<?='images/'.$row['channel_thumbnail']?>" style="width: 40px;height: 40px;border-radius: 50%"/>  
                  <?php }else{ ?>
                    <img src="<?='images/'.APP_LOGO?>" style="width: 40px;height: 40px;border-radius: 50%"/>  
                  <?php } ?>
                </div>
                <div>
                  <a href="javascript:void(0)" title="<?=$row['channel_title']?>" style="color: inherit;">
                    <?php 
                      if(strlen($row['channel_title']) > 25){
                        echo substr(stripslashes($row['channel_title']), 0, 25).'...';  
                      }else{
                        echo $row['channel_title'];
                      }
                    ?>
                    <p style="font-weight: 500"><span class="label label-default" style="font-size: 10px;padding: 2px 8px;">Views: <?=thousandsNumberFormat($row['total_views'])?></p> 
                  </a>
                </div>
              </td>
            </tr>
            <?php }
              mysqli_free_result($res);

            }
            else{
              ?>
              <tr>
                <td class="text-center">No data available !</td>
              </tr>
              <?php
            }
        ?>
      </table>
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
      data.addColumn('string', 'Month');
      data.addColumn('number', 'Users');

      data.addRows([<?=$countStr?>]);

      var options = {
        curveType: 'function',
        fontSize: 15,
        hAxis: {
          title: "Months of <?=(isset($_GET['filterByYear'])) ? $_GET['filterByYear'] : date('Y')?>",
          titleTextStyle: {
            color: '#000',
            bold:'true',
            italic: false
          },
        },
        vAxis: {
          title: "Nos of Users",
          titleTextStyle: {
            color: '#000',
            bold:'true',
            italic: false,
          },
          gridlines: { count: 5},
          format: '#',
          viewWindowMode: "explicit", viewWindow:{ min: 0 },
        },
        height: 400,
        chartArea:{
          left:100,top:20,width:'100%',height:'auto'
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
