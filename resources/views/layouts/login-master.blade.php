<!DOCTYPE html>
<html lang="ja">

<head>
    @yield('head_meta')
    @yield('head_links')
</head>

<body class="wrapper">
    <div id="container-box">
        <div id="container">
            <div class="main">
                @yield('content')
            </div>
        </div>
    </div>
    @yield('footer')
</body>

</html>