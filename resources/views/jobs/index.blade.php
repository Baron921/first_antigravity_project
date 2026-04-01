@extends('layouts.app')

@section('title', 'Trouvez le job idéal')

@section('content')
<main class="main">
    <div class="bg-homepage1"></div>
    <section class="section-box">
        <div class="banner-hero hero-1">
            <div class="banner-inner">
                <div class="row">
                    <div class="col-xl-8 col-lg-12">
                        <div class="block-banner">
                            <h1 class="heading-banner wow animate__animated animate__fadeInUp">The <span class="color-brand-2">Easiest Way</span><br class="d-none d-lg-block">to Get Your New Job</h1>
                            <div class="banner-description mt-20 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Plus de 10 000 offres d'emploi pour propulser votre carrière dans les plus belles entreprises !</div>
                            
                            <div class="form-find mt-40 wow animate__animated animate__fadeIn" data-wow-delay=".2s">
                                <form>
                                    <div class="box-industry">
                                        <select class="form-input mr-10 select-active input-industry">
                                            <option value="0">Toutes catégories</option>
                                            <option value="1">Software</option>
                                            <option value="2">Finance</option>
                                        </select>
                                    </div>
                                    <input class="form-input input-keysearch mr-10" type="text" placeholder="Poste ou mots-clés...">
                                    <button class="btn btn-default btn-find font-sm">Search</button>
                                </form>
                            </div>
                            <div class="list-tags-banner mt-60 wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                                <strong>Recherches populaires:</strong>
                                <a href="#">Designer</a>, <a href="#">Web</a>, <a href="#">IOS</a>, <a href="#">Developer</a>, <a href="#">PHP</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 d-none d-xl-block col-md-6">
                        <div class="banner-imgs">
                            <div class="block-1 shape-1"><img class="img-responsive" alt="jobBox" style="border-radius: 16px;" src="{{ asset('assets/imgs/hero.png') }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Jobs -->
    <section class="section-box mt-50 mb-50">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">Dernières Offres du Jour</h2>
                <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Découvrez les meilleures annonces fraîchement publiées.</p>
            </div>
            <div class="mt-70">
                <div class="row">
                    @forelse($jobs as $job)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="card-grid-2 hover-up">
                            <div class="card-grid-2-image-left"><span class="flash"></span>
                                <div class="image-box" style="display:flex; align-items:center; justify-content:center; background:#f1f5f9; border-radius:5px; height:50px; width:50px; font-weight:bold; font-size:1.5rem; color:#94a3b8;">
                                    {{ substr($job->company->company_name ?? $job->company->name, 0, 1) }}
                                </div>
                                <div class="right-info">
                                    <a class="name-job" href="{{ route('jobs.show', $job->id) }}">{{ $job->company->company_name ?? $job->company->name }}</a>
                                    <span class="location-small">{{ $job->location ?? 'Non spécifié' }}</span>
                                </div>
                            </div>
                            <div class="card-block-info">
                                <h6><a href="{{ route('jobs.show', $job->id) }}">{{ $job->title }}</a></h6>
                                <div class="mt-5"><span class="card-briefcase">Fulltime</span><span class="card-time">{{ $job->created_at->diffForHumans() }}</span></div>
                                <p class="font-sm color-text-paragraph mt-15">{{ Str::limit($job->description, 90) }}</p>
                                <div class="card-2-bottom mt-30">
                                    <div class="row">
                                        <div class="col-lg-7 col-7"><span class="card-text-price">{{ $job->salary ?? 'À débattre' }}</span></div>
                                        <div class="col-lg-5 col-5 text-end">
                                            <a class="btn btn-apply-now" href="{{ route('jobs.show', $job->id) }}">Voir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <div style="padding: 50px; background: #f8fafc; border-radius: 12px; border: 1px dashed #cbd5e1;">
                            <img src="{{ asset('assets/imgs/template/jobhub-logo.svg') }}" style="height: 40px; opacity: 0.3; margin-bottom: 20px;">
                            <h3 style="color: #94a3b8;">Aucune offre n'est disponible pour le moment...</h3>
                        </div>
                    </div>
                    @endforelse
                </div>

                <div class="paginations mt-50 d-flex justify-content-center">
                    {{ $jobs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
