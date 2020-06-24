@extends('layouts.owner')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="row mt-5 mb-5 mr-5 ml-5">
                <div class="col col-4">
                    <h4 class="card-title">Icon perusahaan</h4>
                    <img src="" class="img-thumbnail" alt="">
                </div>
                <div class="col">
                    <ul class="list-group text-left">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">
                                    <label for="address">Nama perusahaan</label>
                                </div>
                                <div class="col">
                                    <label for="">:</label>
                                </div>
                                <div class="col">
                                    example
                                    <a href="#" data-toggle="modal" data-target="#nama" class="badge badge-primary">Change</a>
                                </div>
                            </div>
                        </li>
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
    </div>
</div>

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

    {{-- modal nama --}}
    <div class="modal fade" id="nama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ganti nama</h5>
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
                        <h5 class="modal-title" id="exampleModalLabel">Ganti nomor</h5>
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
@endsection
