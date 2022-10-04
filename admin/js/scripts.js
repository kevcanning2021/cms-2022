$(document).ready(function() {
    $('#summernote').summernote({
      height: 200
    });
  });

$(document).ready(function() {
  $('#select_boxes').click(function() {
    if(this.checked) {
      $('.check_boxes').each(function() {
        this.checked = true;
      });
    } else {
      $('.check_boxes').each(function() {
        this.checked = false;
      });
    }
  });
  
  var div_box = "<div id='load-screen'><div id='loading'></div></div>";
  $("body").prepend(div_box);

  $('#load-screen').delay(700).fadeOut(600, function() {
    $(this).remove();
  });
});