<!-- resources/views/roles/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Roles List</title>
    <!-- Add any CSS here for styling the table if needed -->
</head>
<body>
    <h1>Roles</h1>
    
    <!-- Button to add a new role -->
    <a href="{{ route('role.create') }}">
        <button>Add Role</button>
    </a>
    
    <!-- Table to display role_id and position -->
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Role ID</th>
                <th>Position</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($role as $role)
                <tr>
                    <td>{{ $role->role_id }}</td>
                    <td>{{ $role->position }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
