@extends('master.layout', ['title' => 'Edit Kategori'])
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Kategori Wisata</h1>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success">Data Berhasil Di Tambahkan</div>
        @endif
        @if (session()->has('errors'))
            <div class="alert alert-danger">Data Gagal Di Tambahkan</div>
        @endif
        <div class="section-body py-4">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-light">Kategori Wisata</div>
                        <div class="card-body">
                            <form action="{{ route('kategori.update',$data->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Kategori</label>
                                        <input type="text" class="form-control" value="{{ $data->nama }}" name="nama"
                                        placeholder="Kategori">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" placeholder="Deskripsi">{{ $data->deskripsi }}</textarea>
                                </div>
                                <button class="btn btn-primary mt-1">Simpan</button>
                                <a href="{{ route('kategori') }}" class="btn btn-light mt-1">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
