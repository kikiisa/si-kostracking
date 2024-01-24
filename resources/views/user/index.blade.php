@extends('master.layout',['title' => 'Data Pemetaan Wilayah'])
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Master User</h1>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session()->has('errors'))
            <div class="alert alert-danger">{{session('errors')}}</div>
        @endif
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
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Role</th>
                                            <th>Legalitas Pajak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($data as $item)
                                          <tr>
                                            <td>{{$loop->index+=1}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->phone}}</td>
                                            <td>
                                                <form action="{{Route('user.status',$item->id)}}" method="post">
                                                    @csrf
                                                    @method("PUT")
                                                    @if ($item->status == 'aktif')
                                                        <button name="status" value="nonaktif" class="btn btn-success">Aktif</button>
                                                    @else
                                                        <button name="status" value="aktif" class="btn btn-danger">Nonaktif</button>    
                                                    @endif
                                                </form>
                                            </td>
                                            <td>{{$item->role}}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-primary" onclick="return openModal('{{$item->dokument}}')">Dokument Legalitas</a>
                                            </td>
                                            <td>
                                                <form action="{{Route('user.delete',$item->id)}}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button class="btn btn-danger" onclick="return confirm('apakah anda yakin User Ini akan Di Hapus ?')"><i class="fa fa-trash"></i></button>
                                                    
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
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">File Legalitas Pajak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="" type="application/pdf" height="600px" class="legalitasdoc w-100" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const documentShow = document.querySelector(".legalitasdoc");
        const openModal = (data) => 
        {
            documentShow.src = data
            $('#modal').modal({
                backdrop: 'static',
                keyboard: false
            }).show()
        }
    </script>
@endsection