<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel 7 - Simplest ACL') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 50vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                        @role('super')
                        <a href="{{ url('/admin/clients') }}">Clients</a>
                        <a href="{{ url('/admin/users') }}">Users</a>
                        <a href="{{ url('/admin/roles') }}">Roles</a>
                        <a href="{{ url('/admin/permissions') }}">Permissions</a>
                        @endrole
                        @role('admin')
                        <a href="{{ url('/admin/users') }}">Users</a>
                        <a href="{{ url('/admin/roles') }}">Roles</a>
                        <a href="{{ url('/admin/permissions') }}">Permissions</a>
                        @endrole
                        @role('manager')
                        <a href="{{ url('/admin/clients') }}">Clients</a>
                        @endrole
                        @role('user')
                        <a href="{{ url('/admin/clients') }}">Clients</a>
                        @endrole
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div><h1>
                    {{ config('app.name', 'ACL with Roles and Permissions') }}
                    </h1>
                </div>
<pre>





</pre>
                <div class="links">
                    <a href="https://laravel.com/docs" target="_blank">Docs</a>
                    <a href="https://laracasts.com" target="_blank">Laracasts</a>
                    <a href="https://github.com/laravel/laravel" target="_blank">GitHub</a>
<hr>
                    <a href="https://ribafs.github.io/" target="_blank">RibaFS</a>
                    <a href="https://ribafs.github.io/curriculo/livros.html" target="_blank">Livros</a>
                    <a href="https://github.com/ribafs?tab=repositories" target="_blank">Projetos</a>
                    <a href="https://ribafs.github.io/curriculo/curriculo.html" target="_blank">Currículo</a>
                    <a href="mailto:ribafs@gmail.com" target="_blank" title="ribafs@gmail.com">Contato</a>
                </div>
            </div>
        </div>
    </body>
</html>
