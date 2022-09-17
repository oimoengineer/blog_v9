<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel9</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <form method='POST' action="/games">
            @csrf
            <h1>Game追加</h1>
            <p>Gameの種類を選択してください</p>
            <select name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <p>ゲーム名を入力してください</p>
            <input placeholder="ゼルダの伝説ブレスオブザワイルド" name="game_name" size="50" style="height: 2rem;"/>
            <br>
            <br>
            <button>create</button>
        </form>
    </body>
</html>