@extends('layouts.app')

@section('title', 'Candidats pour ' . $jobOffer->title)

@section('content')
<section class="section-box mt-50 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="box-nav-tabs nav-tavs-profile mb-5">
                    <ul class="nav" role="tablist">
                        <li><a class="btn btn-border mb-20" href="{{ route('company.dashboard') }}">← Retour aux Offres</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                <div class="content-single">
                    <h3 class="mt-0 mb-5 color-brand-1">Gestion des candidatures 👥</h3>
                    <p class="text-muted mb-30" style="font-size: 1.1rem;">Poste concerné : <strong class="text-dark">{{ $jobOffer->title }}</strong></p>
                    
                    @if(session('success'))
                        <div class="alert alert-success mt-20 mb-20" style="background: #ecfdf5; border: 1px solid #10b981; color: #047857; padding: 15px; border-radius: 8px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="box-shadow-bdrd-15 box-filters mt-30 p-4" style="border: 1px solid #e2e8f0; border-radius: 12px; background: white;">
                        @if($applications->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Candidat</th>
                                            <th>Message</th>
                                            <th>CV (Lien)</th>
                                            <th>Statut</th>
                                            <th class="text-end">Décision</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($applications as $app)
                                            <tr>
                                                <td>
                                                    <span class="fw-bold d-block text-dark">{{ $app->candidate->name }}</span>
                                                    <a href="mailto:{{ $app->candidate->email }}" class="small text-decoration-none" style="color: #3b82f6;">{{ $app->candidate->email }}</a>
                                                </td>
                                                <td style="max-width: 200px;">
                                                    <div class="text-muted small text-truncate" title="{{ $app->cover_letter }}">
                                                        "{{ $app->cover_letter ?? 'Aucun message.' }}"
                                                    </div>
                                                </td>
                                                <td>
                                                    @if(Str::startsWith($app->resume_path, 'resumes/'))
                                                        <a href="{{ asset('storage/' . $app->resume_path) }}" target="_blank" class="badge" style="background: #eef2ff; color: #4f46e5; padding: 8px 12px;">📎 Voir le CV PDF</a>
                                                    @else
                                                        <a href="{{ $app->resume_path }}" target="_blank" class="badge bg-success" style="padding: 8px 12px;">🔗 Lien externe</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($app->status === 'pending')
                                                        <span class="badge text-dark" style="background: #fef3c7; border: 1px solid #fde68a;">⏳ En attente</span>
                                                    @elseif($app->status === 'accepted')
                                                        <span class="badge text-white bg-success">✅ Acceptée</span>
                                                    @else
                                                        <span class="badge text-white bg-danger">❌ Refusée</span>
                                                    @endif
                                                </td>
                                                <td class="text-end text-nowrap">
                                                    @if($app->status !== 'accepted')
                                                        <form action="{{ route('applications.status', $app->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="accepted">
                                                            <button class="btn btn-sm btn-success p-2">Accepter</button>
                                                        </form>
                                                    @endif
                                                    @if($app->status !== 'rejected')
                                                        <form action="{{ route('applications.status', $app->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button class="btn btn-sm btn-danger p-2">Refuser</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <p class="text-muted fs-5">Aucune candidature reçue pour l'instant.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
