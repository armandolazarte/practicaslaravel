$(document).ready(function()
{
  $('#userstable').DataTable();   // index
  
  // Crear Usuario  - create
  $('#create-form').submit(function(event)
  {
    event.preventDefault();
    
//    var form = $(this);
    
    $.ajax(
    {
      url     : $(this).attr('action'),   //form.attr('action'),
      type    : 'POST',
      data    : $(this).serialize(),    //form.serialize(),
      success : function(data)
      {
        // Eliminar los datos del formulario y los mensajes de error
        clearMessages();
        
        if (data.success)
        {
          //Mostrar el mensaje de Registro creado          
          $('.successMessages').append('<div class="alert alert-success">' + data.messages + '</div>');
          
          //Remover los datos del formulario
          $('form')[0].reset();
          window.setTimeout('location.reload()', 2000);
          
          Displayusuarios();  // Refrescar la tabla después de insertar usuarios
          
          CheckValidation();
        }
        else {
//          alert('Error creando el usuario');
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
//      ,
//      error   : function(data)
//      {
//        $('#validation').show();
//
//        $('#validation ul li').remove();
//
//        var errors = data.responseJSON;
//
//        for (var key in errors)
//        {
//          if (errors.hasOwnProperty(key))
//          {
//            $('#validation ul').append('<li>' + errors[key] + '</li>');
//          }
//        }
//      }
    }); // Fin ajax()
  }); // Fin Crear Usuario  
  
  // Editar Usuario
  $('body').delegate('#edit-user', 'click', function(event)
  {
    event.preventDefault();
    
//    var url = $(this).attr('href');   //index
    
    $.ajax(
    {
      url       : $(this).attr('href'),   //url,   //index
      datatype  : 'json',
      success   : function(data)
      {
        CheckValidation();
        
        // Mostrar el formulario de creación de usuarios
        $('#users-form').html(data);    //index
      }
      
    }); // Fin ajax()
  }); // Fin Editar Usuario
  
  // Actualizar Usuario  - updateform
  $('body').delegate('#user-update', 'submit', function(event)
  {
    event.preventDefault();
    
//    var form = $(this);
//    var url  = form.attr('action');
    
    $.ajax(
    {
      url       : $(this).attr('action'),   //url,  //form.attr('action'),
      type      : 'PATCH',
      data      : $(this).serialize(),    //form.serialize(),
      success   : function(data)
      {
        clearMessages();
        
        if (data.success)
        {
          $('.successMessages').append('<div class="alert alert-success">' + data.messages + '</div>');
          $('form')[0].reset();
          window.setTimeout('location.reload()', 2000);
          
          Displayusuarios();
          Createform();
          CheckValidation();
        }
        else {
//          alert('Error al actualizar el usuario.');
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
//      ,
//      error: function(jqXHR, textStatus, errorThrown)
//      {
//        if(jqXHR)
//        {
//          clearMessages();
//
//          var errors = jqXHR.responseJSON;
//
//          var html = "<div class='alert alert-danger'>";
//
//          for(error in errors)
//          {
//              html+="<p>" + errors[error] + "</p>";
//          }
//
//          html += "</div>";
//
//          $(".errorMessages").html(html);
//        }
//      }
//      ,
//      error     : function(data)
//      {        
//        $('#validation').show();
//
//        $('#validation ul li').remove();
//
//        var errors = data.responseJSON;
//
//        for (var key in errors)
//        {
//          if (errors.hasOwnProperty(key))
//          {
//            $('#validation ul').append('<li>' + errors[key] + '</li>');
//          }
//        }
//      }
    }); // Fin ajax()
  }); // Fin Actualizar Usuario
  //
  // Eliminar Usuario
  $('body').delegate('#delete-form', 'submit', function(event)
  {
    event.preventDefault();
    
    $.ajax(
    {
      url       : $(this).attr('action'),
      type      : 'POST',
      data      : $(this).serialize(),
      success   : function(data)
      {
        if (data.success)
        {
          $('.successMessages').append('<div class="alert alert-success">' + data.messages + '</div>');
          window.setTimeout('location.reload()', 3000);
          
          Displayusuarios();
        }
        else {
//          alert('Error al eliminar el usuario.');
          $('.errorMessages').append('<div class="alert alert-warning">' + data.messages + '</div>');
        }
      }
    }); // Fin ajax()
  }); // Fin Eliminar Usuario
  
  // Refrescar la tabla después de insertar usuarios
  function Displayusuarios()
  {
    $.ajax(
    {
      url       : '/usuarios/displayusuarios',
      type      : 'GET',
      datatype  : 'json',
      headers   : {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success   : function(data)
      {
        $('#displayusuarios').html(data);
      }
    });
  }

  // Obtener la información del usuario para actualizarla */
  function Createform()
  {
    $.ajax(
    {
      url       : 'usuarios/create',  //'/usuarios/create',
      datatype  : 'json',
      headers   : {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type      : 'GET',
      success   : function(data)
      {
        // Mostrar el formulario de creación de usuarios
        $('#users-form').html(data);    //index
      }
    });
  }
  
  // Comprobar si la validación es visible - index
  function CheckValidation()
  {
    if ($('#validation').is(':visible'))
    {
      $('#validation').hide();
    }
  }

  function clearMessages()
  {
    //Remover los mensajes de error
    $(".text-danger").html('');
    
    // Eliminar la clase error
    $('.form-group').removeClass('has-error');
    
    //Remover los mensajes de creación y actualización
    $(".successMessages").html('');
  }
});
