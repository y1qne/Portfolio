<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('annonces') }}">Accueil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('mesannonces') }}">Mes annonces</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('profil') }}">Profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('messagerie') }}">Messagerie ({{session('unread')}})</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}">Déconnexion</a>
      </li>
    </ul>
  </div>
</nav>
