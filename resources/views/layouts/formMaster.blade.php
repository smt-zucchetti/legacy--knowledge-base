<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
       @include('partials/head')


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