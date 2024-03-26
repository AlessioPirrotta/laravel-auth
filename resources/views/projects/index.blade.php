@extends('layouts.app')

@section('title', ' | Index')

@section('content')
    <h1 class=" text-red-700 font-bold pb-4 text-2xl">Project list</h1>

    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ route('dashboard.projects.create') }}">Create new project</a>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Image</th>
            <th scope="col" class="col-xs-1 col-md-3 col-lg-5 ">Description</th>
            <th scope="col">Software</th>
            <th scope="col" class="col-lg-2">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                <th scope="row">{{ $project->id }}</th>
                <td><a href="{{ route('dashboard.projects.show', ['project' => $project['id']]) }}">{{ $project->title }}</a></td>
                <td>{{ $project->slug }}</td>
                <td>{{ $project->img }}</td>
                <td>{{ $project->description }}</td>
                <td>{{ $project->software }}</td>
                <td>
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ route('dashboard.projects.edit', $project->id)}}">Edit </a>
                    <form action="{{ route('dashboard.projects.destroy', $project->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete </button>
                    </form>
                </td>
                </tr>
            @endforeach

        </tbody>
      </table>
@endsection
