<div class="box no-radius">
	<div class="box-body">
		<div class="chart-responsive">
            <div class="chart" id="genset_tl_chart" style="height: 450px;width: 100%;"></div>
        </div>
	</div>
</div>
<div class="box no-radius">
	<div class="box-body">
		<div class="chart-responsive">
            <div class="chart" id="genset_office_chart" style="height: 450px;width: 100%;"></div>
        </div>
	</div>
</div>
<script type="text/javascript">
	am4core.ready(function() {
		var chart = am4core.create("genset_tl_chart", am4charts.XYChart);
		chart.scrollbarX = new am4core.Scrollbar();
		chart.dataSource.url = "<?=site_url();?>chart/tl/<?=$this->uri->segment(3)?>/<?=$start?>/<?=$end?>";
		var title = chart.titles.create();
		title.text = "Genset-TL";
		title.fontSize = 25;
		title.marginBottom = 15;
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "no_unit";
		categoryAxis.renderer.grid.template.location = 0;
		categoryAxis.renderer.minGridDistance = 10;
		categoryAxis.renderer.labels.template.horizontalCenter = "right";
		categoryAxis.renderer.labels.template.verticalCenter = "middle";
		categoryAxis.renderer.labels.template.rotation = 270;
		categoryAxis.tooltip.disabled = true;
		categoryAxis.renderer.minHeight = 110;
		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.renderer.minWidth = 50;
		valueAxis.title.text = "Hour Meter Total";
		valueAxis.renderer.grid.template.disabled = true;
		var series = chart.series.push(new am4charts.ColumnSeries());
		series.sequencedInterpolation = true;
		series.dataFields.valueY = "hm_total";
		series.dataFields.categoryX = "no_unit";
		series.tooltipText = "HM Total : [bold]{hm_total}";
		series.columns.template.strokeWidth = 0;
		series.showOnInit = false;
		series.tooltip.pointerOrientation = "vertical";
		series.columns.template.adapter.add("fill", function(fill, target) {
			return chart.colors.getIndex(target.dataItem.index);
		});
		chart.cursor = new am4charts.XYCursor();
	});
	am4core.ready(function() {
		var chart = am4core.create("genset_office_chart", am4charts.XYChart);
		chart.scrollbarX = new am4core.Scrollbar();
		chart.dataSource.url = "<?=site_url();?>chart/office/<?=$this->uri->segment(3)?>/<?=$start?>/<?=$end?>";
		var title = chart.titles.create();
		title.text = "Genset-Office";
		title.fontSize = 25;
		title.marginBottom = 15;
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "no_unit";
		categoryAxis.renderer.grid.template.location = 0;
		categoryAxis.renderer.minGridDistance = 10;
		categoryAxis.renderer.labels.template.horizontalCenter = "right";
		categoryAxis.renderer.labels.template.verticalCenter = "middle";
		categoryAxis.renderer.labels.template.rotation = 270;
		categoryAxis.tooltip.disabled = true;
		categoryAxis.renderer.minHeight = 110;
		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.renderer.minWidth = 50;
		valueAxis.title.text = "Hour Meter Total";
		valueAxis.renderer.grid.template.disabled = true;
		var series = chart.series.push(new am4charts.ColumnSeries());
		series.sequencedInterpolation = true;
		series.dataFields.valueY = "hm_total";
		series.dataFields.categoryX = "no_unit";
		series.tooltipText = "HM Total : [bold]{hm_total}";
		series.columns.template.strokeWidth = 0;
		series.showOnInit = false;
		series.tooltip.pointerOrientation = "vertical";
		series.columns.template.adapter.add("fill", function(fill, target) {
			return chart.colors.getIndex(target.dataItem.index);
		});
		chart.cursor = new am4charts.XYCursor();
	});
</script>