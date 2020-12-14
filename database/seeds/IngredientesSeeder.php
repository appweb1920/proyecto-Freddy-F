<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Str;


class IngredientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //id - 1
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'Harina',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'masa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //id - 2
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'sal',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'masa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //id - 3
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'bicarbonato de sodio',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'masa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //id - 4
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'canela en polvo',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'masa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //id - 5
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'nuez moscada',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'masa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //id - 5
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'pimienta molida',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'masa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //id - 6
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'calabaza',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'masa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //id - 7
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'agua',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'volumen',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //id - 8
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'esencia de vainilla',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'volumen',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //id - 9
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'aceite vegetal',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'volumen',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //id - 10
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'huevos',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'masa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //id - 11
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'nuez en trozos',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'masa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //id - 12
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'mantequilla',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'masa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        //id 13
        DB::table('ingredientes')->insert([
            'nombreIngrediente' => 'azucar',
            'categoria' => 'PruebaCategoria',
            'tipoDeMedidaBase' => 'masa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
