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
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //商品一覧
    public function index(Request $request)
    {
        return view('products.index', [
            'companies' => Company::all(),
        ]);
    }

    //検索機能
    public function search(Request $request)
    {
        Log::info('test');
        // error_log(var_export($request->keyword, true), 3, "./debug.txt");
        // //検索フォームに入力された値を取得
        // $keyword = $request->input('keyword');
        // $company_id = $request->input('company_id');
        // $price = $request->input('price');
        // $stock = $request->input('stock');
        // $from_price = $request->input('from_price');
        // $to_price = $request->input('to_price');
        // $from_stock = $request->input('from_stock');
        // $to_stock = $request->input('to_stock');
       
   
        // $query = Product::query();

        // $query->join('companies', 'products.company_id', '=', 'companies.id')
        //     ->select('products.*', 'companies.company_name');

        // //メーカー検索
        // if (!empty($company_id)) {
        //     $query->where('company_id', $company_id);
        // }
        // //商品名検索
        // if (!empty($keyword)) {
        //     $query->where('product_name', 'LIKE', "%{$keyword}%");
        // }
        // //価格検索
        // if (!empty($from_price)) {
        //     $query->where('price', '>=', $from_price);
        // }

        // if (!empty($to_price)) {
        //     $query->where('price', '<=', $to_price);
        // }

        // //在庫検索
        // if (!empty($from_stock)) {
        //     $query->where('stock', '>=', $from_stock);
        // }

        // if (!empty($to_stock)) {
        //     $query->where('stock', '<=', $to_stock);
        // }

        // $products = $query->where('user_id', \Auth::user()->id)->get();

        // return  response()->json($products);
    }


    //削除
    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete();
        return;
    }


    //新規出品フォーム
    public function create()
    {
        return view('products.create', [
            'companies' => Company::all(),
        ]);
    }

    
    // 商品追加処理
    public function store(ProductRequest $request, FileUploadService $service)
    {
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
            public function show($id)
    {
        
        $product = Product::find($id);
        return view('products.show', [
            'product' => $product
        ]);
    }

    //商品編集フォーム
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', [
            'product' => $product,
            'companies' => Company::all()
        ]);
    }

    //商品更新処理
    public function update($id, ProductEditRequest $request, FileUploadService $service)
    {
        $product = Product::find($id);
        $product->update(
            $request->only([
                'id', 'product_name',  'company_name', 'price', 'stock', 'comment', 'img_path'
            ])
        );
        $path = $service->saveImage($request->file('img_path'));
        if ($product->img_path !== '') {
            \Storage::disk('public')->delete($product->img_path);
        }
        $product->update([
            'img_path' => $path, // ファイル名を保存
        ]);
        return redirect()->route('products.edit', $product);
    }

    //購入処理
    public function purchase(SaleRequest $request)
    {
        $sale = Sale::create([
            'user_id' => \Auth::user()->id,
            'product_id' => $request->id,
        ]);
        return redirect()->route('products.purchase', $request->id);
    }
}
