$(function() {
	$('.datepickerz').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		startView: 2,
		daysOfWeekHighlighted: "0"
	});

    
});

$('#formjobhis').validate();
jQuery.extend(jQuery.validator.messages, { required: "Kolom ini wajib diisi." });
$('.alpha').alphanum({allowNumeric: true});
$('.num').numeric({allow: '.'});
$('.select_job').select2({ placeholder: "Pilih Bidang" });

function show1(){ document.getElementById('div1').style.display ='block'; }
function show2(){ document.getElementById('div1').style.display = 'none'; }

$(function() {
	if(localStorage.hasJobYa == null) localStorage.hasJobYa  = "false";
	if(localStorage.jobhis2  == null) localStorage.jobhis2   = "false";
	if(localStorage.jobhis3  == null) localStorage.jobhis3   = "false";
	if(localStorage.jobhis4  == null) localStorage.jobhis4   = "false";

	$('#hasJobYa')
        .prop('checked', localStorage.hasJobYa == "true")
        .on('change', function() {
        localStorage.hasJobYa = this.checked;
        if(localStorage.hasJobYa == "true") {
            $('.hasJobYa').show();
        } else {
            $('.hasJobYa').hide();
        }
    })
    .trigger('change');
      
    $('#jobhis2')
        .prop('checked', localStorage.jobhis2 == "true")
        .on('change', function() {
        localStorage.jobhis2 = this.checked;
        if(localStorage.jobhis2 == "true") {
            $('.jobhis2').show();
        } else {
            $('.jobhis2').hide();
        }
    })
    .trigger('change');

    $('#jobhis3')
        .prop('checked', localStorage.jobhis3 == "true")
        .on('change', function() {
        localStorage.jobhis3 = this.checked;
        if(localStorage.jobhis3 == "true") {
            $('.jobhis3').show();
        } else {
            $('.jobhis3').hide();
        }
    })
    .trigger('change');

    $('#jobhis4')
        .prop('checked', localStorage.jobhis4 == "true")
        .on('change', function() {
        localStorage.jobhis4 = this.checked;
        if(localStorage.jobhis4 == "true") {
            $('.jobhis4').show();
        } else {
            $('.jobhis4').hide();
        }
    })
    .trigger('change');
});