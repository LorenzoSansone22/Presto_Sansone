<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('homepage')}}">Presto.it</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('homepage')}}">{{ __('ui.home') }}</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ __('ui.categories') }}
          </a>
          <ul class="dropdown-menu">
            @foreach(\App\Models\Category::all() as $category)
              <li>
                <a class="dropdown-item" href="{{ route('categoryShow', $category) }}">
                  {{ __("ui.$category->name") }}
                </a>
              </li>
            @endforeach
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('announcements.index') }}">{{ __('ui.allAnnouncements') }}</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('announcements.create') }}">{{ __('ui.newAnnouncement') }}</a>
        </li>
      </ul>

      <form action="{{ route('announcements.search') }}" method="GET" class="d-flex mx-auto" role="search">
        <input name="query" class="form-control me-2" type="search" placeholder="{{ __('ui.search') }}..." aria-label="Search">
        <button class="btn btn-outline-success" type="submit">{{ __('ui.search') }}</button>
      </form>

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
        <li class="nav-item dropdown me-2">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ __('ui.languages') }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li class="dropdown-item d-flex align-items-center justify-content-between">
                    <span>Italiano</span>
                    <x-_locale lang="it" />
                </li>
                <li class="dropdown-item d-flex align-items-center justify-content-between">
                    <span>English</span>
                    <x-_locale lang="uk" />
                </li>
                <li class="dropdown-item d-flex align-items-center justify-content-between">
                    <span>Español</span>
                    <x-_locale lang="es" />
                </li>
            </ul>
        </li>

        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('ui.login') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('ui.register') }}</a>
          </li>
        @else
          @if(Auth::user()->is_revisor)
            <li class="nav-item">
              <a class="nav-link btn btn-outline-danger btn-sm position-relative me-3" href="{{ route('revisor.index') }}">
                {{ __('ui.revisorZone') }}
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ \App\Models\Announcement::toBeRevisionedCount() }}
                </span>
              </a>
            </li>
          @endif

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ __('ui.hello') }}, {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">{{ __('ui.logout') }}</button>
                </form>
              </li>
            </ul>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>