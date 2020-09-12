$(document).ready(function(){
  if ($("#isLogin").val()!="true") {
    $(".icon-menu").click();
    $("#keyword").attr('placeholder', 'Fitur tidak tersedia');
  }
});
