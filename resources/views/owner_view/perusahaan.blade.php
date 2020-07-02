@extends('layouts.owner')

@section('content')
<div class="row">
    <div class="col">
      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
         {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @elseif(session('warning'))
      <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
         {{ session('warning') }}
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
      @error('alamat')
      <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
         {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @enderror
      @error('image')
      <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
         {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @enderror
        <div class="card">
            <div class="row mt-5 mb-5 mr-5 ml-5">
                <div class="col col-4">
                    <h4 class="card-title">Icon perusahaan</h4>
                    <img src="{{ URL::to('/') }}/owner/images/{{ $perusahaan->icon }}" class="img-thumbnail" alt="">
                    <button data-toggle="modal" data-target="#modalIcon" class="btn btn-sm btn-primary mt-2">Edit Icon <span class="mdi mdi-camera"></span></button>
                </div>
                <div class="col">
                    <ul class="list-group text-left">
                        <li class="list-group-item">
                           <div class="row">
                              <div class="col-2">
                                  <label for="address">Nama Perusahaan:</label>
                              </div>
                              <div class="col-8">
                                  <label for="" class="float-right"> {{ $perusahaan->nama }}</label>                                   
                               </div>
                               <div class="col-2">
                                  <button data-toggle="modal" data-target="#modalNama" class="badge badge-primary float-right">Edit</button>
                              </div>
                          </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-2">
                                    <label for="address">Alamat:</label>
                                </div>
                                <div class="col-8">
                                    <label for="" class="float-right"> {{ $perusahaan->alamat }}</label>                                   
                                 </div>
                                 <div class="col-2">
                                    <button data-toggle="modal" data-target="#modalAlamat" class="badge badge-primary float-right">Edit</button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                           <div class="row">
                              <div class="col-2">
                                  <label for="address">Phone:</label>
                              </div>
                              <div class="col-8">
                                  <label for="" class="float-right"> {{ $perusahaan->nomor }}</label>                                   
                               </div>
                               <div class="col-2">
                                  <button data-toggle="modal" data-target="#modalNomor" class="badge badge-primary float-right">Edit</button>
                              </div>
                          </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

      <!-- modal nama -->
      <div class="modal fade" id="modalNama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Nama</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="{{ route('perusahaan.update', [$perusahaan->id]) }}" method="post">
                  @csrf
                  <div class="form-group">
                     <label for="">Masukan Nama Perusahaan Baru</label>
                     <input type="text" name="nama" class="form-control" autocomplete="off" required>
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary float-right">Submit</button>
               </form>
            </div>
         </div>
         </div>
      </div>

      <!-- modal alamat -->
      <div class="modal fade" id="modalAlamat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Alamat</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="{{ route('perusahaan.update', [$perusahaan->id]) }}" method="post">
                  @csrf
                  <div class="form-group">
                     <label for="">Masukan Alamat Perusahaan Baru</label>
                     <textarea name="alamat" class="form-control" cols="30" rows="10" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary float-right">Submit</button>
               </form>
            </div>
         </div>
         </div>
      </div>

      <!-- modal nomor -->
      <div class="modal fade" id="modalNomor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Nomor</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="{{ route('perusahaan.update', [$perusahaan->id]) }}" method="post">
                  @csrf
                  <div class="form-group">
                     <label for="">Masukan Nomor Perusahaan Baru</label>
                     <input type="number" name="nomor" class="form-control" required>
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary float-right">Submit</button>
               </form>
            </div>
         </div>
         </div>
      </div>

      <!-- modal icon -->
      <div class="modal fade" id="modalIcon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Icon</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="{{ route('perusahaan.update', [$perusahaan->id]) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                     <label for="iconInput" class="mb-4">Masukan Icon Perusahaan Baru</label>
                     <input type="file" name="image" id="iconInput" onchange="loadFile(event)" required>
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
                  <button type="submit" class="btn btn-sm btn-primary float-right">Submit</button>
               </form>
            </div>
         </div>
         </div>
      </div>

@endsection
