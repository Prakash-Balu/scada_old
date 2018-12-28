<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row">
              <div class="col-md-12">
                <div class="">
                  <div class="x_content">
                    <div class="row">
                    <?php foreach($response as $key=>$val){ ?>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats text-center <?php echo $key.'-box';?>">
                          <label class="count" style="color: #fff;"><?php echo $val['name'].' : '.$val['count'] ?></label>
                          <div class="border-line"></div>
                          <h5 style="color: #fff;font-weight: bold;padding-top: 10px;">Total WTG : <?php echo $val['total'] ?></h5>
                        </div>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
              <div class="col-md-6 col-sm-6 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2> Wind Speed</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div id="chart_plot_03" class="demo-placeholder"></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div id="chart_02" class="demo-placeholder"></div>
                    </div> -->

                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <lable>AVG wind speed : </lable> <?php echo $avgWindSpeedSum;?>
                      <div class="avg_wind_speed graph" style="height: 70px;">
                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <lable>Real Power : </lable> <?php echo $powerSpeedSum;?>
                      <div class="power_speed graph" style="height: 70px;">
                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </div>
                    </div>
                    <!--<div class="col-md-12 col-sm-12 col-xs-12">
                    <lable>Export GAD : </lable> <?php echo $patGenSum;?>
                      <span class="export_gad graph" style="height: 160px;">
                                 <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                    </div>-->

                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div id="export_gad" style="height:350px;"></div>
                    </div>

                  </div>
                  
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Performance Trending Chart</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Device 1</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Device 2</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Device 3</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Device 4</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <iframe width="530" height="320" src="https://embed.windy.com/embed2.html?lat=13.083&lon=80.283&zoom=6&level=surface&overlay=wind&menu=&message=&marker=&calendar=&pressure=&type=map&location=coordinates&detail=&detailLat=13.083&detailLon=80.283&metricWind=default&metricTemp=default&radarRange=-1" frameborder="0"></iframe>
            </div>

              <div class="col-md-6 col-sm-6 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2> Temperature Trending</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div id="chart_plot_01" class="demo-placeholder"></div>
                  </div>
                </div>
          
        </div>
        <!-- /page content -->

<?php  $this->load->view('layout/footer'); ?>

<script type='text/javascript'>
  var avg_wind_speed =<?php echo json_encode($avgWindSpeed );?>;
  var power_speed =<?php echo json_encode($powerSpeed );?>;
  var pat_gen =<?php echo json_encode($patGen );?>;

var theme = {
				  color: [
					  '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
					  '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
				  ]};
			  if ($('#export_gad').length ){
			  
        var echartBar = echarts.init(document.getElementById('export_gad'), theme);

        echartBar.setOption({
        title: {
          text: 'Export GAD'
         // subtext: 'Graph Sub-text'
        },
        tooltip: {
          trigger: 'axis'
        },
        legend: {
          data: ['purchases']
        },
        toolbox: {
          show: false
        },
        calculable: false,
        xAxis: [{
          type: 'category',
          data: ['10', '20', '30', '40', '50', '60', '70', '80', '90', '100', '110', '120']
        }],
        yAxis: [{
          type: 'value',
        //  data: ['100', '200', '500', '1000', '1500', '2000', '2500', '3000', '4000', '5000', '6000', '7000']
        }],
        series: [{
         // name: 'purchases',
          type: 'bar',
          data: pat_gen,
         /* markPoint: {
          data: [{
            name: 'sales',
            value: 182.2,
            xAxis: 7,
            yAxis: 183,
          }, {
            name: 'purchases',
            value: 2.3,
            xAxis: 11,
            yAxis: 3
          }]
          },
          markLine: {
          data: [{
            type: 'average',
            name: '???'
          }]
          }*/
        }]
        });

    }
	$(".avg_wind_speed").sparkline(avg_wind_speed, {
				type: 'line',
				height: '40',
				width: '100%',
				lineColor: 'green',
				fillColor: 'white',
				lineWidth: 5,
				spotColor: 'red',
				minSpotColor: 'orange'
			});

			$(".power_speed").sparkline(power_speed, {
				title:'Power Speed',
				type: 'line',
				height: '40',
				width: '100%',
				lineColor: 'blue',
				fillColor: 'white',
				lineWidth: 5,
				spotColor: 'red',
				minSpotColor: 'orange'
      });
      
      // $(".export_gad").sparkline(pat_gen, {
			// 	type: 'bar',
      //   height: '100%',
      //   width: '100%',
			// 	barWidth: 8,
			// 	colorMap: {
			// 		'10': '#a1a1a1'
			// 	},
			// 	barSpacing: 2,
			// 	barColor: 'orange'
      // });

     
</script>