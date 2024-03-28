@extends('layouts.app')

@section('title', ' show')

@section('content')

<main>
    <h2 class="text-4xl">{{$project->title}}</h2>
    <img class="w-80" src="{{ asset ('/storage/' . $project-> img)}}" alt="">
    <h3 class="text-2xl">{{($project->description)}}</h3>
</main>

@endsection
