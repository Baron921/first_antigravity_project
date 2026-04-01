@extends('layouts.app')

@section('title', 'Mes Candidatures')

@section('content')
<section class="section-box mt-50 mb-50">
    <div class="container">
        <div class="row w-100 m-0">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-50">
                <div class="content-single">
                    <h3 class="mt-0 mb-15 color-brand-1">Vos Candidatures 📂</h3>
                    <p class="font-lg color-text-paragraph-2">Suivez l'état de l'ensemble de vos demandes d'emploi envoyées.</p>

                    @if(session('success'))
                        <div class="alert alert-success mt-20 mb-20" style="background: #ecfdf5; border: 1px solid #10b981; color: #047857; padding: 15px; border-radius: 8px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="box-shadow-bdrd-15 box-filters mt-40 p-4" style="border: 1px solid #e2e8f0; border-radius: 12px; background: white;">
                        @if($applications->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-striped align-middle text-start">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Poste ciblé</th>
                                            <th>Entreprise</th>
                                            <th>Statut de votre demande</th>
                                            <th>Date d'envoi</th>
                                            <th class="text-end">Rappel d'offre</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($applications as $app)
                                            <tr>
                                                <td class="fw-bold text-dark">{{ $app->jobOffer->title }}</td>
                                                <td class="text-muted">🏢 {{ $app->jobOffer->company->company_name ?? $app->jobOffer->company->name }}</td>
                                                <td>
                                                    @if($app->status === 'pending')
                                                        <span class="badge" style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; padding: 6px 10px;">En attente ⏳</span>
                                                    @elseif($app->status === 'accepted')
                                                        <span class="badge" style="background: #d1fae5; color: #047857; border: 1px solid #a7f3d0; padding: 6px 10px;">Acceptée 🎉</span>
                                                    @else
                                                        <span class="badge" style="background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; padding: 6px 10px;">Refusée ❌</span>
                                                    @endif
                                                </td>
                                                <td class="text-muted">{{ $app->created_at->format('d/m/Y') }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('jobs.show', $app->jobOffer->id) }}" class="btn btn-sm btn-default" style="padding: 5px 15px;">📄 Revoir</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <p class="text-muted fs-5 mb-4">Vous n'avez soumis aucune candidature jusqu'à présent.</p>
                                <a href="{{ route('home') }}" class="btn btn-brand-1 hover-up">
                                    Explorer les offres d'emploi 🚀
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
