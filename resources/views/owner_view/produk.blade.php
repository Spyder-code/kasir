@extends('owner_view.layouts.main')

@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Daftar Produk</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item active">Daftar Produk</li>
               </ol>
            </div>
         </div>
         <form action="" method="post">
         <div class="content mt-4">
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></span>
               </div>
               <input type="text" id="search" class="form-control" placeholder="Cari Produk (berdasarkan nama)" name="keyword" autocomplete="off">
            </div>
         </div>
         </form>         
         <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalTambahProduk">Tambah Produk Baru</button>
         <div class="content mt-2">
            {{-- Masukan konten disini --}}
            <table class="table">
               <thead class="thead-dark">
                 <tr>
                   <th scope="col">No</th>
                   <th scope="col">Nama Produk</th>
                   <th scope="col">Kategori</th>
                   <th scope="col">Harga</th>
                   <th scope="col">Gambar</th>
                   <th scope="col">Aksi</th>
                 </tr>
               </thead>
               <tbody>
                  <tr>
                     <th scope="row">1</th>
                     <td>Ale-ale</td>
                     <td>Minuman</td>
                     <td>12.000.000</td>
                     <td><img src="{{ asset('owner/img/yako.jpg') }}" style="max-width: 150px"></td>
                     <td>
                        <button class="btn btn-sm btn-primary">Detail</button>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Hapus</button>
                     </td>
                   </tr>
               </tbody>
             </table>
         </div>
      </div>
      <!-- modal tambah data travel-->
      <div class="modal fade" id="modalTambahProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Masukan Data Travel Umrah Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                     <input name="nama_maskapai" type="text" class="form-control" placeholder="Nama Maskapai">
                  </div>
                  <div class="form-group">
                      <textarea name="keterangan" class="form-control" rows="4" placeholder="Keterangan"></textarea>
                  </div>
                  <div class="form-group">
                     <div>
                        <label for="gambarMaskapai">Gambar</label>
                     </div>
                     <input name="gambar" type="file" id="gambarMaskapai">
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Tambahkan Data</button>
            </div>
          </div>
        </div>
      </div>
      

   </div>
</div>

@endsection