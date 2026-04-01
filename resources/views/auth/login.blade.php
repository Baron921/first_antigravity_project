@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<section class="pt-100 login-register">
  <div class="container"> 
    <div class="row login-register-cover">
      <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
        <div class="text-center">
          <p class="font-sm text-brand-2">Content de vous revoir ! </p>
          <h2 class="mt-10 mb-5 text-brand-1">Connexion</h2>
          <p class="font-sm text-muted mb-30">Accédez à votre espace pour postuler ou recruter.</p>
        </div>
        <form class="login-register text-start mt-20" action="{{ route('login') }}" method="POST">
          @csrf
          <div class="form-group">
            <label class="form-label" for="email">Adresse Email *</label>
            <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" required name="email" placeholder="stevenjob@gmail.com" value="{{ old('email') }}">
            @error('email')<div style="color:red; font-size:0.8rem; margin-top:5px;">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label class="form-label" for="password">Mot de passe *</label>
            <input class="form-control" id="password" type="password" required name="password" placeholder="************">
          </div>
          <div class="login_footer form-group d-flex justify-content-between">
            <label class="cb-container">
              <input type="checkbox" name="remember"><span class="text-small">Se souvenir de moi</span><span class="checkmark"></span>
            </label>
            <a class="text-muted" href="#">Mot de passe oublié ?</a>
          </div>
          <div class="form-group">
            <button class="btn btn-brand-1 hover-up w-100" type="submit" name="login">Se connecter</button>
          </div>
          <div class="text-muted text-center">Vous n'avez pas de compte ? <a href="{{ route('register') }}">S'inscrire</a></div>
        </form>
      </div>
      <div class="img-1 d-none d-lg-block"><img class="shape-1" src="https://jobbox-html-frontend.vercel.app/assets/imgs/page/login-register/img-4.svg" alt="JobBox"></div>
      <div class="img-2"><img src="https://jobbox-html-frontend.vercel.app/assets/imgs/page/login-register/img-3.svg" alt="JobBox"></div>
    </div>
  </div>
</section>
@endsection
