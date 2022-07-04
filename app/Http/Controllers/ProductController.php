<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductImageRequest;
use App\Http\Requests\ProductEditRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use App\Services\FileUploadService;

class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    //商品一覧
    public function index(Request $request) {
        //検索フォームに入力された値を取得
        $keyword = $request->input('keyword');
        $company_id = $request->input('company_id');
        $query = Product::query();

        if(!empty($company_id)) {
            $query->where('company_id', $company_id)->get();
        }
        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%")->get();
        }
        $products = $query->where('user_id', \Auth::user() -> id) ->get();
        return view('products.index', [
            'products' => $products,
            'companies' => Company::all(),
            'keyword' => $keyword,
        ]);
    }


    //新規出品フォーム
    public function create() {
        return view('products.create', [
            'companies' => Company::all(),
        ]);
    }

    // 商品追加処理
    public function store(ProductRequest $request, FileUploadService $service) {
  //画像投稿処理
        $path = $service->saveImage($request->file('img_path'));
        Product::create([
            'user_id' => \Auth::user()->id,
            'product_name' => $request->product_name,
            'comment' => $request->comment,
            'price' => $request->price,
            'stock' => $request->stock,
            'img_path' => $path,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('products.index', \Auth::user());
    }


    //商品詳細
    public function show($id) {
        $product = Product::find($id);
        return view('products.show', [
            'product' => $product]);
    }

   
    //商品編集フォーム
    public function edit($id) {
        $product = Product::find($id);
        return view('products.edit',[
            'product' => $product,
            'companies' => Company::all()]);
    }


    //商品更新処理
    public function update($id, ProductEditRequest $request, FileUploadService $service)  {
        $product = Product::find($id);
        $product->update(
        $request->only([
            'id','product_name',  'company_name', 'price','stock', 'comment','img_path'])
        );
        $path = $service->saveImage($request->file('img_path'));
        if($product->img_path !== '') {
            \Storage::disk('public')->delete($product->img_path);
          }
          $product->update([
            'img_path' => $path, // ファイル名を保存
          ]);
        return redirect()->route('products.edit', $product);
    }


    //削除
    public function destroy($id) {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index', \Auth::user());
      }
}
