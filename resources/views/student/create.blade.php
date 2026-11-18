@extends('layouts.app')
@section('title', 'Create Student')
@section('content')
<form action="{{ route('students.store') }}" method="POST">
    @include('student._form')
    <button type="submit">Create Student</button>
</form>
<p><a href="{{ route('students.index') }}">Back to Students</a></p>
@endsection
