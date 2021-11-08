<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $transaksi = new Transaksi;
        return response($transaksi->with('barang.kategori')->get())->header('Content-Type','application/json');
    }

    public function store(Request $request){
        $validData = Validator::make($request->all(),[
            'barang' => 'required',
            'stok' => 'required',
            'jumlah_terjual' => 'required',
            'tanggal_transaksi' => 'required',
        ]);
        if($validData->fails()){
            $data['error'] = true;
            $data['messages'] = $validData->errors()->messages();
            return response($data)->header('Content-Type', 'application/json');
        }else{

            $trx = new Transaksi;
            $trx->barang         = $request->input('barang');
            $trx->stok           = $request->input('stok');
            $trx->jumlah_terjual = $request->input('jumlah_terjual');
            $trx->tanggal_transaksi        = $request->input('tanggal_transaksi');
            $trx->save();

            return "Data berasil di input";
        }
    }

    public function update(Request $request){
        $validData = Validator::make($request->all(),[
            'id_transaksi' => 'required'
        ]);
        if($validData->fails()){
            $data['error'] = true;
            $data['messages'] = $validData->errors()->messages();
            return response($data)->header('Content-Type', 'application/json');
        }else{
            $id = $request->input('id_transaksi');
            $old = Transaksi::where('id_transaksi', $id)->get();
            $data = [
                'barang' => $request->input('barang')?$request->input('barang'):$old[0]->barang,
                'stok' => $request->input('stok')?$request->input('stok'):$old[0]->stok,
                'jumlah_terjual' => $request->input('jumlah_terjual')?$request->input('jumlah_terjual'):$old[0]->jumlah_terjual,
                'tanggal_transaksi' => $request->input('tanggal_transaksi')?$request->input('tanggal'):$old[0]->tanggal_transaksi,
            ];
            $trx = new Transaksi;
            $trx->where('id_transaksi',$id)->update($data);

            return "Data berasil di update";
        }
    }


    public function delete(Request $request){
        $validData = Validator::make($request->all(), ['id_transaksi'=>'required']);
        if($validData->fails()){
            $data['error'] = true;
            $data['messages'] = $validData->errors()->messages();
            return response($data)->header('Content-Type', 'application/json');
        }else{
            $id = $request->input('id_transaksi');

            $trx = new Transaksi;
            $trx->where('id_transaksi',$id)->delete();

            return "Data berasil dihapus";
        }
    }
}
