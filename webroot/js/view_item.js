$(document).ready(function () {
    $(document).on("click",".item_thumbnail",function(evt){
        //alert('hola');
        var src = evt.target.getAttribute('src');
        //alert(src);
        console.log(src);
        $('#item_image img').attr('src', src);
        //document.getElementById('item_image').style.backgroundImage = 'url('+src+');'; 
      });
      document.getElementById('item_image').style.backgroundImage = "url('klsdjfa.png');";
});