<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercisesByGroup = Exercise::orderBy('muscle_group')
            ->orderBy('name')
            ->get()
            ->groupBy('muscle_group');

        return view('exercises.index', [
            'exercisesByGroup' => $exercisesByGroup
        ]);
    }

    public function create()
    {
        $muscleGroups = Exercise::select('muscle_group')
            ->distinct()
            ->orderBy('muscle_group')
            ->pluck('muscle_group');

        return view('exercises.create', [
            'muscleGroups' => $muscleGroups
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:exercises,name',
            'muscle_group' => 'required|string|max:255',
            'description' => 'nullable|string',
            'new_muscle_group' => 'required_if:muscle_group,other|string|max:255'
        ]);

        if ($request->muscle_group === 'other' && $request->new_muscle_group) {
            $muscleGroup = $request->new_muscle_group;
        } else {
            $muscleGroup = $request->muscle_group;
        }

        Exercise::create([
            'name' => $validated['name'],
            'muscle_group' => $muscleGroup,
            'description' => $request->description,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('exercises.index')
            ->with('success', 'Exercise created successfully!');
    }

    public function edit(Exercise $exercise)
    {
        $this->authorize('update', $exercise);

        $muscleGroups = Exercise::select('muscle_group')
            ->distinct()
            ->orderBy('muscle_group')
            ->pluck('muscle_group');

        return view('exercises.edit', [
            'exercise' => $exercise,
            'muscleGroups' => $muscleGroups
        ]);
    }

    /**
     * Update the specified exercise in storage.
     */
    public function update(Request $request, Exercise $exercise)
    {
        $this->authorize('update', $exercise);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:exercises,name,' . $exercise->id,
            'muscle_group' => 'required|string|max:255',
            'description' => 'nullable|string',
            'new_muscle_group' => 'required_if:muscle_group,other|string|max:255',
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
        $this->authorize('delete', $exercise);

        if ($exercise->workouts()->count() > 0) {
            return redirect()->route('exercises.index')
                ->with('error', 'Cannot delete exercise as it is currently used in workouts.');
        }

        $exercise->delete();

        return redirect()->route('exercises.index')
            ->with('success', 'Exercise deleted successfully!');
    }
}
