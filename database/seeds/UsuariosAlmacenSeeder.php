<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UsuariosAlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Llenar con elementos creados directamente
        $faker = Faker::create();
        
        //Asigna a 5 usuarios de prueba como propietarios de su almacen
        foreach (range(1, 5) as $index) {
            $user = App\User::where('email',''.$index.'@prueba')->get()->first(); //Busca el id del usuario de pruebas
            $almacen = App\Almacen::where('nombreAlmacen','Almacen '.$index)->get()->first(); //Busca el id del almacen de pruebas
            DB::table('usuariosAlmacen')->insert([
                'idUsuario' => $user->id,
                'idAlmacen' => $almacen->id,
                'tipoDeAcceso' => 'propietario',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        //Asigna 6 usuarios como invitados de los almacenes 1, 2 y 3 (2 usuarios c/almacen)
        foreach (range(6, 11) as $index) {
            $user = App\User::where('email',''.$index.'@prueba')->get()->first(); //Busca el id usuario de pruebas
            $almacen = App\Almacen::where('nombreAlmacen','Almacen '.(1 + $index%3))->get()->first(); //Busca el id del almacen de pruebas 1,2 o 3
            DB::table('usuariosAlmacen')->insert([
                'idUsuario' => $user->id,
                'idAlmacen' => $almacen->id,
                'tipoDeAcceso' => 'invitado',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
