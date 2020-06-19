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
         @if (session('success'))
         <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            {{ session('success') }}
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         @elseif (session('error')) 
         <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
            {{ session('error') }}
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         @endif 
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
                   <th scope="col">Expired</th>
                   <th scope="col">Gambar</th>
                   <th scope="col">Aksi</th>
                 </tr>
               </thead>
               <tbody>
                  @foreach ($produk as $prd)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $prd->nama }}</td>
                    <td>{{ $prd->kategori }}</td>
                    <td>{{ $prd->harga }}</td>
                    <td>{{ $prd->expired }}</td>
                    <td><img src="{{ URL::to('/') }}/owner/images/{{ $prd->image }}" style="max-width: 150px"></td>
                    <td>
                        <button class="btn btn-sm btn-primary bDetailProduk" value="{{ $prd->id }}" data-toggle="modal" data-target="#modalDetail">Detail Gambar</button> 
                        <a href="{{ route('produk.edit', [$prd->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('produk.destroy', [$prd->id]) }}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus produk ini?')">Hapus</a>
                    </td>
                  </tr>
                  @endforeach
                  
               </tbody>
             </table>
         </div>
      </div>

      <!-- modal tambah produk-->
      <div class="modal fade" id="modalTambahProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Masukan Data Produk Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                     <input name="nama" type="text" class="form-control" placeholder="Nama Produk" autocomplete="off" required>
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
                     <input name="harga" type="number" class="form-control" placeholder="Harga (ex: 20000)" min="0" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                     <div>
                        <label for="dateExpired" class="">Tanggal Expired</label>
                     </div>
                     <input name="expired" id="dateExpired" type="date" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <div>
                        <label for="" class="">Gambar Produk</label>
                     </div>
                     <input name="image" type="file" required>
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Tambahkan Data</button>
               </form>
            </div>
          </div>
        </div>
      </div>
      
      <!-- modal detail produk-->
      <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Detail Gambar Produk</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
         </div>
         </div>
      </div>

   </div>
</div>
@endsection

@section('custom-script')
<script>
   $(document).ready(function(){
      $( ".bDetailProduk" ).click(function() {
         const nilai = $(this).val();
         $.get("{{ URL::to('/') }}/owner/produk/show/"+nilai, function( response ) {
            let data = JSON.parse(response)
            console.log(data.image);
            if($(".modal-body").has("img").length){
               $(".modal-body").empty();
               $('<img/>').attr({src:'{{ URL::to('/') }}/owner/images/'+ data.image, class:'img-fluid'}).appendTo(".modal-body");
            } else {
               $('<img/>').attr({src:'{{ URL::to('/') }}/owner/images/'+ data.image, class:'img-fluid'}).appendTo(".modal-body");
            }
         });
      });
   })
  
</script>
@endsection
