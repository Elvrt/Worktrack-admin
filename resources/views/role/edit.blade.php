<!-- resources/views/roles/edit.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Role</title>
</head>
<body>
    <h1>Edit Role</h1>
    <form action="{{ route('role.update', $role->role_id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Position:</label>
        <input type="text" name="position" value="{{ $role->position }}" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>
