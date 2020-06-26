@extends('layouts.kasir')
@section('content')
<div class="row" style="margin-right: 200px; margin-left: 200px;">
    <div class="col">
        <form action="" method="post">
            <div class="content mt-4">
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></span>
                  </div>
                  <input type="text" id="searchProduk" class="form-control" placeholder="Cari Produk (berdasarkan nama)" name="keyword" autocomplete="off" autofocus>
               </div>
            </div>
            </form>
        <div class="card mt-5">
            <table class="table teble-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Expired</th>
                    <th scope="col">Gambar</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                    @foreach ($produk as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>{{ $item->expired }}</td>
                        <td><img src="{{ asset('owner/images/'.$item->image) }}" style="max-width: 150px"></td>
                    </tr>
                    @endforeach

                </tbody>
              </table>
        </div>
    </div>
</div>

<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $(function(){
        $('#searchProduk').keyup(function(){
            var nama = $(this).val();
            $.ajax({
            url:"{{ url('kasir/cari') }}",
            method:"POST",
            data:{nama:nama},
            success:function(data){
                $('#tbody').html(data);
                console.log("success");
            }
        });

        });
    });
</script>
@endsection
