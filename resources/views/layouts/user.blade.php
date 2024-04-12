<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/min.css') }}">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('bootstrap/bundle.min.js') }}"></script>
<script src="{{ asset('js/notify.min.js') }}"></script>
<script>
    $(document).ready(function(){
        @if(session('success'))
            $.notify("{{ session('success') }}", "success");
        @endif
        @if(session('error'))
            $.notify("{{ session('error') }}", "error");
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                $.notify("{{ $error }}", "error");
            @endforeach
        @endif
    });
</script>
</html>
