$('.js-select2').select2({ placeholder: "Pilih kota" });
$(document).ready(function () {
	var validobj = $('#formlisence').validate({
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
		    if (element.attr("name") == "plisence_keluaran_ktp") {
		    	error.insertAfter('#errorTerbitan');
		  	} else if(element.attr("name") == "alamat_kota_ktp") {
		  		error.insertAfter('#errorAlamatKTP');
		  	} else if(element.attr("name") == "alamat_kota_dom") {
		  		error.insertAfter('#errorAlamatDOM');
		  	} else {
		  		error.insertAfter(element);
		  	}
		},
	});

	$(document).on("change", ".select2-offscreen", function () {
        if (!$.isEmptyObject(validobj.submitted)) { validobj.form(); }
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
	    digits: "Harap masukkan hanya angka.",
	    equalTo: "Silakan masukkan nilai yang sama lagi.",
	    accept: "Harap masukkan nilai dengan ekstensi yang benar.",
	    maxlength: jQuery.validator.format("Harap masukkan tidak lebih dari {0} karakter."),
	    minlength: jQuery.validator.format("Harap masukkan setidaknya {0} karakter."),
	    rangelength: jQuery.validator.format("Masukkan nilai antara {0} dan {1} karakter."),
	    range: jQuery.validator.format("Harap masukkan nilai antara {0} dan {1}."),
	    max: jQuery.validator.format("Harap masukkan nilai kurang dari atau sama dengan {0}."),
	    min: jQuery.validator.format("Harap masukkan nilai yang lebih besar dari atau sama dengan {0}.")
	});
});

$(function() {
    if ($("#tipektp").is(":checked")) {
        $("#dateend_ktp").attr("disabled", "disabled");
    }
    $("#tipektp").click(function() {
        var ep = $("#dateend_ktp");
        if (ep) {
            ep.removeAttr("disabled");
            if (this.checked) { ep.attr("disabled", "disabled"); }
        }
    });
});

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

$(function() {
	if(localStorage.simA   == null) localStorage.simA   = "false";
	if(localStorage.simB1  == null) localStorage.simB1  = "false";
	if(localStorage.simB2  == null) localStorage.simB2  = "false";
	if(localStorage.simB2U == null) localStorage.simB2U = "false";
	if(localStorage.simC   == null) localStorage.simC   = "false";
	if(localStorage.simD   == null) localStorage.simD   = "false";
      
    $('#simA')
        .prop('checked', localStorage.simA == "true")
        .on('change', function() {
        localStorage.simA = this.checked;
        if(localStorage.simA == "true") {
            $('.sim-1').show();
        } else {
            $('.sim-1').hide();
            var cookie_name = 'plisence_number_A';
        }
    })
    .trigger('change');
        
    $('#simB1')
        .prop('checked', localStorage.simB1 == "true")
        .on('change', function() {
        localStorage.simB1 = this.checked;
        if(localStorage.simB1 == "true") {
            $('.sim-2').show();
        } else {
            $('.sim-2').hide();
        }
    })
    .trigger('change');

    $('#simB2')
        .prop('checked', localStorage.simB2 == "true")
        .on('change', function() {
        localStorage.simB2 = this.checked;
        if(localStorage.simB2 == "true") {
            $('.sim-3').show();
        } else {
            $('.sim-3').hide();
        }
    })
    .trigger('change');

    $('#simB2U')
        .prop('checked', localStorage.simB2U == "true")
        .on('change', function() {
        localStorage.simB2U = this.checked;
        if(localStorage.simB2U == "true") {
            $('.sim-4').show();
        } else {
            $('.sim-4').hide();
        }
    })
    .trigger('change');

    $('#simC')
        .prop('checked', localStorage.simC == "true")
        .on('change', function() {
        localStorage.simC = this.checked;
        if(localStorage.simC == "true") {
            $('.sim-5').show();
        } else {
            $('.sim-5').hide();
        }
    })
    .trigger('change');

    $('#simD')
        .prop('checked', localStorage.simD == "true")
        .on('change', function() {
        localStorage.simD = this.checked;
        if(localStorage.simD == "true") {
            $('.sim-6').show();
        } else {
            $('.sim-6').hide();
        }
    })
    .trigger('change');
});