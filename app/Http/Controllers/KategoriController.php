<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index(Request $request){
        $kategori = new Kategori;
        return $kategori->get();
    } 

    public function store(Request $request){
        $validData = Validator::make($request->all(), [
            'nama_kategori' => 'required'
        ]);
        if ($validData->fails()) {
            $data['error'] = true;
            $data['messages'] = $validData->errors()->messages();
            return response($data)->header('Content-Type', 'application/json');
        }else{
            $kategori = new Kategori;
            $nama_kategori = $request->input('nama_kategori');
            $kategori->nama_kategori = $nama_kategori; 
            if($kategori->save()){
                return "Data $nama_kategori berhasil ditambahkan";
            }else{
                return "Data $nama_kategori gagal ditambahkan";
            }
        }
    }

    public function update(Request $request){
        $validData = Validator::make($request->all(), [
            'nama_kategori' => 'required',
            'id_kategori' => 'required'
        ]);
        if ($validData->fails()) {
            $data['error'] = true;
            $data['messages'] = $validData->errors()->messages();
            return response($data)->header('Content-Type', 'application/json');
        }else{
            $id = $request->input('id_kategori');
            $kategori = new Kategori;
            $nama_kategori = $request->input('nama_kategori');

            if(
                $kategori
                        ->where('id_kategori',$id)
                        ->update([
                            'nama_kategori'=>$nama_kategori
                        ])
            ){
                return "Data $nama_kategori berhasil diubah";
            }else{
                return "Data $nama_kategori gagal diubah";
            }
        }
    }

    public function delete(Request $request){
        $validData = Validator::make($request->all(), [
            'id_kategori' => 'required'
        ]);
        if ($validData->fails()) {
            $data['error'] = true;
            $data['messages'] = $validData->errors()->messages();
            return response($data)->header('Content-Type', 'application/json');
        }else{
            $id = $request->input('id_kategori');
            $kategori = new Kategori;

            if(
                $kategori
                        ->where('id_kategori',$id)
                        ->delete()
            ){
                return "Data berhasil dihapus";
            }else{
                return "Data gagal dihapus";
            }
        }
    }
}
