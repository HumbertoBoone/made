var abc = getLastIndex();
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
  $('.cancel_cross').on('click', function() {
    $(this).parent().parent().remove();
  });
  function imageIsLoaded(e) {
    $('#previewimg' + abc).attr('src', e.target.result).attr('class', 'img');
  };
  function getLastIndex(){
    return parseInt($('#last_id').val(), 10);
  }
  function deleteUnusedInputs(){
    $('.file').remove(':visible');
  }