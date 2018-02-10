t_groups = 0;
t_option = 0;
$(document).ready(function () {
  $('#btnNewGroup').click(function(){
    alert('hola');
    //$('#options_wrapper').append('<div id="group' + t_groups + '"></div>');
    //$('#options_wraper').append('<DIV></DIV>');
    newGroup();
  });
  $(document).on("click","#btnNewOption",function(){
    alert('hey');
    //$('#options_wrapper').append('<div id="group' + t_groups + '"></div>');
    //$('#options_wraper').append('<DIV></DIV>');
    newGroupOption();
  });
});
function newGroup(){
    $('#options_wrapper').append('<div id="groups'+t_groups+'"><label for="groups['+t_groups+'][type]">Tipo:</label><select name="groups['+t_groups+'][type]">    <option value="checkbox">Checkbox</option>    <option value="radio">Radio</option>    <option value="2">3</option>    <option value="3">4</option>    <option value="4">5</option></select><label for="groups['+t_groups+'][name]">Nombre</label><input type="text" name="groups['+t_groups+'][name]"><label for="groups['+t_groups+'][required]">Obligatorio?</label><input type="hidden" name="groups['+t_groups+'][required]" value="0" ><input type="checkbox" name="groups['+t_groups+'][required]" value="1" ><label for="groups['+t_groups+'][description]">Descripción</label><textarea name="groups['+t_groups+'][description]"></textarea><button type="button" id="btnNewOption">New Option</button><div id="group_options'+t_groups+'"><p>Options</p></div></div>');
    t_groups++;
}
function newGroupOption(){
  $('#group_options'+(t_groups-1)).append('<div id="option'+t_option+'">    <input type="text" name="groups['+t_groups+'][group_options]['+t_option+'][name]">    <input type="number" name="groups['+t_groups+'][group_options]['+t_option+'][value]" >    <input type="hidden" name="groups['+t_groups+'][group_options]['+t_option+'][available]" value="1"></div>');
}