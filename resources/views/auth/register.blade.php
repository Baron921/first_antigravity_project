@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<section class="pt-100 login-register">
  <div class="container"> 
    <div class="row login-register-cover">
      <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
        <div class="text-center">
          <p class="font-sm text-brand-2">Inscription </p>
          <h2 class="mt-10 mb-5 text-brand-1">Créez votre compte</h2>
          <p class="font-sm text-muted mb-30">Rejoignez-nous ! C'est rapide, facile et gratuit.</p>
        </div>
        <form class="login-register text-start mt-20" action="{{ route('register') }}" method="POST">
          @csrf
          <div class="form-group">
            <label class="form-label" for="name">Nom Complet *</label>
            <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" required name="name" placeholder="John Doe" value="{{ old('name') }}">
            @error('name')<div style="color:red; font-size:0.8rem; margin-top:5px;">{{ $message }}</div>@enderror
          </div>
          
          <div class="form-group">
            <label class="form-label" for="email">Email *</label>
            <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" required name="email" placeholder="john@example.com" value="{{ old('email') }}">
            @error('email')<div style="color:red; font-size:0.8rem; margin-top:5px;">{{ $message }}</div>@enderror
          </div>
          
          <div class="form-group">
            <label class="form-label" for="role">Vous êtes : *</label>
            <div class="box-industry">
                <select class="form-input select-active" id="role" name="role" required style="width: 100%; border: 1px solid #e0e6f7; border-radius: 4px; padding: 10px 15px; color: #4f5e64;">
                    <option value="candidate" style="padding:10px;">Un Candidat cherchant un emploi</option>
                    <option value="company" style="padding:10px;">Une Entreprise cherchant à recruter</option>
                </select>
            </div>
          </div>
          
          <div class="form-group">
            <label class="form-label" for="password">Mot de passe *</label>
            <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" required name="password" placeholder="************">
            @error('password')<div style="color:red; font-size:0.8rem; margin-top:5px;">{{ $message }}</div>@enderror
          </div>
          
          <div class="form-group">
            <label class="form-label" for="password_confirmation">Confirmer le mot de passe *</label>
            <input class="form-control" id="password_confirmation" type="password" required name="password_confirmation" placeholder="************">
          </div>
          
          <div class="login_footer form-group d-flex justify-content-between">
            <label class="cb-container">
              <input type="checkbox" required><span class="text-small">J'accepte les conditions générales</span><span class="checkmark"></span>
            </label>
          </div>
          
          <div class="form-group">
            <button class="btn btn-brand-1 hover-up w-100" type="submit">M'inscrire gratuitement</button>
          </div>
          <div class="text-muted text-center">Vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></div>
        </form>
      </div>
      <div class="img-1 d-none d-lg-block"><img class="shape-1" src="https://jobbox-html-frontend.vercel.app/assets/imgs/page/login-register/img-1.svg" alt="JobBox"></div>
      <div class="img-2"><img src="https://jobbox-html-frontend.vercel.app/assets/imgs/page/login-register/img-2.svg" alt="JobBox"></div>
    </div>
  </div>
</section>
@endsection
