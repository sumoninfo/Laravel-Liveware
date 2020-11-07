<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:liveware="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Liveware</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css"
          integrity="sha512-kJ30H6g4NGhWopgdseRb8wTsyllFUYIx3hiUwmGAkgA9B/JbzUBDQVr2VVlWGde6sdBVOG7oU8AL35ORDuMm8g=="
          crossorigin="anonymous"/>
    @livewireStyles
    @livewireScripts
    {{--    <liveware:styles/>--}}
</head>
<body>
{{--<livewire:counter/>--}}
<div class="flex justify-center">
    <div class="w-10/12 my-10 flex">
        <div class="w-5/12 rounded p-2">
            <livewire:ticket/>
        </div>
        <div class="w-7/12 rounded p-2">
            <livewire:comments/>
        </div>
    </div>
</div>



{{--<liveware:scripts/>--}}
</body>
</html>
