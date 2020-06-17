@extends('owner_view.layouts.main')

@section('content')
@extends('owner_view.layouts.main')

@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Laporan Bulanan</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item active">Laporan Bulanan</li>
               </ol>
            </div>
         </div>  
         <div class="content mt-4">
            {{-- Masukan konten disini --}}
            <div class="row mb-3 mt-3 justify-content-center">
               
               <input type="date" name="" id="">
               
               <input type="date" name="" id="">
            </div>
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
                  <tr>
                     <th scope="row">1</th>
                     <td>Ilham Akhyar</td>
                     <td>ilham@gmail.com</td>
                     <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Hapus</button>
                     </td>
                   </tr>
               </tbody>
             </table>
         </div>
      </div>
     
      

   </div>
</div>

@endsection

@endsection