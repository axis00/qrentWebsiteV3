var last = false;

$(document).ready(function () {

    var pageNumber = 1;
    
    loaditems((pageNumber - 1) * 10,10);

    $('#nextBtn').on('click',function(){
        if(!last){
            pageNumber++;
            loaditems((pageNumber - 1) * 10,10);
        }
        
    });

    $('#backBtn').on('click',function(){
        if(pageNumber){
            pageNumber--;
            loaditems((pageNumber - 1) * 10,10);
        }
    });

});

function loaditems(lower,upper) {

    var cont = $('#content');
    cont.html("");

    $.ajax({
        url: '/getReservations',
        host: 'qrent.com',
        type: 'POST',
        data: {lowerLim: lower, upperLim: upper},
        success: function(data){
                console.log(data);          
                for(i in data)(function(i){
                    var contTemp = $('#reservationTemplate').clone();
                    contTemp.attr('id','res' + i);            
                    cont.append(contTemp);
                    var sel = '#' + contTemp.attr('id');
                    $(sel + ' .reservationTitle').html(data[i].itemName);
                    $(sel + ' .reservationStatus').html(data[i].status);

                    var reqDate = new Date(Date.parse(data[i].requestdate));
                    $(sel + ' .requestDate').html(reqDate.toDateString());

                    var startDate = new Date(Date.parse(data[i].startdate));
                    $(sel + ' .startDate').html(startDate.toDateString());

                    var endDate = new Date(Date.parse(data[i].enddate));
                    $(sel + ' .endDate').html(endDate.toDateString());

                    $(sel + ' .rentPrice').html(data[i].itemRentPrice + " PHP/DAY");
                    $(sel + ' .reservee').html(data[i].client);
                    $(sel + ' .reservee').attr('href','http://www.qrent.com/profile?user=' + data[i].client);
                    $(sel + ' #approve').on('click',function(){
                        var resId = data[i].ReservationID;
                        console.log(resId);
                        $.ajax({
                            url: '/approveReservation',
                            host: 'qrent.com',
                            type: 'POST',
                            data: {reservID: resId},
                            success: function(data){
                                if(data == 'success'){
                                    $(sel + ' .reservationStatus').html("Approved");
                                }
                            }
                        });
                    });

                    $(sel + ' #cancel').on('click',function(){
                        var resId = data[i].ReservationID;
                        console.log(resId);
                        $.ajax({
                            url: '/cancelReservation',
                            host: 'qrent.com',
                            type: 'POST',
                            data: {reservID: resId},
                            success: function(data){
                                if(data == 'success'){
                                    $(sel + ' .reservationStatus').html("rejected");
                                }
                            }
                        });
                    });
                })(i);

            }
    });
}