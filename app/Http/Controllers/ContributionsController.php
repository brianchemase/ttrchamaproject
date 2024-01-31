<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker;
use PDF;

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


    public function statement()
    {
        $contributions="";


        $statements = [
            '2022' => [100, 150, 200, 180, 120, 250, 300, 210, 180, 150, 200, 250],
            '2021' => [90, 130, 180, 160, 110, 220, 280, 200, 170, 140, 190, 240],
            // Add more years and contributions as needed
        ];

        $data=[
            'contributions' => $contributions,
            'statements' => $statements,
            

        ];

       // return view('dashone.statement')->with($data);

       // $pdf = PDF::loadView('dashone.statement', $data);
       // return $pdf->download('ClientStatement.pdf');
       // return $pdf->stream();


        $pdf = PDF::loadView('dashone.statement', $data);
        $pdf->setPaper('L', 'landscape');
              return $pdf->stream();
    }








    
}
