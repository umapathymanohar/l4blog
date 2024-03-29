<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet"> -->
        {{Html::style('css/bootstrap-combined.min.css')}}
        <style>
            table form { margin-bottom: 0; }
            form ul { margin-left: 0; list-style: none; }
            .error { color: red; font-style: italic; }
            body { padding-top: 20px; }
        </style>
    </head>

    <body>

        <div class="container">
            @if (Session::has('flash'))
                <div class="flash alert">
                    <p>{{ Session::get('flash') }}</p>
                </div>
            @endif

            @yield('main')
        </div>

    </body>

</html>