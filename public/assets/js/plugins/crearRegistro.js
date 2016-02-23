$(function()
{
  // CSRF Token para Laravel
  $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('#token').val()} });

  $('#crearForm').on("submit", function(event)
  {
    event.preventDefault();	//Guarda la forma de comportarse como un formulario HTML normal (no ajax)
    event.stopPropagation();

    $.ajax(
    {
      url     : $(this).attr('action'),     //$('form').attr("action"),   //$(this).attr('url'),
      method  : $(this).attr("method"),     //type    : 'POST',
      data    : $(this).serialize(),        //información a enviar
      dataType: 'json',
      success : function(data)
      {
        clearMessages();
        
        // Mostrar los datos en la consola
        console.log(data);

        if(data.success)
        {
          window.history.back();    //Volver a la página anterior
//          $('form').append('<div class="alert alert-success">' + data.messages + '</div>');
          $('.successMessages').append('<div class="alert alert-success">' + data.messages + '</div>');
//          $(".successMessages").slideUp(300).delay(4000).fadeIn(400);
          $('form')[0].reset();
//          console.log(data);
//              window.setTimeout('location.reload()', 3000);
        }

        if (data.fail)
        {
          $.each(data.messages, function(index, value)
          {            
            //Funciona agregando en el form => <div class="text-danger" id="nombre_error"></div>
            var errorDiv = '#'+index+'_error';
            $(errorDiv).addClass('has-error');
            $(errorDiv).empty().append(value);
            console.error(index+': '+value);
            
//            //Funciona agregando en el form => <div class="text-danger"><b>{!! $errors->first('nombre') !!}</b></div>
//            var errorDiv = '#'+index;
//            $(errorDiv).parent().addClass('has-error');
//            $(errorDiv).next().html(value);
//            console.error(index+': '+value);
            
//            //Funciona no colocando en el form => <div class="text-danger"><b>{!! $errors->first('nombre') !!}</b></div>
//            var formGroup = $('[name='+index+']', $('form')).closest('.form-group');
//            formGroup.addClass('has-error').append('<div><small class="text-danger">'+value+'</small></div>');
//            console.error(index+': '+value);
          });
          $('#successMessages').empty();
        }
      }
    }); // Fin función ajax()
  }); // Fin Guardar registro
});

function clearMessages()
{
  // Eliminar el texto de error
  $('.help-block').remove();    //$('.help-block').html("");

  // Eliminar la clase error
  $('.form-group').removeClass('has-error');

  $(".errorMessages").html('');
  $(".successMessages").html('');
}