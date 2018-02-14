t_groups = 0;
t_option = 0;
$(document).ready(function () {

  $('#btnNewGroup').click(function(){

    var newGroup = '<div id="group_'+t_groups+'">';
    newGroup += '<button type="button" id="btnDeleteGroup" onclick="deleteGroup('+t_groups+')">Delete Group</button>';
    newGroup += '<label for=groups['+t_groups+'][type]>Tipo: </label>';
    newGroup += '<select name="groups['+t_groups+'][type]">' ;
    newGroup +=   '<option value="checkbox">Checkbox</option>' ;
    newGroup +=   '<option value="radio">Radio</option>' ;
    newGroup +=   '<option value="2">3</option>' ;
    newGroup +=   '<option value="3">4</option>' ;
    newGroup +=   '<option value="4">5</option>' ;
    newGroup += '</select>';

    newGroup += '<label for="groups['+t_groups+'][name]">Nombre: </label>';
    newGroup += '<input type="text" name="groups['+t_groups+'][name]">';

    newGroup += '<label for="groups['+t_groups+'][required]">Obligatorio?</label>';
    newGroup += '<input type="hidden" name="groups['+t_groups+'][required]" value="0" >';
    newGroup += '<input type="checkbox" name="groups['+t_groups+'][required]" value="1" >';

    newGroup += '<label for="groups['+t_groups+'][description]">Descripción</label>';
    newGroup += '<textarea name="groups['+t_groups+'][description]"></textarea>';

    newGroup += '<button type="button" id="btnNewOption">New Option</button>';
    newGroup += '<div id="group_options'+t_groups+'"><p>Options</p></div>';
    newGroup += '</div>';

    t_groups++;
    $('#options_wrapper').append(newGroup);
  });

  $(document).on("click","#btnNewOption",function(){
    
    //$('#options_wrapper').append('<div id="group' + t_groups + '"></div>');
    //$('#options_wraper').append('<DIV></DIV>');
    newGroupOption();
  });
});
function deleteGroup(id){
    alert('entra delete');
    console.log("group_"+id);
    $("#group_"+id).remove();
}
function newGroup(){
    $('#options_wrapper').append('<div id="groups'+t_groups+'"><label for="groups['+t_groups+'][type]">Tipo:</label><select name="groups['+t_groups+'][type]">    <option value="checkbox">Checkbox</option>    <option value="radio">Radio</option>    <option value="2">3</option>    <option value="3">4</option>    <option value="4">5</option></select><label for="groups['+t_groups+'][name]">Nombre</label><input type="text" name="groups['+t_groups+'][name]"><label for="groups['+t_groups+'][required]">Obligatorio?</label><input type="hidden" name="groups['+t_groups+'][required]" value="0" ><input type="checkbox" name="groups['+t_groups+'][required]" value="1" ><label for="groups['+t_groups+'][description]">Descripción</label><textarea name="groups['+t_groups+'][description]"></textarea><button type="button" id="btnNewOption">New Option</button><div id="group_options'+t_groups+'"><p>Options</p></div></div>');
    t_groups++;
}
function newGroupOption(){
  var newOption = '<div id="option'+t_option+'">';
  newOption += '<input type="text" name="groups[' + (t_groups - 1)+'][options]['+t_option+'][name]">';
  newOption += '<input type="number" name="groups[' + (t_groups - 1)+'][options]['+t_option+'][value]">';   
  newOption += '<input type="hidden" name="groups[' + (t_groups - 1)+'][options]['+t_option+'][available]" value="1"></div>';
  $('#group_options'+(t_groups-1)).append(newOption);
}