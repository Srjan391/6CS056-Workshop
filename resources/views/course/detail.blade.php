@extends('layouts.app')
@section('title', 'Course Details')
@section('content')
<p><strong>ID:</strong> {{ $course->id }}</p>
<p><strong>Name:</strong> {{ $course->name }}</p>
<p><strong>Description:</strong> {{ $course->description }}</p>
<p><strong>Duration:</strong> {{ $course->duration }} weeks</p>
<p><strong>Fee:</strong> {{ $course->fee }}</p>
<p><strong>Difficulty:</strong> {{ $course->difficulty }}</p>
<p><strong>Active:</strong> {{ $course->is_active ? 'Yes' : 'No' }}</p>
<p><strong>Created:</strong> {{ $course->created_at }}</p>
<p><strong>Updated:</strong> {{ $course->updated_at }}</p>
<a href="{{ route('courses.edit', $course->id) }}">Edit Course</a>
<br>
<a href="{{ route('courses.index') }}">Back to Courses</a>
@endsection
