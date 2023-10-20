<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Tag;
use App\Models\User;
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
            'subtitle' => 'required|max:255',
            'description' => 'required',
            'tags' => 'required|exists:tags,id|min:1'
        ]);

        $exercise = new Exercise();
        $exercise->title = $request->input('title');
        $exercise->subtitle = $request->input('subtitle');
        $exercise->description = $request->input('description');
        $exercise->user_id = \Auth::user()->id;


        if ($exercise->save()) {
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
        if (\Auth::user()->id === $exercise->user_id) {
            $tags = Tag::all();
            return view('edit', compact('exercise'), compact('tags'));
        }

        return redirect()->route('exercises.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exercise $exercise)
    {
        $request->validate([
            'title' => 'required|max:50',
            'subtitle' => 'required|max:255',
            'description' => 'required',
            'tags' => 'required|exists:tags,id|min:1'
        ]);

        $exercise->title = $request->input('title');
        $exercise->subtitle = $request->input('subtitle');
        $exercise->description = $request->input('description');

        if ($exercise->save()) {
            $exercise->tags()->detach();
            $exercise->tags()->attach($request->input('tags'));
        }

        return redirect()->route('exercises.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        if (\Auth::user()->id === $exercise->user_id) {
            $exercise->tags()->detach();
            Exercise::where('id', $exercise->id)->forceDelete();
        }
        return redirect()->route('exercises.index');
    }

    public function showAdmin ()
    {
        if (\Auth::user()->role === 2)
        {
            $exercises = Exercise::with('user')->withTrashed()->get();
            return view('exercises-admin', compact('exercises'));
        }
        return view('home');
    }

    public function softDeleteOrRestore(Exercise $exercise, Request $request)
    {
        if (\Auth::user()->role === 2)
        {
            if ($request->input('on') === 1) {
                $exercise->restore();
                return redirect(route('show-admin'));
            } elseif ($request->input('on') === null) {
                Exercise::where('id', $exercise->id)->delete();
                return redirect(route('show-admin'));
            }
        }
        return view('home');
    }
}
