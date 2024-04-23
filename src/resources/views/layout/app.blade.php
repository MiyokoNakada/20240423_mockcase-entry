<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <h1 class="header-ttl">
            Atte
        </h1>
        @if (Auth::check())
        <nav class="header-navi">
            <ul class="header-navi__list">
                <li>ホーム</li>
                <li>日付一覧</li>
                <li>ログアウト</li>
            </ul>
        </nav>
        @endif
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <small>Atte,inc.</small>
    </footer>
</body>

</html>