@extends('layouts.app')

@section('title', 'Nous contacter')

@section('content')
<main class="main">
    <section class="section-box mt-50 mb-50">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">Contactez-nous</h2>
                <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Nous sommes à votre écoute pour toute question ou partenariat.</p>
            </div>
            <div class="row mt-50">
                <div class="col-lg-8 mx-auto">
                    <div class="box-shadow-bdrd-15 p-4" style="border: 1px solid #e2e8f0; border-radius: 12px; background: white;">
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col-md-6 form-group mb-4">
                                    <label class="form-label font-bold text-dark">Nom Complet</label>
                                    <input type="text" class="form-control" placeholder="Votre nom complet" required>
                                </div>
                                <div class="col-md-6 form-group mb-4">
                                    <label class="form-label font-bold text-dark">Email</label>
                                    <input type="email" class="form-control" placeholder="vous@exemple.com" required>
                                </div>
                                <div class="col-12 form-group mb-4">
                                    <label class="form-label font-bold text-dark">Message</label>
                                    <textarea class="form-control" rows="6" placeholder="Comment pouvons-nous vous aider ?" required></textarea>
                                </div>
                                <div class="col-12 mt-3 text-end">
                                    <button type="submit" class="btn btn-brand-1 hover-up px-5 py-3">Envoyer le message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
