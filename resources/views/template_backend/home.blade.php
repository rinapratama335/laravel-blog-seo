      <!-- header -->
      @include('template_backend.header')

      <!-- Sidebar Menu -->
      @include('template_backend.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>@yield('subjudul')</h1>
          </div>

          @yield('content')

          <div class="section-body">
          </div>
        </section>
      </div>

      <!-- Footer -->
      @include('template_backend.footer')


