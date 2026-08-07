<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!--Isi title yang kita kirimkan dari views lain-->
    <title>@yield('title')</title>
    <!--memanggil Link bootstraps-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>   
    @endif     

    <!-- Isi konten yang kita kirimkan dari views lain-->
@yield('content')

</div>

<script>
    setTimeout(function () {
        document.querySelectorAll('.alert').forEach(function(alertEl) {
            if (typeof bootstrap !== 'undefined' && bootstrap.Alert) {
                bootstrap.Alert.getOrCreateInstance(alertEl).close();
            } else {
                alertEl.style.transition = 'opacity 0.5s ease';
                alertEl.style.opacity = '0';
                setTimeout(function() {
                    alertEl.remove();
                }, 500);
            }
        });
    }, 3000);
</script>
</body>

</html>