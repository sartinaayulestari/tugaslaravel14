<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galeri;
use App\KategoriGaleri;

class GaleriController extends Controller
{
    public function index(){
        
        $listGaleri=Galeri::all(); 
    
        
        return view('galeri.index' ,compact('listGaleri'));
    }

    public function show($id){

        $Galeri=Galeri::find($id);


        return view('galeri.show', compact('Galeri'));
    }
    public function create(){

        $kategoriGaleri= KategoriGaleri::pluck('nama', 'id');
        

        return view('galeri.create',compact('kategoriGaleri'));
    }

    public function store(Request $request){
        $input=$request->except('path');

        $Galeri=Galeri::create($input);

        if ($request->has('path')){
            $file=$request->file('path');
            $filename=$Galeri->id.'.'.$file->getClientOriginalExtension();
            $path=$request->path->storeAS('public/galeri',$filename,'local');
            $Galeri->path="storage". substr($path,strpos($path, '/'));
            $Galeri->save();
        }

        return redirect(route('galeri.index'));
    }
    public function edit($id){
        $Galeri=Galeri::find($id);
        $kategoriGaleri= KategoriGaleri::pluck('nama', 'id');

        if(empty($Galeri)){
            return redirect(route('galeri.index'));
        }
        return view('galeri.edit', compact('Galeri', 'kategoriGaleri'));
    }
    public function update($id,Request $request){
        $Galeri=Galeri::find($id);
        $input= $request->all();

        if(empty($Galeri)){
            return redirect(route('galeri.index'));
        }

        $Galeri->update($input);

        return redirect(route('galeri.index'));
    }
    public function destroy($id){
        $Galeri=Galeri::find($id);
     
        if(empty($Galeri)){
            return redirect(route('galeri.index'));
        }
        $Galeri->delete();
        return redirect(route('galeri.index'));
    }
    public function trash(){
    
        $listGaleri=Galeri::onlyTrashed(); 
        return view('galeri.index' ,compact('listGaleri'));
    }
}

