@extends('layouts.app')
@section('title', 'Edit Course')
@section('content')
<form action="{{ route('courses.update', $course->id) }}" method="POST">
    @method('PUT')
    @include('course._form')
    <button type="submit">Update Course</button>
</form>
<p><a href="{{ route('courses.index') }}">Back to Courses</a></p>
@endsection
