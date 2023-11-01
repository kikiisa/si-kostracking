@extends('frontend.master')
@section('content')
<section class="product container" style="margin-bottom:70px;margin-top:160px;">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Login Ke Akun</h5>
                    <form action="{{ route('login') }}" method="post">
                        @csrf                       
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                            <div class="form-floating">
                                <input name="email" type="text" class="form-control" id="floatingInputGroup1"
                                    placeholder="Username">
                                <label for="floatingInputGroup1">Email</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            <div class="form-floating">
                                <input name="password" type="password" class="form-control" id="floatingInputGroup1"
                                    placeholder="Username">
                                <label for="floatingInputGroup1">Password</label>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-success mt-1 mb-2 text-light fw-bold w-100">Masuk</button>
                        <small class="text-muted">Belum Punya Account ? <a href="{{Route('registrasi')}}">Registrasi Sekarang
                        !</a></small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('theme/vendor/toastify/src/toastify.js') }}"></script>
    @if (count($errors) > 0)
        <script>
            var errors = @json($errors->all());
            Toastify({
                text: errors,
                duration: 3000,
                close: true,
                backgroundColor: "#D61355",
            }).showToast();
        </script>
    @enderror
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
