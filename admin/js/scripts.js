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
});