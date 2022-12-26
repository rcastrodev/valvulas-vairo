<?php

namespace App\Http\Controllers;

use App\Page;
use App\Image;
use App\Content;
use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    public function content()
    {
        return view('administrator.category.content');
    }

    public function create()
    {
        return view('administrator.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/category','public');


        $data['outstanding'] = ($request->has('outstanding')) ? '1' : '0';
        $data['product_direct'] = ($request->has('product_direct')) ? '1' : '0';
        $category = Category::create($data);

        return redirect()->route('category.content.edit', ['id' => $category->id])->with('message', 'Categoría creada');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('administrator.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->all();
        $element = Category::find($id);
        if($request->hasFile('image')){

            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/category','public');
        } 

        $data['outstanding'] = ($request->has('outstanding')) ? '1' : '0';
        $data['product_direct'] = ($request->has('product_direct')) ? '1' : '0';
        $element->update($data);
        return redirect()->route('category.content.edit', ['id' => $element->id])->with('message', 'Actualizada');
    }

    public function find($id)
    {
        $content = Category::find($id);
        return response()->json(['content' => $content]);
    }

    public function destroy($id)
    {
        $element = Category::find($id);
        
        if(Storage::disk('public')->exists($element->image))
            Storage::disk('public')->delete($element->image);

        $element->delete();
        return response()->json([], 200);
    }

    public function getList()
    {
        $categories = Category::orderBy('order', 'ASC');
        return DataTables::of($categories)
        ->editColumn('image', function($category) {
            return '<img src="'.asset($category->image).'" width="150" height="50">';
        })
        ->addColumn('actions', function($category) {
            return '<a href="'. route('category.content.edit', ['id' => $category->id]) .'" class="btn btn-sm btn-primary rounded-pill far fa-edit"></a><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroy('.$category->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'image'])
        ->make(true);
    }

}
