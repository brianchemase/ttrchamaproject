<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
        $Members = DB::table('membership')->get();


        $data=[
            'contributions' => $contributions,
            'Members' => $Members,
            

        ];

        return view('dashone.postcontributions')->with($data);
    }


   

    public function search_entry(Request $request)
    { 


        if(isset($_GET['q']))
        {    
            $memberno=$_GET['q'];
          

            $selectedOption = $request->input('q');

            
            //$selectedValues = explode(',', $selectedOption);
            //$idNumber = $selectedValues[0];
            //$loanId = $selectedValues[1];

            $memberData = DB::table('membership')->where('memberno', $memberno)->first();
           // return $memberData;
           $Members = DB::table('membership')->get();
            $data=[
                
                'Members' => $Members,
                'memberData' => $memberData,
        
        ];

        return view('dashone.postcontributions')->with($data);


        }
        else{
            $contributions="";
            $Members = DB::table('membership')->get();
            $data=[
                'contributions' => $contributions,
                'Members' => $Members,
        
        ];

        return view('dashone.postcontributions')->with($data);

        }
    }



    public function submitContribution(Request $request)
    {

        $inputs = $request->all();
        // Validate the form data
        $validatedData = $request->validate([
            'contributionDate' => 'required|date',
            'contribution' => 'required|numeric',
            'contributionMonth' => 'required|numeric',
            // Add other validation rules as needed
        ]);


        $year = Carbon::now()->year;

        // Save the form data to the database
        // Assuming you have a "contributions" table
        DB::table('monthly_contributions')->insert([
            'member_no' => $request->input('memberno'),
            'amount' => $validatedData['contribution'],
            'payment_date' => $validatedData['contributionDate'],
            'payment_month' => $validatedData['contributionMonth'],
            'payment_year' => $year,
            // Add other fields as needed
        ]);

        // Redirect back or wherever you want after submitting
        return redirect()->back()->with('success', 'Contribution registered successfully!');
    }


    public function statement()
    {
        $contributions="";


        $statements = [
            '2022' => [100, 150, 200, 180, 120, 250, 300, 210, 180, 150, 200, 250],
            '2021' => [90, 130, 180, 160, 110, 220, 280, 200, 170, 140, 190, 240],
            '2023' => [150, 130, 180, 160, 110, 220, 280, 200, 170, 140, 190, 240],
            '2024' => [200, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            
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
