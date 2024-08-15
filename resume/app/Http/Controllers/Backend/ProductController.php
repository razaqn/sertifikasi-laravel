<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::orderBy('id')->get();
        return view('backend.product.index', compact('products'));
    }

    public function create()
    {
        return view('backend.product.create');
    }

    public function create_process(Request $request)
    {
        request()->validate([
            'name'         =>  'required',
            'id_category'  =>  'required',
        ]);

        Product::create([
            'name'        => $request->name,
            'id_category' => $request->id_category,
        ]);

        return redirect()->route('backend.manage.product')->with('success', 'Item created successfully');
    }

    public function edit($id = null)
    {
        if ($id == null){
            return redirect()->route('backend.manage.product')->with('error', "the ID is empty");
        } else{
            $item = Product::find($id);
            if ($item) {
                return view('backend.product.edit', compact('item'));
            } else {
                return redirect()->route('backend.manage.product')->with('error', "the ID is invalid");
            }
        }
    }

    public function edit_process(Request $request)
    {
        request()->validate([
            'name'         =>  'required',
            'id_category'  =>  'required',
        ]);

        Product::where('id', $request->id)->update(([
            'name'        => $request->name,
            'id_category' => $request->id_category,
        ]));

        return redirect()->route('backend.manage.product')->with('success', 'Item Edited Successfully');
    }

    public function destroy(Request $request)
    {
        $product = Product::find($request->id)->delete();

        return redirect()->route('backend.manage.product')->with('success', 'Item deleted successfully');
    }

}
