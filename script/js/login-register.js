$("button#submitLogin").click( function() {
 
  if( $("#votreemail").val() == "" || $("#password").val() == "" )
    $("div#reponseLogin").html('<div class="bg-red color-white p-10 b-r-5 m-b-10">Un ou plusieurs champs sont manquants.</div>');
  else
    $.post( $("#FormLogin").attr("action"),
	        $("#FormLogin :input").serializeArray(),
			function(data) {
			  $("div#reponseLogin").html(data);
			});
			
	$("#FormLogin").submit( function() {
	   return false;	
	});
	
});

$("button#submitRegister").click( function() {
 
  if( $("#votreprénomRegister").val() == "" || $("#votrenomRegister").val() == "" || $("#votreemailRegister").val() == "" || $("#votrepwdRegister").val() == "" || $("#votreemailRegister").val() == "" )
    $("div#reponseRegister").html('<div class="bg-red color-white p-10 b-r-5 m-b-10">Un ou plusieurs champs sont manquants.</div>');
  else
    $.post( $("#FormRegister").attr("action"),
	        $("#FormRegister :input").serializeArray(),
			function(data) {
			  $("div#reponseRegister").html(data);
			});
			
	$("#FormRegister").submit( function() {
	   return false;	
	});
	
});

$("button#submitContact").click( function() {
 
  if( $("#contact_email").val() == "" || $("#contact_sujet").val() == "" || $("#contact_description").val() == "" )
    $("div#reponseLogin").html('<div class="bg-red color-white p-10 b-r-5 m-b-10">Un ou plusieurs champs sont manquants.</div>');
  else
    $.post( $("#contact_form").attr("action"),
	        $("#contact_form :input").serializeArray(),
			function(data) {
			  $("div#reponseLogin").html(data);
			});
			
	$("#contact_form").submit( function() {
	   return false;	
	});
	
});