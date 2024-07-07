<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

{{-- navbar --}}

<div class="container">
  <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom align-items-center">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4 fw-bold">BLOOGG</span>
    </a>

    <nav>
      @guest
          <a href="{{ route('login') }}" class="px-3">Login</a>
          <a href="{{ route('register') }}">Register</a>
      @else
          <a href="{{ route('user.posts', auth()->user()->id) }}">My Posts</a>
          <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit">Logout</button>
          </form>
      @endguest
  </nav>
  </header>
</div>
{{-- end --}}


    @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>