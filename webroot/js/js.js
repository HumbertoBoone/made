$(document).ready(function () {
    $(document).on("click", ".add", function (evt) {
        var id = evt.target.id;
        addCart(id);
    });
    $('#metodo input[type=radio]').change(function(evt){

        metodo(evt.target.id);
    });

});
function addCart(id) {
    var data = {
       id: id
    };
    $.ajax({
        type: "POST",
        url: 'items/add-cart',
        datatype: "html",
        data: data,
        success: function (respuesta) {
            console.log(respuesta);

        }
    });
}
function metodo(c){
    $('.container_method').hide();
    switch (c) {
        case "card":
            $('#card_container').slideDown();
            break;
    
        case "oxxo":
            $('#oxxo_container').slideDown();
            break;
        case "paypal":
            $('#paypal_container').slideDown();
        break;
    }
}