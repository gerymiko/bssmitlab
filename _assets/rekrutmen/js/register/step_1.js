$('#formlogin').validate({
    rules: {
        username: "required",
        password: "required",
        repassword: "required",
        repassword: {
	    	equalTo: "#password"
	    }
    },
    messages: {
        username: "Masukkan username.",
        password: "Masukkan password.",
        repassword: "Masukkan password yang sama.",
    },
    errorContainer: $('#errorContainer'),
    errorLabelContainer: $('#errorContainer ul'),
    wrapper: 'li'
});

$(document).ready(function(){
    $('#username').blur(checkAvailability1);
});

$('#username').alphanum({allowSpace: false, disallow: ''});
$('#password').alphanum({allowSpace: false, disallow: ''});

function checkAvailability1(){
    var username = $('#username').val();
    if(username == "" || username.length < 6){  
        $("#user-availability-status").html('Masukkan minimal 6 karakter.').css('color', 'red');  
    } else if (username.length > 20) {
    	$("#user-availability-status").html('Maksimal 20 karakter.').css('color', 'red');
    } else {
        $.ajax({
            type: "POST",
            url: "registration/checkAvailUser",
            cache: false,
            data: 'username=' + $('#username').val(),
            success: function(response){ 
                try {
                    if(response == "false"){
                        $('#user-availability-status').html('Username dapat digunakan').css('color', 'green');
                    } else {
                        $('#user-availability-status').html('Username tidak dapat digunakan. Gunakan username yang lain.').css('color', 'red');
                    }          
                } catch(e) {  
                    swal("Opss!", "Terjadi kesalahan sistem, mohon refresh ulang halaman ini atau cek koneksi internet anda", "error");
                }  
            },
            error: function(){      
                swal("Opss!", "Terjadi kesalahan sistem, mohon refresh ulang halaman ini atau cek koneksi internet anda", "error");
            }
        });
    }
}

$("#showHide").click(function () {
    if ($("#password").attr("type") == "password") {
        $("#password").attr("type", "text");
        $("#showHide").show("<i class='fa fa-eye-slash' style='color: #FFF; padding: 0px;'></i>");
    } else {
        $("#password").attr("type", "password");
        $("#showHide").show("<i class='fa fa-eye-slash' style='color: #FFF; padding: 0px;'></i>");
    }
});
$("#showHide2").click(function () {
    if ($("#repassword").attr("type") == "password") {
        $("#repassword").attr("type", "text");
        $("#showHide2").show("<i class='icon-eye' style='color: #C3C3C3; padding: 0px;'></i>");
    } else {
        $("#repassword").attr("type", "password");
        $("#showHide2").show("<i class='icon-eye' style='color: #C3C3C3; padding: 0px;'></i>");
    }
});	