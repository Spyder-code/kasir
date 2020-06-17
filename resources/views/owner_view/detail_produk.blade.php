@extends('owner_view.layouts.main')

@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Detail Produk</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item active">Detail Produk</li>
               </ol>
            </div>
         </div>
         <!-- content -->
         <hr>
         <div class="content ml-3">
            <div class="row pt-3"> 
               <div class="col-md-6">
                  <h3 class="font-weight-bold">Nama Produk</h3>
                  <p>asa</p>
                  <h3 class="font-weight-bold">Fasilitas</h3>
                  <p>asd</p>
                  <h3 class="font-weight-bold">Harga</h3>
                  <p>asd</p>
               </div>
               <div class="col-md-6">
                  <h3 class="font-weight-bold">Nama Hotel</h3>
                  <p>asd</p>
                  <h3 class="font-weight-bold">Keterangan Hotel</h3>
                  <p>asd</p>
                  <h3 class="font-weight-bold">Gambar Hotel</h3>
                  <img src="{{ asset('owner/img/yako.jpg') }}" class="w-50">
               </div>
            </div>
            <a href="" class="btn btn-secondary mt-5">Kembali</a>
         </div>
      </div>

   </div>
</div>
@endsection