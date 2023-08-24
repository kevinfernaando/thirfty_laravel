<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{route('user.home')}}">Thrifty</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('user.products')}}">Products</a>
      </li>
      @if (Auth::check())
      <li class="nav-item">
        <a class="nav-link" href="{{route('user.orders')}}">My Order</a>
      </li>
      @endif
    </ul>

    @if (Auth::check())
      <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-outline-danger" style="margin-left: 10px;">Logout</button>
      </form>
    @else
      <div>
        <button class="btn btn-outline-primary">
          <a href="/login">Login</a>
        </button>
      </div>
    @endif  
  </div>
</nav>