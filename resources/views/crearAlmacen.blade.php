@extends('layouts.baseOp2')

@section('content')

@auth
<div class="container">
    <div class="row justify-content-center">
        <h1>Crear nuevo almacén</h1>
    </div>

    <div class="row justify-content-center">
        <form action="/crearNuevoAlmacen" class="needs-validation col-lg-10 " method="POST" novalidate>
            @csrf
            <input type="hidden" name="idUsuario" value="{{ Auth::user()->id }}" required>
            <div class="form-row">
                <div class="col-lg-12 mb-3">
                    <label for="validationTooltip01">Nombre del almacén:</label>
                    <input type="text" class="form-control" name="nombreAlmacen" id="validationDefault01" placeholder="Mi almacén" required>
                    <div class="valid-feedback"> Campo válido </div>
                    <div class="invalid-feedback"> Campo inválido </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-12 mb-3">
                    <label for="validationDefault02">Descripción:</label>
                    <textarea class="form-control" name="descripcion" id="validationDefault02" rows="5" placeholder="Este es un almacen privado" required>
                    </textarea>
                    <div class="valid-feedback"> Campo válido </div>
                    <div class="invalid-feedback"> Campo inválido </div>
                </div>
            </div>
            @isset($mensaje)
            <div class="form-row justify-content-center">
                <p class="text-danger col-8 text-center"> {{$mensaje ?? 'Texto alternativo'}} </p>
            </div>
            @endisset
            <div class="form-row justify-content-around">
                <button class="btn btn-primary" type="submit">Registrar Almacén</button>
                <a class="btn btn-primary" href="/misAlmacenes/{{Auth::user()->id}}">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endauth
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
