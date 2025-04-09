<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;
use App\Models\Exercise;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Events\WorkoutRecorded;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'date');
        $direction = $request->get('direction', 'desc');

        $query = Workout::with(['user', 'exercises'])
            ->where('user_id', Auth::id());

        if ($sort === 'name') {
            $query->orderBy('name', $direction);
        } else {
            $query->orderBy('date', $direction);
        }

        $workouts = $query->paginate(5);

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

        $workout = Workout::create([
            'date' => $validatedData['date'],
            'name' => $validatedData['name'] ?? 'Workout on ' . $validatedData['date'],
            'notes' => $validatedData['notes'] ?? null,
            'user_id' => Auth::id(),
        ]);

        foreach ($validatedData['exercises'] as $exerciseData) {
            $workout->exercises()->attach($exerciseData['id'], [
                'sets' => $exerciseData['sets'],
                'repetitions' => $exerciseData['repetitions'],
                'weight' => $exerciseData['weight'],
                'unit' => $exerciseData['unit'],
            ]);
        }

//        event(new WorkoutRecorded($workout, auth()->id()));

//        broadcast(new WorkoutRecorded($workout))->toOthers();

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
        Gate::authorize('update', $workout);

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

//    /**
//    *
//    * @param  \App\Models\Workout  $workout
//    * @return \Illuminate\Http\RedirectResponse
//    */
    public function duplicate(Workout $workout)
    {
        if ($workout->user_id !== Auth::id()) {
            abort(403);
        }

        // Create a new workout with the same details
        $newWorkout = $workout->replicate();
        $newWorkout->name = $workout->name ? $workout->name . ' (Copy)' : null;
        $newWorkout->date = now(); // Set date to today
        $newWorkout->created_at = now();
        $newWorkout->save();

        // Copy all workout exercises with their pivot data
        foreach ($workout->exercises as $exercise) {
            $newWorkout->exercises()->attach($exercise->id, [
                'sets' => $exercise->pivot->sets,
                'repetitions' => $exercise->pivot->repetitions,
                'weight' => $exercise->pivot->weight,
                'unit' => $exercise->pivot->unit
            ]);
        }

        return redirect('/workouts/' . $newWorkout->id)
            ->with('success', 'Workout duplicated successfully.');
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
