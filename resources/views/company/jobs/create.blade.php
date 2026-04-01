@extends('layouts.app')

@section('title', 'Publier une offre d\'emploi')

@section('content')
<section class="section-box mt-50 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="box-nav-tabs nav-tavs-profile mb-5">
                    <ul class="nav" role="tablist">
                        <li><a class="btn btn-border mb-20" href="{{ route('company.dashboard') }}">Vos Offres (Tableau bord)</a></li>
                        <li><a class="btn btn-border mb-20 active" href="{{ route('company.jobs.create') }}">Publier une offre</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                <div class="content-single">
                    <h3 class="mt-0 mb-15 color-brand-1">Créer une offre d'emploi ✍️</h3>
                    <p class="font-lg color-text-paragraph-2 mb-30">Veuillez détailler précisément le poste pour attirer les meilleurs talents.</p>

                    @if($errors->any())
                        <div class="alert alert-danger" style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 15px; border-radius: 8px;">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="box-shadow-bdrd-15 box-filters mt-30 p-4" style="border: 1px solid #e2e8f0; border-radius: 12px; background: white;">
                        <form action="{{ route('company.jobs.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 form-group mb-4">
                                    <label class="form-label font-bold text-dark" for="title">Titre du poste <span class="text-danger">*</span></label>
                                    <input type="text" id="title" class="form-control" name="title" value="{{ old('title') }}" required placeholder="Ex: Développeur PHP Fullstack (H/F)">
                                </div>
                                
                                <div class="col-md-6 form-group mb-4">
                                    <label class="form-label font-bold text-dark" for="location">Lieu (Ville ou Remote)</label>
                                    <input type="text" id="location" class="form-control" name="location" value="{{ old('location') }}" placeholder="Ex: Paris, France ou Full Remote">
                                </div>
                                
                                <div class="col-md-6 form-group mb-4">
                                    <label class="form-label font-bold text-dark" for="salary">Salaire indicatif</label>
                                    <input type="text" id="salary" class="form-control" name="salary" value="{{ old('salary') }}" placeholder="Ex: 45k€ - 60k€ / an">
                                </div>
                                
                                <div class="col-12 form-group mb-4">
                                    <label class="form-label font-bold text-dark" for="description">Description détaillée du poste <span class="text-danger">*</span></label>
                                    <textarea id="description" name="description" class="form-control" rows="8" required placeholder="Décrivez les missions, le profil recherché, les avantages...">{{ old('description') }}</textarea>
                                </div>
                                
                                <div class="col-12 mt-3 text-end">
                                    <button type="submit" class="btn btn-brand-1 hover-up px-5 py-3" style="font-size: 1.1rem;">
                                        Publier l'annonce maintenant 🚀
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
