<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
  <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
  @include('layouts.partials.head')
  @livewireStyles
</head>

<body>
  @auth
    <main id="main-wrapper" class="main-wrapper">
        @livewire('component.header')
        {{-- <livewire:component.header /> --}}
         <!-- Sidebar -->
         <livewire:component.sidebar />
        <!-- Page Content -->
        <div id="app-content">
            <div class="app-content-area">
                <div class="bg-primary pt-10 pb-21"></div>
                {{ $slot }}
            </div>
        </div>
    </main>
  @endauth
  @guest
  {{ $slot }}
  @endguest

 {{-- @stack('modal') --}}
 @include('layouts.partials.scripts')
 @livewireScripts

 @stack('script')
 <script>
  @auth
  Livewire.on('sidebarVisibleChanged', (sidebarVisible) => {
      const body = document.querySelector('body');
      const mainElement = body.querySelector('main');
      if (sidebarVisible) {
          mainElement.classList.add('toggled');
      } else {
          mainElement.classList.remove('toggled');
      }
  });
  Livewire.on('toggledThemeAppChange', (themeLight) => {
      if (themeLight === true) {
        document.documentElement.setAttribute('data-theme', 'light');
      }else if (themeLight === false){
        document.documentElement.setAttribute('data-theme', 'dark');
      } else {
        document.documentElement.setAttribute('data-theme', 'light');
      }
  });
    // In your JavaScript file or script section
document.addEventListener('livewire:load', function () {
    // Initialize components here
    document.documentElement.setAttribute('data-theme', 'light');
});

document.addEventListener('livewire:update', function () {
    // Update components here
    feather.replace(); //reload icon feather
    $('[data-bs-toggle="tooltip"]').tooltip();
});
 @endauth
</script>
</body>

</html>