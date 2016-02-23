$(function()
{
	$.ajaxSetup({
      headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
  });

	addAndEditUsingAjax();
	deleteUsingAjax();

});

function addAndEditUsingAjax()
{
	$('#btn-form').click(function(event)    //createUpdate
  {
		event.preventDefault();
    
    var formId = '#formulario';

		$.ajax(
    {
			url     : $(formId).attr('action'),
			type    : $(formId).attr('method'),
			data    : $(formId).serialize(),
      dataType: 'json',
      success : function(data)
      {
        if ($(formId).find("input:first-child").attr('value') === 'PATCH')
        {
        if (data.success)
          {
            redirectPage(data);
            $('.successMessages').append('<div class="alert alert-success">' + data.messages + '</div>');
          }
          else {
            console.log(data);

            $.each(data.messages, function(index, value)
            {            
              //Funciona agregando en el form => <div class="text-danger" id="nombreCampo_error"></div>
              var errorDiv = '#'+index+'_error';
              $(errorDiv).addClass('has-error');
              $(errorDiv).empty().append(value);
              console.error(index+': '+value);
            });
          }
        }
				else {
          if (data.success)
          {
            //Limpiar el formulario
            $('form')[0].reset();
            redirectPage(data);
            printSuccessMessage(data);

            window.setTimeout('location.reload()', 2000);
          }
          else {
            console.log(data);

            $.each(data.messages, function(index, value)
            {
              //Funciona agregando en el form => <div class="text-danger" id="nombreCampo_error"></div>
              var errorDiv = '#'+index+'_error';
              $(errorDiv).addClass('has-error');
              $(errorDiv).empty().append(value);
              console.error(index+': '+value);
            });
          }
        }
      }   //Fin success
		});   //Fin ajax()
	});   //Fin #btn-form
}   //Fin function addAndEditUsingAjax()

function deleteUsingAjax()
{
	$('.btn-danger').click(function(event)
  {
		event.preventDefault();

		var row  = $(this).parents('tr');
		var form = $('#formulario');

		$.ajax(
    {
			url     : form.attr('action').replace(':USER_ID', row.data('id')),
			type    : form.attr('method'),
			data    : form.serialize(),
			dataType: 'json',
			success : function(data)
      {
				row.fadeOut();
				printSuccessMessage(data);
        redirectPage(data);
			},
			error: function() {
				console.log('Error');
			}
		});
	});
}

function redirectPage(data)
{
  // Tipo de datos json
  var parsed = data;
  $(location).attr('href',parsed.url);
	$("#myAlert").delay(3000).fadeOut();
  
  // Tipo de datos html
//	var $jsonObject = jQuery.parseJSON(data);
//	$(location).attr('href',$jsonObject.url);
//	$("#myAlert").delay(3000).fadeOut();
  
//    var formId = '#formulario';
//    var url =  $(formId).attr('action');
//    $(location).attr('href', url);
}

function printSuccessMessage(data)
{
  // Tipo de datos json         
  $('.successMessages').append('<div class="alert alert-success">' + data.messages + '</div>');
  
  // Otra forma de mostrar el mensaje de éxito
//	$(".successMessages").append(
//    '<div id="myAlert" class="alert alert-success">'+
//      '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>'+
//      '</button>'+
//      '<div id="message">'+ data.messages +'</div>'+
//    '</div>'
//	);
  
  // Tipo de datos html
//	$(".successMessages").append(
//    '<div id="myAlert" class="alert alert-success">'+
//      '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>'+
//      '</button>'+
//      '<div id="message">'+ jQuery.parseJSON(message).messages +'</div>'+
//    '</div>'
//	);
//	$("#myAlert").delay(3000).fadeOut();
}