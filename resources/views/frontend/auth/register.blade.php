@extends('frontend.master')
@section('content')
    <section class="product container" style="margin-bottom:70px;margin-top:160px;">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-start fw-bold">REGISTRASI</h4>
                        <form action="{{ Route('registrasi.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label class="mb-2 mt-2"><strong>Nama Lengkap</strong></label>
                                <input type="text" name="name" placeholder="Nama Lengkap" class="form-control">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="mb-2 mt-2"><strong>Email</strong></label>
                                <input type="text" name="email" placeholder="Email" class="form-control">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="mb-2 mt-2"><strong>Phone</strong></label>
                                <input type="text" name="phone" placeholder="phone" class="form-control">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="mb-2 mt-2"><strong>Password</strong></label>
                                <input type="password" name="password" placeholder="Password" class="form-control">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="mb-2 mt-2"><strong>Konfirmasi Password</strong></label>
                                <input type="password" name="confirm" placeholder="Konfirmasi Password"
                                    class="form-control">
                                @error('confirm')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                            
                            <div class="form-group">
                                <label class="mb-2 mt-2"><strong>Dokumen Legalitas (Pajak)</strong></label>
                                <input type="file" name="legalitas" id="legalitas" class="form-control">
                                @error('legalitas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                
                            </div>
                            
                            <button class="btn btn-success w-100 mt-4 mb-4 fw-bold">Simpan</button>
                            <small class="text-muted mt-1">Sudah Punya Account ? <a href="{{Route('login')}}">Login Sekarang
                                    !</a></small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('theme/vendor/toastify/src/toastify.js') }}"></script>
    @if (session()->has('error'))
        <script>
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                backgroundColor: "#D61355",
            }).showToast();
        </script>
    @endif
    @if (session()->has('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                backgroundColor: "#19C37D",
            }).showToast();
        </script>
    @endif
@endsection
