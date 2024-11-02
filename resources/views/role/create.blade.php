<!-- resources/views/roles/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Create Role</title>
</head>
<body>
    <h1>Create Role</h1>
    <form action="{{ route('role.store') }}" method="POST">
        @csrf
        <label>Position:</label>
        <input type="text" name="position" required>
        <button type="submit">Save</button>
    </form>
</body>
</html>
