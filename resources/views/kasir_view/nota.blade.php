@extends('layouts.kasir')
@section('content')
<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding mt-5 mb-5">
    <div id="print">
        <div class="card">
            <div class="card-header p-4">
                <div class="float-right">
                    @foreach ($customer as $item)
                    <h3 class="mb-0">Invoice #{{$item->id}}</h3>
                    Date: {{date("d, M Y", strtotime($item->updated_at))}}
                    @endforeach
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        @foreach ($toko as $item)
                        <h3 class="text-dark mb-1">{{$item->nama}}</h3>
                        <div>{{$item->alamat}}</div>
                        <div>Jl.surodinawan</div>
                        {{-- <div>Email: contact@example.com</div> --}}
                        <div>Phone: {{$item->nomor}}</div>
                        @endforeach
                    </div>
                    <div class="col-sm-6 ">
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th class="right">Price</th>
                                <th class="center">Qty</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $item)
                            <tr>
                                <td class="center">{{$loop->iteration}}</td>
                                <td class="left strong">{{$item->nama}}</td>
                                <td class="right">{{$item->harga}}</td>
                                <td class="center">{{$item->jumlah}}</td>
                                <td class="right">{{$item->total_harga}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto" style="margin-right: 100px">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Subtotal</strong>
                                    </td>
                                    <td class="right">Rp. {{$total}}</td>
                                </tr>
                                @foreach ($customer as $item)
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Uang</strong>
                                    </td>
                                    <td class="right">Rp. {{$item->uang}}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Kembalian</strong>
                                    </td>
                                    <td class="right">Rp. {{$item->kembalian}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer bg-white text-center">
        <button class="btn btn-secondary btn-rounded" id="btnPrint" style="width:300px">Print</button>
    </div>
</div>

<script>
    $(function(){
        $('#btnPrint').on('click',function(){
            window.print();
        });
    });
</script>
@endsection
