$('#edu_tipe').select2({ placeholder: "Pilih Jenjang" });
$('#edu_kota').select2({ placeholder: "Pilih Kota" });
$('#edu_jurusan').select2({ placeholder: "Pilih Jurusan" });
$(function() {
    $('.datepickerz').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		startView: 2,
		daysOfWeekHighlighted: "0"
	});
});

$('.alpha').alphanum({allowNumeric: false});
$('.num').numeric();

$(document).ready(function () {
	var validobj = $('#formeducation').validate({
		onkeyup: false,
        errorClass: "error",

	    highlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").addClass(errorClass);
            } else {
                elem.addClass(errorClass);
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
            } else {
                elem.removeClass(errorClass);
            }
        },
	    errorPlacement: function(error, element) {
		    if (element.attr("name") == "edu_tipe") {
		    	error.insertAfter('#errorEduTipe');
		  	} else if(element.attr("name") == "edu_kota") {
		  		error.insertAfter('#errorEduKota');
		  	} else {
		  		error.insertAfter(element);
		  	}
		},
	});
	$(document).on("change", ".select2-offscreen", function () {
        if (!$.isEmptyObject(validobj.submitted)) {
            validobj.form();
        }
    });
    $(document).on("select2-opening", function (arg) {
        var elem = $(arg.target);
        if ($("#s2id_" + elem.attr("id") + " ul").hasClass("error")) {
            $(".select2-drop ul").addClass("error");
        } else {
            $(".select2-drop ul").removeClass("error");
        }
    });
    jQuery.extend(jQuery.validator.messages, {
	    required: "Kolom ini wajib diisi.",
	    remote: "Silakan perbaiki kolom ini.",
	    email: "Format email salah.",
	    url: "Format URL salah.",
	    date: "Harap masukkan tanggal yang benar.",
	    dateISO: "Harap masukkan tanggal yang benar (ISO).",
	    number: "Harap masukkan nomor yang benar.",
	    digits: "Harap masukkan hanya angka."
	});
});