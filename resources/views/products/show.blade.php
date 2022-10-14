@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>商品詳細</h1>
        <div class="col-md-8">
            <div class="product_content">
                <div class="product_body">
                    <ul class="products">

                        <li class="product">
                            <div class="product_detail">
                                商品名
                            </div>
                        </li>
                        <div>
                            {{ $product->product_name }}
                        </div>

                        <li class="product">
                            <div class="product_detail">
                                メーカー
                            </div>
                        </li>
                        <div>
                            {{ $product->company->company_name }}
                        </div>

                        <li class="product">
                            <div class="product_detail">
                                価格
                            </div>
                        </li>
                        <div>
                            {{$product->price}}円
                        </div>

                        <li class="product">
                            <div class="product_detail">
                                在庫
                            </div>
                        </li>
                        <div>
                            {{ $product->stock }}
                        </div>

                        <li class="product">
                            <div class="product_detail">
                                コメント
                            </div>
                        </li>
                        <div>
                            {{ $product->comment }}
                        </div>
                    </ul>

                    <div>
                        <div>
                            商品画像:
                            @if($product->img_path !== '')
                            <img src="{{ asset('storage/images/' . $product->img_path) }}">
                            @else
                            <img src="{{ asset('storage/images/no_image.png') }}">
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <button type="submit" name="edit" value="edit"><a href="{{route('products.edit', $product)}}">編集</a></button>
            <button type="submit" name="back" value="back" id="back"><a href="{{route('products.index')}}">戻る</a></button>
        </div>
    </div>
</div>
@endsection