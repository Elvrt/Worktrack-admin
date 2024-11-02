@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
<div class="container">
        <h1>Time Off Records</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Take Off ID</th>
                    <th>Employee ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Letter</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $timeOff)
                    <tr>
                        <td>{{ $timeOff->take_off_id }}</td>
                        <td>{{ $timeOff->employee_id }}</td>
                        <td>{{ $timeOff->start_date }}</td>
                        <td>{{ $timeOff->end_date }}</td>
                        <td>{{ $timeOff->reason }}</td>
                        <td>{{ $timeOff->letter }}</td>
                        <td>{{ $timeOff->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</html>
    