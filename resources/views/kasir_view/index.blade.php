@extends('layouts.kasir')
@section('content')
    <div class="row text-center mb-5 mt-3">
        <div class="col">
            <button class="btn btn-primary btn-rounded btn-lg">1</button>
        </div>
        <div class="col">
            <hr>
        </div>
        <div class="col">
            <button class="btn btn-primary btn-rounded btn-lg">2</button>
        </div>
        <div class="col">
            <hr>
        </div>
        <div class="col">
            <button class="btn btn-primary btn-rounded btn-lg">3</button>
        </div>
    </div>
    <div class="row mb-5 ml-5">
        <div class="col col-sm-4 mt-3">
            <div class="card">
                <h2 class="card-title text-center mt-5">Produk</h2>
                <div class="row">
                    <div class="col col-12">
                        <form action="post">
                            @csrf
                            <div class="form-group mr-3 ml-3">
                                <label for="kode">Kode produk</label>
                                <input type="text" name="kode" id="kode" class="form-control text-center" autofocus style="border-color: rgb(89, 185, 241)">
                            </div>
                            <div class="form-group mr-3 ml-3">
                               <div class="row">
                                    <div class="col">
                                        <label for="kode">Nama produk</label>
                                        <input type="text" disabled name="kode" id="kode" class="form-control text-center" autofocus style="border-color: rgb(89, 185, 241)">
                                    </div>
                                    <div class="col">
                                        <label for="kode">Harga</label>
                                        <input type="text" disabled name="kode" id="kode" class="form-control text-center" autofocus style="border-color: rgb(89, 185, 241)">
                                    </div>
                               </div>
                            </div>
                            <div class="form-group mr-3 ml-3">
                                <label for="kode">Jumlah</label>
                                <input type="number" min="1" value="1" name="kode" id="kode" class="form-control text-center" autofocus style="border-color: rgb(89, 185, 241)">
                            </div>
                            <div class="form-group mr-3 ml-3">
                                <label for="kode">Sub-total (Rp)</label>
                                <input type="number" disabled min="1" value="1" name="kode" id="kode" class="form-control text-center" autofocus style="border-color: rgb(89, 185, 241)">
                            </div>
                            <button type="submit" class="btn btn-success ml-2 mb-3 mr-2 d-block" style="width:95%">Tambah</button>
                        </form>
                    </div>
                    {{-- <div class="col col-sm-6">
                        <label for="barcode">Barcode Scanner</label>
                        <img src="{{asset('image/green.jpg')}}" class="img-thumbnail mr-2">
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col col-sm-5 mt-3">
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
                            <tbody>
                                <tr>
                                <td>1</td>
                                <td>Jacob</td>
                                <td>1000</td>
                                <td>2</td>
                                <td class="text-danger"> 28.76% <i class="mdi mdi-arrow-down"></i></td>
                                <td><a class="btn btn-danger btn-rounded btn-sm text-light">Hapus</a></td>
                                </tr>
                                <tr>
                                <td>2</td>
                                <td>Messsy</td>
                                <td>1000</td>
                                <td>2</td>
                                <td class="text-danger"> 21.06% <i class="mdi mdi-arrow-down"></i></td>
                                <td><a class="btn btn-danger btn-rounded btn-sm text-light">Hapus</a></td>
                                </tr>
                                <tr>
                                <td>3</td>
                                <td>John</td>
                                <td>1000</td>
                                <td>2</td>
                                <td class="text-danger"> 35.00% <i class="mdi mdi-arrow-down"></i></td>
                                <td><a class="btn btn-danger btn-rounded btn-sm text-light">Hapus</a></td>
                                </tr>
                            </tbody>
                        </table>
                </div>
                <div class="card-footer">
                    <h4>Harga total : Rp.100.000</h4>
                </div>
            </div>
        </div>
        <div class="col col-sm-3 mt-3">
            <div class="card">
                <h4 class="card-title mt-5 text-center">Pembayaran</h4>
                <form action="post">
                    @csrf
                    <ul class="list-arrow ml-2">
                        <li>Total pembayaran : <div class="d-inline ml-5">Rp.100.000 </div></li>
                        <li>Uang
                                <div class="form-group ml-3 mr-3">
                                    <input type="text" name="uang" id="uang" class="form-control ">
                                </div>
                        </li>
                        <li>Kembalian : <div class="d-inline ml-5">Rp.100.000 </div></li>
                    </ul>
                    <hr>
                    <button type="submit" class="btn btn-primary float-right mb-2 mr-2 d-block">Bayar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
