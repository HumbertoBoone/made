t_groups = 0;
t_option = 0;
var abc = 1; 
var data = {"groups":[]
};
$(document).ready(function () {
  $(document).on("click","#btnMedia",function(){
    var modal = '<div id="media" class="modalContenedor" style="width: 100%; height: 100vh; position: fixed; top: 0; background-color: rgba(0,0,0,.7); display: block; ">'; // display table
    modal += '<div id="mm" class="mod" style="width: 100%; max-height: 650px; height: 100vh; margin-top: calc(50vh - 325px); max-width: 950px; margin-left: auto; margin-right: auto; background-color: #e5e5e5;border-radius: 6px; color: #444;">';
    bringMedia();
    modal += '</div></div>';
    $('body').append(modal);
  });
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
    console.log(group);
    newGroupOption(group);
  });

  $('#add_more').click(function () {
    $(this).before($("<div/>", {
      class: 'filediv'
    }).fadeIn('slow').append($("<input/>", {
      name: 'file[]',
      type: 'file',
      id: 'file'
    }), $("<br/><br/>")));
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
  /*$('#upload').click(function (e) {
    var name = $(":file").val();
    if (!name) {
      alert("First Image Must Be Selected");
      e.preventDefault();
    }
  });*/

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
function newGroupOption(group){
  //var gg = $('#group_' + group + ' input:last-child').attr('data-option');
  //var op = $('input[name="groups[' + group + '][options][' + 0 +'][name]"').substr(19,20);
  //var g = nn.match(/^\d +|\d +\b |\d + (?=\w)/);
  //console.log(gg);
  if ($('#group_' + group).contents().length == 0){
    var newOption = '<div id="option'+group+'" data-option="0">';
    newOption += '<input type="text" name="groups[' + group+'][options][0][name]">';
    newOption += '<input type="number" name="groups[' + group+'][options][0][value]">';   
    newOption += '<input type="hidden" name="groups[' + group+'][options][0][available]" value="1" data-option="0"></div>';
  }else{
    var gg = $('#option0').attr('data-option');
    console.log(gg);
    var newOption = '<div id="option' + group + '">';
    newOption += '<input type="text" name="groups[' + group + '][options]['+(gg+1)+'][name]">';
    newOption += '<input type="number" name="groups[' + group + '][options][' + (gg + 1) +'][value]">';
    newOption += '<input type="hidden" name="groups[' + group + '][options][' + (gg + 1) + '][available]" value="1" data-option="' + (gg + 1) +'"></div>';
  }
  $('#group_options'+(group)).append(newOption);
}
function bringMedia()
{
 
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: '../../images/get_images',
    success:function(res){
      var r = '<ul>';
      $.each(res, function (key, item) {
        r += '<li><img src="/made/img/items/'+item+'" style="max-width: 50px;"> </li>';
      });
      r += '</ul>';
      /*
      var r = '<ul>';
      res.forEach(function(data){
        r += '<li>'+data+'<li>';
      });
      r += '</ul>';
      console.log(r);*/
      $('#mm').append(r);
    }
  });
}