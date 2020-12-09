$(document).ready(function () {
	var validobj = $('#formdatadiri').validate({
		onkeyup: false,
        errorClass: "error",
		rule: { people_email: true },
	    messages: {
	        people_firstname: "Masukkan nama anda",
	        people_birth_place: "Masukkan tempat lahir anda",
	        people_birth_date: "Masukkan tanggal lahir anda",
	        people_gender: "Pilih jenis kelamin anda",
	        plisence_number: "Masukkan nomor KTP anda",
	        people_mobile: "Masukkan nomor handphone anda",
	        pstat_status: "Pilih status anda",
	        people_religion: "Pilih agama anda",
	        people_citizen: "Pilih status Kewarganegaraan anda",
	        people_blood_type: "Pilih golongan darah anda",
	        people_height: "Masukkan tinggi badan anda",
	        people_weight: "Masukkan berat badan anda",
	        people_email: "Masukkan format email yang benar"
	    },
	    highlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").addClass(errorClass);
            } else { elem.addClass(errorClass); }
        },
        unhighlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
            } else { elem.removeClass(errorClass); }
        },
	    errorPlacement: function(error, element) {
	    	if (element.attr("name") == "people_firstname") {
		    	error.insertAfter(element);
		  	}
		  	if (element.attr("name") == "people_mobile") {
		    	error.insertAfter(element);
		  	}
		  	if (element.attr("name") == "lstColors") {
		   		error.insertAfter(element);
		  	}
		  	if (element.attr("name") == "people_email") {
		    	error.insertAfter(element);
		  	}
		  	if (element.attr("name") == "plisence_number") {
		    	error.insertAfter(element);
		  	}
		  	if (element.attr("name") == "people_birth_place") {
		    	error.insertAfter("#errorBorn");
		  	}
		  	if (element.attr("name") == "people_birth_date") {
		    	error.insertAfter(element);
		  	}
			if (element.attr("name") == "people_gender") {
				error.insertAfter("#errorGender");
			}
			if (element.attr("name") == "pstat_status") {
				error.insertAfter("#errorStatus");
			} 
			if (element.attr("name") == "people_religion") {
				error.insertAfter("#errorReligion");
			} 
			if (element.attr("name") == "people_citizen") {
				error.insertAfter("#errorCitizen");
			} 
			if (element.attr("name") == "people_blood_type") {
				error.insertAfter("#errorBlood");
			}
			if (element.attr("name") == "people_height") {
				error.insertAfter("#errorHeight");
			}
			if (element.attr("name") == "people_weight") {
				error.insertAfter("#errorWeight");
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
        if ($("#s2id_" + elem.attr("id") + " ul").hasClass("myErrorClass")) {
            $(".select2-drop ul").addClass("myErrorClass");
        } else {
            $(".select2-drop ul").removeClass("myErrorClass");
        }
    });
});
	
$(document).ready(function() { $('#plisence_number').blur(checkAvailability1); });

$('.alpha').alphanum({allowNumeric: false});
$('.num').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false, allowMinus: false});
$('#people_birth_place').select2();

$('#klikinfo').click(function() {
    $('#infoemail').css({
        'background-color': 'red',
        'color': 'white'
    });
});
$(function() {
    $('#people_birth_date').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		startView: 2,
		daysOfWeekHighlighted: "0"
	});
});
function checkAvailability1(){
    var plisence_number = $('#plisence_number').val(); 
    if(plisence_number == "" || plisence_number.length < 5){  
        $("#ktp-availability-status").html('Masukkan minimal 5 karakter.').css('color', 'red');  
    } else if (plisence_number.length > 17) {
    	$("#ktp-availability-status").html('Maksimal hanya 17 karakter saja.').css('color', 'red');
    } else {
        $.ajax({
            type: "POST",
            url: "registration/checkAvailKTP",
            cache: false,    
            data:'plisence_number=' + $("#plisence_number").val(),
            success: function(response){ 
                try {
                    if(response == "false"){
                        $("#ktp-availability-status").html('KTP dapat digunakan').css('color', 'green');
                    } else {
                        $("#ktp-availability-status").html('KTP sudah pernah terdaftar, gunakan fitur login untuk mengakses akun atau gunakan fitur lupa password jika lupa password Anda.').css('color', 'red');
                    }          
                } catch(e) {  
                    swall("Oops!", "Terjadi kesalahan.. Reload halaman ini dan pastikan koneksi internet Anda stabil.", "error");
                }  
            },
            error: function(){      
                swall("Oops!", "Terjadi kesalahan.. Reload halaman ini dan pastikan koneksi internet Anda stabil.", "error");
            }
        });
    }
}