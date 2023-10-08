<!DOCTYPE html>
<html>
<head>
    <title>Generate QR</title>
</head>
<body>
    <h1>Generate QR</h1>
    <form action="{{ route('generate.totp') }}" method="post">
        @csrf
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="label">Label:</label>
        <input type="text" id="label" name="label" required><br><br>

        <button type="submit">Generate</button>
    </form>
</body>
</html>
