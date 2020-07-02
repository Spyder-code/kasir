<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;
use App\User;
use App\Company;
use App\Transaction;
use App\Customer;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
       return view('owner_view.index');
   }

   // -------------------------------------- Main Dashboard
   public function indexDashboard()
   {
      $customer = Customer::all();
      $transaksi = Transaction::all();
      echo json_encode(array('customer' => $customer, 'transaksi' => $transaksi));
   }

   public function showDashboardGrafik()
   {
      $transaksi = Transaction::all();
      echo json_encode($transaksi);
   }

   // -------------------------------------- Perusahaan
   public function indexPerusahaan()
   {
      $result = Company::all();
      if($result->first()) {
         return view('owner_view.perusahaan', ['perusahaan' => $result->first()]);
      } else {
         return redirect()->route('perusahaan.show')->with('error', 'Kamu belum memasukan data perusahaan, masukan data terlebih dahulu');
      }
   }

   public function showPerusahaan()
   {
      $result = Company::all();
      if($result->first()){
         return redirect()->route('perusahaan')->with('warning', 'Kamu sudah menambahkan data perusahaan!');
      } else {
         return view('owner_view.tambah_perusahaan');
      }
   }

   public function updatePerusahaan(Request $request, $id)
   {
      if($request->nama) {
         $request->validate([
            'nama'         => 'required|max:255'
         ]);
         $perusahaan = Company::find($id);
         $perusahaan->nama = $request->nama;
         $perusahaan->save();
         return redirect()->route('perusahaan')->with('success', 'Data nama perusahaan berhasil diperbarui');
      } elseif($request->alamat) {
         $request->validate([
            'alamat'         => 'required|max:255'
         ]);
         $perusahaan = Company::find($id);
         $perusahaan->alamat = $request->alamat;
         $perusahaan->save();
         return redirect()->route('perusahaan')->with('success', 'Data alamat perusahan berhasil diperbarui');
      } elseif($request->nomor) {
         $request->validate([
            'nomor'         => 'required|numeric'
         ]);
         $perusahaan = Company::find($id);
         $perusahaan->nomor = $request->nomor;
         $perusahaan->save();
         return redirect()->route('perusahaan')->with('success', 'Data nomor perusahaan berhasil diperbarui');
      } elseif($request->hasFile('image')) {
         $request->validate([
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);
         $namaGambar = time().'.'.$request->image->extension();
         $request->image->move(public_path('owner/images'), $namaGambar);
         //---------------------------
         $perusahaan = Company::find($id);
         $perusahaan->icon = $namaGambar;
         $perusahaan->save();
         return redirect()->route('perusahaan')->with('success', 'Data icon perusahan berhasil diperbarui'); 
      }  else {
         return redirect()->route('perusahaan');
      }
   }

   public function storePerusahaan(Request $request)
   {
      $request->validate([
         'nama'         => 'required|max:255',
         'alamat'       => 'required|max:255',
         'nomor'        => 'required|numeric',
         'image'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
      if($request->hasFile('image')){
         $namaGambar = time().'.'.$request->image->extension();
         $request->image->move(public_path('owner/images'), $namaGambar);
         //---------------------------
         $perusahaan = new Company;
         $perusahaan->nama = $request->nama;
         $perusahaan->alamat = $request->alamat;
         $perusahaan->icon = $namaGambar;
         $perusahaan->nomor = $request->nomor;
         $perusahaan->save();
         return redirect()->route('perusahaan')->with('success', 'Data berhasil ditambahkan');
      } else {
         return redirect()->route('perusahaan.store');
      }
   }

   // -------------------------------------- Owner
   public function indexOwner()
   {
      $owner = User::all()->where('level', '=', 1)->first();
      return view('owner_view.profile', ['owner' => $owner]);
   }

   public function updateOwner(Request $request)
   {
      if($request->alamat) {
         $request->validate([
            'alamat'         => 'required|max:255'
         ]);
         $owner = DB::table('users')->where('level', '=', 1)->update(['alamat' => $request->alamat]);
         return redirect()->route('owner')->with('success', 'Data alamat berhasil diperbarui');
      } elseif($request->nomor) {
         $request->validate([
            'nomor'         => 'required|min:2|max:13|numeric'
         ]);
         $owner = DB::table('users')->where('level', '=', 1)->update(['no_telp' => $request->nomor]);
         return redirect()->route('owner')->with('success', 'Data nomor berhasil diperbarui');
      } elseif($request->hasFile('image')) {
         $request->validate([
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);
         $namaGambar = time().'.'.$request->image->extension();
         $request->image->move(public_path('owner/images'), $namaGambar);
         //---------------------------
         DB::table('users')->where('level', '=', 1)->update(['image' => $namaGambar]);
         return redirect()->route('owner')->with('success', 'Data gambar berhasil diperbarui');
      }  else {
         return redirect()->route('owner');
      }
   }

   public function updatePassword(Request $request)
   {
      $pass1 = $request->pass1;
      $user = User::all()->where('level', '=', 1)->first();
      if (Hash::check($pass1, $user->password)) {
         $request->validate([
            'pass2'         => 'required'
         ]);
         $newPassword = Hash::make($request->pass2);
         DB::table('users')->where('level', '=', 1)->update(['password' => $newPassword]);
         return redirect()->route('owner')->with('success', 'Password berhasil diperbarui');
      } else {
         return redirect()->route('owner')->with('fail', 'Pastikan password lama yang dimasukan benar');
      }
   }

   // -------------------------------------- User
   public function indexUser()
   {
      $user = User::all()->where('level', '=', 2);
      return view('owner_view.user', ['user' => $user]);
   }

   public function storeUser(Request $request)
   {
      $request->validate([
         'nama'         => 'required|max:255',
         'email'        => 'required|max:255|email',
         'password'     => 'required|confirmed|min:5'
      ]);
      $user = new User;
      $user->name = $request->nama;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->level = 2;
      $user->save();
      return redirect()->route('user')->with('success', 'Data berhasil ditambahkan');
   }

   public function editUser($id)
   {
      $user = User::where('id', $id)->first();
      return view('owner_view.edit_user', ['user' => $user]);
   }

   public function updateUser(Request $request, $id)
   {
      if($request->password) {
         $request->validate([
            'nama'         => 'required|max:255',
            'email'        => 'required|max:255|email',
            'password'     => 'required|confirmed|min:5'
         ]);
         $user = User::find($id);
         $user->name = $request->nama;
         $user->email = $request->email;
         $user->password = Hash::make($request->password);
         $user->level = 2;
         $user->save();
         return redirect()->route('user')->with('success', 'Data berhasil diperbarui');
      } else {
         $request->validate([
            'nama'         => 'required|max:255',
            'email'        => 'required|max:255|email',
         ]);
         $user = User::find($id);
         $user->name = $request->nama;
         $user->email = $request->email;
         $user->level = 2;
         $user->save();
         return redirect()->route('user')->with('success', 'Data berhasil diperbarui');
      }
   }

   public function destroyUser($id)
   {
      try {
         $user = User::find($id);
         $user->delete();
         return redirect()->route('user')->with('success', 'Data berhasil dihapus');
      } catch (\Throwable $th) {
         return redirect()->route('user')->with('error', 'Data gagal dihapus!');
      }
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
         return redirect()->route('produk')->with('error', 'Data gagal ditambahkan, pastikan data diisi dengan benar');
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
         return redirect()->route('produk')->with('error', 'Data gagal diperbarui!');
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

   public function searchProduk($id)
   {
      if($id != "zero"){
         $produk = DB::table('products')
                     ->join('categories', 'categories.id', '=', 'products.id_kategori')
                     ->select('products.*', 'categories.nama as kategori')
                     ->where('products.nama','like',"%".$id."%")
                     ->get();
         echo json_encode($produk);
      } else {
         $produk = DB::table('products')
                  ->join('categories', 'categories.id', '=', 'products.id_kategori')
                  ->select('products.*', 'categories.nama as kategori')
                  ->get();
         echo json_encode($produk);
      }
   }

   // -------------------------------------- Laporan
   public function indexLaporanTabel()
   {
      // $transaksi = Transaction::all();
      // return view('owner_view.laporan_tabel', ['transaksi' => $transaksi]);
      return view('owner_view.laporan_tabel');
   }

   public function indexLaporanGrafik()
   {   
      return view('owner_view.laporan_grafik');
   }

   public function showLaporan()
   {
      $transaksi = Transaction::all();
      echo json_encode($transaksi);
   }

   // -------------------------------------- Kategori
   public function indexKategori()
   {
      $kategori = Category::all();
      return view('owner_view.kategori', ['kategori' => $kategori]);
   }

   public function storeKategori(Request $request)
   {
      $request->validate([
         'nama'     => 'required|max:255'
      ]);
      $category = new Category;
      $category->nama = $request->nama;
      $category->save();
      return redirect()->route('kategori')->with('success', 'Data berhasil ditambahkan');
   }

   public function editKategori($id)
   {
      $kategori = Category::where('id', $id)->first();
      return view('owner_view.edit_kategori', ['kategori' => $kategori]);
   }

   public function updateKategori(Request $request, $id)
   {
      $request->validate([
         'nama'     => 'required|max:255'
      ]);
      $kategori = Category::find($id);
      $kategori->nama = $request->nama;
      $kategori->save();
      return redirect()->route('kategori')->with('success', 'Data berhasil diperbarui');
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
