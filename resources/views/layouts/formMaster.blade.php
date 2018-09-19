<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HIF Forms - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <link rel="stylesheet" href="/KnowledgeBase/resources/css/main.css" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.1/jquery.fancybox.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.1/jquery.fancybox.min.js"></script>

        <link href='http://fonts.googleapis.com/css?family=Cabin:100,100italic,400,400italic600,700' rel='stylesheet' type='text/css'>

        <!-- Add fancyBox -->
        <link rel="stylesheet" href="http://www.verticalbookingusa.com/assets/scripts/vendor/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <script type="text/javascript" src="http://www.verticalbookingusa.com/assets/scripts/vendor/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


    </head>
    <body id="{{!empty($bodyId)?$bodyId:''}}">
        @include('partials/header')
        <main>
          <div class="container">
            
              @section('main')
              @show
          </div>
          <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
          <script src="http://localhost:8888/KnowledgeBase/resources/js/tinymceConfig.js"></script>
        </main>
        @include('partials/footer')



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