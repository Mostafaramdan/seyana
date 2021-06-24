<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>seyana  </title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link type="text/css" rel="stylesheet" href="{{asset('css/all.css')}}">
        <link href="{{asset('css/fontawesome/css/all.css')}}" rel="stylesheet"> <!--load all styles -->
        {{-- @laravelPWA --}}
        <script>
            (function () {
                window.Laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };
            })();
        </script>
    </head>
    <body class="text-right" style="background-color:rgb(221, 221, 221);; ">
        <div id="mainapp" >
                <main-app></main-app>
            </div>
    </body>
    <script src="{{asset('javascript/app.js')}}"></script>
    <script >

    </script>
</html>
