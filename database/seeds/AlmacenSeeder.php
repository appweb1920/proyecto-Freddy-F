<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AlmacenSeeder extends Seeder
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
        
        //Crea 5 almacenes para pruebas
        foreach (range(1, 5) as $index) {
            DB::table('almacen')->insert([
                'nombreAlmacen' => 'Almacen '.$index,
                'descripcion' => $faker->text(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
