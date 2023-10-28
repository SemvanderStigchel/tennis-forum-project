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
        $tags = Tag::all();
        $filters = [];
        $exercises = Exercise::with('tags')->get();
        return view('exercises', compact('exercises', 'tags', 'filters'));
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
            $exercise->forceDelete();
        }
        return redirect()->route('exercises.index');
    }

    public function showAdmin()
    {
        $exercises = Exercise::with('user')->withTrashed()->get();
        return view('exercises-admin', compact('exercises'));
    }

    public function softDeleteOrRestore(int $id, Request $request)
    {
        $exercise = Exercise::withTrashed()->find($id);
        if ($exercise->trashed()) {
            $exercise->restore();
            return redirect(route('show-admin'));
        } else {
            $exercise->delete();
            return redirect(route('show-admin'));
        }
    }

    public function search(Request $request)
    {
        $tags = Tag::all();
        $request->validate([
            'search' => 'max:255',
            'filters' => 'exists:tags,id'
        ]);
        $filters = $request->input('filters');

        if (collect($filters)->count() === 0) {
            $exercises = Exercise::where('title', 'LIKE', '%' . $request->input('search') . '%')
                ->orWhere('subtitle', 'LIKE', '%' . $request->input('search') . '%')->get();
            return view('exercises', compact('exercises', 'tags', 'filters'));
        } elseif ($request->input('search') === null) {
            $exercises = Exercise::whereHas('tags', function ($query) use ($filters) {
                $query->whereIn('tag_id', $filters);
            })->get();
            return view('exercises', compact('exercises', 'tags', 'filters'));
        } else {
            $exercises = Exercise::whereHas('tags', function ($query) use ($filters) {
                $query->whereIn('tag_id', $filters);
            });

            $exercises->where('title', 'LIKE', '%' . $request->input('search') . '%')
                ->orWhere('subtitle', 'LIKE', '%' . $request->input('search') . '%')
                ->get();
            return view('exercises', compact('exercises', 'tags', 'filters'));
        }
    }

    public function notEnoughExercises()
    {
        return view('not-enough-exercises');
    }
}
