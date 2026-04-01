<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with('jobOffer.company')
                            ->where('user_id', Auth::id())
                            ->latest()
                            ->get();
                            
        return view('candidate.applications', compact('applications'));
    }

    public function store(Request $request, JobOffer $jobOffer)
    {
        $validated = $request->validate([
            'cover_letter' => 'nullable|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // Max 5MB
        ]);

        if (Application::where('job_offer_id', $jobOffer->id)->where('user_id', Auth::id())->exists()) {
            return back()->withErrors(['Vous avez déjà postulé à cette offre.']);
        }

        $resumePath = $request->file('resume')->store('resumes', 'public');

        Application::create([
            'job_offer_id' => $jobOffer->id,
            'user_id' => Auth::id(),
            'cover_letter' => $validated['cover_letter'],
            'resume_path' => $resumePath,
            'status' => 'pending',
        ]);

        return redirect()->route('candidate.applications')->with('success', 'Félicitations, votre candidature avec CV a bien été envoyée !');
    }

    public function companyApplications(JobOffer $jobOffer)
    {
        if ($jobOffer->user_id !== Auth::id()) {
            abort(403);
        }

        $applications = $jobOffer->applications()->with('candidate')->latest()->get();
        return view('company.applications', compact('jobOffer', 'applications'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        if ($application->jobOffer->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,rejected'
        ]);

        $application->update(['status' => $validated['status']]);

        return back()->with('success', 'Statut de la candidature mis à jour.');
    }
}
