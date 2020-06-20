<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;
use App\Transaction;

class OwnerController extends Controller
{
   /*
      index => nampilin semua data
      show => nampilin halaman detail
      store => nyimpan data baru
      edit => menampilkan halaman buat update
      update => update data
      destroy => delete data
   */

   public function index()
   {
       return view('owner_view.user');
   }

   // -------------------------------------- Perusahaan
   public function showPerusahaan()
   {

   }

   // -------------------------------------- User
   public function destroyUser()
   {

   }

   // -------------------------------------- Produk
   public function indexProduk()
   {
      $produk = DB::table('products')
                  ->join('categories', 'categories.id', '=', 'products.id_kategori')
                  ->select('products.*', 'categories.nama as kategori')
                  ->get();
      $kategori = Category::all();
      return view('owner_view.produk', ['produk' => $produk, 'kategori' => $kategori]);
   }

   public function showProduk($id)
   {
      $produk = Product::where('id', $id)->first();
      echo json_encode($produk);
   }

   public function storeProduk(Request $request)
   {
      try {
         $request->validate([
            'nama'         => 'required|max:255',
            'kategori'     => 'required|numeric',
            'harga'        => 'required|numeric',
            'expired'      => 'required|date',
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);
         if($request->hasFile('image')){
            $namaGambar = time().'.'.$request->image->extension();  
            $request->image->move(public_path('owner/images'), $namaGambar);
            //---------------------------
            $produk = new Product;
            $produk->nama = $request->nama;
            $produk->id_kategori = $request->kategori;
            $produk->harga = $request->harga;
            $produk->expired = $request->expired;
            $produk->image = $namaGambar;
            $produk->barcode = $request->nama;
            $produk->save();
            return redirect()->route('produk')->with('success', 'Data berhasil ditambahkan');
         } else {
            return redirect()->route('produk')->with('error', 'Jangan lupa masukan gambar produk');
         } 
      } catch (\Throwable $th) {
         return redirect()->route('produk')->with('error', 'Data gagal ditambahkan');
      }
      
   }

   public function editProduk($id)
   {
      $produk = Product::find($id);
      $kategori = Category::all();
      return view('owner_view.edit_produk', ['produk' => $produk, 'kategori' => $kategori]);
   }

   public function updateProduk(Request $request, $id)
   {
      try {
         $request->validate([
            'nama'         => 'required|max:255',
            'kategori'     => 'required|numeric',
            'harga'        => 'required|numeric',
            'expired'      => 'required|date',
            'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);
         if($request->hasFile('image')){
            $namaGambar = time().'.'.$request->image->extension();  
            $request->image->move(public_path('owner/images'), $namaGambar);
            //---------------------------
            $produk = Product::find($id);
            $produk->nama = $request->nama;
            $produk->id_kategori = $request->kategori;
            $produk->harga = $request->harga;
            $produk->expired = $request->expired;
            $produk->image = $namaGambar;
            $produk->barcode = $request->nama;
            $produk->save();
            return redirect()->route('produk')->with('success', 'Data berhasil diperbarui');
         } else {
            $produk = Product::find($id);
            $produk->nama = $request->nama;
            $produk->id_kategori = $request->kategori;
            $produk->harga = $request->harga;
            $produk->expired = $request->expired;
            $produk->image = $request->gambarLama;
            $produk->barcode = $request->nama;
            $produk->save();
            return redirect()->route('produk')->with('success', 'Data berhasil diperbarui');
         } 
      } catch (\Throwable $th) {
         return redirect()->route('produk')->with('error', 'Data gagal diperbarui');
      }
   }

   public function destroyProduk($id)
   {
      try {
         $produk = Product::find($id);
         $produk->delete();
         return redirect()->route('produk')->with('success', 'Data berhasil dihapus');
      } catch (\Throwable $th) {
         return redirect()->route('produk')->with('error', 'Data gagal dihapus!');
      }
   }

   // -------------------------------------- Laporan
   public function indexLaporanTabel()
   {
      $transaksi = Transaction::all();
      return view('owner_view.laporan_tabel', ['transaksi' => $transaksi]);
   }

   // -------------------------------------- Kategori
   public function indexKategori()
   {
      $kategori = Category::all();
      return view('owner_view.kategori', ['kategori' => $kategori]);
   }

   public function storeKategori(Request $request)
   {
      try {
         $request->validate([
            'nama'     => 'required'
         ]);
         $category = new Category;
         $category->nama = $request->nama;
         $category->save();
         return redirect()->route('kategori')->with('success', 'Data berhasil ditambahkan');
      } catch (\Throwable $th) {
         return redirect()->route('kategori')->with('error', 'Data gagal ditambahkan!');
      }
   }

   public function editKategori($id)
   {
      $kategori = Category::where('id', $id)->first();
      return view('owner_view.edit_kategori', ['kategori' => $kategori]);
   }

   public function updateKategori(Request $request, $id)
   {
      try {
         $request->validate([
            'nama'     => 'required'
         ]);
         $kategori = Category::find($id);
         $kategori->nama = $request->nama;
         $kategori->save();
         return redirect()->route('kategori')->with('success', 'Data berhasil diperbarui');
      } catch (\Throwable $th) {
         return redirect()->route('kategori')->with('error', 'Data gagal diperbarui!');
      }
   }

   public function destroyKategori($id)
   {
      try {
         $category = Category::find($id);
         $category->delete();
         return redirect()->route('kategori')->with('success', 'Data berhasil dihapus');
      } catch (\Throwable $th) {
         return redirect()->route('kategori')->with('error', 'Data gagal dihapus!');
      }
   }


}
