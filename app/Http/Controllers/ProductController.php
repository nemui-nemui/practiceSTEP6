<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $keyword = $request->input('keyword');
        $company_id = $request->input('company_id');

        $query = Product::query();

        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }

        if (!empty($company_id)) {
            $query->where('company_id', $company_id);
        }

        $products = $query->with('company')->latest() -> paginate(5);

        $companies = Product::with('company')->get()->pluck('company')->unique('id');

        return view('list' , compact('products' , 'companies' , 'keyword'))
            ->with('page_id',request()->page)
            ->with('i' , (request()->input('page' , 1) - 1) * 5);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $companies = Product::with('company')->get()->pluck('company')->unique('id');
        return view('create', compact('companies')); 
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'productName' => 'required',
            'company' => 'required',
            'price' => 'required|integer|regex:/^[0-9]+$/',
            'stock' => 'required|integer|regex:/^[0-9]+$/',
            'company' => 'nullable|required_without:new_company',
            'new_company' => 'nullable|required_without:company|string|max:255'
        ]);

        DB::beginTransaction();

        try{
            if ($request->input('company') === 'new') {
                if ($request->input('new_company')) {
                    $newCompany = new Company();
                    $newCompany->company_name = $request->input('new_company');
                    $newCompany->save(); // 新しいメーカーを保存
            
                    // 新しく登録したメーカーのIDを使う
                    $companyId = $newCompany->id;                   
                } else {
                    // 既存のメーカーIDを使用
                    return redirect()->back()->withErrors(['new_company' => '入力してください']);
                }

            } else {
                // 既存のメーカーIDを使用
                $companyId = $request->input('company');
            }

            $product = new Product;
            $product->product_name = $request->input(["productName"]);
            $product->company_id = $companyId;
            $product->price = $request->input(['price']);
            $product->stock = $request->input(['stock']);
            $product->comment = $request->input(['comment']);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName); // imagesフォルダに保存
                $product->img_path = 'images/' . $imageName; // 画像パスをデータベースに保存
            }

            $product->save();

            DB::commit();

            return redirect()->route('products.index');  //
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('company')->findOrFail($id);
        $companies = Company::all();
        return view('show', compact('product', 'companies'))
            ->with('page_id',request()->page_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $product = Product::find($id);
       $companies = Company::all();
       return view('edit', compact('product' , 'companies'))
            ->with('page_id',request()->page_id);//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'productName' => 'required',
            'company' => 'required',
            'price' => 'required|integer|regex:/^[0-9]+$/',
            'stock' => 'required|integer|regex:/^[0-9]+$/',
        ]);

        DB::beginTransaction();
        try {

            $product->product_name = $request->input(["productName"]);
            $product->company_id = $request->input(['company']);
            $product->price = $request->input(['price']);
            $product->stock = $request->input(['stock']);
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $product->img_path = 'images/' . $imageName;
            }

            $product->save();

            DB::commit();

            return redirect()->route('products.edit', ['id' => $product->id]);

        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::beginTransaction();

        try{
            Product::destroy($id);
            DB::commit();
            return redirect()->route('products.index');

        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    }
}