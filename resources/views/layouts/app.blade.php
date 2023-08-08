<!DOCTYPE html>
<html lang="en">

<head>
  <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
  @include('layouts.partials.head')
  @livewireStyles
</head>

<body class="bg-light">
  <!-- container -->
  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
 {{ $slot }}

 {{-- @stack('modal') --}}
 @include('layouts.partials.scripts')
 @livewireScripts

 @stack('script')
</body>

</html>