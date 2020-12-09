(function ($) {
    "use strict";
    $('.select2').select2({ placeholder: 'Pilih Site', allowClear: true });
    /*[ Focus input ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != ""){
                $(this).addClass('has-val');
            } else {
                $(this).removeClass('has-val');
            }
        });
    });    
    /*[ Show pass ]*/
    var showPass = 0;
    $('.btn-show-pass').on('click', function(){
        if(showPass == 0){
            $(this).next('input').attr('type','text');
            $(this).find('i').removeClass('zmdi-eye');
            $(this).find('i').addClass('zmdi-eye-off');
            showPass = 1;
        } else {
            $(this).next('input').attr('type','password');
            $(this).find('i').addClass('zmdi-eye');
            $(this).find('i').removeClass('zmdi-eye-off');
            showPass = 0;
        }
    });
    $('._CnUmB').numeric({allowThouSep: false,   allowDecSep: false, allowPlus: false, allowMinus: false});
    $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '_.@' });
    $('#form-login').validate();
    $('.select2').one('select2:open', function(e) {
        $('input.select2-search__field').prop('placeholder', 'Cari site');
    });
})(jQuery);