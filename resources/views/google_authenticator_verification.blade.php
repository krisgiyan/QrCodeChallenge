@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div style="color: red;">{{ session('error') }}</div>
@endif

<form action="{{ url('/verification') }}" method="post">
    @csrf

    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br>

    <label for="code">Google Authenticator Code:</label>
    <input type="text" name="code" id="code" required><br>

    <button type="submit">Verify</button>
</form>
