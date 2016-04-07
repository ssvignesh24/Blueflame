function send_request(){
  email = $("#email").val();
  $.post("/subscribe",{email : email}, function(d){
    $("#email, #subscribe").fadeOut();
    $(".splash_content .subscribe_outer").css("border-color","rgba(0,0,0,0)");
    if(d == -1)
      $(".queue").fadeIn();
    else if(d == 1)
      $(".thank").fadeIn();
    else
      $(".error").fadeIn();
  });
}   
$('#email').keyup(function(e){
  email_ = this.value;
  regex_email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(regex_email.test(email_)){
    $('#subscribe').attr("data-send","true");
    $('#subscribe').css("opacity",1);
    if(e.which == 13){
      send_request();
    }
  }else{
    $('#subscribe').attr("data-send","false");
    $('#subscribe').css("opacity", "0.25");
  }
});

$('#subscribe').click(function(){
  if($(this).attr("data-send") == "true")
    send_request();
});

$(document).ready(function(){
  r = new Image();
  r.src = "/assets/images/getting_ready.jpg";
  r.onload = function(){
    $("body").css("background-image","url(/assets/images/getting_ready.jpg)");
  }
});