@extends('master.layout',['title' => 'Edit Informasi'])
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Informasi</h1>
    </div>
    @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('errors') }}</div>
    @endif
        
    @error('deskripsi_apps')
        <div class="alert alert-danger">{{ $message }}</div>    
    @enderror
    @error('image')
        <div class="alert alert-danger">{{ $message }}</div>    
    @enderror
    <div class="section-body py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">Ubah Informasi</div>
                    <div class="card-body">
                        <div class="map" id="map" style="width: 100%">
                        </div>
                        <form action="{{ route('setting.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Aplikasi</label>
                                <textarea name="deskripsi_apps" class="summernote" id="deskripsi" cols="30" rows="10" placeholder="Deskripsi Aplikasi">{{ $data->deskripsi_apps }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Strukture Organisasi</label>
                                <input type="file" name="image" id="image"  class="form-control-file">
                                <small class="text-danger">*Jpg,Png,Jpeg,Gif</small>
                            </div>                           
                            <button class="btn btn-primary">Ubah Informasi</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection