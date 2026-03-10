<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Vantage</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar Navigation -->
        <!-- Header -->
        <main class="admin-main">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
