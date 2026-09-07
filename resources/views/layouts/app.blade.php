<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', config('app.name'))</title>
  <meta name="description" content="@yield('meta_description', 'Gaskeun Travel menyediakan layanan City Tour Bandung terbaik.')">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { heading: ['Poppins','sans-serif'], body: ['Inter','sans-serif'] }
        }
      }
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="@yield('body_class', 'font-body bg-white text-gray-900 overflow-x-hidden')">

  @include('partials.preloader')
  @include('partials.navbar')

  @yield('content')

  @include('partials.footer')

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script src="{{ asset('js/script.js') }}"></script>
  @stack('scripts')
</body>
</html>
