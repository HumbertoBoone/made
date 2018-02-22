t_groups = 0;
t_option = 0;
var abc = 1; 
var data = {"groups":[]
};
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

    newGroup += '<button type="button" id="btnNewOption" data-group="'+t_groups+'">New Option</button>';
    newGroup += '<div id="group_options'+t_groups+'"><p>Options</p></div>';
    newGroup += '</div>';

    t_groups++;
    $('#options_wrapper').append(newGroup);
  });

  $(document).on("click","#btnNewOption",function(evt){
    group = evt.target.getAttribute('data-group');
    newGroupOption(group);
  });
  // Following function will executes on change event of file input to select different file.
  $('body').on('change', '.file', function () {
    if (this.files && this.files[0]) {
      abc += 1; // Incrementing global variable by 1.
      var z = abc - 1;
      var x = $(this).parent().find('#previewimg' + z).remove();
      $(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
      var reader = new FileReader();
      reader.onload = imageIsLoaded;
      reader.readAsDataURL(this.files[0]);
      $(this).hide();
      $('.images_box').append($("<div/>", {
        class: 'filediv'
      }).fadeIn('slow').append($("<input/>", {
        name: 'images['+(abc)+'][img]',
        type: 'file',
        class: 'file'
      }), $("<br/><br/>")));
      $("#abcd" + abc).append($("<img/>", {
        class: 'cancel_cross',
        src: '/made/img/x.png',
        alt: 'delete'
      }).click(function () {
        $(this).parent().parent().remove();
      }));
    }
  });
  // To Preview Image
  function imageIsLoaded(e) {
    $('#previewimg' + abc).attr('src', e.target.result).attr('class', 'img');
  };
 
});
function deleteGroup(id){
    console.log("group_"+id);
    $("#group_"+id).remove();
}
function newGroupOption(group){
  if ($('#group_options' + group).has(".option_row").length == 0 ){
    console.log('vacio')
    var newOption = '<div id="option0' + '_group_parent' + group +'" class="option_row" data-option="0">';
    newOption += '<input type="text" name="groups[' + group+'][options][0][name]">';
    newOption += '<input type="number" name="groups[' + group+'][options][0][value]">';   
    newOption += '<input type="hidden" name="groups[' + group+'][options][0][available]" value="1">';
    newOption += '<button type="button" onclick="deleteOption(' + group + ', 0)">Delete Option</button></div>';
  }else{
    var gg = $('.option_row').last().attr('data-option');
    var opp = parseInt(gg) + parseInt(1);
    var newOption = '<div id="option' + opp + '_group_parent' + group +'" class="option_row " data-option="'+opp+'">';
    newOption += '<input type="text" name="groups[' + group + '][options]['+(opp)+'][name]">';
    newOption += '<input type="number" name="groups[' + group + '][options][' + (opp) +'][value]">';
    newOption += '<input type="hidden" name="groups[' + group + '][options][' + (opp) + '][available]" value="1">';
    newOption += '<button type="button" onclick="deleteOption(' + group +', '+opp+')">Delete Option</button></div>';
  }
  $('#group_options'+(group)).append(newOption);
}
/*
* Elimina los input file sin imagen seleccionada antes de enviar al servidor para evitar error
*/
function deleteUnusedInputs(){
  $('.file').remove(':visible');
}
function deleteOption(group,op){
  document.getElementById('option' + op + '_group_parent' + group).remove();
}
