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
      <form method="POST" action="/posts">
        @csrf
        <div class="form-group">
          <p>Title</p>
          <input type="text" name="post[title]"/>
          <p>Body</p>
          <textarea name="post[body]"></textarea>
          <br>
          <p>Tag</p>
          <input type="text" name="tag_name" />
          <br>
          <p><input type="submit" value="投稿する"/></p>
        </div><!-- /.form-group -->
        <a href="/posts">[back]</a>
      </form> 
    </body>
</html>