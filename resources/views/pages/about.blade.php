@extends('layouts.app')

@section('title', 'À propos de nous')

@section('content')
<main class="main">
    <section class="section-box mt-50 mb-50">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">À propos de Global Jobs</h2>
                <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">La plateforme qui connecte les talents aux meilleures opportunités.</p>
            </div>
            <div class="row mt-50">
                <div class="col-lg-8 mx-auto">
                    <div class="content-single">
                        <h4>Notre Mission</h4>
                        <p>Global Jobs a été fondé avec une idée simple : simplifier drastiquement le processus de recrutement pour les entreprises locales, tout en offrant aux chercheurs d'emploi une interface intuitive pour décrocher le travail de leurs rêves.</p>
                        
                        <h4 class="mt-30">Notre Vision</h4>
                        <p>Nous croyons en un marché du travail transparent et dynamique. En exploitant la technologie (comme notre Smart Assistant IA), nous aidons les recruteurs à identifier facilement les profils rares et les candidats à valoriser leur expérience de manière optimale.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
