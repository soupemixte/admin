<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <meta name="author" content="Equipe #1">
    <script type="module" src="{{ asset('js/main.js')}}" defer></script>
    <title>{{ config('app.name') }} - @yield('title')</title>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <img src="{{ asset('img/header/vino_logo_final.svg') }}" alt="Logo Vino">
        </div>
        <ul>
            <div class="hidden dropdown">
                <img src="{{ asset('img/navigation/language.png')}}" alt="language settings">
                <div class="dropdown-box">
                    <a href="{{ route('lang', 'en') }}">@lang('lang.lang_en')</a>
                    <a href="{{ route('lang', 'fr') }}">@lang('lang.lang_fr')</a>
                </div>
            </div>  
        </ul>
    </header>

    @if(session('success'))
    <div class="alert success">
        <p>{{ session('success') }}</p>
        <button type="button" class="btn-close">X</button>
    </div>
    @endif

    @if(session('errors'))
        <div class="alert error">
            <p>{{ session('errors')->first() }}</p>
            <button type="button" class="btn-close">X</button>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert warning">
            <p>{{ session('warning') }}</p>
            <button type="button" class="btn-close">X</button>
        </div>
    @endif

    


    <!-- Success Modal -->
    <div id="successModal" class="modal" style="display: none;">
        <div class="modal-content">
            <button type="button" class="btn-close" id="closeModal">&times;</button>
            <p id="successMessage"></p>
        </div>
    </div>
    <!-- Content -->
    @yield('content')
    <!-- Navigation -->
    <nav class="navigation">
        <!-- Visible for admins users only -->
        @auth('admin')
            <a class="nav-link" href="{{ route('admin.dashboard') }}"> 
                <img src="{{asset('img/navigation/dashboard.png') }}" alt="nav-image">@lang('lang.dashboard')
            </a>
        @endauth
        @php
            $isAdmin = Auth::guard('admin')->check(); // Check if admin is logged in
        @endphp

@if(!$isAdmin)
  <!-- Guest: Not logged in -->
  <a class="nav-link" href="{{ route('admin.login') }}">
    <img src="{{ asset('img/navigation/profile.svg') }}" alt="nav-image">@lang('lang.login')
  </a>
@else
  @if($isAdmin)
    <!-- Admin logged in -->
    <a class="nav-link" href="{{ route('logout') }}">
      <img src="{{ asset('img/navigation/profile.svg') }}" alt="nav-image">@lang('lang.logout') (Admin)
    </a>
  @elseif($isUser)
    <!-- User logged in -->
    <a class="nav-link" href="{{ route('logout') }}">
      <img src="{{ asset('img/navigation/profile.svg') }}" alt="nav-image">@lang('lang.logout')
    </a>
  @endif
@endif
    </nav>

    <!-----Script général réutilisable pour masquer la modale------>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
        const closeButtons = document.querySelectorAll(".btn-close");

        closeButtons.forEach(button => {
            button.addEventListener("click", function () {
                const alert = this.parentElement;
                alert.classList.add("hide");
            });
        });
    });

    </script>


    



</body>
</html>