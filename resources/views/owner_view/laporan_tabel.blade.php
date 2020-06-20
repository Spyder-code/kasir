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
            <table class="table">
               <thead class="thead-dark">
                 <tr>
                   <th scope="col">No</th>
                   <th scope="col">Kode transaksi</th>
                   <th scope="col">Kasir</th>
                   <th scope="col">Total pembayaran</th>
                   <th scope="col">Uang</th>
                   <th scope="col">Kembalian</th>
                   <th scope="col">Tanggal transaksi</th>
                   <th scope="col">Aksi</th>
                 </tr>
               </thead>
               <tbody>
                  <tr>
                     <th scope="row">1</th>
                     <td>1</td>
                     <td>Ilham</td>
                     <td>10000</td>
                     <td>20000</td>
                     <td>10000</td>
                     <td>23 february 2020</td>
                     <td><button class="btn btn-primary">Lihat detail</button></td>
                   </tr>
               </tbody>
             </table>
         </div>
      </div>



   </div>
</div>
@endsection

