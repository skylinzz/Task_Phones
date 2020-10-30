function refreshData(){
    var params = getFilterParams();

    $.ajax({ type: "GET",
        url: `ajaxController.php${params}`,
        contentType: "charset=utf-8",
        async: true,
        dataType: "html",
        success: function(response){
            var a = $('#myTable');

            a[0].innerHTML = response;
        }
    });
}

function getFilterParams(){
    var params = "?";
    params += `prefix=${$('#countryList').val()}&`;
    params += `isValid=${$('#isValidOptions').val()}`;

    return params;
}