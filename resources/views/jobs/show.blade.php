@extends('layouts.app')

@section('title', $jobOffer->title)

@section('content')
<section class="section-box mt-50">
    <div class="container">
        <!-- En-tête du Job : Banner Entreprise (Cover) -->
        <div class="job-header" style="background: url('{{ asset('assets/imgs/hero.png') }}') no-repeat center bottom; background-size: cover; border-radius: 12px; height: 180px; position: relative; margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; display: flex; align-items: flex-end;">
            <div style="background: rgba(0,0,0,0.5); position: absolute; top:0; left:0; right:0; bottom:0; border-radius: 12px;"></div>
            <div class="p-4" style="position: relative; z-index: 2; width: 100%; display: flex; justify-content: space-between; align-items: flex-end; padding: 30px;">
                <div style="display: flex; gap: 20px; align-items: center;">
                    <div style="width: 80px; height: 80px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; color: #3b82f6; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        {{ substr($jobOffer->company->company_name ?? $jobOffer->company->name, 0, 1) }}
                    </div>
                    <div>
                        <h1 style="color: white; font-size: 2.2rem; font-weight: 800; margin: 0;">{{ $jobOffer->title }}</h1>
                        <span style="color: #e2e8f0; font-size: 1rem;">
                            {{ $jobOffer->company->company_name ?? $jobOffer->company->name }} • {{ $jobOffer->location ?? 'Non spécifié' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Sidebar: Information & Apply Button -->
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 mb-30" style="order: 2;">
                <div class="sidebar-border" style="border: 1px solid #e2e8f0; padding: 30px; border-radius: 12px; background: #f8fafc; position: sticky; top: 100px;">
                    <h5 class="font-bold mb-20" style="font-size: 1.25rem; font-weight: 700; color: #1e293b;">Aperçu du poste</h5>
                    <ul class="list-info" style="list-style: none; padding: 0; margin-bottom: 30px;">
                        <li style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px; color: #64748b;">
                            <strong style="color: #1e293b; min-width: 80px;">Publié :</strong> {{ $jobOffer->created_at->format('d/m/Y') }}
                        </li>
                        <li style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px; color: #64748b;">
                            <strong style="color: #1e293b; min-width: 80px;">Lieu :</strong> {{ $jobOffer->location ?? 'Remote' }}
                        </li>
                        <li style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px; color: #64748b;">
                            <strong style="color: #1e293b; min-width: 80px;">Type :</strong> Temps Plein
                        </li>
                        <li style="display: flex; align-items: center; gap: 10px; color: #64748b;">
                            <strong style="color: #1e293b; min-width: 80px;">Salaire :</strong> <span style="color: #10b981; font-weight: 700;">{{ $jobOffer->salary ?? 'À discuter' }}</span>
                        </li>
                    </ul>

                    <div style="border-top: 1px solid #e2e8f0; padding-top: 20px;">
                        @guest
                            <div style="background: rgba(59, 130, 246, 0.1); padding: 15px; border-radius: 8px; text-align: center;">
                                <p style="color: #475569; font-size: 0.9rem; margin-bottom: 15px;">Inscrivez-vous pour envoyer votre candidature avec CV directement depuis la plateforme.</p>
                                <a href="{{ route('login') }}" class="btn-apply-custom d-block text-center text-decoration-none">Se connecter pour postuler</a>
                            </div>
                        @else
                            @if(Auth::user()->role === 'candidate')
                                @if($jobOffer->applications()->where('user_id', Auth::id())->exists())
                                    <div style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 15px; border-radius: 8px; text-align: center; border: 1px dashed rgba(16, 185, 129, 0.3);">
                                        <strong>✓ Candidature Envoyée</strong>
                                    </div>
                                @else
                                    <form action="{{ route('applications.store', $jobOffer->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-20">
                                            <label style="font-weight: 600; font-size: 0.9rem;">Message / Lettre de motivation</label>
                                            <textarea name="cover_letter" rows="4" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px;" required></textarea>
                                        </div>
                                        <div class="form-group mb-20">
                                            <label style="font-weight: 600; font-size: 0.9rem;">Fichier CV (PDF, DOCX)</label>
                                            <input type="file" name="resume" accept=".pdf,.doc,.docx" style="width: 100%; border: 1px dashed #cbd5e1; border-radius: 6px; padding: 10px; background: white;" required>
                                        </div>
                                        <button type="submit" class="btn btn-default" style="width: 100%; padding: 12px; border-radius: 6px; background: #3b82f6; color: white; border: none; font-weight: 600;">Envoyer ma candidature</button>
                                    </form>
                                @endif
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
            
            <!-- Description de l'emploi -->
            <div class="col-lg-8 col-md-12 col-sm-12 col-12 mb-30" style="order: 1;">
                <div class="content-single" style="font-size: 1.05rem; line-height: 1.8; color: #334155;">
                    <h4 class="mb-20" style="color: #0f172a; font-weight: 700; font-size: 1.5rem; margin-bottom: 20px;">Mission & Profil Recherché</h4>
                    
                    <div style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; white-space: pre-wrap;">{{ $jobOffer->description }}</div>
                    
                    <div class="mt-40" style="background: #f8fafc; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <h4 class="mb-20" style="color: #0f172a; font-weight: 700; font-size: 1.2rem;">À propos de l'entreprise</h4>
                        <p>{{ $jobOffer->company->bio ?? 'Description rapide de l\'entreprise non disponible.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
