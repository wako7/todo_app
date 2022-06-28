<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- str_replace("検索を行う文字列","置き換えを行う文字列","対象の文字列","str_replace処理の回数") -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- configフォルダ内のapp.phpファイル内のnameの箇所を指定していて、設定オプションが存在しない場合にapp.phpファイル内のnameで指定されているデフォルト値を返す -->

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- Laravel MixでコンパイルしたJavascriptファイルを読み込んでいる -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <!-- Laravel Mixでコンパイルしたcssファイルを読み込んでいる -->
</head>
<body>
    <div id="app">
        @component('components.header')
        @endcomponent

        @component('components.flash')
        @endcomponent

        <main>
            <div class="container-fruid h-100 p-2 d-flex flex-column">
                @yield('content')
            </div>
        </main>

        @component('components.footer')
        @endcomponent
    </div>
</body>
</html>