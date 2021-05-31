<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Full stack Blog</title>

        <link rel="stylesheet" href="/css/all.css">
    </head>
    <body>
        {{-- vue JS will load inside the confines of the 'app' div --}}
        <div id='app'>
            <mainapp></mainapp>
        </div>
    </body>
    {{-- Link to public folder ->js ->app.js --}}
    <script src="{{ mix('/js/app.js') }}"></script>
</html>
