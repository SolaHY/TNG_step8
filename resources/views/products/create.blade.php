@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">

    <h1>商品新規登録</h1>
    {{-- エラーメッセージを出力 --}}
    @foreach($errors->all() as $error)
    <p class="error">{{ $error }}</p>
    @endforeach

    <div class="col-md-8">
      <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
          <label>
            商品名:
            <div>
              <input type="text" name="product_name">
            </div>
          </label>
        </div>


        <div class="form-group">
          <label for="company-id">{{ __('メーカー') }}</label>
          <select class="form-control" id="company-id" name="company_id">
            @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
          </select>
        </div>



        <div>
          <label>
            価格:
            <div>
              <input type="text" name="price">
            </div>
          </label>
        </div>

        <div>
          <label>
            在庫数:
            <div>
              <input type="text" name="stock">
            </div>
          </label>
        </div>


        <div>
          <label>
            コメント:
            <div>
              <textarea type="text" name="comment" rows="5" cols="80">{{ old('comment') }}</textarea>
              @if ($errors->has('comment'))
              <div class="text-danger">
                {{ $errors->first('comment') }}
              </div>
              @endif
            </div>
          </label>
        </div>


        <div>
          <label>
            商品画像:
            <input type="file" name="img_path">
          </label>
        </div>

        <button type="submit">登録</button>

        <button type="submit" name="back" value="back"><a href="{{route('products.index')}}">戻る</a></button>
      </form>
    </div>
  </div>
</div>
@endsection