<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Training Institute</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 960px; margin: 0 auto; padding: 1rem; line-height: 1.5; }
        nav a { margin-right: 1rem; }
        .success { background: #e6f7e9; border: 1px solid #2e9e4f; padding: .5rem 1rem; }
        .errors { background: #fdeaea; border: 1px solid #c33; padding: .5rem 1rem; }
        .field { margin-bottom: 1rem; }
        label { display: block; font-weight: 600; }
        input[type=text], input[type=email], input[type=date], input[type=number], select, textarea { width: 100%; max-width: 28rem; padding: .4rem; box-sizing: border-box; }
        .table-wrap { overflow-x: auto; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: .5rem; text-align: left; }
    </style>
</head>
<body>
<nav>
    <a href="{{ route('students.index') }}">Students</a>
    <a href="{{ route('courses.index') }}">Courses</a>
</nav>
<hr>
<h1>@yield('title')</h1>

@if(session('success'))
    <p class="success" role="status">{{ session('success') }}</p>
@endif

@if($errors->any())
    <div class="errors" role="alert">
        <h3>Please fix the following errors:</h3>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@yield('content')
</body>
</html>
