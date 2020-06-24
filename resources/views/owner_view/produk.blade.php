@extends('layouts.owner')

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
               <input type="text" id="searchProduk" class="form-control" placeholder="Cari Produk (berdasarkan nama)" name="keyword" autocomplete="off">
            </div>
         </div>
         </form>
         <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalTambahProduk">Tambah Produk Baru</button>
         <div class="content mt-2">
            {{-- Masukan konten disini --}}
            <div class="card">
                <table class="table teble-hover">
                    <thead>
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
                    <tbody id="tBodyProduk">
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
                     <input name="image" type="file" onchange="loadFile(event)" required>
                     <img id="output" class="img-thumbnail mt-3" />
                    <script>
                    var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                        URL.revokeObjectURL(output.src)
                        }
                    };
                    </script>
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
               <button type="button" class="close" id="bTutupDetail" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body" id="bModalDetail"></div>
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
      $( "#tBodyProduk" ).on("click", "button.bDetailProduk", function() {
         const nilai = $(this).val();
         $.get("{{ URL::to('/') }}/owner/produk/show/"+nilai, function( response ) {
            const data = JSON.parse(response)
            if($("#bModalDetail").has("img").length){
               $("#bModalDetail").empty();
               $('<img/>').attr({src:'{{ URL::to('/') }}/owner/images/'+ data.image, class:'img-fluid'}).appendTo("#bModalDetail");
            } else {
               $('<img/>').attr({src:'{{ URL::to('/') }}/owner/images/'+ data.image, class:'img-fluid'}).appendTo("#bModalDetail");
            }
         });
      });

      $("#searchProduk").keyup(function(){
         const nilai = $(this).val();
         if(nilai) {
            $.get("{{ URL::to('/') }}/owner/produk/search/"+nilai, function( response ) {
               const data = JSON.parse(response);
               let output;
               $("#tBodyProduk").empty();
               data.map((data, index) => {
                  output += `
                  <tr>
                     <th scope="row">${index+1}</th>
                     <td>${data.nama}</td>
                     <td>${data.kategori}</td>
                     <td>${data.harga}</td>
                     <td>${data.expired}</td>
                     <td><img src="{{ URL::to('/') }}/owner/images/${data.image}" style="max-width: 150px"></td>
                     <td>
                        <button class="btn btn-sm btn-primary bDetailProduk" value="${data.id}" data-toggle="modal" data-target="#modalDetail">Detail Gambar</button>
                        <a href="{{ URL::to('/') }}/owner/produk/edit/${data.id}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ URL::to('/') }}/owner/produk/destroy/${data.id}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus produk ini?')">Hapus</a>
                     </td>
                  </tr>`;
               })
               $("#tBodyProduk").append(output);
            });
         } else {
            $.get("{{ URL::to('/') }}/owner/produk/search/"+"0", function( response ) {
               const data = JSON.parse(response);
               let output;
               $("#tBodyProduk").empty();
               data.map((data, index) => {
                  output += `
                  <tr>
                     <th scope="row">${index+1}</th>
                     <td>${data.nama}</td>
                     <td>${data.kategori}</td>
                     <td>${data.harga}</td>
                     <td>${data.expired}</td>
                     <td><img src="{{ URL::to('/') }}/owner/images/${data.image}" style="max-width: 150px"></td>
                     <td>
                        <button class="btn btn-sm btn-primary bDetailProduk" value="${data.id}" data-toggle="modal" data-target="#modalDetail">Detail Gambar</button>
                        <a href="{{ URL::to('/') }}/owner/produk/edit/${data.id}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ URL::to('/') }}/owner/produk/destroy/${data.id}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus produk ini?')">Hapus</a>
                     </td>
                  </tr>`;
               })
               $("#tBodyProduk").append(output);
            });
         }

      });


   })

</script>
@endsection

