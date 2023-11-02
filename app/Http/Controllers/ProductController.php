<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        // return response()->json(['data' => $products[0]->subcategory]);
        return response()->json(['data' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $input = $request->all();
        
        $image_path = $request->file('image')->store('images', 'public');
        $input['image'] = $image_path;

        
        $product = Product::create($input);


        // "title",
        // "article",
        // "description",
        // "image",
        // "brand",
        // "category_id",
        // "subcategory_id",
        // "TNVED",
        // "color",
        // "extra_fileds",
        // "bardoc",
        // "sizes",
        // "docs"
        
        return response()->json(['data'=> [ 'status' => 'Successfully added!' ]]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }


    public function generationBarcode(Request $request){
        $input = $request->all();
        
        $products = Product::all();

        $barcode = rand(100000000000,999999999999);
        foreach($products as $product){
            $bardoc = json_decode($product->bardoc);
            foreach($bardoc as $bardoc_arr){
               if($barcode==$bardoc_arr->barcode){
                    $barcode = rand(100000000000,999999999999);
               } 
            }  
        }


        return response()->json(['barcode'=> [ $barcode ] ]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());
        // "title",
        // "article",
        // "description",
        // "image",
        // "brand",
        // "category_id",
        // "subcategory_id",
        // "TNVED",
        // "color",
        // "extra_fileds",
        // "bardoc",
        // "sizes",
        // "docs"
        
        return response()->json(['data'=> [ 'status'=> 'Successfully edited!' ]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $product)
    {
        $product = Product::findOrFail($product);
        if ($product->delete()) {
            return response()->json(['data'=> [ 'status'=> 'Successfully deleted!'] ]);
        }
        return response()->json(['data'=> [ 'status'=> 'Not deleted'] ]);
    }
}
