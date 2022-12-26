<?php

namespace App\Http\Controllers;

use App\Page;
use App\Image;
use App\Content;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    protected $page;

    public function content()
    {
        $content = Content::where('section_id', 10)->first();
        return view('administrator.clients.content', compact('content'));
    }
    
    public function createInfo(Request $request)
    {
        $data = $request->all();

        if($request->hasFile('image'))            
            $data['image'] = $request->file('image')->store('images/clients','public');

        Content::create($data);
        return back()->with('mensaje', 'creado con exito');
    }

    public function updateInfo(Request $request)
    {
        $element= Content::find($request->input('id'));
        $data   = $request->all();
        
        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/downloads','public');
        } 

        $element->update($data);

        return back()->with('mensaje', 'Contenido actualizado con exito');
    }


    public function destroySlider($id)
    {
        $element = Content::find($id);
        
        if(Storage::disk('public')->exists($element->image))
            Storage::disk('public')->delete($element->image);
        
        $element->delete();

        return response()->json([], 200);
    }

    public function sliderGetList()
    {
        return DataTables::of(Content::where('section_id', 9)->orderBy('order', 'ASC'))
        ->editColumn('image', function($slider){
            return '<img src="'.asset($slider->image).'" class="img-fluid" style="max-width:100px">';
        })
        ->addColumn('actions', function($slider) {
            return '<button type="button" class="btn btn-sm btn-primary rounded-pill far fa-edit" data-toggle="modal" data-target="#modal-update-element" onclick="findContent('.$slider->id.')"></button><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroy('.$slider->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'image', 'content_3'])
        ->make(true);
    }

    public function images($id)
    {
        $elements = Content::find($id)->images()->where('name', 'image')->orderBy('order', 'ASC');
        return DataTables::of($elements)
        ->editColumn('image', function($element) {
            return '<img src="'.asset($element->image).'" width="150" height="160">';
        })
        ->addColumn('actions', function($element) {
            return '<button type="button" class="btn btn-sm btn-primary rounded-pill far fa-edit" data-toggle="modal" data-target="#modal-update-image" onclick="findContentImage('.$element->id.')"></button><button class="btn btn-sm btn-danger rounded-pill" onclick="modalImageDestroy('.$element->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'image'])
        ->make(true);
    }

    public function imagesStore(Request $request)
    {
        $element   = Content::find($request->input('content_id'));
        $data       = $request->all();

        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/clients/images','public');
        
        unset($data['content_id']);
        $element->images()->create($data);
        return response()->json([], 201);
    }

    public function imagesUpdate(Request $request)
    {
        $element = Image::find($request->input('id'));
        $data    = $request->all();

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/clients/images','public');
        }   
        
        $element->update($data);
        return response()->json([], 200);
    }

    public function findImage($id)
    {
        $image = Image::find($id);
        return response()->json(['content' => $image]);
    }

    public function imageDestroy($id)
    {
        $element = Image::find($id);
        if ($element) {
            if(Storage::disk('public')->exists($element->image))
            Storage::disk('public')->delete($element->image);

            $element->delete();
        }
        

        return response()->json([], 200);
    }
}
