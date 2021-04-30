@component('components.header')
@endcomponent

<div class=container style="padding-left: 475px;padding-top: 10px;">
    <h2>新規投稿</h2>
    <div class='form-wrapper'>
      <form enctype="multipart/form-data" action="/words" accept-charset="UTF-8" method="post"><input type="hidden" name="authenticity_token" value="XGfaLXG7AaqeA2l5VicjU3mWVjAes0gPc5U7oe3bpJACi4drzh_0qWb0vfRV31d3NKh4Qd0FYjQuby0zuhNhhQ" />
  
    <div class="field form-group">
      <label for="word_word">ニックネーム(必須)</label><br />
        <textarea id="article_title" class="form-control4" type="text" rows="10" cols="60" name="word[word]">
</textarea>
    </div>
    <p>
      <div class="field form-group">
        <label for="word_yomi">内容 (必須)</label><br />
          <textarea id="article_title" class="form-control4" type="text" rows="10" cols="60" name="word[yomi]">
</textarea>
      </div>
      <p>
        <div class="field form-group">
          <label for="word_mean">カテゴリー(必須)</label><br />
            <textarea id="article_title" class="form-control2" type="text" rows="10" cols="60" name="word[mean]">
</textarea>
        </div>
        <p>
          <div class="field"> <label>画像(任意)</label><br />
            <input id="inputFile" type="file" name="word[image]" />
          </div>
          <p>
            <div class="actions text-right">
              <input type="submit" name="commit" value="投稿する" class="btn btn-sm btn-outline-secondary" data-disable-with="投稿する" />
            </div>
            <p> </p>
            <a class="btn btn-sm btn-outline-secondary" href="#">キャンセル</a>
</form>              <p>
  </body>
</html>
