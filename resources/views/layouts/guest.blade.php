<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WellMaggot') }}</title>

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        @layer utilities {
          .bg-chartreuse { background-color: #B9C240; }
          .text-chartreuse { color: #B9C240; }
          .focus\:ring-chartreuse:focus { --tw-ring-color: #B9C240; }
        }
    </style>
</head>
<body class="h-screen flex flex-wrap font-roboto">
    {{ $slot }}
</body>
</html>
