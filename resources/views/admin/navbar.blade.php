<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Thrifty [admin]</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.products')}}">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.orders')}}">Orders</a>
        </li>
      </ul>

      @if (Auth::check())
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Logout</button>
        </form>
      @else
        <div>
          <button class="btn btn-outline-primary">
            <a href="{{ route('login') }}">Login</a>
          </button>
        </div>
      @endif  
   

    </div>

  </nav>