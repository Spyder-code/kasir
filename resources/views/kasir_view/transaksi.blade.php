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
                  <input type="text" id="kode" class="form-control" placeholder="Kode transaksi" name="keyword" autocomplete="off" autofocus>
               </div>
            </div>
            </form>
        <div class="card mt-5">
            <table class="table table-hover">
                <thead>
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
                <tbody id="tbody">
                    @foreach ($transaksi as $item)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$item->id}}</td>
                        <td>{{$item->kasir}}</td>
                        <td>{{$item->total_pembayaran}}</td>
                        <td>{{$item->uang}}</td>
                        <td>{{$item->kembalian}}</td>
                        <td>{{date("d, M Y", strtotime($item->updated_at))}}</td>
                        <td><a href="{{url('kasir/transaksi/'.$item->id)}}" class="btn btn-primary">Lihat detail</a></td>
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
            $('#kode').keyup(function(){
                var kode = $(this).val();
                $.ajax({
                url:"{{ url('kasir/cariTransaksi') }}",
                method:"POST",
                data:{kode:kode},
                success:function(data){
                    $('#tbody').html(data);
                    console.log("success");
                }
            });

            });
        });
    </script>
@endsection
