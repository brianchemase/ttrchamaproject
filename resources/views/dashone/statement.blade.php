<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Contribution Statement</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        
    </style>
</head>
<body>
    <div style="text-align: center;" >
        <img src="{{public_path('logo/logo.png')}}" alt="logo" width="70" height="70">
        <h1>Member Contribution Statement</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th align="centre">Member No: {{ $memberData->memberno ?? '' }}</th>
                <th align="centre">Member name : {{ $memberData->full_name ?? '' }}</th>
                <th align="centre">Member Contact: {{ $memberData->phone_number ?? '' }}</th>
                <th align="centre">Total Contribution: KES {{$Totalcontributions}}</th>
            </tr>
            <tr>
                <th colspan="3">Year</th>
                <th align="centre">Interest earned: KES 500</th>
            </tr>
        </thead>
    </table>
    <div style="text-align: center;">
        <h3>Member Contribution summary Statement</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th>Year</th>
                <th>January</th>
                <th>February</th>
                <th>March</th>
                <th>April</th>
                <th>May</th>
                <th>June</th>
                <th>July</th>
                <th>August</th>
                <th>September</th>
                <th>October</th>
                <th>November</th>
                <th>December</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statements as $year => $contributions)
                <tr>
                    <td>{{ $year }}</td>
                    @foreach($contributions as $contribution)
                        <td>{{ $contribution }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="text-align: center;">
        <p><i><b>Report generated on Date from TTR System<br> Contact : 07 for enquries</b></i></p>
        
    </div>

</body>
</html>
