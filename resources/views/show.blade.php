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
          <div class="post">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->body }}</p>
            <p>{{ $post->updated_at }}</p>
            @if($post->likes()->where('user_id', Auth::id())->exists())
              <div class="like">
                <form action="/post/{{ $post->id }}/unlike" method="POST">
                  @csrf
                  <button id="like">いいね解除</button>
                  <p>いいね数:{{ $post->likes()->count() }}</p>
                </form>
              </div><!-- /.like -->
            @else
              <div class="like">
                <form action="/post/{{ $post->id }}/like" method="POST">
                  @csrf
                    <button id="like">いいね</button>
                    <p>いいね数:{{ $post->likes()->count() }}</p>
                </form>
              </div><!-- /.like -->
            @endif
            </div><!-- /.post -->
          <br>
      <a href="/posts">[back]</a>
    </body>
</html>