@extends('layouts.students')

@section('content')
    <h1>Students of </h1>

    @forelse($students as $student)
        <article>
            <h3>
                {{$student->name}}
            </h3>
            <p>Course: {{$student->course}}</p>
            <p>Speciality: {{$student->speciality}}</p>
        </article>
    @empty
        <p>
            No employees
        </p>
    @endforelse

@endsection