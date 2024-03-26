@extends('layouts.app')

@section('title', ' show')

@section('content')

<main>
    <h2>{{$project->title}}</h2>
    {{($project->description)}}
</main>

@endsection
