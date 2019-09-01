$(function () {
    $(document).ajaxStart(function () {
        $('#spiner-load-ajax').modal({
            backdrop: 'static',
            keyboard: false
        });
    });
    $(document).ajaxComplete(function () {
        $('#spiner-load-ajax').modal('hide');
    });
    // populate Models dropdown upon selecting make
    $("select#make").change(function (e) {
        var makeId = $(this).val();
        if (makeId > 0) {
            var getModelsUrl = '/models/' + makeId;
            $.ajax({
                url: getModelsUrl,
                success: function (reply) {
                    $("select#model").html(reply);
                    $("select#model").prop("disabled", false);  
                }
            });
        } else {
            $("select#model").empty();
            $("select#model").prop("disabled", true);  
        }        
    });
});