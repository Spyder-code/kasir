<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="{{asset('owner/css/style.css')}}">
   <title>Masukan Perusahaan</title>
</head>
<body style="background: #F2EDF3">
   <div class="caontainer">
      <div class="row justify-content-center">
         <div class="col-lg-6 mt-5 mb-5">
            <div class="card">
               <h3 class="mx-auto font-weight-bold pt-5">Masukan Data Perusahaan</h3>
               @if (session('error'))
               <div class="alert alert-warning alert-dismissible fade show mt-4 ml-4 mr-4" role="alert">
                  {{ session('error') }}
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               @endif
               <div class="card-body">
                  <form action="{{route('perusahaan.store')}}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                        <label for="namaInput">Nama Perusahaan</label>
                        <input name="nama" type="text" id="namaInput" class="form-control" autocomplete="off" required>
                     </div>
                     <div class="form-group">
                        <label for="alamatInput">Alamat</label>
                        <textarea name="alamat" id="alamatInput" cols="30" rows="10" class="form-control" required></textarea>
                     </div>
                     <div class="form-group">
                        <label for="iconInput">Icon</label>
                        <input name="image" onchange="loadFile(event)" type="file" id="iconInput" class="form-control" required>
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
                     <div class="form-group">
                        <label for="hpInput">No. handphone</label>
                        <input name="nomor" type="number" id="hpInput" class="form-control" min="0" autocomplete="off" required>
                     </div>
                     <button type="submit" class="btn btn-primary float-right">Submit</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script src="{{asset('owner/vendors/js/vendor.bundle.base.js')}}"></script>
</body>
</html>