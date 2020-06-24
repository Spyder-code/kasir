@extends('layouts.owner')

@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Edit Kategori</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item active">Edit Kategori</li>
               </ol>
            </div>
         </div>
         <div class="content mt-4">
            {{-- Masukan konten disini --}}
            <form action="{{ route('kategori.update', [$kategori->id]) }} }}" method="post">
               @csrf
               <div class="form-group">
                  <label for="namaKategori">Nama Kategori</label>
                  <input name="nama" type="text" id="namaKategori" class="form-control" value="{{ $kategori->nama }}" placeholder="Ubah nama kategori" required>
               </div>
               <div class="form-group">
                  <a href="{{ route('kategori') }}" class="btn btn-secondary text-white">Kembali</a>
                  <button type="submit" class="btn btn-primary float-right text-white">Edit Data</button>
               </div>
            </form>
         </div>
      </div>

   </div>
</div>
@endsection
