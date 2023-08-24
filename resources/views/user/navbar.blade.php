<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
  <div class="container px-4 px-lg-5">
      <a class="navbar-brand" href="{{ route('user.home') }}">Thrifty</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ms-auto my-2 my-lg-0">
              <li class="nav-item"><a class="nav-link" href="{{ route('user.products') }}">Products</a></li>
              @if (Auth::check())
                <li class="nav-item"><a class="nav-link" href="{{ route('user.orders') }}">My Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
              @endif

            @if (!Auth::check())
              <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            @endif

          </ul>
          </div>
      </div>
  </div>
</nav>

<script>
  window.addEventListener('DOMContentLoaded', event => {
      const navbarCollapsible = document.querySelector('#mainNav');
      const navbarToggler = document.querySelector('.navbar-toggler');
      const responsiveNavItems = Array.from(document.querySelectorAll('#navbarResponsive .nav-link'));

      // Navbar shrink function
      const navbarShrink = () => {
          if (!navbarCollapsible) return;
          navbarCollapsible.classList.toggle('navbar-shrink', window.scrollY !== 0);
      };

      // Shrink the navbar when page is scrolled
      document.addEventListener('scroll', navbarShrink);

      // Activate Bootstrap scrollspy on the main nav element
      const mainNav = document.querySelector('#mainNav');
      if (mainNav) {
          new bootstrap.ScrollSpy(document.body, {
              target: '#mainNav',
              rootMargin: '0px 0px -40%',
          });
      }

      // Collapse responsive navbar when toggler is visible
      responsiveNavItems.forEach(responsiveNavItem => {
          responsiveNavItem.addEventListener('click', () => {
              if (window.getComputedStyle(navbarToggler).display !== 'none') {
                  navbarToggler.click();
              }
          });
      });

      // Activate SimpleLightbox plugin for portfolio items
      new SimpleLightbox({
          elements: '#portfolio a.portfolio-box'
      });

      // Initial call to navbarShrink to set initial state
      navbarShrink();
  });
</script>
