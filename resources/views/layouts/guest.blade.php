<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('storage/images/WellMaggot.png') }}" type="image/png">
    <title>{{ config('app.name', 'WellMaggot') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    <style type="text/tailwindcss">
        @layer utilities {
            .bg-chartreuse {
                background-color: #B9C240;
            }

            .text-chartreuse {
                color: #B9C240;
            }

            .focus\:ring-chartreuse:focus {
                --tw-ring-color: #B9C240;
            }
        }
    </style>
</head>

<body class="flex font-roboto">
    {{ $slot }}
</body>

</html>
