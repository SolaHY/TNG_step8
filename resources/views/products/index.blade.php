@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


        <h1>商品一覧画面</h1>
        <div class="col-md-8">

            <div>
                <form action="{{ route('products.index') }}" method="GET">
                    @csrf
                    <input type="text" name="keyword" value="{{ $keyword }}">

                    <div>
                        <label>
                            <div>
                                <select class="form-control" id="company-id" name="company_id">
                                    @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" @if($company=='{{ $company->company_name }}' ) selected @endif>{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </label>
                    </div>

                    <input type="submit" value="検索">
                </form>
            </div>



            <div>
                <button type="submit" name="create" value="create"><a href="{{route('products.create')}}">新規出品</a></button>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>商品ID</th>
                        <th>商品名</th>
                        <th>価格</th>
                        <th>在庫数</th>
                        <th>メーカー名</th>
                        <th>画像</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->stock}}</td>
                        <td>{{$product->company->company_name}}</td>
                        <td>
                            @if($product->img_path !== '')
                            <img src="{{ asset('storage/' . $product->img_path) }}">
                            @else
                            <img src="{{ asset('images/no_image.png') }}">
                            @endif
                        </td>

                        <td><button type="submit" name="show" value="show"><a href="{{route('products.show', $product)}}">商品詳細</a></button></td>
                        <td>
                            <div>
                                <form class="delete" method="post" action="{{ route('products.destroy', $product) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input class="del_button" type="submit" value="削除" onClick="delete_alert(event);return false;">
                                </form>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
