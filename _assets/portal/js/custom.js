jQuery(document).ready(function(){
    jQuery("body").append( jQuery(".page-container .all-modals") );
});

replaceCheckboxes();

$(document).ready(function() {
	$('.datepicker').datepicker({
		format: 'dd-mm-yyyy',
		todayBtn: true,
		timePicker: true,
		autoclose: true
	});
});

if($.isFunction($.fn.datepicker)){
	$(".datepicker").each(function(i, el){
		var $this = $(el),
			opts = {
				format: attrDefault($this, 'format', 'dd-mm-yyyy'),
				startDate: attrDefault($this, 'startDate', ''),
				endDate: attrDefault($this, 'endDate', ''),
				daysOfWeekDisabled: attrDefault($this, 'disabledDays', ''),
				startView: attrDefault($this, 'startView', 0),
				rtl: rtl()
			},
			$n = $this.next(),
			$p = $this.prev();
						
		$this.datepicker(opts);
		
		if($n.is('.input-group-addon') && $n.has('a')){
			$n.on('click', function(ev){
				ev.preventDefault();
				$this.datepicker('show');
			});
		}
		
		if($p.is('.input-group-addon') && $p.has('a')){
			$p.on('click', function(ev){
				ev.preventDefault();
				$this.datepicker('show');
			});
		}
	});
}

if($.isFunction($.fn.timepicker)){
	$(".timepicker").each(function(i, el){
		var $this = $(el),
			opts = {
				template: attrDefault($this, 'template', false),
				showSeconds: attrDefault($this, 'showSeconds', false),
				defaultTime: attrDefault($this, 'defaultTime', 'current'),
				showMeridian: attrDefault($this, 'showMeridian', true),
				minuteStep: attrDefault($this, 'minuteStep', 15),
				secondStep: attrDefault($this, 'secondStep', 15)
			},
			$n = $this.next(),
			$p = $this.prev();
		
		$this.timepicker(opts);
		
		if($n.is('.input-group-addon') && $n.has('a')){
			$n.on('click', function(ev){
				ev.preventDefault();
				$this.timepicker('showWidget');
			});
		}
		
		if($p.is('.input-group-addon') && $p.has('a')){
			$p.on('click', function(ev){
				ev.preventDefault();
				$this.timepicker('showWidget');
			});
		}
	});
}






