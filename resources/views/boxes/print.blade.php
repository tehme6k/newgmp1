<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>

    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                Box {{ $box->id }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                Hold Until: {{ $box->hold_date }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                0001-01-001
            </div>
            <div class="col-md-3">
                01/01/2019
            </div>

            <div class="col-md-3">
                0002-01-002
            </div>
            <div class="col-md-3">
                02/05/2019
            </div>
        </div>

    </div>




    <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>