@extends('owner_view.layouts.main')

@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Edit Produk</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item active">Edit Produk</li>
               </ol>
            </div>
         </div>  
         <div class="content mt-4">
            {{-- Masukan konten disini --}}
            <form action="{{ route('produk.update', [$produk->id]) }} }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                  <label for="dateExpired" class="">Nama Produk</label>
                  <input name="nama" type="text" class="form-control" placeholder="Nama Produk" autocomplete="off" value="{{ $produk->nama }}" required>
               </div>
               <div class="form-group">
                  <div>
                     <label for="kategoriProduk" class="">Kategori</label>
                  </div>
                   <select name="kategori" id="kategoriProduk" required>
                        @foreach ($kategori as $ktg)
                           <option value="{{ $ktg->id }}">{{ $ktg->nama }}</option>
                        @endforeach
                   </select>
               </div>
               <div class="form-group">
                  <label for="dateExpired" class="">Harga</label>
                  <input name="harga" type="number" class="form-control" placeholder="Harga (ex: 20000)" min="0" autocomplete="off" value="{{ $produk->harga }}" required>
               </div>
               <div class="form-group">
                  <div>
                     <label for="dateExpired" class="">Tanggal Expired</label>
                  </div>
                  <input name="expired" id="dateExpired" type="date" class="form-control" value="{{ $produk->expired }}" required>
               </div>
               <div class="form-group">
                  <div>
                     <label for="" class="">Gambar Produk</label>
                     <div>
                        <img src="{{ URL::to('/') }}/owner/images/{{ $produk->image }}" class="mb-3" style="max-width: 450px">
                     </div>
                  </div>
                  <input type="hidden" name="gambarLama" value="{{ $produk->image }}">
                  <input name="image" type="file">
               </div>
               <div class="form-group">
                  <a href="{{ route('produk') }}" class="btn btn-secondary text-white">Kembali</a>
                  <button type="submit" class="btn btn-primary float-right text-white">Edit Data</button>
               </div>
            </form>
         </div>
      </div>
     
   </div>
</div>
@endsection