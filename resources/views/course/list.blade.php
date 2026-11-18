@extends('layouts.app')
@section('title', 'Courses')
@section('content')
<p><a href="{{ route('courses.create') }}">Create Course</a></p>
<div class="table-wrap">
<table>
    <thead>
        <tr><th>ID</th><th>Name</th><th>Duration</th><th>Fee</th><th>Difficulty</th><th>Active</th><th>Actions</th></tr>
    </thead>
    <tbody>
    @forelse($courses as $course)
        <tr>
            <td>{{ $course->id }}</td>
            <td>{{ $course->name }}</td>
            <td>{{ $course->duration }} weeks</td>
            <td>{{ $course->fee }}</td>
            <td>{{ $course->difficulty }}</td>
            <td>{{ $course->is_active ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('courses.show', $course->id) }}">View</a>
                <a href="{{ route('courses.edit', $course->id) }}">Edit</a>
                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline"
                      onsubmit="return confirm('Delete this course?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="7">No courses found.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
@endsection
