@extends('master.layout', ['title' => 'Setting Password'])
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success">Data Berhasil Di Update</div>
        @endif
        @if (session()->has('errors'))
            <div class="alert alert-danger">Data Gagal Di Update</div>
        @endif
        <div class="section-body py-4">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-light">Ubah Password</div>
                        <div class="card-body">
                            @if ($errors->has('current_password'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('current_password') }}
                                </div>
                            @endif
                            <form action="{{ route('user.password')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Password Lama</label>
                                    <input type="text" placeholder="Password Lama"  name="old" class="form-control">
                                    @error('old')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="text" placeholder="Password Baru" name="new" class="form-control">
                                    @error('new')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input type="text" placeholder="Konfirmasi Password" name="confirm" class="form-control">
                                    @error('confirm')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <button class="btn btn-primary mt-1">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
