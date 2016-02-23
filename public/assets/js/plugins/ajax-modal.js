$.ajaxSetup(
{
  headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
  }
});

$(document).ready(function()    // o $(function()
{
  $(document).on('click', '#showModal', function()
  {
    var modalTitle = $(this).attr('data-modal-title');    //index

    $.ajax(
    {
      url       : $(this).attr('data-href'),
      dataType  : 'html',
      success   : function(data)
      {
//        $('.modalTitle').text(modalTitle.toString());   //modal-crud
        $('.modalTitle').html(modalTitle);   //modal-crud
        $('.showForm').html(data);    //modal-crud
      }
    });//Fin ajax()
  });//Fin Ventanas Modales
  
  // Crear y Actualizar registros
  $(document).on('submit', '#formRegistros', function(event)
  {
    event.preventDefault();

    clearMessages();
    
    var formId = '#formRegistros';

    $.ajax(
    {
      url     : $(formId).attr('action'),   //$(this).attr('action'),
      method  : $(formId).attr('method'),   //$(this).attr('method'),
      data    : $(formId).serialize(),      //$(this).serialize(),
      dataType: 'json',
      success : function(data)
      {
        if ($(formId).find("input:first-child").attr('value') === 'PATCH')
        {
        if (data.success)
          {
            $('#crearEditar').modal('hide');
            printSuccessMessage(data);
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
            $('#crearEditar').modal('hide');
            printSuccessMessage(data);
          }
          else {
            console.log(data);

            $.each(data.messages, function(index, value)
            {
              //Funciona agregando en cada campo del form =>
              //<div class="text-danger" id="nombreCampo_error"></div>
              var errorDiv = '#'+index+'_error';
              $(errorDiv).addClass('has-error');
              $(errorDiv).empty().append(value);
              console.error(index+': '+value);
            });
          }
        }        
      } //Fin success
    }); //Fin ajax()
//      .done(function(data)
//      {
//        $('alert-success').removeClass('hidden');
//        $('#crearEditar').modal('hide');
//      })
//      .fail(function(data)
//      {
//        //Funciona agregando en cada campo del form => <small class="help-block"></small>
//        $.each(data.responseJSON, function(key, value)
//        {
//          var input = '#formRegistros input[name=' + key + ']';
//          $(input + '+small').text(value);
//          $(input).parent().addClass('has-error');
//        });
//      });
  }); //Fin Crear y Actualizar registros - #formRegistros
  
  // Eliminar registros
  $(document).on('click', '.confirmarEliminar', function () {
    $('#eliminarForm').prop('action', $(this).attr('data-href'));
  });
  
  $(document).on('click', '.eliminarReg', function(e)
  {
    e.preventDefault();
    
    var selectorForm = $(this);
    var formAction   = $('#eliminarForm').attr('action');    //Obtener el id
//    alert(formAction);
    
    $.ajax(
    {
      url     : formAction,
      method  : 'DELETE',       //type
      dataType: 'json',
      success : function(data)
      {
        $('#modalEliminar').modal('hide');
//        $.growl.notice({
//          title:   selectorForm.attr('data-message-title'),
//          message: selectorForm.attr('data-message-success')
//        });
        printSuccessMessage(data);
      },
      error: function(data)
      {
        $("#msj2").empty();
        
        $.each(data.responseJSON, function(key, value)
        {
          $("#msj2").append('<li>' + value + '</li>');
        });
        
        if (! $("#msj-error").is(":visible"))
        {
          $("#msj-error").fadeIn();
          $("#msj-error").delay(2000).fadeOut(1000);
        }
      }
    });
    $('#modalEliminar').modal('hide');
  });  
    
  function clearMessages()
  {
    // Remover los mensajes de error
    $(".text-danger").html('');

    // Eliminar la clase error
    $('.form-group').removeClass('has-error');

    //Remover los mensajes de creación y actualización
    $(".successMessages").html('');
  }
  
  function printSuccessMessage(data)
  {
    // Tipo de datos json         
    $('.successMessages').append('<div class="alert alert-success">' + data.messages + '</div>');
    window.setTimeout('location.reload()', 2000);   //Refrescar el formulario de registros
  //          $(".successMessages").delay(3000).fadeOut();
  //          $(".modal-backdrop").hide();
  }
});