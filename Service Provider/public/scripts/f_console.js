
$(document).ready(function(){
    $('.sidenav').sidenav();
});

var last = false;
var _filters = ['available','loaned','missing'];

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
        if(pageNumber > 1){
            pageNumber--;
            loaditems((pageNumber - 1) * 10,10);
        }
    });

    $('#filterBtn').on('click',function(){
        var checked = $('input:checked');
        _filters = [];
        for(i = 0 ; i < checked.length; i++){
            _filters.push(checked[i].value);
        }

        console.log(_filters);

        loaditems((pageNumber - 1) * 10,10);

    });

});

function loaditems(lower,upper,filter) {

    var cont = $('#content');
    cont.html("");

    $.ajax({
        url: '/getItems',
        host: 'qrent.com',
        type: 'POST',
        data: {lowerLim: lower, upperLim: upper , filter : JSON.stringify(_filters)},
        success: function(data){
            last = data.length < 10;
            for(var i = 0; i < data.length; i++){
                var itemCont = $('<div class="card card-panel horizontal hoverable row">');
                var imgCont = $('<div>');
                var itemLink = $('<a class = "qrent-link col s12">');
                var itemNameTitle = $('<div class="card-title col m12 itemname">');
                var itemDescTitle = $('<div class="card-text col s6 itemdesc">');
                var itemBrandTitle = $('<div class="card-text col s6 brandtitle">');
                var itemRPTitle = $('<div class="card-text col s6 rptitle">');
                var itemStatus = $('<div class="card-text itemstat">');
                
                var deleteForm = $('<form>');
                deleteForm.on('submit',function(evnt){
                    evnt.preventDefault();
                    $.ajax({
                        url: '/deleteItem',
                        host: 'qrent.com',
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(data){
                            if(data == 'success'){
                                $(evnt.target).parent().fadeOut();
                            }
                        },
                        error: function(err){
                            console.log(err);
                        }
                    });
                });
                
                itemCont.attr('id', data[i].itemNumber);
                deleteForm.html('<input name = "itemToDelete" type = "hidden" value = ' + data[i].itemNumber + '>' +
                                    '<input type = "submit" value = "Delete" class="shadow-sm btn btn-danger">'
                                 );
                deleteForm.attr('class', 'deleteForm');

                itemLink.attr('href','/item?id='+ data[i].itemNumber);
                itemNameTitle.html(data[i].itemName);
                itemDescTitle.html(data[i].itemDescription);
                itemBrandTitle.html(data[i].itemBrand);
                itemRPTitle.html(data[i].itemRentPrice + " PHP / Day");
                itemStatus.html(data[i].status);
                
                itemLink.append(itemNameTitle);
                itemCont.append(itemLink);
                itemCont.append(itemRPTitle);
                itemCont.append(itemStatus);
                itemCont.append($('<br/>'));
                itemCont.append(itemBrandTitle);
                itemCont.append(itemDescTitle);
                itemCont.append(deleteForm);

                cont.append(itemCont);           

            }
        }  
    });
}

