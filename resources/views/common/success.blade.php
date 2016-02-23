<!--common.success.blade.php -->

@if (Session::has('flash_message'))
  <div class="alert alert-success alert-dismissible" role="alert">
    @if (Session::has('flash_message_important'))
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    @endif
    {{ Session('flash_message') }}
  </div>
@endif