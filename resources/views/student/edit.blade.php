@extends('layouts.app')
@section('title', 'Edit Student')
@section('content')
<form action="{{ route('students.update', $student->id) }}" method="POST">
    @method('PUT')
    @include('student._form')
    <button type="submit">Update Student</button>
</form>
<p><a href="{{ route('students.index') }}">Back to Students</a></p>
@endsection
