@extends('layouts.owner')

@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Edit User</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item active">Edit User</li>
               </ol>
            </div>
         </div>
         @error('nama')
         <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
            {{ $message }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         @enderror
         @error('email')
         <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
            {{ $message }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         @enderror
         @error('password')
         <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
            {{ $message }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         @enderror
         <div class="content mt-4">
            {{-- Masukan konten disini --}}
            <form action="{{ route('user.update', [$user->id]) }} }}" method="post">
               @csrf
               <div class="form-group">
                  <input name="nama" type="text" class="form-control" placeholder="Masukan nama" autocomplete="off" value="{{ $user->name }}" required>
               </div>
               <div class="form-group">
                  <input name="email" type="email" class="form-control" placeholder="Alamat email" autocomplete="off" value="{{ $user->email }}" required>
               </div>
               <div class="form-group">
                  <label for="">Password Section</label>
                  <input name="password" type="password" class="form-control" placeholder="Password (min. 5 karakter)">
                  <input name="password_confirmation" type="password" class="form-control mt-2" placeholder="Re-type password">
               </div>
               <div class="form-group">
                  <a href="{{ route('user') }}" class="btn btn-secondary text-white">Kembali</a>
                  <button type="submit" class="btn btn-primary float-right text-white">Edit Data</button>
               </div>
            </form>
         </div>
      </div>

   </div>
</div>
@endsection
