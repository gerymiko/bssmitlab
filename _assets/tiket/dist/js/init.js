jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "formatted-num-pre": function ( a ) {
        a = (a === "-" || a === "") ? 0 : a.replace( /[^\d\-\.]/g, "" );
        return parseFloat( a );
    },
 
    "formatted-num-asc": function ( a, b ) {
        return a - b;
    },
 
    "formatted-num-desc": function ( a, b ) {
        return b - a;
    }
});
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
	/*TABS*/
    var numItems = $('li.fancyTab').length;
    if (numItems == 12) {
        $("li.fancyTab").width('8.3%');
    }
    if (numItems == 11) {
        $("li.fancyTab").width('9%');
    }
    if (numItems == 10) {
        $("li.fancyTab").width('10%');
    }
    if (numItems == 9) {
        $("li.fancyTab").width('11.1%');
    }
    if (numItems == 8) {
        $("li.fancyTab").width('12.5%');
    }
    if (numItems == 7) {
        $("li.fancyTab").width('14.2%');
    }
    if (numItems == 6) {
        $("li.fancyTab").width('16.666666666666667%');
    }
    if (numItems == 5) {
        $("li.fancyTab").width('20%');
    }
    if (numItems == 4) {
        $("li.fancyTab").width('25%');
    }
    if (numItems == 3) {
        $("li.fancyTab").width('33.3%');
    }
    if (numItems == 2) {
        $("li.fancyTab").width('50%');
    }
    // Select2
    $.fn.select2.defaults.set( "theme", "bootstrap" );
    $('.select2js').select2({
        width: '100%'
    });
    // Return Flight Field
    $( "#fReturn" ).focus(function() {
        $("#fReturn").removeAttr("readonly");
    });
    // Tour Book Date
    $('#tDate').datetimepicker({
        useCurrent: false,
        minDate: moment().add(1, 'days'),
        maxDate: moment().add(547, 'days'),
        format: 'DD MMMM YYYY'
    });
    // Datepicker Flight
    $('#fDepart,#fReturn').datetimepicker({
        useCurrent: false,
        minDate: moment(),
        maxDate: moment().add(547, 'days'),
        format: 'DD MMMM YYYY'
    });
    $('#fDepart').datetimepicker().on('dp.change', function (e) {
        var incrementDay = moment(new Date(e.date));
        incrementDay.add(1, 'days');
        $('#fReturn').data('DateTimePicker').minDate(incrementDay);
        $(this).data("DateTimePicker").hide();
    });
    $('#fReturn').datetimepicker().on('dp.change', function (e) {
        var decrementDay = moment(new Date(e.date));
        decrementDay.subtract(1, 'days');
        $('#fDepart').data('DateTimePicker').maxDate(decrementDay);
        $(this).data("DateTimePicker").hide();
    });
    if (document.getElementById('defaultDepart')) {
        $('#fDepart').data('DateTimePicker').defaultDate(document.getElementById('defaultDepart').value);
    }
    if (document.getElementById('defaultReturn')) {
        $('#fReturn').data('DateTimePicker').defaultDate(document.getElementById('defaultReturn').value);
    }
    // Hotel Datepicker
    $('#ci').datetimepicker({
        format: 'DD MMMM YYYY',
        minDate: moment().add(2, 'day').format('DD MMMM YYYY'),
        defaultDate: moment().add(2, 'day').format('DD MMMM YYYY')
    });
    $('#co').datetimepicker({
        useCurrent: false,
        format: 'DD MMMM YYYY',
        defaultDate: moment().add(3, 'day').format('DD MMMM YYYY')
    });
    $("#ci").on("dp.change", function (e) {
        $('#co').data("DateTimePicker").minDate(moment(e.date).add(1, 'day').format('DD MMMM YYYY'));
        $('#co').val('');
        $("#co").focus();
    });
    $("#co").on("dp.change", function (e) {
        $('#ci').data("DateTimePicker").maxDate(e.date);
    });
    // Hotel Autocomplete
    $("#autocompleteHotel").select2({
        width: '100%',
        ajax: {
            url: "/api/hotel/autocomplete",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data.results
                };
            },
            cache: true
        },
        placeholder: 'Nama Kota, Negara atau Hotel',
        minimumInputLength: 3,
    });
    // Flight Detail
    $('#flightDetaildepart').DataTable({
        "responsive": true,
        "ordering": false,
        "paging": false,
        "info": false,
        "searching": false,
        "columnDefs": [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ]
    });
    $('#flightDetailreturn').DataTable({
        "responsive": true,
        "ordering": false,
        "paging": false,
        "info": false,
        "searching": false,
        "columnDefs": [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ]
    });
    // Detail Flight DOB
    $('.adob').datetimepicker({
        format: 'DD MMMM YYYY',
        maxDate: moment().subtract(13, "years"),
        minDate: moment().subtract(80, "years"),
    });
    $('.adob').val('');
    $('.cdob').datetimepicker({
        format: 'DD MMMM YYYY',
        maxDate: moment().subtract(2, "years"),
        minDate: moment().subtract(11, "years"),
    });
    $('.cdob').val('');
    $('.idob').datetimepicker({
        format: 'DD MMMM YYYY',
        maxDate: new Date(),
        minDate: moment().subtract(2, "years"),
    });
    $('.idob').val('');
    // Sidebar Scroll
    if (document.getElementById('sidebarscroll')) {
        var sidebar = document.getElementById('sidebarscroll');
        Stickyfill.add(sidebar);
    }
    $( ".pointer" ).click(function() {
        $('#showtourindex').fadeIn('slow');
    });
});