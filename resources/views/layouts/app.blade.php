<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="https://jobbox-html-frontend.vercel.app/assets/imgs/template/favicon.svg">
    <!-- Load JobBox native compiled CSS via Hotlink for valid font-faces and svgs -->
    <link href="https://jobbox-html-frontend.vercel.app/assets/css/style.css?version=4.1" rel="stylesheet">
    <title>{{ config('app.name', 'Global Jobs') }} - @yield('title')</title>
  </head>
  <body>
    <header class="header sticky-bar">
      <div class="container">
        <div class="main-header">
          <div class="header-left">
            <div class="header-logo"><a class="d-flex" href="{{ route('home') }}"><img alt="jobBox" src="{{ asset('assets/imgs/template/jobhub-logo.svg') }}"></a></div>
          </div>
          <div class="header-nav">
            <nav class="nav-main-menu">
              <ul class="main-menu">
                <li><a class="active" href="{{ route('home') }}">Home</a>
                </li>
                <li><a href="{{ route('home') }}">Find a Job</a>
                </li>
                @auth
                    @if(Auth::user()->role === 'company')
                        <li><a href="{{ route('company.dashboard') }}">Dashboard Entreprise</a></li>
                    @elseif(Auth::user()->role === 'candidate')
                        <li><a href="{{ route('candidate.applications') }}">Mes candidatures</a></li>
                    @endif
                @endauth
              </ul>
            </nav>
            <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
          </div>
          <div class="header-right">
            <div class="block-signin">
                @guest
                    <a class="text-link-bd-btom hover-up" href="{{ route('register') }}">Register</a>
                    <a class="btn btn-default btn-shadow ml-40 hover-up" href="{{ route('login') }}">Sign in</a>
                @else
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-default btn-shadow ml-40 hover-up">Déconnexion</button>
                    </form>
                @endguest
            </div>
          </div>
        </div>
      </div>
    </header>

    @yield('content')

    <footer class="footer mt-50">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-12 mb-30">
              <img alt="jobBox" src="{{ asset('assets/imgs/template/jobhub-logo.svg') }}" style="height: 35px; margin-bottom: 20px;">
              <div class="mt-20 mb-20 font-xs color-text-paragraph-2">
                 GlobalJobs est le cœur de la plateforme de recherche d'emplois innovante. Décrochez le job de vos rêves dès aujourd'hui.
              </div>
          </div>
          <div class="col-md-2 col-xs-6">
            <h6 class="mb-20">Entreprises</h6>
            <ul class="menu-footer">
              <li><a href="#">Pourquoi nous choisir</a></li>
              <li><a href="#">Publier une annonce</a></li>
            </ul>
          </div>
          <div class="col-md-2 col-xs-6">
            <h6 class="mb-20">Ressources</h6>
            <ul class="menu-footer">
              <li><a href="#">À propos</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="footer-bottom mt-50">
          <div class="row">
            <div class="col-md-6"><span class="font-xs color-text-paragraph">Copyright &copy; 2026. JobBox Clone by Antigravity.</span></div>
          </div>
        </div>
      </div>
    </footer>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/vendor/bootstrap.bundle.min.js"></script>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/plugins/waypoints.js"></script>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/plugins/wow.js"></script>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/plugins/magnific-popup.js"></script>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/plugins/select2.min.js"></script>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/plugins/isotope.js"></script>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/plugins/scrollup.js"></script>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/plugins/swiper-bundle.min.js"></script>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/plugins/counterup.js"></script>
  <script src="https://jobbox-html-frontend.vercel.app/assets/js/main.js?v=4.1"></script>
  </body>
</html>
