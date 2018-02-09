t_groups = 0;
$(document).ready(function () {
  $('#btnNewGroup').click(function(){
    alert('hola');
    $('#options_wrapper').append('<div id="group' + t_groups + '"></div>');
  });
});
function newGroup(){
    $('#options_wraper').append('<div id="group'+t_groups+'"></div>');
    t_groups++;
}
