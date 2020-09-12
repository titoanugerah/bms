$(document).ready(function(){
  if ($("#IsLogin").val()!="true") {
    $(".icon-menu").click();
    $("#keyword").attr('placeholder', 'Fitur tidak tersedia');
  }
});
