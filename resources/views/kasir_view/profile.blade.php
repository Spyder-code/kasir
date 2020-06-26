@extends('layouts.kasir')
@section('content')
<div class="container">
    @error('nomor')
    <div class="alert alert-danger mt-3">{{ $message }}</div>
    @enderror
    @error('alamat')
    <div class="alert alert-danger mt-3">{{ $message }}</div>
    @enderror
    @if ($message = Session::get('success'))
        <div class="row">
            <div class="col mt-3">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{{ $message }}</strong>
                </div>
            </div>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="row">
            <div class="col mt-3">
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{{ $message }}</strong>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col text-center">
            <div class="card mt-3 ml-5">
                <img class="img-thumbnail ml-5 mr-5 mt-3" src="" style="height:260px">
                <div class="card-body">
                    <h5 class="card-title">Nama Owner</h5>
                    <ul class="list-group text-left">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">
                                    <label for="address">Alamat</label>
                                </div>
                                <div class="col">
                                    <label for="">:</label>
                                </div>
                                <div class="col">
                                    alamat
                                    <a href="#" data-toggle="modal" data-target="#alamat" class="badge badge-primary">Change</a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">
                                    <label for="address">Phone</label>
                                </div>
                                <div class="col">
                                    <label for="">:</label>
                                </div>
                                <div class="col">
                                    0834545462
                                    <a href="#" data-toggle="modal" data-target="#nomor" class="badge badge-primary">Change</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
                <div class="col mt-3">
                <h4 class="mt-5">Ganti Password</>
                <hr>
                <form class="form-row"  method="post" action="{{url('changePasswordMitra')}}">
                    @csrf
                    <div class="col">
                        <div class="form-group">
                            <label for="pass1">Old Password</label>
                            <input type="password" class="form-control" name="pass1">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="pass2">New Password</label>
                            <input type="password" class="form-control" name="pass2">
                        </div>
                        <button type="submit" class="btn btn-success mb-2 float-right mr-5">Change</button>
                    </div>
                </form>
                <hr>

                {{-- modal alamat --}}
                <div class="modal fade" id="alamat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ganti alamat</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-row"  method="post" action="{{url('changeAlamat')}}">
                                    @csrf
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="alamat" value="">
                                        </div>
                                    </div>
                            </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Ganti</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>

                {{-- modal nomor --}}
                <div class="modal fade" id="nomor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ganti nomor telp.</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-row"  method="post" action="{{url('changeNomor')}}">
                                    @csrf
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="nomor" value="">
                                        </div>
                                    </div>
                            </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Ganti</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</div>
@endsection
