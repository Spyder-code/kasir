@extends('owner_view.layouts.main')

@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Perusahaan</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item active">Perusahaan</li>
               </ol>
            </div>
         </div>
         <div class="content mt-2 pt-4">
            {{-- Masukan konten disini --}}
            <div class="row pl-3 pr-3">
               <div class="col-md-3">
                  <img src="{{ asset('owner/img/yako.jpg') }}" style="max-width: 200px">   
               </div>   
               <div class="col-md-9">
                  <div class="row">
                     <div class="col-md-6">
                        <h5 class="font-weight-bold">Nama Toko</h5>
                        <h3>Pt Abdi Jaya</h3>
                        <h5 class="font-weight-bold pt-4">Keterangan</h5>
                        <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Nemo illum libero tenetur doloremque odit soluta tempora 
                            expedita totam nihil, doloribus natus commodi vero suscipit
                            molestiae corrupti enim veniam pariatur iusto.Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Nemo illum libero tenetur doloremque odit soluta tempora 
                            expedita totam nihil, doloribus natus commodi vero suscipit
                            molestiae corrupti enim veniam pariatur iusto.</h6>
                     </div>
                     <div class="col-md-6">
                        <h5 class="font-weight-bold">No Telp</h5>
                        <h6>082455543323</h6>
                     </div>
                  </div>
               </div>   
            </div>  
         </div>
      </div>
      

   </div>
</div>

@endsection