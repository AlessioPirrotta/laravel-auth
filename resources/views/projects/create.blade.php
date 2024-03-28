@extends('layouts.app')

@section('title', ' | Create')

@section('content')

    <h1>Create new Project</h1>

    <form action="{{ route('dashboard.projects.store')}}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Example label</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="New title: max 4 words">
        </div>

        <div class="form-group">
          <label for="img"></label>
          <input type="file" class="form-control" name="img" id="img" aria-describedby="helpId" placeholder="">

        </div>


        <div class="mb-3">
            <label for="description" class="form-label">Example textarea</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Insert a description"></textarea>
          </div>

        <div class="mb-3">
            <label for="software" class="form-label">Example label</label>
            <input type="text" class="form-control" id="software" name="software" placeholder="New title: max 4 words">
        </div>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded " type="submit">Create project</button>
    </form>
@endsection
