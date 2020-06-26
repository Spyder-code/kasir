<?php

namespace App\Http\Controllers;

use App\Company;
use App\Customer;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function index()
    {
        return view('kasir_view.index');
    }

    public function transaksi()
    {
        $transaksi = DB::table('customers')
        ->join('users','users.id','=','customers.id_user')
        ->select('customers.*','users.name as kasir')
        ->get();
        return view('kasir_view.transaksi', compact('transaksi'));
    }

    public function produk()
    {
        $produk = DB::table('products')
        ->join('categories','categories.id','=','products.id_kategori')
        ->select('products.*','categories.nama as kategori')
        ->get();
        return view('kasir_view.produk', compact('produk'));
    }

    public function profile(Request $request)
    {
        return view('kasir_view.profile');
    }

    public function kode(Request $request)
    {
        $nama = auth()->user()->name;
        $nama = $request->kode;
        $output=0;
        $data = Product::query()->where('id', $nama)
        ->get();
        if($data->count()>0){
            return response($data);
        }else{
            return response($output);
        }
    }

    public function addCustomer(Request $request)
    {
        $id = auth()->user()->id;
        $data = new Customer();
        $data->id_user = $id;
        $data->uang = 0;
        $data->save();
        $idUser = $data->id;
        return response($idUser);
    }

    public function addTransaksi(Request $request)
    {
        $a=1;
        $data = new Transaction();
        $data->id_customer = $request->idCustomer;
        $data->id_product = $request->idProduct;
        $data->jumlah = $request->jumlah;
        $data->total_harga = $request->total;
        $data->save();
        // $data = Transaction::query()->where('id_customer', $request->idCustomer)->get();
        $data = DB::table('transactions')
        ->join('products','products.id','=','transactions.id_product')
        ->select('transactions.*','products.nama','products.harga')
        ->where('transactions.id_customer',$request->idCustomer)
        ->get();

        foreach($data as $item){
            $output= '<tr>
            <th scope="row"> '.$a++.'</th>
            <td>'.$item->nama.'</td>
            <td>'.$item->harga.'</td>
            <td>'.$item->jumlah.'</td>
            <td>'.$item->total_harga.'</td>
            <td><a href="hapus/'.$item->id.'" class="btn btn-danger btn-rounded btn-sm text-light">Hapus</a></td>
            </tr>';
        }
        return response($output);
    }

    public function fetchHarga(Request $request)
    {
        $idCustomer = $request->idCustomer;
        $data = DB::table('transactions')
        ->where('id_customer',$idCustomer)
        ->sum('total_harga');
        return response($data);
    }

    public function cari(Request $request)
    {
        $a = 1;
        $nama = $request->nama;
        $data = DB::table('products')
        ->join('categories','categories.id','=','products.id_kategori')
        ->select('products.*','categories.nama as kategori')
        ->where('products.nama','LIKE','%'.$nama."%")
        ->get();
        $output='';
        if($data){
        foreach ($data as $item) {
        $output.='<tr>'.
        '<th scope="row"> '.$a++.'</th>'.
        '<td>'.$item->nama.'</td>'.
        '<td>'.$item->kategori.'</td>'.
        '<td>'.$item->harga.'</td>'.
        '<td>'.$item->expired.'</td>'.
        '<td><img src="'.asset('owner/images/'.$item->image).'" style="max-width: 150px"></td>'.
        '</tr>';
        }
        return Response($output);
        }else{
            return Response($output);
        }
    }

    public function cariTransaksi(Request $request)
    {
        $a = 1;
        $kode = $request->kode;
        $data = DB::table('customers')
        ->join('users','users.id','=','customers.id_user')
        ->select('customers.*','users.name as kasir')
        ->where('customers.id','LIKE','%'.$kode."%")
        ->get();
        $output='';
        if($data){
        foreach ($data as $item) {
        $output.='<tr>'.
        '<th scope="row"> '.$a++.'</th>'.
        '<td>'.$item->id.'</td>'.
        '<td>'.$item->kasir.'</td>'.
        '<td>'.$item->total_pembayaran.'</td>'.
        '<td>'.$item->uang.'</td>'.
        '<td>'.$item->kembalian.'</td>'.
        '<td>'.date("d, M Y", strtotime($item->updated_at)).'</td>'.
        '<td><a href="'.url('kasir/transaksi/'.$item->id).'" class="btn btn-primary">Lihat detail</a></td>'.
        '</tr>';
        }
        return Response($output);
        }else{
            return Response($output);
        }
    }

    public function fetchData(Request $request)
    {
        $a = 1;
        $data = DB::table('transactions')
        ->join('products','products.id','=','transactions.id_product')
        ->select('transactions.*','products.nama','products.harga')
        ->where('transactions.id_customer',$request->idCustomer)
        ->get();
        echo json_encode($data);
    }

    public function delete(Request $request)
    {
        DB::table('transactions')
                ->where('id', $request->id)
                ->delete();
    }

    public function bayar(Request $request)
    {
        $kembalian = $request->uang - $request->totalPembayaran;
        $id = $request->idCustomer;
        Customer::where('id',$id)->update([
            'total_pembayaran' => $request->totalPembayaran,
            'uang' => $request->uang,
            'kembalian' => $kembalian
        ]);

        return redirect('kasir/transaksi/'.$id);
    }

    public function detailTransaksi($id)
    {
        $transaksi = DB::table('transactions')
        ->join('products','products.id','=','transactions.id_product')
        ->join('customers','customers.id','=','transactions.id_customer')
        ->select('transactions.*','customers.*','products.nama','products.harga')
        ->where('transactions.id_customer',$id)
        ->get();

        $customer = Customer::all()->where('id',$id);

        $toko = Company::all();

        $total = DB::table('transactions')
        ->where('id_customer',$id)
        ->sum('total_harga');
        return view('kasir_view.nota', compact('transaksi','customer','total','toko'));
    }
}
