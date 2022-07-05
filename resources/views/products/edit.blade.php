@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">

    <h1>商品情報編集</h1>
    {{-- エラーメッセージを出力 --}}
    @foreach($errors->all() as $error)
    <p class="error">{{ $error }}</p>
    @endforeach

    <div class="col-md-8">
      <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div>
          <label>
            商品名:
            <div>
              <input type="text" name="product_name" value="{{$product->product_name}}">
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
              <input type="text" name="price" value="{{$product->price}}">
            </div>
          </label>
        </div>


        <div>
          <label>
            在庫数:
            <div>
              <input type="text" name="stock" value="{{$product->stock}}">
            </div>
          </label>
        </div>


        <div>
          <label>
            コメント:
            <div>
              <textarea type="text" name="comment" rows="5" cols="80">{{$product->comment}}</textarea>
            </div>
          </label>
        </div>


        <div>
          <label>
            商品画像:
            @if($product->img_path !== '')
            <img src="{{ asset('storage/' . $product->img_path) }}">
            @else
            <img src="{{ asset('images/no_image.png') }}">
            @endif
            <input type="file" name="img_path" value="{{$product->img_path}}">
          </label>
        </div>


        <input type="submit" value="更新">
        <button type="submit" name="back" value="back"><a href="{{route('products.show', $product)}}">戻る</button>

      </form>
    </div>
  </div>
</div>
@endsection
