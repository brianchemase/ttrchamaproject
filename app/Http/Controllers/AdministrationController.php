<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Faker\Factory as Faker;


class AdministrationController extends Controller
{
    //
    public function home()
    {
        $contributions="";
        $MonthCollection="2500";
        $LastMonthCollection="12,500";
        $members="400";

        //https://demo.bootstrapdash.com/purple/jquery/template/demo_1/pages/samples/widgets.html

        $data=[
            'contributions' => $contributions,

            'MonthCollection' => $MonthCollection,
            'LastMonthCollection' => $LastMonthCollection,
            'members' => $members,
            

        ];

        return view('dashone.home')->with($data);
    }


    public function memberregister()
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

       // return $Members;

        $data=[
            'contributions' => $contributions,
            'Members'=> $Members
            

        ];

        return view('dashone.memberregister')->with($data);
    }

    public function StoreMemberData(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'memberno' => 'required',
            'full_name' => 'required',
            'id_number' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'email' => 'nullable|email',
            'birthday' => 'required|date',
            'residence' => 'required',
        ]);

        try {
            // Insert data into the membership table
            DB::table('membership')->insert($validatedData);

            // If successful, redirect back with success message
            return back()->with('success', 'Data saved successfully!');
        } catch (\Exception $e) {
            // If an error occurs, redirect back with error message
            return back()->with('error', 'Error saving data. Please try again.');
        }
    }



    public function viewmemberregister()
    {
        $contributions="";

        $faker = Faker::create();

        $Members = [];

        for ($i = 0; $i < 20; $i++) {
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
            'Members'=> $Members
            

        ];

        return view('dashone.memberstable')->with($data);
    }


    public function table()
    {
        $contributions="";

        $data=[
            'contributions' => $contributions,
            

        ];

        return view('dashone.table')->with($data);
    }

    public function form()
    {
        $contributions="";

        $data=[
            'contributions' => $contributions,
            

        ];

        return view('dashone.forms')->with($data);
    }
    public function formtable()
    {
        $contributions="";

        $data=[
            'contributions' => $contributions,
            

        ];

        return view('dashone.formtable')->with($data);
    }
}
