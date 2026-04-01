<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    public function index()
    {
        $jobs = JobOffer::with('company')->where('is_active', true)->latest()->paginate(9);
        return view('jobs.index', compact('jobs'));
    }

    public function show(JobOffer $jobOffer)
    {
        return view('jobs.show', compact('jobOffer'));
    }

    public function companyDashboard()
    {
        $companyId = auth()->id();
        $jobs = JobOffer::where('user_id', $companyId)->latest()->get();
        return view('company.dashboard', compact('jobs'));
    }

    public function create()
    {
        return view('company.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'description' => 'required|string',
        ]);

        JobOffer::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'location' => $validated['location'],
            'salary' => $validated['salary'],
            'description' => $validated['description'],
            'is_active' => true,
        ]);

        return redirect()->route('company.dashboard')->with('success', 'Votre offre a été publiée avec succès !');
    }

    public function edit(JobOffer $jobOffer) {}
    public function update(Request $request, JobOffer $jobOffer) {}
    
    public function destroy(JobOffer $jobOffer)
    {
        if ($jobOffer->user_id !== auth()->id()) {
            abort(403, 'Action non autorisée.');
        }

        $jobOffer->delete();
        return redirect()->route('company.dashboard')->with('success', 'Offre supprimée avec succès.');
    }
}
