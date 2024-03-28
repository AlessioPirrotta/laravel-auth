<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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


public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255|unique:projects',
        'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $formData = $request->all();

    // Genera lo slug basato sul titolo
    $slug = Str::slug($formData['title']);

    // Assegna lo slug ai dati del modulo
    $formData['slug'] = $slug;

    if ($request->hasFile('img')) {
        // Salva il file e ottieni il percorso
        $img_path = $request->file('img')->store('project_images', 'public');
        $formData['img'] = $img_path;
    }

    $newProject = Project::create($formData);

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
        $formData = $request->all();
        $project = Project::find($id);

        // Aggiorna il progetto con i dati dal modulo
        $project->update($formData);

        if ($request->hasFile('img')) {
            // Elimina l'immagine precedente se presente
            if ($project->img) {
                Storage::delete($project->img);
            }

            // Carica la nuova immagine e ottieni il percorso
            $img_path = $request->file('img')->store('project_images', 'public');

            // Aggiorna il percorso dell'immagine nel modello
            $project->img = $img_path;

            // Salva il progetto aggiornato
            $project->save();
        }
        return redirect()->route('dashboard.projects.index')->with('success', 'Project updated successfully.');
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
