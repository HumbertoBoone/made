t_groups = 0;
t_option = 0;
var abc = 1; 
var data = {"groups":[]
};
$(document).ready(function () {

  /*$('.group_type').on('change', function() {
    alert('entra');
    var id = $(this).getAttribute('data-group-id');
    console.log(id);
  });*/
  $('#btnNewGroup').click(function(){

    var newGroup = '<div id="group_'+t_groups+'" class="item_group">';
    newGroup += '<div class="row">';
    newGroup += '<div class="col">';
    newGroup += '<button type="button" id="btnDeleteGroup" class="delete_group_button" onclick="deleteGroup('+t_groups+')"><i class="fas fa-times fa-2x" style="color: Tomato;"></i></button>';
    newGroup += '</div>';
    newGroup += '</div>';
    //newGroup += '<label for=groups['+t_groups+'][type]>Tipo: </label>';
    newGroup += '<div class="row">';
    newGroup +=   '<div class="col-4 input">';
    newGroup +=     '<input type="text" class="form-control" placeholder="Nombre del grupo" name="groups['+t_groups+'][name]">';
    newGroup +=   '</div>';
    
    newGroup += '<div class="col-6 input">';
    newGroup +=   '<select name="groups['+t_groups+'][type]" id="group_type_'+t_groups+'" class="group_type form-control" data-group-id="'+t_groups+'" onchange="groupChange('+t_groups+')" >' ;
    newGroup +=     '<option value="checkbox">Casillas de verificación (múltiple selección)</option>' ;
    newGroup +=     '<option value="radio">Botones de radio (única selección)</option>' ;
    newGroup +=     '<option value="select">Lista de selección (única selección)</option>' ;
    newGroup +=     '<option value="textarea">Área de texto (cliente puede escribir libremente)</option>' ;
    newGroup +=     '<optgroup label="Campo personalizado">';
    newGroup +=       '<option value="custom_text">Cualquier texto</option>'; 
    newGroup +=       '<option value="custom_int_num">Sólo números enteros</option>';
    newGroup +=       '<option value="custom_dec_num">Solo numeros enteros con o sin decimales</option>';
    newGroup +=     '</optgroup>' ;
    newGroup +=   '</select>';
    newGroup += '</div>';
    newGroup += '</div>';
    //newGroup += '<label for="groups['+t_groups+'][name]">Nombre: </label>';
    newGroup += '<div class="row">';
    newGroup +=   '<div class="col-6 input">';

    newGroup +=     '<textarea name="groups['+t_groups+'][description]" class="form-control" placeholder="Descripción"></textarea>';
    newGroup +=   '</div>';
    newGroup +=   '<div class="col-6 input">';
    newGroup +=     '<label for="groups['+t_groups+'][required]">¿Obligatorio?</label>';
    newGroup +=     '<input type="hidden"  name="groups['+t_groups+'][required]" value="0" >';
    newGroup +=     '<input type="checkbox"  name="groups['+t_groups+'][required]" value="1" >';
    newGroup +=   '</div>';
    newGroup += '</div>';

    
    newGroup += '<div id="group_options'+t_groups+'"><h6>Opciones:</h6></div>';
    newGroup += '<button type="button" class="btn btn-info new_option_button" id="btnNewOption" data-group="'+t_groups+'">Agregar Opción</button>';
    newGroup += '</div>';
    
    t_groups++;
    $('#options_wrapper').append(newGroup);
  });

  $(document).on("click","#btnNewOption",function(evt){
    group = evt.target.getAttribute('data-group');
    var type = $('#group_type_'+group+' option:selected').val();
    console.log(type);
    newGroupOption(group,type);
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
function groupChange(id){
  if ($('#group_options' + id).has(".option_row").length != 0 ){
    Array.from(document.getElementById('group_options' + id).getElementsByClassName('option_row')).forEach(
      function(element, index, array) {
        element.remove();
      }
    );
    alert('Cuando cambia el tipo de grupo se eliminan las opciones ya existentes para evitar incompatibilidad. Vuelva a introducirlas');
  }
}
function newGroupOption(group,type){
  if ($('#group_options' + group).has(".option_row").length == 0 ){
    var newOption = '<div id="option0' + '_group_parent' + group +'" class="option_row" data-option="0">';
    newOption += '<div class="form-row" style="margin-bottom: 10px;">';
    newOption += '<div class="col-3">';
    newOption += '<input type="text" class="form-control" placeholder="Nombre" name="groups[' + group+'][options][0][name]">';
    newOption += '</div>';
    switch(type){
      case 'checkbox':
      newOption += '<div class="col-3">';
      newOption += '<input type="number" class="form-control" placeholder="Valor" name="groups[' + group +'][options][0][value]">';
      newOption += '</div>';
      newOption += '<div class="col-6">';
      newOption += '¿Disponible? <input type="hidden" name="groups[' + group +'][options][0][available]" value="0">';
      newOption += '<input type="checkbox" checked name="groups[' + group +'][options][0][available]" value="1">';
      newOption += '<button type="button" class="delete_option_button" onclick="deleteOption(' + group + ', 0)"><i class="fas fa-trash-alt" style="color: Tomato; font-size: 1.4em; margin-top: 5px;"></i></button></div>';
      newOption += '</div>';
      break;
      case 'radio':
      newOption += '<div class="col-3">';
      newOption +=    '<input type="number" class="form-control" name="groups[' + group +'][options][0][value]">';
      newOption += '</div>';
      newOption += '<div class="col-6">';
      newOption += '¿Disponible? <input type="hidden" name="groups[' + group +'][options][0][available]" value="0">';
      newOption += '<input type="checkbox" name="groups[' + group +'][options][0][available]" value="1">';
      newOption += '<button type="button" class="delete_option_button" onclick="deleteOption(' + group + ', 0)"><i class="fas fa-trash-alt" style="color: Tomato; font-size: 1.4em; margin-top: 5px;"></i></button></div>';
      newOption += '</div>';
      break;
      case 'select':
      newOption += '<div class="col-6">';
      newOption += '¿Disponible? <input type="hidden" name="groups[' + group +'][options][0][available]" value="0">';
      newOption += '<input type="checkbox" name="groups[' + group +'][options][0][available]" value="1">';
      newOption += '<button type="button" class="delete_option_button" onclick="deleteOption(' + group + ', 0)"><i class="fas fa-trash-alt" style="color: Tomato; font-size: 1.4em; margin-top: 5px;"></i></button></div>';
      newOption += '</div>';
      break;
      case 'custom_text':
      case 'custom_int_num':
      newOption += '<div class="col-3">';
      newOption += '<input type="number" class="form-control" name="groups[' + group +'][options][0][min]" placeholder="Mínimo" step="1">';
      newOption += '</div>';
      newOption += '<div class="col-3">';
      newOption += '<input type="number" class="form-control" name="groups[' + group +'][options][0][max]" placeholder="Máximo" step="1">';
      newOption += '</div>';
      newOption += '<div class="col-3">';
      newOption += '¿Disponible? <input type="hidden" name="groups[' + group +'][options][0][available]" value="0">';
      newOption += '<input type="checkbox" name="groups[' + group +'][options][0][available]" value="1">';
      newOption += '<button type="button" class="delete_option_button" onclick="deleteOption(' + group + ', 0)"><i class="fas fa-trash-alt" style="color: Tomato; font-size: 1.4em; margin-top: 5px;"></i></button></div>';
      newOption += '</div>';
      break;
      case 'custom_dec_num':
      newOption += '<div class="col-3">';
      newOption += '<input type="number" class="form-control" name="groups[' + group +'][options][0][min]" placeholder="0.00" step="0.0001">';
      newOption += '</div>';
      newOption += '<div class="col-3">';
      newOption += '<input type="number" class="form-control" name="groups[' + group +'][options][0][max]" placeholder="0.00" step="0.0001">';
      newOption += '</div>';
      newOption += '<div class="col-3">';
      newOption += '¿Disponible? <input type="hidden" class="form-control" name="groups[' + group +'][options][0][available]" value="0">';
      newOption += '<input type="checkbox" class="form-control" name="groups[' + group +'][options][0][available]" value="1">';
      newOption += '<button type="button" class="delete_option_button" onclick="deleteOption(' + group + ', 0)"><i class="fas fa-trash-alt" style="color: Tomato; font-size: 1.4em; margin-top: 5px;"></i></button></div>';
      newOption += '</div>';
      break;
      default:
      break;
    }
    
    newOption += '</div>'; //close form-row
  }else{
    var gg = $('.option_row').last().attr('data-option');
    var opp = parseInt(gg) + parseInt(1);
    var newOption = '<div id="option' + opp + '_group_parent' + group +'" class="option_row " data-option="'+opp+'">';
    newOption += '<div class="form-row" style="margin-bottom: 10px;">';
    newOption += '<div class="col-3">';
    newOption += '<input type="text" class="form-control" placeholder="Nombre" name="groups[' + group+'][options]['+opp+'][name]">';
    newOption += '</div>';
    switch(type){
      case 'checkbox':
      newOption += '<div class="col-3">';
      newOption += '<input type="number" class="form-control" placeholder="Valor" name="groups[' + group +'][options]['+opp+'][value]">';
      newOption += '</div>';
      newOption += '<div class="col-6">';
      newOption += '¿Disponible? <input type="hidden" name="groups[' + group +'][options]['+opp+'][available]" value="0">';
      newOption += '<input type="checkbox" checked name="groups[' + group +'][options]['+opp+'][available]" value="1">';
      newOption += '<button type="button" class="delete_option_button" onclick="deleteOption(' + group + ', '+opp+')"><i class="fas fa-trash-alt" style="color: Tomato; font-size: 1.4em; margin-top: 5px;"></i></button></div>';
      newOption += '</div>';
      break;
      case 'radio':
      newOption += '<div class="col-3">';
      newOption +=    '<input type="number" class="form-control" name="groups[' + group +'][options]['+opp+'][value]">';
      newOption += '</div>';
      newOption += '<div class="col-6">';
      newOption += '¿Disponible? <input type="hidden" name="groups[' + group +'][options]['+opp+'][available]" value="0">';
      newOption += '<input type="checkbox" name="groups[' + group +'][options]['+opp+'][available]" value="1">';
      newOption += '<button type="button" class="delete_option_button" onclick="deleteOption(' + group + ', '+opp+')"><i class="fas fa-trash-alt" style="color: Tomato; font-size: 1.4em; margin-top: 5px;"></i></button></div>';
      newOption += '</div>';
      break;
      case 'select':
      newOption += '<div class="col-6">';
      newOption += '¿Disponible? <input type="hidden" name="groups[' + group +'][options]['+opp+'][available]" value="0">';
      newOption += '<input type="checkbox" name="groups[' + group +'][options]['+opp+'][available]" value="1">';
      newOption += '<button type="button" class="delete_option_button" onclick="deleteOption(' + group + ', '+opp+')"><i class="fas fa-trash-alt" style="color: Tomato; font-size: 1.4em; margin-top: 5px;"></i></button></div>';
      newOption += '</div>';
      break;
      case 'custom_text':
      case 'custom_int_num':
      newOption += '<div class="col-3">';
      newOption += '<input type="number" class="form-control" name="groups[' + group +'][options]['+opp+'][min]" placeholder="Mínimo" step="1">';
      newOption += '</div>';
      newOption += '<div class="col-3">';
      newOption += '<input type="number" class="form-control" name="groups[' + group +'][options]['+opp+'][max]" placeholder="Máximo" step="1">';
      newOption += '</div>';
      newOption += '<div class="col-3">';
      newOption += '¿Disponible? <input type="hidden" name="groups[' + group +'][options]['+opp+'][available]" value="0">';
      newOption += '<input type="checkbox" name="groups[' + group +'][options]['+opp+'][available]" value="1">';
      newOption += '<button type="button" class="delete_option_button" onclick="deleteOption(' + group + ', '+opp+')"><i class="fas fa-trash-alt" style="color: Tomato; font-size: 1.4em; margin-top: 5px;"></i></button></div>';
      newOption += '</div>';
      break;
      case 'custom_dec_num':
      newOption += '<div class="col-3">';
      newOption += '<input type="number" class="form-control" name="groups[' + group +'][options]['+opp+'][min]" placeholder="0.00" step="0.0001">';
      newOption += '</div>';
      newOption += '<div class="col-3">';
      newOption += '<input type="number" class="form-control" name="groups[' + group +'][options]['+opp+'][max]" placeholder="0.00" step="0.0001">';
      newOption += '</div>';
      newOption += '<div class="col-3">';
      newOption += '¿Disponible? <input type="hidden" class="form-control" name="groups[' + group +'][options]['+opp+'][available]" value="0">';
      newOption += '<input type="checkbox" class="form-control" name="groups[' + group +'][options]['+opp+'][available]" value="1">';
      newOption += '<button type="button" class="delete_option_button" onclick="deleteOption(' + group + ', '+opp+')"><i class="fas fa-trash-alt" style="color: Tomato; font-size: 1.4em; margin-top: 5px;"></i></button></div>';
      newOption += '</div>';
      break;
      default:
      break;
    }
    
    newOption += '</div>'; //close form-row
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
