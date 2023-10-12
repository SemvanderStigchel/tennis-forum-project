<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Tag;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $exercises = Exercise::with('tags')->get();
        return view('exercises', compact('exercises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required',
            'tags' => 'required|exists:tags,id|min:1'
        ]);

        $exercise = new Exercise();
        $exercise->title = $request->input('title');
        $exercise->description = $request->input('description');
        $exercise->user_id = \Auth::user()->id;


        if ($exercise->save())
        {
            $exercise->tags()->attach($request->input('tags'));
        }

        return redirect()->route('exercises.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise)
    {
        return view('exercise', compact('exercise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exercise $exercise)
    {
        $tags = Tag::all();
        return view('edit', compact('exercise'), compact('tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exercise $exercise)
    {
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required',
            'tags' => 'required|exists:tags,id|min:1'
        ]);

        $exercise->title = $request->input('title');
        $exercise->description = $request->input('description');

        if ($exercise->save())
        {
            $exercise->tags()->attach($request->input('tags'));
        }

        return redirect()->route('exercises.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {

    }
}
