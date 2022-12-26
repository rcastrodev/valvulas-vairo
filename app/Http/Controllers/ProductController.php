<?php

namespace App\Http\Controllers;

use App\Page;
use App\Image;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function content()
    {
        return view('administrator.product.content');
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('administrator.product.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        if($request->hasFile('data_sheet')) 
            $data['data_sheet'] = $request->file('data_sheet')->store('images/data-sheet', 'public');

        $product = Product::create($data);

        return redirect()
            ->route('product.content.edit', ['id' => $product->id])
            ->with('mensaje', 'Producto creado');

    }

    public function edit($id)
    {   
        $categories = Category::orderBy('name', 'ASC')->get();
        $product = Product::findOrFail($id);
        return view('administrator.product.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request)
    {        
        $data = $request->all();
        $product = Product::find($request->input('id'));

        if($request->hasFile('data_sheet')){
            if (Storage::disk('public')->exists($product->data_sheet))
                    Storage::disk('public')->delete($product->data_sheet);
            
            $data['data_sheet'] = $request->file('data_sheet')->store('images/data-sheet', 'public');
        }
        $data['outstanding'] = ($request->has('outstanding')) ? '1' : '0';
        $product->update($data);                        
        return back()->with('mensaje', 'Producto editado correctamente');
    }

    public function destroy($id)
    {
        $element = Product::find($id);
        if (Storage::disk('public')->exists($element->data_sheet))
            Storage::disk('public')->delete($element->data_sheet);

        $element->delete();
    }

    public function find($id)
    {
        $content = Product::find($id);
        return response()->json(['content' => $content]);
    }

    public function getList()
    {
        $products = Product::orderBy('order', 'ASC');
        return DataTables::of($products)
        ->editColumn('description', function($product) {
            return $product->description;
        })
        ->addColumn('category', function($product) {
            return $product->category->name;
        })
        ->addColumn('actions', function($product) {
            return '<a href="'.route('product.content.edit', ["id" => $product->id]).'" class="btn btn-sm btn-primary rounded-pill far fa-edit"></a><button class="btn btn-sm btn-danger rounded-pill" onclick="modalProductDestroy('.$product->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'description'])
        ->make(true);
    }

    public function fichaTecnica($id)
    {
        $producto = Product::findOrFail($id);  
        
        if (Storage::disk('public')->exists($producto->data_sheet)) {
            return Response::download($producto->data_sheet);  
        }else{
            return back();
        }
        
    }

    public function borrarFichaTecnica($id)
    {
        $product = Product::findOrFail($id); 
        
        if(Storage::disk('public')->exists($product->data_sheet))
            Storage::disk('public')->delete($product->data_sheet);

        $product->data_sheet = null;
        $product->save();

        return response()->json([], 200);
    }

    public function imagesProduct($id)
    {
        $product = Product::find($id)->images()->where('name', 'image')->orderBy('order', 'ASC');
        return DataTables::of($product)
        ->editColumn('image', function($element) {
            return '<img src="'.asset($element->image).'" width="150" height="160">';
        })
        ->addColumn('actions', function($element) {
            return '<button type="button" class="btn btn-sm btn-primary rounded-pill far fa-edit" data-toggle="modal" data-target="#modal-update-element" onclick="findContentImageProduct('.$element->id.')"></button><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroyProduct('.$element->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'image'])
        ->make(true);
    }

    public function findImageProduct($id)
    {
        $image = Image::find($id);
        return response()->json(['content' => $image]);
    }

    public function imagesStore(Request $request)
    {
        $product   = Product::find($request->input('product_id'));
        $data       = $request->all();

        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/product/images','public');
        
        unset($data['product_id']);
        $product->images()->create($data);
        return response()->json([], 201);
    }

    public function imagesUpdate(Request $request)
    {
        $element = Image::find($request->input('id'));
        $data    = $request->all();

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/product/images','public');
        }   
        
        $element->update($data);
        return response()->json([], 200);
    }

    public function imageDestroyProduct($id)
    {
        $element = Image::find($id);
        
        if(Storage::disk('public')->exists($element->image))
            Storage::disk('public')->delete($element->image);

        $element->delete();
        return response()->json([], 200);
    }

    public function applicationProduct($id)
    {
        $product = Product::find($id)->images()->where('name', 'application')->orderBy('order', 'ASC');
        return DataTables::of($product)
        ->editColumn('image', function($element) {
            return '<img src="'.asset($element->image).'" width="150" height="160">';
        })
        ->addColumn('actions', function($element) {
            return '<button type="button" class="btn btn-sm btn-primary rounded-pill far fa-edit" data-toggle="modal" data-target="#modal-update-application" onclick="findContentApplicationProduct('.$element->id.')"></button><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroyProduct('.$element->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'image'])
        ->make(true);
    }


    public function applicationStore(Request $request)
    {
        $product   = Product::find($request->input('product_id'));
        $data       = $request->all();

        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/product/application','public');
        
        unset($data['product_id']);
        $product->images()->create($data);
        
        return back()->with('mensaje', 'Característica subida');

    }

    public function applicationUpdate(Request $request)
    {
        $element = Image::find($request->input('id'));
        $data    = $request->all();

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/product/application','public');
        }   
        
        $element->update($data);
        return back()->with('mensaje', 'Característica se ha actualizado');
    }

    public function findApplicationProduct($id)
    {
        $image = Image::find($id);
        return response()->json(['content' => $image]);
    }

}
