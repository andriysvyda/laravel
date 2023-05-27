@extends('layouts.app')

@section('title', 'Laravel')

@section('header')
    <p>Logo</p>
    <nav>
        <ul>
            <li>
                <a href="{{URL::to('students')}}">
                    Home
                </a>
            </li>
        </ul>
    </nav>
@endsection

@section('footer')
    2023
@endsection