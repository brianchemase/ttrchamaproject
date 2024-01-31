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

        div {text-align: center;}
    </style>
</head>
<body>
    <div>
        <img src="{{public_path('logo/logo.png')}}" alt="logo" width="70" height="70">
        <h1>Member Contribution Statement</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th align="centre">Member name : Names</th>
                <th align="centre">Member No: Number</th>
                <th align="centre">Member Contact: 0712345678</th>
                <th align="centre">Total Contribution: KES 25,000</th>
            </tr>
            <tr>
                <th colspan="3">Year</th>
                <th align="centre">Interest earned: KES 500</th>
            </tr>
        </thead>
    </table>
    <div>
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

</body>
</html>
