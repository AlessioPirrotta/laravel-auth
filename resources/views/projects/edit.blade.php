@extends('layouts.app')

@section('title', ' | Edit')

@section('content')

<main>
    <h2 class=" text-red-700 font-bold pb-4 text-2xl">Edita Fumetto</h2>
    <div class="container">
        <form action="{{ route('dashboard.projects.update', $project->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="New title: max 4 words" value="{{old('title', $project->title)}}">
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Image</label>
                <input type="file" class="form-control" id="img" name="img" placeholder="Image URL" value="{{old('img', $project->img)}}">
            </div>

            <div class="mb-3 flex items-center">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Insert a description">{{old('description', $project->description)}}</textarea>
              </div>

            <div class="mb-3">
                <label for="software" class="form-label">Softwares utilised</label>
                <input type="text" class="form-control" id="software" name="software" placeholder="New title: max 4 words" value="{{old('software', $project->software)}}">
            </div>

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Save changes</button>
        </form>

    </div>
</main>

@endsection
