<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker;

class ContributionsController extends Controller
{
    //

    public function contributions()
    {
        $contributions="";


        $faker = Faker::create();

        $Members = [];

        for ($i = 0; $i < 5; $i++) {
            $Members[] = [
                'memberno' => $faker->unique()->randomNumber(),
                'full_name' => $faker->name,
                'id_number' => $faker->ean8,
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->email,
                'birthday' => $faker->date,
                'residence' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $data=[
            'contributions' => $contributions,
            'Members' => $Members,
            

        ];

        return view('dashone.postcontributions')->with($data);
    }
}
