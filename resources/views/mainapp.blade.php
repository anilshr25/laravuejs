<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravuejs</title>

        <link rel="stylesheet" href="/css/app.css">
        <script>
            (function() {
                window.Laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };
            })();
        </script>
    </head>
    <body id="page-top">
       <div id="app">
           @if (Auth::check() && Auth::user()->role->permission !=null)
                <mainapp :user="{{ Auth::user() }}" :permission="{{ Auth::user()->role->permission }}"></mainapp>
           @else
                <mainapp :user="false"></mainapp>
           @endif

       </div>
    </body>

    <script src="{{ mix('js/app.js') }}"></script>
</html>
