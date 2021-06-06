<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portal</title>
</head>
<body>
    @foreach (Auth::user()->applications as $application)
    <form action="{{ url('/applications/' . $application->id . '/login') }}" method="POST">
        @csrf
        <input type="submit" value="{{ $application->label }}">
    </form>
    @endforeach
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <input type="submit" value="logout">
    </form>
</body>
</html>