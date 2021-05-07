@component('components.header')
@endcomponent
<p>

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('新規登録') }}</div>
  
                <div class="card-body">
                   
                        {{ Form::open(['route' => 'post.store']) }}
                        <div class="form-group row">
                            <div class="col-md-6">
                              {{ Form::label('title', 'タイトル   ') }}
                              
                          {{ Form::text('title', null, ['placeholder'=>'内容を入力']) }}
                          </div>
                        </div>
  
                        <div class="form-group row">
                          <div class="col-md-6">
                            {{ Form::label('text', '内容   ') }}
                            
                        {{ Form::text('text', null, ['placeholder'=>'内容を入力']) }}
                        </div>
                      </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              {{ Form::submit('投稿ボタン', ['class' => 'btn btn-primary']) }}
                              <a href='/'>一覧に戻る</a>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
  
  
