@extends('layouts.baseOp2')

@section('content')

@if ( $validacion && Auth::user()->id == $idUsuario)
<div class="container">
    <div class="row justify-content-center">
        <h1>Invitar usuario a almacén</h1>
    </div>
    <div class="row justify-content-center">
        <form action="/invitarUsuario" class="needs-validation col-lg-10 " method="POST" novalidate>
            @csrf
            <input type="hidden" name="idUsuarioPropietario" value="{{ Auth::user()->id }}" required>
            <input type="hidden" name="idAlmacen" value="{{ $idAlmacen }}" required>
            <div class="form-row">
                <div class="col-lg-8 mb-3">
                    <label for="validationDefault01">Correo de usuario invitado:</label>
                    <input type="email" class="form-control" name="emailUsuarioInvitado" id="validationDefault01" 
                        placeholder="Correo de usuario a invitar" required>
                    <div class="valid-feedback"> Formato de campo válido </div>
                    <div class="invalid-feedback"> Formato de campo inválido </div>
                    <p class="text-secondary font-italic"> Se enviará la invitación a la cuenta del usuario con el correo indicado.</p>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="validationDefault02">Tipo de acceso:</label>
                    <select class="custom-select" name="tipoDeAcceso" id="validationDefault02" required>
                        <option value="invitado">Invitado</option>
                        <option value="propietario">Propietario</option>
                    </select>
                </div>
            </div>
            @if (Session::has('invitacionEnviada'))
                <div class="alert alert-success"> {{ Session::get('invitacionEnviada') }} </div>
            @endif
            @if (Session::has('invitacionNoEnviada'))
                <div class="alert alert-danger"> {{ Session::get('invitacionNoEnviada') }} </div>
            @endif

            <div class="form-row justify-content-around">
                <button class="btn btn-primary" type="submit">Enviar invitación</button>
                <a class="btn btn-primary" href="/misAlmacenes/{{Auth::user()->id}}/{{$idUsuarioAlmacen}}/almacen/{{$idAlmacen}}">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@else
    <!-- El usuario no tiene acceso a esta ubicacion -->
    <div class="row justify-content-center">
        <p class="text-center text-danger ">Acceso denegado</p>
    </div>
@endif

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

@endsection