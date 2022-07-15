@extends('layout.admin')
@section('section')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1><b>Pengumpulan</b>, <span>Feature</span></h1>
                            <h1>Image yang telah terhapus, tidak dapat di download <br>(jika di download akan menghasilkan error)</h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Pengumpulan Feature</li>
                            </ol>
                        </div>
                    </div>
                    {{-- <a class="btn btn-primary btn-flat btn-addon float-right" href="{{ route('admin.categories.create') }}">
                        <i class="ti-plus"></i>
                        Tambah</a> --}}
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <section id="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="bootstrap-data-table-panel">
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>File Pengumpulan</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $data as $datas )
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $datas->name }}</td>
                                                <td>{{ $datas->email }}</td>
                                                <td>
                                                    <img src="{{ URL::asset('features_asset/pengumpulan/'.$datas->features->file) }}" alt="" width="100px">
                                                    <form action="{{ route('admin.pengumpulan.file', $datas->id) }}" method="POST">
                                                        @csrf
                                                        <input class="btn btn-primary" type="submit" name="submit" value="Download" id="submit">
                                                    </form>
                                                </td>
                                                <td>
                                                    @if($datas->features->status == "2")
                                                        Sudah Di Cek
                                                    @elseif($datas->features->status == "1")
                                                        Belum Di Cek
                                                    @else
                                                        Belum Dikumpul
                                                    @endif
                                                </td>
                                                <td>{{ $datas->features->updated_at }}</td>
                                                <td>
                                                    @if($datas->features->status == "1")
                                                    <form style="display: inline" action="{{ route('admin.pengumpulan.feature.accept', $datas->id) }}" id="delete-form-verify{{ $datas->id }}" method="POST">
                                                        @csrf
                                                        <button value="{{ $datas->id }}" id="btn-submit-verify"  class="btn btn-success btn-flat btn-addon" type="submit">Tandai</button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
            </section>
        </div>
    </div>
</div>
@endsection