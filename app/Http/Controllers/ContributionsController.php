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
        $currentMonthWord = now()->format('F');

        $memberno=$request->input('memberno');
        $contribution=$request->input('contribution');

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

        $memberData = DB::table('membership')->where('memberno', $memberno)->first();

        if ($memberData) {
            $phone = $memberData->phone_number;
            $fullName = $memberData->full_name;
           
            // Split the full name into words
            $words = explode(' ', $fullName);

            // Get the first word (first name)
            $firstName = $words[0];

            // Capitalize the first letter
            $memberfirstname = ucfirst(strtolower($firstName));

            $message="Dear $memberfirstname,\nWe have received your monthly contribution of KES $contribution for the month of $currentMonthWord.\n Thank you for being loyal. Regards\n TTR ";
            $Notify = $this->SendNotification($phone, $message);
            // Now $phoneNumber contains the phone number
        }
        // Redirect back or wherever you want after submitting
        return redirect()->back()->with('success', 'Contribution registered successfully!');
    }


    public function Memberstatement()
    {
        $contributions="";

        $Members = DB::table('membership')->get();


        $data=[
            'contributions' => $contributions,
            'Members' => $Members,
            ];

        return view('dashone.memberstatementform')->with($data);
    }
    


    public function statement(Request $request)
    {
        //$memberno="411";
        $memberno = $request->input('memberno');
        $memberData = DB::table('membership')->where('memberno', $memberno)->first();

        $contributions="";
        $Totalcontributions = DB::table('monthly_contributions')
                    ->where('member_no', $memberno)
                    ->sum('amount');

        $statements = [
            '2022' => [100, 150, 200, 180, 120, 250, 300, 210, 180, 150, 200, 250],
            '2021' => [90, 130, 180, 160, 110, 220, 280, 200, 170, 140, 190, 240],
            '2023' => [150, 130, 180, 160, 110, 220, 280, 200, 170, 140, 190, 240],
            '2024' => [200, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            
            // Add more years and contributions as needed
        ];

        $distinctYears = DB::table('monthly_contributions')
            ->select('payment_year')
            ->where('member_no', $memberno)
            ->distinct()
            ->pluck('payment_year');

        $statements = [];

      // Loop through distinct years and fetch sums for each year
        foreach ($distinctYears as $year) {
            $totalSum = DB::table('monthly_contributions')
                ->select(DB::raw('SUM(amount) as total_amount'), 'payment_month')
                ->where('member_no', $memberno)
                ->where('payment_year', $year)
                ->groupBy('payment_month')
                ->orderBy('payment_month')
                ->pluck('total_amount', 'payment_month')
                ->toArray();

           
            // Fill the array with 0 for missing months
                $statements[$year] = [
                    $totalSum[1] ?? 0,  // January
                    $totalSum[2] ?? 0,  // February
                    $totalSum[3] ?? 0,  // March
                    $totalSum[4] ?? 0,  // April
                    $totalSum[5] ?? 0,  // May
                    $totalSum[6] ?? 0,  // June
                    $totalSum[7] ?? 0,  // July
                    $totalSum[8] ?? 0,  // August
                    $totalSum[9] ?? 0,  // September
                    $totalSum[10] ?? 0, // October
                    $totalSum[11] ?? 0, // November
                    $totalSum[12] ?? 0, // December
                ];
        }

        //return $statements;


        $data=[
            'contributions' => $contributions,
            'statements' => $statements,
            'memberData' => $memberData,
            'Totalcontributions' => $Totalcontributions,
            

        ];

       // return view('dashone.statement')->with($data);

       // $pdf = PDF::loadView('dashone.statement', $data);
       // return $pdf->download('ClientStatement.pdf');
       // return $pdf->stream();


        $pdf = PDF::loadView('dashone.statement', $data);
        $pdf->setPaper('L', 'landscape');
              return $pdf->stream();
    }


    public function tablestatement($memberno)
    {
        //$memberno="411";
        //$memberno = $request->input('memberno');
        $memberData = DB::table('membership')->where('memberno', $memberno)->first();

        $contributions="";
        $Totalcontributions = DB::table('monthly_contributions')
                    ->where('member_no', $memberno)
                    ->sum('amount');

        $statements = [
            '2022' => [100, 150, 200, 180, 120, 250, 300, 210, 180, 150, 200, 250],
            '2021' => [90, 130, 180, 160, 110, 220, 280, 200, 170, 140, 190, 240],
            '2023' => [150, 130, 180, 160, 110, 220, 280, 200, 170, 140, 190, 240],
            '2024' => [200, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            
            // Add more years and contributions as needed
        ];

        $distinctYears = DB::table('monthly_contributions')
            ->select('payment_year')
            ->where('member_no', $memberno)
            ->distinct()
            ->pluck('payment_year');

        $statements = [];

      // Loop through distinct years and fetch sums for each year
        foreach ($distinctYears as $year) {
            $totalSum = DB::table('monthly_contributions')
                ->select(DB::raw('SUM(amount) as total_amount'), 'payment_month')
                ->where('member_no', $memberno)
                ->where('payment_year', $year)
                ->groupBy('payment_month')
                ->orderBy('payment_month')
                ->pluck('total_amount', 'payment_month')
                ->toArray();

           
            // Fill the array with 0 for missing months
                $statements[$year] = [
                    $totalSum[1] ?? 0,  // January
                    $totalSum[2] ?? 0,  // February
                    $totalSum[3] ?? 0,  // March
                    $totalSum[4] ?? 0,  // April
                    $totalSum[5] ?? 0,  // May
                    $totalSum[6] ?? 0,  // June
                    $totalSum[7] ?? 0,  // July
                    $totalSum[8] ?? 0,  // August
                    $totalSum[9] ?? 0,  // September
                    $totalSum[10] ?? 0, // October
                    $totalSum[11] ?? 0, // November
                    $totalSum[12] ?? 0, // December
                ];
        }

        //return $statements;


        $data=[
            'contributions' => $contributions,
            'statements' => $statements,
            'memberData' => $memberData,
            'Totalcontributions' => $Totalcontributions,
            

        ];

       // return view('dashone.statement')->with($data);

       // $pdf = PDF::loadView('dashone.statement', $data);
       // return $pdf->download('ClientStatement.pdf');
       // return $pdf->stream();


        $pdf = PDF::loadView('dashone.statement', $data);
        $pdf->setPaper('L', 'landscape');
              return $pdf->stream();
    }

    public function viewcontributingMembers()
    {
        $contributions="";

        
        $Members = DB::table('membership')->get();

        $Members = DB::table('membership')
            ->join('monthly_contributions', 'membership.memberno', '=', 'monthly_contributions.member_no')
            ->select('membership.*')
            ->distinct()
            ->get();

        //return $Members;


        $data=[
            'contributions' => $contributions,
            'Members'=> $Members
            

        ];

        return view('dashone.membercontributions')->with($data);
    }


    public function ContributionsReminder()
    {


        $currentMonth = now()->format('n'); // 'n' returns the month without leading zeros
        $currentMonthWord = now()->format('F');
        $currentYear = now()->format('Y');
       // return $currentMonth;
       
            $missingPayments = DB::table('membership')
            ->select('memberno', 'full_name', 'phone_number')
            ->whereNotIn('memberno', function ($query) use ($currentMonth, $currentYear) {
                $query->select('member_no')
                    ->from('monthly_contributions')
                    ->where('payment_month', '=', $currentMonth)
                    ->where('payment_year', '=', $currentYear);
                   
            })
            ->get();


        // Output or use $missingPayments as needed

        // Loop through missing payments and send a message
            foreach ($missingPayments as $member) {
                $memberNo = $member->memberno;
                $fullName = $member->full_name;
                $phone = $member->phone_number;

                // Split the full name into words
                $words = explode(' ', $fullName);

                // Get the first word (first name)
                $firstName = $words[0];

                // Capitalize the first letter
                $memberfirstname = ucfirst(strtolower($firstName));

                // Create your message content here
                $message = "Dear $fullName, you have not made a payment for the current month. Please make the payment as soon as possible.";


                $message = "Dear $memberfirstname,\n\n"
                    . "Unapokea ujumbe huu kukuhabarisha kuhusu michango ya mwezi inayoendelea. "
                    . "Tunapofunga ripoti za $currentMonthWord tarehe kumi (10.$currentMonth.$currentYear), hakutakuwa na muda wa ziada. Tafadhali jaribu kushiriki.\n\n"
                    . "Nambari ya Paybill: 400222\n"
                    . "Nambari ya akaunti: 9348#$memberNo\n\n"
                    . "Asante kwa ushirikiano wako.\n"
                    . "From TTR.\n";

                // Use your preferred method to send the message (e.g., SMS, email, etc.)
                // Example: You can use Laravel's notification system or a third-party API
                // For demonstration purposes, let's just print the message
                //$Notify = $this->SendNotification($phone, $message);
                echo "Sending message to $fullName ($phone): $message\n";
            }
        
    }

    public function SendNotification($phone, $message)
    {
        // Define the JSON data to send
        $data = [
            "phone" => $phone,
            "message" => $message,
        ];

        $apikey="6bffdc7405dd019325db9cfe3ec093e0";
        $shortcode="TextSMS";
        $partnerID="6712";
        $serviceId=0;

                $smsdata=array(
                    "apikey" => $apikey,
                    "shortcode" => $shortcode,
                    "partnerID"=> $partnerID,
                    "mobile" => $phone,
                    "message" => $message,
                    //"serviceId" => $serviceId,
                    //"response_type" => "json",
                    );
                    
                $smsdata_string=json_encode($smsdata);
                //echo $smsdata_string."\n";

                $smsURL="https://sms.textsms.co.ke/api/services/sendsms/";

                //POST
                $ch=curl_init($smsURL);
                curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"POST");
                curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
                curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
                curl_setopt($ch,CURLOPT_POSTFIELDS,$smsdata_string);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                curl_setopt($ch,CURLOPT_HTTPHEADER,array(
                    'Content-Type: application/json',
                    'Content-Length: '.strlen($smsdata_string)
                    )	
                );
                $response=curl_exec($ch);
                $err = curl_error($ch);
                curl_close($ch);

        // Output the response from the endpoint
       // return "Response: " . $response;
    }

    public function SendNotification1($phone, $message)
    {
        set_time_limit(10000); // Set to a higher value than the default
       
        $tel = $phone; // Copy the original phone number
        $code = "254";

        // Check if the phone number starts with "254"
        if (substr($tel, 0, 3) !== "254") {
            // Check if the phone number starts with "07"
            if (substr($tel, 0, 2) === "07") {
                // Remove the first zero and add the country code
                $tel = $code . substr($tel, 1);
            } else {
                // Add the country code to other cases
                $tel = $code . $tel;
            }
        }

             $to = $tel;
             //return $to;

                $ApiKey = 'mrbZnidZL1aisGhRem5yQ38v1DjFZXdFamYpRr21YtQ=';
                $ClientId = 'ae5e5440-3968-4422-8018-feb27cebd201';
                $SenderId = 'SUCDIAGENCY';
                $AccessKey = 'mwNYuBUe0fxbYqDyyYkz9gsgNIH5cP0H';
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.onfonmedia.co.ke/v1/sms/SendBulkSMS",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\n  \"SenderId\": \"".$SenderId."\",\n  \"MessageParameters\": [\n    {\n      \"Number\": \"".$to."\",\n      \"Text\": \"".$message."\"\n    }\n  ],\n  \"ApiKey\": \"".$ApiKey."\",\n  \"ClientId\": \"".$ClientId."\"\n}",
                CURLOPT_HTTPHEADER => array(
                    "accesskey: ".$AccessKey."",
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                //return $response;
    }








    
}
