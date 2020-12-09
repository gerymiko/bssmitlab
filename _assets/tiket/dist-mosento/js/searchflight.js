$(document).ready(function() {
    $("#noResult").hide();
    // Depart
    // $("#flightDt").hide();
    var tableDepart = $('#flightDt').DataTable({
        "responsive": true,
        "paging": false,
        "info": false,
        "searching": false,
        "order": [[ 4, 'asc' ]],
        "columnDefs": [
            { type: 'formatted-num', targets: 4 },
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ]
    });
    $("#flightRt").hide();
    var tableReturn = $('#flightRt').DataTable({
        "responsive": true,
        "paging": false,
        "info": false,
        "searching": false,
        "order": [[ 4, 'asc' ]],
        "columnDefs": [
            { type: 'formatted-num', targets: 4 },
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ]
    });

    // Action Here!!!
    let linksArr = [];
    let oneway = true;
    let sid = null;
    let fno1 = null;
    let cid1 = null;
    let totalResult = 0;

    // Get Airlines
    axios.get('/api/flight/airlines'+window.location.search)
        .then((response) => {
            if (response.data.airlines_data.length > 0) {
                var datas = response.data.airlines_data;
                for (let data of datas) {
                    if (data.connection_status === 'on') {
                        // getResult('/api/flight/search'+window.location.search+'&id='+data.airlines_id);
                        linksArr.push('/api/flight/search'+window.location.search+'&id='+data.airlines_id);
                    }
                }
                if (linksArr.length > 0) {
                    linksArr.forEach(function(i, idx, array){
                        // Get last array
                        $.ajax({
                            url: i,
                            success: function(result) {
                                if (typeof(result.schedule) !== "undefined" && typeof(result.schedule) !== null && typeof(result.schedule) !== "") {
                                    totalResult++
                                    // Check Oneway
                                    if (typeof(result.schedule.return) !== "undefined" && typeof(result.schedule.return) !== null && typeof(result.schedule.return) !== "") {
                                        oneway = false;
                                    }
                                    // Depart
                                    if (typeof(result.schedule.depart) !== "undefined" && typeof(result.schedule.depart) !== null && typeof(result.schedule.depart) !== "") {
                                        for (let depart of result.schedule.depart) {
                                            if (typeof(depart.class) !== "undefined" && typeof(depart.class) !== null && typeof(depart.class) !== "") {
                                                for (let dclass of depart.class) {
                                                    if (depart.type === 'connecting') {
                                                        if (typeof(depart.connecting_flight[0]) !== "undefined" && typeof(depart.connecting_flight[0]) !== null && typeof(depart.connecting_flight[0]) !== "") {
                                                            tableDepart.row.add( [
                                                                '<center><img src="/images/airlines/'+depart.airline_id+'.png" class="img-responsive airline" width="45"><p>'+depart.airline_name+' - '+depart.fno+'</p></center>',
                                                                '<center><h4 class="nopad">'+depart.etd+'</h4>('+depart.from+')</center>',
                                                                '<center><h4 class="nopad">'+depart.connecting_flight[0].eta+'</h4>('+depart.connecting_flight[0].to+')</center>',
                                                                '<center><h4 class="nopad">'+dclass.class_name+'</h4>'+depart.type+'</center>',
                                                                '<center><h2 class="flightprice">'+numeral(dclass.price).format('0,0')+'</h2><a href="javascript:;" class="btn btn-success btn-sm btn-flightbook btndepartBook" data-sid="'+result.session_id+'" data-fno1="'+depart.fno+'" data-cid1="'+dclass.class_id+'">PESAN SEKARANG</a></center>'
                                                            ]).draw( false );
                                                        }
                                                    } else {
                                                        tableDepart.row.add( [
                                                            '<center><img src="/images/airlines/'+depart.airline_id+'.png" class="img-responsive airline" width="45"><p>'+depart.airline_name+' - '+depart.fno+'</p></center>',
                                                            '<center><h4 class="nopad">'+depart.etd+'</h4>('+depart.from+')</center>',
                                                            '<center><h4 class="nopad">'+depart.eta+'</h4>('+depart.to+')</center>',
                                                            '<center><h4 class="nopad">'+dclass.class_name+'</h4>'+depart.type+'</center>',
                                                            '<center><h2 class="flightprice">'+numeral(dclass.price).format('0,0')+'</h2><a href="javascript:;" class="btn btn-success btn-sm btn-flightbook btndepartBook" data-sid="'+result.session_id+'" data-fno1="'+depart.fno+'" data-cid1="'+dclass.class_id+'">PESAN SEKARANG</a></center>'
                                                        ]).draw( false );
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    // Return
                                    if (typeof(result.schedule.return) !== "undefined" && typeof(result.schedule.return) !== null && typeof(result.schedule.return) !== "") {
                                        for (let freturn of result.schedule.return) {
                                            if (typeof(freturn.class) !== "undefined" && typeof(freturn.class) !== null && typeof(freturn.class) !== "") {
                                                for (let rclass of freturn.class) {
                                                    if (freturn.type === 'connecting') {
                                                        if (typeof(freturn.connecting_flight[0]) !== "undefined" && typeof(freturn.connecting_flight[0]) !== null && typeof(freturn.connecting_flight[0]) !== "") {
                                                            tableReturn.row.add( [
                                                                '<center><img src="/images/airlines/'+freturn.airline_id+'.png" class="img-responsive airline" width="45"><p>'+freturn.airline_name+' - '+freturn.fno+'</p></center>',
                                                                '<center><h4 class="nopad">'+freturn.etd+'</h4>('+freturn.from+')</center>',
                                                                '<center><h4 class="nopad">'+freturn.connecting_flight[0].eta+'</h4>('+freturn.connecting_flight[0].to+')</center>',
                                                                '<center><h4 class="nopad">'+rclass.class_name+'</h4>'+freturn.type+'</center>',
                                                                '<center><h2 class="flightprice">'+numeral(rclass.price).format('0,0')+'</h2><a href="javascript:;" class="btn btn-success btn-sm btn-flightbook btnreturnBook" data-fno2="'+freturn.fno+'" data-cid2="'+rclass.class_id+'">PESAN SEKARANG</a></center>'
                                                            ]).draw( false );
                                                        }
                                                    } else {
                                                        tableReturn.row.add( [
                                                            '<center><img src="/images/airlines/'+freturn.airline_id+'.png" class="img-responsive airline" width="45"><p>'+freturn.airline_name+' - '+freturn.fno+'</p></center>',
                                                            '<center><h4 class="nopad">'+freturn.etd+'</h4>('+freturn.from+')</center>',
                                                            '<center><h4 class="nopad">'+freturn.eta+'</h4>('+freturn.to+')</center>',
                                                            '<center><h4 class="nopad">'+rclass.class_name+'</h4>'+freturn.type+'</center>',
                                                            '<center><h2 class="flightprice">'+numeral(rclass.price).format('0,0')+'</h2><a href="javascript:;" class="btn btn-success btn-sm btn-flightbook btnreturnBook" data-fno2="'+freturn.fno+'" data-cid2="'+rclass.class_id+'">PESAN SEKARANG</a></center>'
                                                        ]).draw( false );
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    $('.btndepartBook').click(function(e) {
                                        e.preventDefault();
                                        sid = this.getAttribute("data-sid");
                                        fno1 = this.getAttribute("data-fno1");
                                        cid1 = this.getAttribute("data-cid1");
                                        if (oneway) {
                                            window.location = '/flight/detail?sid='+sid+'&fno1='+fno1+'&cid1='+cid1;
                                        } else {
                                            $("#flightDt").hide();
                                            $('html, body').animate({
                                                scrollTop: $("#top").offset().top
                                            }, 1000);
                                            $("#flightRt").show();
                                            alert('Silakan Pilih Penerbangan Pulang');
                                            $('.btnreturnBook').click(function(e) {
                                                e.preventDefault();                                
                                                console.log(sid);
                                                console.log(fno1);
                                                console.log(cid1);
                                                console.log(this.getAttribute("data-fno2"));
                                                console.log(this.getAttribute("data-cid2"));
                                                console.log('This is a Return Way');
                                                window.location = '/flight/detail?sid='+sid+'&fno1='+fno1+'&cid1='+cid1+'&fno2='+this.getAttribute("data-fno2")+'&cid2='+this.getAttribute("data-cid2");
                                            });
                                        }
                                    });
                                }
                            }
                        });
                    });
                } else {
                    $("#loading").fadeOut();
                    $("#noResult").show();
                }
            }
        })
        .catch((error) => {
            $("#loading").fadeOut();
            $("#noResult").show();
        });
    $(document).ajaxStop(function() {
        $("#loading").fadeOut();
        if (totalResult == 0) {
            $("#noResult").show();
        }
    });
});