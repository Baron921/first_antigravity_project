@extends('layouts.app')

@section('title', 'Tableau de bord Entreprise')

@section('content')
<section class="section-box mt-50 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="box-nav-tabs nav-tavs-profile mb-5">
                    <ul class="nav" role="tablist">
                        <li><a class="btn btn-border mb-20 active" href="{{ route('company.dashboard') }}">Vos Offres ({{ $jobs->count() }})</a></li>
                        <li><a class="btn btn-border mb-20" href="{{ route('company.jobs.create') }}">Publier une offre</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                <div class="content-single">
                    <h3 class="mt-0 mb-15 color-brand-1">Vos offres d'emploi 🏢</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success mt-20 mb-20" style="background: #ecfdf5; border: 1px solid #10b981; color: #047857; padding: 15px; border-radius: 8px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Version Table Responsive (JobBox style) -->
                    <div class="box-shadow-bdrd-15 box-filters mt-30 p-4" style="border: 1px solid #e2e8f0; border-radius: 12px; background: white;">
                        @if($jobs->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-striped align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Titre du poste</th>
                                            <th>Lieu</th>
                                            <th>Candidatures</th>
                                            <th>Date de publication</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jobs as $job)
                                            <tr>
                                                <td class="fw-bold" style="color: #1e293b;">{{ $job->title }}</td>
                                                <td class="text-muted">{{ $job->location ?? 'Non spécifié' }}</td>
                                                <td>
                                                    <a href="{{ route('company.jobs.applications', $job->id) }}" style="text-decoration: none;">
                                                        <span class="badge" style="background: #eef2ff; color: #4f46e5; padding: 8px 12px; font-weight: 600;">{{ $job->applications->count() }} candidatures 👀</span>
                                                    </a>
                                                </td>
                                                <td class="text-muted">{{ $job->created_at->format('d/m/Y') }}</td>
                                                <td class="text-end text-nowrap">
                                                    <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-sm" style="background: #f1f5f9; color: #475569; margin-right: 5px;">Voir l'offre</a>
                                                    
                                                    <form action="{{ route('company.jobs.destroy', $job->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm" style="background: #fee2e2; color: #ef4444;" onclick="return confirm('La supprimer définitivement ?')">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <p class="text-muted fs-5">Vous n'avez pas encore publié d'offres.</p>
                                <a href="{{ route('company.jobs.create') }}" class="btn btn-default mt-15">Publier votre première offre</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
