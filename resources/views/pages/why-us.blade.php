@extends('layouts.app')

@section('title', 'Pourquoi nous choisir ?')

@section('content')
<main class="main">
    <section class="section-box mt-50 mb-50">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">Pourquoi faire confiance à Global Jobs ?</h2>
                <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Les avantages exclusifs pour les entreprises et talents.</p>
            </div>
            <div class="row mt-50">
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="box-shadow-bdrd-15 p-4 text-center h-100" style="border: 1px solid #e2e8f0; border-radius: 12px; background: white;">
                        <div style="font-size: 3rem; margin-bottom: 20px;">🤖</div>
                        <h4>Intelligence Artificielle</h4>
                        <p class="mt-15 text-muted">Notre Chatbot intégré oriente les candidats directement vers vos offres pertinentes, propulsant le taux de conversion.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="box-shadow-bdrd-15 p-4 text-center h-100" style="border: 1px solid #e2e8f0; border-radius: 12px; background: white;">
                        <div style="font-size: 3rem; margin-bottom: 20px;">⚡</div>
                        <h4>Processus Rapide</h4>
                        <p class="mt-15 text-muted">Publiez une offre ou postulez en moins de 2 minutes. Plus de formulaires interminables, juste l'essentiel.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="box-shadow-bdrd-15 p-4 text-center h-100" style="border: 1px solid #e2e8f0; border-radius: 12px; background: white;">
                        <div style="font-size: 3rem; margin-bottom: 20px;">📊</div>
                        <h4>Suivi ATS Intégré</h4>
                        <p class="mt-15 text-muted">Les recruteurs disposent d'un tableau de bord de pointe pour accepter, refuser et suivre les candidats.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
