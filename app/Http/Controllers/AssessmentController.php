<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AssessmentController extends Controller
{
    /**
     * Display a listing of assessments.
     */
    // public function index()
    // {
    //     $assessments = Assessment::where('user_id', Auth::id())->get();
    //     return Inertia::render('assessments.index', compact('assessments'));
    // }

    /**
     * Show the form for creating a new assessment.
     */
    // public function create()
    // {
    //     return Inertia('assessments.create');
    // }

    /**
     * Store a newly created assessment in storage.
     */
    public function store(Request $request)
    {
 

        $request->validate([
            'assessment_date' => 'required|date|after_or_equal:today',
            'qualification' => 'required|string|max:255',
            'no_of_pax' => 'required|integer',
            'training_status' => 'required|in:scholar,non-scholar',
            'type_of_scholar' => 'nullable|string|max:255',
            'eltt' => 'required|mimes:pdf',
            'rfftp' => 'required|mimes:pdf',
            'oropfafns' => 'required|mimes:pdf',
            'sopcctvr' => 'required|mimes:pdf',
        ]);

        // If training status is non-scholar, set type_of_scholar to 'NA'
if ($request->training_status == 'non-scholar') {
    $request->merge(['type_of_scholar' => 'N/A']);
}

        // Create a new Assessment instance
        $assessment = new Assessment();
        $assessment->user_id = Auth::id();
        $assessment->assessment_date = $request->assessment_date;
        $assessment->qualification = $request->qualification;
        $assessment->no_of_pax = $request->no_of_pax;
        $assessment->training_status = $request->training_status;
        $assessment->type_of_scholar = $request->type_of_scholar;
        $assessment->status = 'pending';
    

        // Handle file uploads
        if ($request->hasFile('eltt')) {
            $file = $request->file('eltt');
            $filename = time() . '_eltt.' . $file->getClientOriginalExtension();
            $file->move(public_path('eltts'), $filename);
            $assessment->eltt = 'eltts/' . $filename;
        }

        if ($request->hasFile('rfftp')) {
            $file = $request->file('rfftp');
            $filename = time() . '_rfftp.' . $file->getClientOriginalExtension();
            $file->move(public_path('rfftp'), $filename);
            $assessment->rfftp = 'rfftp/' . $filename;
        }

        if ($request->hasFile('oropfafns')) {
            $file = $request->file('oropfafns');
            $filename = time() . '_oropfafns.' . $file->getClientOriginalExtension();
            $file->move(public_path('oropfafns'), $filename);
            $assessment->oropfafns = 'oropfafns/' . $filename;
        }

        if ($request->hasFile('sopcctvr')) {
            $file = $request->file('sopcctvr');
            $filename = time() . '_sopcctvr.' . $file->getClientOriginalExtension();
            $file->move(public_path('sopcctvr'), $filename);
            $assessment->sopcctvr = 'sopcctvr/' . $filename;
        }

        $assessment->save();

        return redirect()->route('dashboard')->with('success', 'Assessment created successfully!');
    }

    /**
     * Display the specified assessment.
     */
    public function show(Assessment $assessment)
    {
        return Inertia('assessments.show', compact('assessment'));
    }

    /**
     * Show the form for editing the specified assessment.
     */
    public function edit(Assessment $assessment)
    {
        return view('assessments.edit', compact('assessment'));
    }

    /**
     * Update the specified assessment in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'assessment_date' => 'required|date|after_or_equal:today',
            'qualification' => 'required|string|max:255',
            'no_of_pax' => 'required|integer',
            'training_status' => 'required|in:scholar,non-scholar',
            'type_of_scholar' => 'nullable|string|max:255',
            'eltt' => 'required|mimes:pdf',
            'rfftp' => 'required|mimes:pdf',
            'oropfafns' => 'required|mimes:pdf',
            'sopcctvr' => 'required|mimes:pdf',
        ]);

                // If training status is non-scholar, set type_of_scholar to 'NA'
if ($request->training_status == 'non-scholar') {
    $request->merge(['type_of_scholar' => 'N/A']);
}

        $assessment = Assessment::findOrFail($id);

        $assessment->assessment_date = $request->assessment_date;
        $assessment->qualification = $request->qualification;
        $assessment->no_of_pax = $request->no_of_pax;
        $assessment->training_status = $request->training_status;
        $assessment->type_of_scholar = $request->type_of_scholar;
	$assessment->update_awareness = now(); // Timestamp for tracking the update

        // Handle file uploads
        if ($request->hasFile('eltt')) {
            $file = $request->file('eltt');
            $filename = time() . '_eltt.' . $file->getClientOriginalExtension();
            $file->move(public_path('eltts'), $filename);
            $assessment->eltt = 'eltts/' . $filename;
        }

        if ($request->hasFile('rfftp')) {
            $file = $request->file('rfftp');
            $filename = time() . '_rfftp.' . $file->getClientOriginalExtension();
            $file->move(public_path('rfftp'), $filename);
            $assessment->rfftp = 'rfftp/' . $filename;
        }

        if ($request->hasFile('oropfafns')) {
            $file = $request->file('oropfafns');
            $filename = time() . '_oropfafns.' . $file->getClientOriginalExtension();
            $file->move(public_path('oropfafns'), $filename);
            $assessment->oropfafns = 'oropfafns/' . $filename;
        }

        if ($request->hasFile('sopcctvr')) {
            $file = $request->file('sopcctvr');
            $filename = time() . '_sopcctvr.' . $file->getClientOriginalExtension();
            $file->move(public_path('sopcctvr'), $filename);
            $assessment->sopcctvr = 'sopcctvr/' . $filename;
        }

        $assessment->save();

        return redirect()->route('dashboard')->with('success', 'Assessment updated successfully!');
    }

    /**
     * Remove the specified assessment from storage.
     */
    public function destroy(Assessment $assessment)
    {
        $assessment->delete();
        return redirect()->route('assessments.index')->with('success', 'Assessment deleted successfully!');
    }
}   
