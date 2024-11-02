<!-- resources/views/reports/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
</head>
<body>
    <h1>Reports</h1>
    <a href="{{ route('reports.create') }}">Create New Report</a>
    <ul>
        @foreach ($reports as $report)
            <li>
                <a href="{{ route('reports.show', $report->report_id) }}">{{ $report->activity_title }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
