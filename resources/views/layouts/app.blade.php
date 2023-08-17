<!DOCTYPE html>
<html lang="en">

<head>
  <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
  @include('layouts.partials.head')
  @livewireStyles
</head>

<body class="bg-light">
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
 @endauth
</script>
</body>

</html>