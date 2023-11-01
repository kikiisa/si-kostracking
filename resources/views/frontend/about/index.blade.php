@extends('frontend.master', ['title' => 'Tentang Kami'])
@section('content')
<section class="slider container">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
            <div class="card border-0">
                <div class="card-body">
                    <h3>SISTEM INFORMASI KOS</h3>
                    <hr>
                    @empty($record)
                        <div class="p-4 bg-danger text-light text-center rounded-4 fw-bold">Informasi Website Masih Kosong</div>
                    @else
                        {!! $data->deskripsi_apps !!}
                    @endempty
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
