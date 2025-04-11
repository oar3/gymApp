<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
//    public function index()
//    {
//        $exercisesByGroup = Exercise::orderBy('muscle_group')
//            ->orderBy('name')
//            ->get()
//            ->groupBy('muscle_group');
//
//        return view('exercises.index', [
//            'exercisesByGroup' => $exercisesByGroup
//        ]);
//    }
    /**
     * Display a listing of the exercises.
     * @param  Request  $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        if ($request->has('user_id') && $request->user_id) {
            if (!auth()->user() || !auth()->user()->is_admin) {
                abort(403, 'Unauthorized action.');
            }

            $user = User::find($request->user_id);
            if (!$user) {
                return redirect()->route('exercises.index')
                    ->with('error', 'Selected user does not exist.');
            }
        }

        return view('exercises.index');
    }

    public function create()
    {
        $muscleGroups = \App\Models\MuscleGroup::orderByRaw('user_id IS NULL DESC, name ASC')->get();

        return view('exercises.create', [
            'muscleGroups' => $muscleGroups,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:exercises,name',
            'muscle_group_option' => 'required|in:existing,new',
            'muscle_group' => 'required_if:muscle_group_option,existing',
            'new_muscle_group' => 'required_if:muscle_group_option,new|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->muscle_group_option === 'new') {
            $muscleGroup = \App\Models\MuscleGroup::firstOrCreate(
                ['name' => $request->new_muscle_group, 'user_id' => auth()->id()],
                ['created_at' => now(), 'updated_at' => now()]
            );
        } else {
            $muscleGroup = \App\Models\MuscleGroup::findOrFail($request->muscle_group);
        }

        \App\Models\Exercise::create([
            'name' => $validated['name'],
            'muscle_group' => $muscleGroup->name,
            'muscle_group_id' => $muscleGroup->id,
            'description' => $request->description,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('exercises.index')
            ->with('success', 'Exercise created successfully!');
    }

    public function edit(Exercise $exercise)
    {
        Gate::authorize('edit', $exercise);

        $muscleGroups = Exercise::select('muscle_group')
            ->distinct()
            ->orderBy('muscle_group')
            ->pluck('muscle_group');

        return view('exercises.edit', [
            'exercise' => $exercise,
            'muscleGroups' => $muscleGroups
        ]);
    }

    public function update(Request $request, Exercise $exercise)
    {
        Gate::authorize('update', $exercise);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:exercises,name,' . $exercise->id,
            'muscle_group' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->muscle_group === 'other' && $request->new_muscle_group) {
            $muscleGroup = $request->new_muscle_group;
        } else {
            $muscleGroup = $request->muscle_group;
        }

        $exercise->update([
            'name' => $validated['name'],
            'muscle_group' => $muscleGroup,
            'description' => $request->description
        ]);

        return redirect()->route('exercises.index')
            ->with('success', 'Exercise updated successfully!');
    }

    public function destroy(Exercise $exercise)
    {
        Gate::authorize('delete', $exercise);

        if ($exercise->workouts()->count() > 0) {
            return redirect()->route('exercises.index')
                ->with('error', 'Cannot delete exercise as it is currently used in workouts.');
        }

        $exercise->delete();

        return redirect()->route('exercises.index')
            ->with('success', 'Exercise deleted successfully!');
    }
}
