@extends('layouts.owner')

@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Daftar Kategori</h1>
            </div>
            <div class="col-sm-6 mb-4">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item active">Daftar Kategori</li>
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
         @endif
         @error('nama')
         <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
            {{ $message }}
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         @enderror
         <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahKategori">Tambah Kategori Baru</button>
         <div class="content mt-2">
            {{-- Masukan konten disini --}}
            <div class="card">
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                       @foreach ($kategori as $ktg)
                       <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td>{{ $ktg->nama }}</td>
                          <td>
                             <input type="text" value="{{ $ktg->id }}" hidden>
                             <a href="{{ route('kategori.edit', [$ktg->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                             <a href="{{ route('kategori.destroy', [$ktg->id]) }}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus kategori ini?')">Hapus</a>
                          </td>
                       </tr>
                       @endforeach
                    </tbody>
                  </table>
            </div>
         </div>
      </div>

      <!-- modal tambah kategori-->
      <div class="modal fade" id="modalTambahKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Masukan Kategori Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <form action="{{ route('kategori.store') }}" method="post">
                  @csrf
                  <div class="form-group">
                     <label for="">Nama Kategori</label>
                     <input name="nama" type="text" class="form-control" placeholder="Masukan nama kategori..." autocomplete="off" required>
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Tambahkan Data</button>
               </form>
            </div>
          </div>
        </div>
      </div>



   </div>
</div>
@endsection
