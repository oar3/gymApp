<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;
use App\Models\Exercise;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{
    public function index()
    {
        $workouts = Workout::with(['user', 'exercises'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(5);

        return view('workouts.index', [
            'workouts' => $workouts
        ]);
    }

    public function create()
    {
        $exercises = Exercise::getAllExercises();

        return view('workouts.create', [
            'exercises' => $exercises
        ]);
    }

    public function show(Workout $workout)
    {
        $workout->load('exercises');

        return view('workouts.show', [
            'workout' => $workout
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->getValidatedData($request);

        // Create the workout
        $workout = Workout::create([
            'date' => $validatedData['date'],
            'name' => $validatedData['name'] ?? 'Workout on ' . $validatedData['date'],
            'notes' => $validatedData['notes'] ?? null,
            'user_id' => Auth::id(),
        ]);

        // Attach the exercises with their pivot data
        foreach ($validatedData['exercises'] as $exerciseData) {
            $workout->exercises()->attach($exerciseData['id'], [
                'sets' => $exerciseData['sets'],
                'repetitions' => $exerciseData['repetitions'],
                'weight' => $exerciseData['weight'],
                'unit' => $exerciseData['unit'],
            ]);
        }

        return redirect()->route('workouts.show', $workout)
            ->with('success', 'Workout created successfully!');
    }

    public function edit(Workout $workout)
    {
        Gate::authorize('edit', $workout);

        $allExercises = Exercise::orderBy('name')->get();

        $workout->load('exercises');

        return view('workouts.edit', [
            'workout' => $workout,
            'allExercises' => $allExercises
        ]);
    }

    public function update(Request $request, Workout $workout)
    {
        Gate::authorize('edit', $workout);

        $validatedData = $this->getValidatedData($request);

        $workout->update([
            'date' => $validatedData['date'],
            'name' => $validatedData['name'] ?? 'Workout on ' . $validatedData['date'],
            'notes' => $validatedData['notes'] ?? null,
        ]);

        $syncData = [];
        foreach ($validatedData['exercises'] as $exerciseData) {
            $syncData[$exerciseData['id']] = [
                'sets' => $exerciseData['sets'],
                'repetitions' => $exerciseData['repetitions'],
                'weight' => $exerciseData['weight'],
                'unit' => $exerciseData['unit'],
            ];
        }

        $workout->exercises()->sync($syncData);

        return redirect()->route('workouts.show', $workout)
            ->with('success', 'Workout updated successfully!');
    }

    public function destroy(Workout $workout)
    {
        Gate::authorize('edit', $workout);

        $workout->delete();

        return redirect()->route('workouts.index')
            ->with('success', 'Workout deleted successfully.');
    }

    /**
     * @param  Request  $request
     * @return array
     */
    public function getValidatedData(Request $request): array
    {
        return $request->validate([
            'date' => ['required', 'date'],
            'name' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'exercises' => ['required', 'array', 'min:1'],
            'exercises.*.id' => ['required', 'integer', 'exists:exercises,id'],
            'exercises.*.sets' => ['required', 'integer', 'min:1'],
            'exercises.*.repetitions' => ['required', 'integer', 'min:1'],
            'exercises.*.weight' => ['required', 'numeric', 'min:0'],
            'exercises.*.unit' => ['required', 'in:KGs,LBs'],
        ]);
    }
}
