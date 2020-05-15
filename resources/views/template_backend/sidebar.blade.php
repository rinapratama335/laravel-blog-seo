<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>

      <li class="menu-header">Starter</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-newspaper"></i> <span>Posts</span></a>
        <ul class="dropdown-menu">
            <li>
                <a class="nav-link" href="{{ route('post.index') }}">List Posts</a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('post.tampil_hapus') }}">Trash Posts</a>
            </li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-folder-open"></i> <span>Kategori</span></a>
        <ul class="dropdown-menu">
            <li>
                <a class="nav-link" href="{{ route('category.index') }}">List Kategori</a>
            </li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-tags"></i> <span>Tags</span></a>
        <ul class="dropdown-menu">
            <li>
                <a class="nav-link" href="{{ route('tag.index') }}">List Tags</a>
            </li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>User</span></a>
        <ul class="dropdown-menu">
            <li>
                <a class="nav-link" href="{{ route('user.index') }}">List User</a>
            </li>
        </ul>
      </li>
    </ul>
  </aside>
</div>
