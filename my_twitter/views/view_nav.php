<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="./images/fav.png" alt="Hatpink" width="100%" height="50">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home"><i class="fa-solid fa-house"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="trending"><i class="fa-solid fa-fire-flame-curved"></i> Trending</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="conversations"><i class="fa-solid fa-paper-plane"></i> Message</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="@<?= $pseudo ?>"><i class="fa-solid fa-user"></i> Profil</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">

          <a class="navbar-brand" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="./images/users_placeholder.png" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
          </a>


          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><span class="dropdown-item"><?= $alias; ?></span></li>
            <li><a class="dropdown-item" href="logout">Logout</a></li>
            <li><a class="dropdown-item" href="edit">Edit Profil</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" action="search" method="POST">
        <input class="form-control me-2" type="search" name="texte" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>

    </div>
  </div>
</nav>