@extends('layouts.baseOp2')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1>Crear nuevo almacén</h1>
    </div>

    <div class="row justify-content-center">
        <form class="needs-validation col-lg-10 ">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="validationCustom01">First name</label>
                    <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="validationCustom02">Last name</label>
                    <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="validationTooltipUsername">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                        </div>
                        <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
                        <div class="invalid-tooltip">
                            Please choose a unique and valid username.
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-6 mb-3">
                    <label for="validationCustom03">City</label>
                    <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <label for="validationCustom04">State</label>
                    <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
                    <div class="invalid-feedback">
                        Please provide a valid state.
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <label for="validationCustom05">Zip</label>
                    <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
                    <div class="invalid-feedback">
                        Please provide a valid zip.
                    </div>
                </div>
            </div>
            <div class="form-row justify-content-around">
                <button class="btn btn-primary" type="submit">Registrar Almacén</button>
                <!-- <div class="mr-auto"></div> -->
                <a class="btn btn-primary" type="submit">Cancelar</a>
            </div>
        </form>
    </div>
</div>


@endsection
