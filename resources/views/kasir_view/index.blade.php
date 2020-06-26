@extends('layouts.kasir')
@section('content')
    <div class="row text-center mb-2 mt-3">
        <div class="col">
            <button class="btn btn-primary btn-rounded btn-lg" style="margin-top: 200px" id="mulai">New Transaction</button>
        </div>
    </div>
    <div class="row mb-5 ml-5" id="menu">
        <div class="col col-sm-6">
            <div class="card">
                <h2 class="card-title text-center mt-5">Produk</h2>
                <div class="row">
                    <div class="col col-6">
                        <form id="formTambah">
                            <input type="hidden" name="idCustomer" id="idCustomer">
                            <input type="hidden" name="idProduct" id="idProduct">
                            <div class="form-group mr-3 ml-3">
                                <label for="kode">Kode produk</label>
                                <input type="text" name="kode" id="kode" class="form-control text-center" autofocus style="border-color: rgb(153, 214, 250);text-transform: uppercase;" >
                            </div>
                            <div class="form-group mr-3 ml-3" id="ket1">
                               <div class="row">
                                    <div class="col">
                                        <label for="nama">Nama produk</label>
                                        <input type="text" disabled name="nama" id="nama" class="form-control text-center" autofocus style="border-color: rgb(89, 185, 241)">
                                    </div>
                                    <div class="col">
                                        <label for="harga">Harga</label>
                                        <input type="text" disabled name="harga" id="harga" class="form-control text-center" autofocus style="border-color: rgb(89, 185, 241)">
                                    </div>
                               </div>
                            </div>
                            <div class="form-group mr-3 ml-3" id="ket2">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" min="1" value="1" name="jumlah" id="jumlah" class="form-control text-center" autofocus style="border-color: rgb(89, 185, 241)">
                            </div>
                            <div class="form-group mr-3 ml-3" id="ket3">
                                <label for="total">Sub-total (Rp)</label>
                                <input type="number" disabled min="1" value="1" name="total" id="total" class="form-control text-center" autofocus style="border-color: rgb(89, 185, 241)">
                            </div>
                            <button type="button" id="tambah" class="btn btn-success ml-2 mb-3 mr-2 d-block" style="width:95%">Tambah</button>
                        </form>
                    </div>
                    <div class="col col-sm-6">
                        <label for="barcode">Barcode Scanner</label>
                        <img src="{{asset('image/green.jpg')}}" width="300" height="200" class="mb-3">
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-6 mt-3">
            <div class="card">
                <h2 class="card-title text-center mt-5">Transaksi</h2>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th>No.</th>
                                <th>Product</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Sub-total</th>
                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="result">

                            </tbody>
                        </table>
                </div>
                <div class="card-footer">
                    <div class="d-inline ml-5">Harga total: Rp. <div class="hargaTotal d-inline"></div></div>
                    <button type="button" class="btn btn-primary p-3 ml-5" data-toggle="modal" data-target="#modalBayar" style="width: 300px">
                        Bayar
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="modalBayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('kasir/bayar')}}" method="POST">
                @csrf
                <input type="hidden" id="totalPembayaran" name="totalPembayaran">
                <input type="hidden" id="customerId" name="idCustomer">
                <ul class="list-arrow ml-2">
                    <li>Total pembayaran : Rp.<div class="d-inline hargaTotal"></div></li>
                    <li>Uang
                            <div class="form-group ml-3 mr-3">
                                <input type="number" name="uang" id="uang" class="form-control ">
                            </div>
                    </li>
                    <li>Kembalian : <div class="d-inline ml-5">Rp. <div class="kembalian d-inline"></div></div></li>
                </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Bayar</button>
        </div>
    </form>
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

    $('#modalBayar').on('shown.bs.modal', function () {
    $('#uang').trigger('focus')
})
    $('#ket1').hide();
    $('#menu').hide();
    $('#ket2').hide();
    $('#ket3').hide();
    $('#tambah').hide();
    $('#mulai').on('click',function(){
        $.ajax({
            url:"{{url('kasir/addCustomer')}}",
            type:"POST",
            success:function (data) {
                $('#idCustomer').val(data);
                $('#customerId').val(data);
            }
        });

        $('#menu').show();
        $('#kode').focus();
        $(this).hide();
    });

    $('#kode').keyup(function(){
        var kode = $(this).val();
        $.ajax({
            url:"{{url('kasir/kode')}}",
            type:"POST",
            data:{kode:kode},
            success:function (data) {
                if(kode==""){
                    $('#ket1').hide();
                    $('#ket2').hide();
                    $('#ket3').hide();
                    $('#jumlah').val(1);
                }else{
                    $('#tambah').show();
                    $('#ket1').show();
                    $('#ket2').show();
                    $('#ket3').show();
                    $('#nama').val(data[0].nama);
                    $('#idProduct').val(data[0].id);
                    $('#harga').val(data[0].harga);
                    $('#total').val(data[0].harga);
                    var harga =  $('#harga').val();
                    $('#jumlah').change(function(){
                        var jumlah = $('#jumlah').val();
                        var total = jumlah * harga;
                        $('#total').val(total);
                    });
                    $('#jumlah').keyup(function(){
                        var jumlah = $('#jumlah').val();
                        var total = jumlah * harga;
                        $('#total').val(total);
                    });
                }
            }
        })
    });

    $('#tambah').on('click',function(){
        var idCustomer = $('#idCustomer').val();
        var idProduct = $('#idProduct').val();
        var jumlah = $('#jumlah').val();
        var total = $('#total').val();

        $.ajax({
            url:"{{url('kasir/addTransaksi')}}",
            type:"POST",
            data:{idCustomer:idCustomer,idProduct:idProduct,jumlah:jumlah,total:total},
            success:function (data) {
                console.log("tambah");

                // $('#result').append(data);
            }
        });

        $('#formTambah')[0].reset();
        $('#kode').focus();
        $('#ket1').hide();
        $('#ket2').hide();
        $('#ket3').hide();
        fetch();

    });

    $(document).on('click', '.delete', function(){
        var id = $(this).attr("id");
        console.log(id);

        if(confirm("Are you sure you want to delete this records?"))
        {
        $.ajax({
            url:"{{ url('kasir/delete') }}",
            method:"POST",
            data:{id:id},
            success:function(data)
            {
                console.log("terhapus");

            fetch();
            }
        });
        }
    });

    function fetch(){
        var idCustomer = $('#idCustomer').val();
        $.ajax({
            url:"{{url('kasir/fetchData')}}",
            type:"POST",
            dataType:"json",
            data:{idCustomer:idCustomer},
            success:function (data) {
                var a = data.length + 1;
                var b = parseInt(a);

                var html ='';
                html +='<tr>';
                html +='<td></td>';
                html +='<td></td>';
                html += '<td></td>';
                html += '<td></td>';
                html += '<td></td>';
                html += '<td></td></tr>';
                for(var count=1; count < b; count++)
                {
                html +='<tr>';
                html +='<td>'+count+'</td>';
                html +='<td>'+data[count-1].nama+'</td>';
                html += '<td>'+data[count-1].harga+'</td>';
                html += '<td>'+data[count-1].jumlah+'</td>';
                html += '<td>'+data[count-1].total_harga+'</td>';
                html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="'+data[count-1].id+'">Delete</button></td></tr>';
                }
                $('tbody').html(html);
            }
        });

        $.ajax({
            url:"{{url('kasir/fetchHarga')}}",
            type:"POST",
            data:{idCustomer:idCustomer},
            success:function (data) {
                $('.hargaTotal').html(data);
                $('#totalPembayaran').val(data);

            }
        });
    }

    $('#uang').keyup(function(){
        var uang = $(this).val();
        var totalPembayaran = $('#hargaTotal').html();
        var hasil = uang - totalPembayaran;
        $('.kembalian').html(hasil);

    });

    });

    </script>
@endsection
