<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref full-height">


            <div class="content">
                <div class="container">
                    <h2 class="text-center">Files list</h2>
                       <div class="row">

                           <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">mime_type</th>
                        <th scope="col">url</th>
                        <th scope="col">path</th>
                        <th scope ="col">action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($files as $file)
                    <tr>
                      <td>{{$file->id}}</td>
                      <td>{{$file->mime_type}}</td>
                      <td>{{$file->url}}</td>
                      <td>{{$file->path}}</td>
                      <td><a href="destroy/{{$file->id}}" class="btn btn-danger">delete</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                       </div>
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </body>
</html>
