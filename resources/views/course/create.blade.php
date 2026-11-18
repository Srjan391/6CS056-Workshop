@extends('layouts.app')
@section('title', 'Create Course')
@section('content')
<form action="{{ route('courses.store') }}" method="POST">
    @include('course._form')
    <button type="submit">Create Course</button>
</form>
<p><a href="{{ route('courses.index') }}">Back to Courses</a></p>
@endsection
