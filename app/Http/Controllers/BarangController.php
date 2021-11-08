<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $barang = Barang::all();
        return response($barang->load(['kategori']))->header('Content-Type','application/json');
    }

    public function store(Request $request){
        $validData = Validator::make($request->all(),[
            'nama_barang' => 'required',
            'kategori' => 'required'
        ]);
        if($validData->fails()){
            $data['error'] = true;
            $data['messages'] = $validData->errors()->messages();
            return response($data)->header('Content-Type', 'application/json');
        }else{

            $barang = new Barang;
            $barang->nama_barang    = $request->input('nama_barang');
            $barang->kategori       = $request->input('kategori');
            if($barang->save()){
                return "Data berasil di input";
            }
        }
    }

    public function update(Request $request){
        $validData = Validator::make($request->all(),[
            'id_barang' => 'required'
        ]);
        if($validData->fails()){
            $data['error'] = true;
            $data['messages'] = $validData->errors()->messages();
            return response($data)->header('Content-Type', 'application/json');
        }else{
            $id = $request->input('id_barang');
            $data = [
                'nama_barang' => $request->input('nama_barang')?$request->input('nama_barang'):null,
                'kategori' => $request->input('kategori')?$request->input('kategori'):null,
            ];
            $barang = new Barang;
            $barang->where('id_barang',$id)->update($data);

            return "Data berasil di update";
        }
    }


    public function delete(Request $request){
        $validData = Validator::make($request->all(), ['id_barang'=>'required']);
        if($validData->fails()){
            $data['error'] = true;
            $data['messages'] = $validData->errors()->messages();
            return response($data)->header('Content-Type', 'application/json');
        }else{
            $id = $request->input('id_barang');

            $barang = new Barang;
            $barang->where('id_barang',$id)->delete();

            return "Data berasil dihapus";
        }
    }
}
