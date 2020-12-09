<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>MOSENTO | PT BINA SARANA SUKSES</title>
   <meta name="description" content="web.binasaranasukses.com/mosento" />
   <meta name="keywords" content="web.binasaranasukses.com/mosento" />
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta property="og:type" content="business.business">
   <meta property="og:title" content="PT BINA SARANA SUKSES">
   <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
   <meta property="og:url" content="web.binasaranasukses.com/mosento">
   <meta property="og:image" content="<?=site_url();?>getimage/png/compact">
   <meta property="business:contact_data:street_address" content="Jl. Pantai Indah Utara 2, Pantai Indah Kapuk Penjaringan">
   <meta property="business:contact_data:locality" content="Jakarta">
   <meta property="business:contact_data:region" content="DKI Jakarta">
   <meta property="business:contact_data:postal_code" content="14460">
   <meta property="business:contact_data:country_name" content="Indonesia">
   <link rel="shortcut icon" type="image/png" href="<?=site_url();?>getimage/png/compact"/>
   <?php
      function siteURL(){
         $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
         $domainName = $_SERVER['HTTP_HOST'].'/';
         return $protocol.$domainName;
      }
      define('SITE_URL', siteURL());
      $this->load->view($header);
   ?>
   <style>
      #chartdiv {
         width: 100%;
         height: 500px;
      }
   </style>
</head>
<body class="hold-transition skin-blue layout-top-nav">
   <div class="wrapper">
      <header class="main-header">
         <nav class="navbar navbar-static-top">
            <div class="container">
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <li data-tooltip="logout" data-tooltip-place="bottom">
                        <a href="<?=site_url();?>logout"><i class="fas fa-power-off"></i></a>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <div class="content-wrapper">
         <div class="container">
            <section class="content">
               <div id="chartdiv"></div>
            </section>
         </div>
      </div>
   </div>
   <?php $this->load->view($footer); ?>
   <script type="text/javascript">
      am4core.ready(function() {
         var chart = am4core.create('chartdiv', am4charts.XYChart)
         chart.colors.step = 2;

         chart.dataSource.url = "<?=site_url();?>cnew/sysnew/chart_data1";         

         chart.legend = new am4charts.Legend()
         chart.legend.position = 'top'
         chart.legend.paddingBottom = 20
         chart.legend.labels.template.maxWidth = 95

         var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
         xAxis.dataFields.category = 'tahun'
         xAxis.renderer.cellStartLocation = 0.1
         xAxis.renderer.cellEndLocation = 0.9
         xAxis.renderer.grid.template.location = 0;

         var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
         yAxis.min = 0;

         function createSeries(value, name) {
            var series = chart.series.push(new am4charts.ColumnSeries())
            series.dataFields.valueY = value
            series.dataFields.categoryX = 'tahun'
            series.name = name
            series.events.on("hidden", arrangeColumns);
            series.events.on("shown", arrangeColumns);
            var bullet = series.bullets.push(new am4charts.LabelBullet())
            bullet.interactionsEnabled = false
            bullet.dy = 30;
            bullet.label.text = '{valueY}'
            bullet.label.fill = am4core.color('#ffffff');
            return series;
         }

         createSeries('TELKOM-SMD', 'TELKOM SMD');
         // createSeries('second', 'The Second');
         // createSeries('third', 'The Third');

         function arrangeColumns() {
            var series = chart.series.getIndex(0);
            var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
            if (series.dataItems.length > 1) {
               var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
               var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
               var delta = ((x1 - x0) / chart.series.length) * w;
               if (am4core.isNumber(delta)) {
                  var middle = chart.series.length / 2;
                  var newIndex = 0;
                  chart.series.each(function(series) {
                     if (!series.isHidden && !series.isHiding) {
                        series.dummyData = newIndex;
                        newIndex++;
                     } else {
                        series.dummyData = chart.series.indexOf(series);
                     }
                  });
                  var visibleCount = newIndex;
                  var newMiddle = visibleCount / 2;
                  chart.series.each(function(series) {
                     var trueIndex = chart.series.indexOf(series);
                     var newIndex = series.dummyData;
                     var dx = (newIndex - trueIndex + middle - newMiddle) * delta
                     series.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                     series.bulletsContainer.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                  });
               }
            }
         }
      });
   </script>
</body>
</html>
