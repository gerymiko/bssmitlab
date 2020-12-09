$('.alpha').alphanum({
	allowNumeric: true,
	allow: ',.'
});
$('.num').numeric();

$(document).ready(function () {
	var validobj = $('#formquestion').validate({
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
		    if (element.attr("name") == "question_placement") {
		    	error.insertAfter('#errorPlacement');
		  	} else if(element.attr("name") == "question_shift") {
		  		error.insertAfter('#errorShift');
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
    jQuery.extend(jQuery.validator.messages, { required: "Kolom ini wajib diisi." });
});