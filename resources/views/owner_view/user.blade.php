@extends('layouts.owner')

@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Daftar Kasir</h1>
            </div>
            <div class="col-sm-6 mb-4">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item active">Daftar Kasir</li>
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
         <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahUser">Tambah Kasir Baru</button>
         <div class="content mt-2">
            {{-- Masukan konten disini --}}
            <div class="card">
               <table class="table">
                  <thead class="thead-dark">
                     <tr>
                     <th scope="col">No</th>
                     <th scope="col">Nama</th>
                     <th scope="col">Email</th>
                     <th scope="col">Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($user as $us)
                     <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $us->name }}</td>
                        <td>{{ $us->email }}</td>
                        <td>
                        <a href="{{ route('user.edit', [$us->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('user.destroy', [$us->id]) }}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus user ini?')">Hapus</a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>

      <!-- modal tambah user-->
      <div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Masukan Kasir Baru</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="{{ route('user.store') }}" method="post">
                  @csrf
                  <div class="form-group">
                     <input name="nama" type="text" class="form-control" placeholder="Masukan nama" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                     <input name="email" type="email" class="form-control" placeholder="Alamat email" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                     <label for="">Password Section</label>
                     <input name="password" type="password" class="form-control" placeholder="Password (min. 5 karakter)" required>
                     <input name="password_confirmation" type="password" class="form-control mt-2" placeholder="Re-type password" required>
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
