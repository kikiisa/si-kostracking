@extends('master.layout',['title' => 'Kategori'])
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kategori</h1>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session()->has('errors'))
            <div class="alert alert-danger">{{session('errors')}}</div>
        @endif
        <a href="{{ route('kategori.tambah') }}" class="btn btn-primary"><i class="fa fa-server mr-2"></i>Tambah Kategori</a>
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
                                            <th>Kategori</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $x)
                                            <tr>
                                                <td>{{ $loop->index+=1 }}</td>
                                                <td>{{ $x->nama }}</td>
                                                <td>
                                                    <form action="{{ Route("kategori.delete",$x->id) }}" method="post">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button onclick="return confirm('apakah anda yakin ingin menghapus data ini ?')" class="btn btn-danger">Hapus</button>
                                                        <a href="{{ Route("kategori.edit",$x->uuid) }}" class="btn btn-warning">Edit</a>
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