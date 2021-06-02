@component('components.header')
@endcomponent
<p>

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 20px; font-weight:bold; color:black; text-align: center;">{{ __('新規投稿') }}</div>
  
                <div class="card-body">
                    {{ Form::open(['route' => 'post.store','enctype'  => "multipart/form-data"]) }}
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                        
                            <div class="col-md-6" style="width: 100%;">
                              {{ Form::label('title', 'タイトル(必須)   ') }}
                            
                          {{ Form::text('title', null, ['placeholder'=>'タイトルを入力', 'class'=>'form-control']) }}
                          <p>
                        </div>
                          <div class="col-md-6" style="width: 100%;">
                            {{ Form::label('text', '内容(必須)   ') }}
                        {{ Form::text('text', null, ['placeholder'=>'内容を入力', 'class'=>'form-control','rows'=>'10', 'cols'=>'60']) }}
                        <p> 
                      </div>
                       <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              {{ Form::submit('投稿ボタン', ['class' => 'btn btn-sm btn-outline-secondary']) }}
                              <a class="btn btn-sm btn-outline-secondary" href='/'>一覧に戻る</a>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
  
  
