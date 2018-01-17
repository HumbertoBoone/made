$(document).ready(function () {
    $(document).on("click", ".add", function (evt) {
        var id = evt.target.id;
        addCart(id);
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