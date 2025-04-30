<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TemplateController extends Controller
{
    /**
     * Display a listing of the templates.
     */
    public function index()
    {
        $templates = Template::where('user_id', Auth::id())
            ->with('exercises')
            ->orderBy('name')
            ->paginate(10);

        return view('templates.index', [
            'templates' => $templates
        ]);
    }

    /**
     * Show the form for creating a new template.
     */
    public function create()
    {
        $exercises = Exercise::getAllExercises();

        return view('templates.create', [
            'exercises' => $exercises
        ]);
    }

    /**
     * Store a newly created template in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->getValidatedData($request);

        $template = Template::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
            'user_id' => Auth::id(),
        ]);

        foreach ($validatedData['exercises'] as $exerciseData) {
            $template->exercises()->attach($exerciseData['id'], [
                'sets' => $exerciseData['sets'],
                'repetitions' => $exerciseData['repetitions'],
                'weight' => $exerciseData['weight'],
                'unit' => $exerciseData['unit'],
            ]);
        }

        return redirect()->route('templates.show', $template)
            ->with('success', 'Template created successfully!');
    }

    /**
     * Display the specified template.
     */
    public function show(Template $template)
    {
        if ($template->user_id !== Auth::id()) {
            abort(403);
        }

        $template->load('exercises');

        return view('templates.show', [
            'template' => $template
        ]);
    }

    /**
     * Show the form for editing the specified template.
     */
    public function edit(Template $template)
    {
        if ($template->user_id !== Auth::id()) {
            abort(403);
        }

        $allExercises = Exercise::orderBy('name')->get();
        $template->load('exercises');

        return view('templates.edit', [
            'template' => $template,
            'allExercises' => $allExercises
        ]);
    }

    /**
     * Update the specified template in storage.
     */
    public function update(Request $request, Template $template)
    {
        if ($template->user_id !== Auth::id()) {
            abort(403);
        }

        $validatedData = $this->getValidatedData($request);

        $template->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
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

        $template->exercises()->sync($syncData);

        return redirect()->route('templates.show', $template)
            ->with('success', 'Template updated successfully!');
    }

    /**
     * Remove the specified template from storage.
     */
    public function destroy(Template $template)
    {
        if ($template->user_id !== Auth::id()) {
            abort(403);
        }

        $template->delete();

        return redirect()->route('templates.index')
            ->with('success', 'Template deleted successfully.');
    }

    /**
     * Create a new workout from a template.
     */
    public function createWorkout(Template $template)
    {
        if ($template->user_id !== Auth::id()) {
            abort(403);
        }

        return view('workouts.create-from-template', [
            'template' => $template->load('exercises')
        ]);
    }

    /**
     * Validate the request data.
     */
    protected function getValidatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'exercises' => ['required', 'array', 'min:1'],
            'exercises.*.id' => ['required', 'integer', 'exists:exercises,id'],
            'exercises.*.sets' => ['required', 'integer', 'min:1'],
            'exercises.*.repetitions' => ['required', 'integer', 'min:1'],
            'exercises.*.weight' => ['required', 'numeric', 'min:0'],
            'exercises.*.unit' => ['required', 'in:KGs,LBs'],
        ]);
    }
}
