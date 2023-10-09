<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://cdn.tailwindcss.com"></script>
  <title>{{ $title }} | SecureVault</title>
</head>
<body>
  @include('partials.navbar')

  <div class="mx-10 my-10">
    @yield('container')
  </div>
</body>
</html>