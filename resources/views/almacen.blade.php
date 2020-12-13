@extends('layouts.baseOp2')

@section('content')

@if (Auth::user()->id == $idUsuario && !is_null($datosAlmacen) )
<div class="container">
    <div class="row justify-content-center">
        <h1>{{ $datosAlmacen->nombreAlmacen }}</h1>
    </div>
    <div class="row justify-content-center">
        <p class="col-12 col-lg-10 text-center font-weight-light">{{ $datosAlmacen->descripcion }}</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <!-- Selectores de Secciones -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-colorPrimario active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Inventario de ingredientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-colorPrimario" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Usuarios</a>
                </li>
                @if( $datosAlmacen->tipoDeAcceso == "propietario")
                <!-- Opciones para el propietario -->
                <li class="nav-item ml-auto">  <!-- Espaciado para la izq. -->
                    <a class="nav-link text-colorPrimario" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Invitaciones enviadas</a>
                </li>
                @endif
            </ul>
            <!-- Secciones -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero dolores quasi distinctio veritatis rerum aperiam, dolore fugiat pariatur porro ratione ipsa cupiditate excepturi delectus eveniet veniam debitis laborum non tempore!
                    </p>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla facere maxime ipsa omnis quas rem a neque. Omnis debitis sed ullam. Hic dolorem odio autem nesciunt laudantium provident sed amet.
                        Saepe voluptate iure fugiat cum nostrum, accusamus harum accusantium voluptas voluptates aliquam sit optio dolorem impedit architecto molestias sunt sint adipisci id doloremque in vero fuga. Labore iusto maiores odio?
                        Ratione magni nisi quo omnis amet explicabo laboriosam aliquid deserunt tempore asperiores doloremque nesciunt similique natus fugiat dolor dolores autem hic, distinctio ipsam est. Numquam ipsum repellendus nobis animi minima!
                    </p>
                </div>
                @if( $datosAlmacen->tipoDeAcceso == "propietario")
                <!-- Opciones para el propietario -->
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="d-flex mx-3 my-3">
                        <a href="/misAlmacenes/{{Auth::user()->id}}/{{$datosAlmacen->id}}/almacen/{{$datosAlmacen->idAlmacen}}/invitarUsuario" 
                            class="btn btn-primary">Invitar usuario</a>
                    </div>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iusto voluptate odit sed esse error doloribus sint eveniet corporis obcaecati. Error voluptas itaque sapiente, repellendus omnis maiores? Sint, voluptatum recusandae!
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
@else
    <!-- El usuario no tiene acceso a esta ubicacion o la petición no tiene resultados -->
    <div class="row justify-content-center">
        <p class="text-center text-danger ">Acceso denegado</p>
    </div>
@endif

</div>

@endsection