<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 12 Multiple Image Upload CRUD with Preview Example - ItStuffSolutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
  <style type="text/css">


    #image_gallery img, #preview img{

      width: 200px;

      padding: 5px;

    }

  </style>
</head>

<body>
    <div class="container my-4">
      <div class="row justify-content-center">
        <div class="col-md-10 ">
         @yield('content')
        </div>
     </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $("#images").on("change", function(){
                var files = $(this)[0].files;
                $("#image_gallery").empty();
                if(files.length > 0){
                    for(var i = 0; i < files.length; i++){
                        $('#image_gallery').append("<img class='img-thumbnail m-3' src='"+URL.createObjectURL(event.target.files[i])+"'>");

                    }
                }
            });

             @stack('script')

        });
    </script>
   

</body>

</html>