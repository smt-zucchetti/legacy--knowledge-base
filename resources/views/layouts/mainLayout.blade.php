<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include(env("APP_ENV") === "dev"? "partials/leafo/scssCompiler":"")
        @include('partials/head')
    </head>
    <body>
        <header>
            @include('partials/header')
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
            @include('partials/footer')
        </footer>


      <script>
        $(document).ready(function(){

            $('#youtube-popup').click(function(e){
                e.preventDefault();

                $.fancybox({
                    href: "https://www.youtube.com/embed/8Ii61D6g41g?autoplay=1", 
                    type: "iframe",
                    padding: 0,
                    afterClose: function() {
                        $('#bg').hide();
                    }
                });
            });

          });
      </script>


    </body>
</html>