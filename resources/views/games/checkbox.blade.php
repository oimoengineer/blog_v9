<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel9</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <script src="https://cdn.jsdelivr.net/npm/vue@2.7.10/dist/vue.js"></script>
    </head>
    <body>
        <h1>メモを作成する</h1>
        <a href="/games/create">新しいゲームを登録する</a>
        <form method="POST" action="/games/notes" id="checkbox">
        @csrf
            @foreach($categories as $category)
            <dl class="gamelist">
              <dt><label><input type="checkbox" v-model="checked" @change="onChange(checked)" name="note[category_id]" value="{{ $category->id }}">{{ $category->name }}</label></dt>
              @{{checked}}
                @foreach($games as $game)
                  @if($category->id === $game->category_id)
                        <dd><label><input type="checkbox" v-model="checked" name="note[game_id]" value="{{ $game->id }}">{{ $game->name }}</label></dd>
                  @endif
                @endforeach
            </dl>
            @endforeach
            <textarea placeholder="メモ" rows="10" cols="60" name="note[memo]"></textarea>
            <br>
            <button>create</button>
        </form>
    </body>
    <script>
    
        const CheckBox = new Vue({
            el: '#checkbox',
            data(){
                    return {
                        checked: false
                    }
            }
        });
            
    </script>
</html>