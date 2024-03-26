<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255|unique:projects', // Aggiunto 'unique:projects'
    ]);

    $formData = $request->all();

    // Genera lo slug basato sul titolo
    $slug = Str::slug($formData['title']);

    // Aggiungi lo slug ai dati del modulo
    $formData['slug'] = $slug;

    // Verifica se esiste già un progetto con lo stesso titolo
    if (Project::where('title', $formData['title'])->exists()) {
        // Gestisci il caso in cui esiste già un progetto con lo stesso titolo
        return redirect()->back()->withErrors(['title' => 'Il titolo del progetto deve essere unico.']);
    }

    $newProject = new Project();
    $newProject->fill($formData);
    $newProject->save();

    $projects = Project::all();

    return view('projects.index', compact('projects'));
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);
        // findOrFail
        return view ('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);
        return view ('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $formData = $request->All();
        $project = Project::find($id);
        $project->update($formData);
        return redirect()->route('dashboard.projects.index', ['project'=> $project->id]);
    }


    public function destroy(string $id)
{
    $project = Project::find($id);

    // Verifica se l'oggetto è stato trovato prima di tentare la cancellazione
    if ($project) {
        $project->delete();
        return redirect()->route('dashboard.projects.index');
    } else {
        // Gestisci il caso in cui l'oggetto non è stato trovato nel database
        return redirect()->route('dashboard.projects.index')->with('error', 'Project not found.');
    }
}
}
