<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div>
            <label for="login">login :</label>
            <input type="text" name="login" id="login" required>
            @error('login')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password">password :</label>
            <input type="password" name="password" id="password" required>
        </div>
        <input type="submit" value="login">
    </form>
</body>
</html>