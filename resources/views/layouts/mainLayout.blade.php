<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @if(env("APP_ENV") === "dev")
            @include("partials/leafo/scssCompiler")
        @endif
        @include('partials/common/head')
    </head>
    <body>
        <header>
            @include('partials/common/header')
        </header>
        <main>
            <div class="container">            
                @section('main')
                @show
            </div>
            <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
            @include('partials/tinymceConfigJs')
        </main>
        <footer>
            @include('partials/common/footer')
        </footer>
    </body>
</html>