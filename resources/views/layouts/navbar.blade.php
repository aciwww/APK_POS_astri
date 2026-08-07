<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" style="font-family: bold" href="#">POS ASTRI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users') }}">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('produk') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
        </li>
      </ul>

      <form action="{{ route('logout') }}" method="POST" class="d-flex">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
      </form>
    </div>
  </div>
</nav>

<style>
  .navbar-nav {
    gap: 20px;
  }

  .navbar-nav .nav-link {
    position: relative;
    padding-bottom: 6px;
  }

  .navbar-nav .nav-link::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 2px;
    background-color: #b03a2e;
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.2s ease;
  }

  .navbar-nav .nav-link.active::after {
    transform: scaleX(1);
  }

  .navbar-nav .nav-link.active {
    font-weight: 600;
    color: #212529 !important;
  }

  .navbar form .btn-danger {
    background-color: #fff;
    border-color: #ee2e0c;
    color: #ee2e0c;
    transition: background-color 0.15s ease, border-color 0.15s ease, color 0.15s ease;
  }

  .navbar form .btn-danger:hover {
    background-color: #ee2e0c;
    border-color: #ee2e0c;
    color: #fff;
  }

  .navbar form .btn-danger:active,
  .navbar form .btn-danger:focus {
    background-color: #cf4a3f !important;
    border-color: #cf4a3f !important;
    color: #fff !important;
  }
</style>