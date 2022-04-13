<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SISVOTO</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link href="/css/loading.css" rel="stylesheet">
        <style>

            body, html {
                height: 100%;
            }
            .bg {
                /* Full height */
                height: 100%;

                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                background-image: url('/img/bg-congresso.png');
            }
                    
        </style>
    </head>
    <body class="bg">
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">SISVOTO </a>
        </nav>
        
        <div class="container ">

            @if (session('message'))
                <div class="alert alert-{{session('message')['type']}} mt-5 alert-dismissible fade show" style="margin: 50">
                    {!! session('message')['message'] !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @yield('content')           
        </div>
        <form id="sair" action="{{route('logout')}}" method="post">
            @csrf
        </form>
    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="/js/html5-qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easy-loading/1.3.0/jquery.loading.js" integrity="sha512-l9jYjbia7nXf4ZpR3dFSAjOOygUAytRrqmT32a5cBZjVpIUdFgBzIPQPPhJ6gh/NwaIerUEsn3vkEVQzQExGag==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('script')
    <script>
        
        function sair(){
            $('#sair').submit();
        }
    </script>
</html>