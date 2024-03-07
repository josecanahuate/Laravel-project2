<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">{{config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>

        <!-- aca si el usuario esta logeado, ocultaremos el register y solo dejaremos el logout y el upload-->
        @auth
        <li class="nav-item">
          <a class="nav-link" href="{{route('logout') }}">Logout</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('upload') }}">Upload Files</a>
        </li>
        @else

        <li class="nav-item">
          <a class="nav-link" href="{{route('login') }}">Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('registration') }}">Register</a>
        </li>

        @endauth
      </ul>
      <span class="navbar-text">@auth{{ auth()->user()->name }}@endauth</span>
    </div>
  </div>
</nav>