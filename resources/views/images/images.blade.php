@extends('master.layout',['title' => 'Data Slider'])
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Slider</h1>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session()->has('errors'))
            <div class="alert alert-danger">{{session('errors')}}</div>
        @endif
        <a href="{{ route('fasilitas.create') }}" class="btn btn-primary"><i class="fa fa-server mr-2"></i>Tambah Gambar Slider</a>
        <div class="section-body py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Slider</th>
                                            <th>Gambar</th>
                                          
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $x)
                                            <tr>
                                                <td>{{ $loop->index+=1 }}</td>
                                                <td>{{ $x->judul }}</td>
                                                <td><img src="{{ asset('assets/fasilitas/'.$x->image) }}" width="90" alt="" srcset=""></td>
                                                <td>
                                                    <form action="{{ Route("fasilitas.delete",$x->id) }}" method="post">
                                                        @csrf
                                                        @method("DELETE")
                                                        <input type="text" name="id" value="{{ $x->id }}" hidden>
                                                        <button onclick="return confirm('apakah anda yakin ingin menghapus data ini ?')" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>                          
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection