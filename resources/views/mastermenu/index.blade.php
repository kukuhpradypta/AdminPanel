@extends('dashboard')
@section('title')
    Master Menu
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <button type="button" class="btn btn-success mb-4" onclick="create()">
                            <i class="fas fa-folder-plus"> Tambah
                                Master Menu</i>
                        </button>
                        <table class="table table-bordered">
                            <thead class="bg-dark">
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Sort</th>
                                    <th scope="col">Menu Group</th>
                                    <th scope="col">Is Hidden</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($mastermenus as $mastermenu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mastermenu->name }}</td>
                                        <td>{{ $mastermenu->icon }}</td>
                                        <td>{{ $mastermenu->url }}</td>
                                        <td>{{ $mastermenu->sort }}</td>
                                        <td>{{ $mastermenu->menugroup }}</td>
                                        <td>{{ $mastermenu->ishidden }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('mastermenu.destroy', $mastermenu->id) }}" method="POST">
                                                <div onclick="findData({{ $mastermenu->id }})"
                                                    class="btn btn btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </div>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Mastermenu belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if (session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!');
        
        @elseif(session()->has('error'))
        
            toastr.error('{{ session('error') }}', 'GAGAL!');
        
        @endif

        function create() {
            $.get("{{ url('mastermenu') }}", {},
                function(data, status) {
                    $("#staticBackdrop").modal('show');

                });
        }
        // FIND DATA mastermenu
        function findData(id) {
            $.ajax({
                url: `{{ env('APP_URL') }}/mastermenu/find/${id}`,
                method: 'GET',
                accept: 'application/json',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        $("#edit_nama_group").val(response.data.name);
                        $("#edit_icon_group").val(response.data.icon);
                        $("#edit_url_group").val(response.data.url);
                        $("#edit_sort_group").val(response.data.sort);
                        $("#edit_menugroup_group").val(response.data.menugroup);
                        $("#edit_ishidden_group").val(response.data.ishidden);
                        $("#exampleModal form").attr('action', `http://localhost:8000/mastermenu/${id}`);
                        $("#exampleModal").modal();
                    } else {
                        alert(response.msg)
                    }
                },
                error: function() {
                    alert('terjadi kesalahan');
                }
            });


        }
    </script>

    @section('modal')
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input id="edit_nama_group" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $mastermenu->name) }}" placeholder="Masukkan Nama ">

                                <!-- error message untuk name -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Icon</label>
                                <input id="edit_icon_group" type="text" class="form-control @error('icon') is-invalid @enderror"
                                    name="icon" value="{{ old('icon', $mastermenu->icon) }}" placeholder="Masukkan icon ">

                                <!-- error message untuk icon -->
                                @error('icon')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Url</label>
                                <input id="edit_url_group" type="text" class="form-control @error('url') is-invalid @enderror"
                                    name="url" value="{{ old('url', $mastermenu->url) }}" placeholder="Masukkan url ">

                                <!-- error message untuk url -->
                                @error('url')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Sort</label>
                                <input id="edit_sort_group" type="text" class="form-control @error('sort') is-invalid @enderror"
                                    name="sort" value="{{ old('sort', $mastermenu->sort) }}" placeholder="Masukkan sort ">

                                <!-- error message untuk sort -->
                                @error('sort')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Menu Group</label>
                                <input id="edit_menugroup_group" type="text"
                                    class="form-control @error('menugroup') is-invalid @enderror" name="menugroup"
                                    value="{{ old('menugroup', $mastermenu->menugroup) }}"
                                    placeholder="Masukkan menu group ">

                                <!-- error message untuk menugroup -->
                                @error('menugroup')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Is hidden</label>
                                <input id="edit_ishidden_group" type="text"
                                    class="form-control @error('ishidden') is-invalid @enderror" name="ishidden"
                                    value="{{ old('ishidden', $mastermenu->ishidden) }}" placeholder="Masukkan menu group ">

                                <!-- error message untuk ishidden -->
                                @error('ishidden')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-edit">
                                    Edit</i></button>
                            <button type="reset" class="btn btn-md btn-warning"><i class="fas fa-redo-alt text-white">
                                    Reset</i></button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('modalcreate')
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('mastermenu.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" placeholder="Masukkan Name">

                                <!-- error message untuk name -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Icon</label>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon"
                                    value="{{ old('icon') }}" placeholder="Masukkan Icon">

                                <!-- error message untuk name -->
                                @error('icon')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Url</label>
                                <input type="text" class="form-control @error('url') is-invalid @enderror" name="url"
                                    value="{{ old('url') }}" placeholder="Masukkan URL">

                                <!-- error message untuk name -->
                                @error('url')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Sort</label>
                                <input type="text" class="form-control @error('sort') is-invalid @enderror" name="sort"
                                    value="{{ old('sort') }}" placeholder="Masukkan Sort">

                                <!-- error message untuk name -->
                                @error('sort')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Menu Group</label>
                                <input type="text" class="form-control @error('menugroup') is-invalid @enderror"
                                    name="menugroup" value="{{ old('menugroup') }}" placeholder="Masukkan Nama menugroup">

                                <!-- error message untuk name -->
                                @error('menu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Is Hidden</label>
                                <input type="text" class="form-control @error('ishidden') is-invalid @enderror" name="ishidden"
                                    value="{{ old('ishidden') }}" placeholder="Masukkan Is Hidden">

                                <!-- error message untuk name -->
                                @error('ishidden')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-save">
                                    Simpan</i></button>
                            <button type="reset" class="btn btn-md btn-warning"><i class="fas fa-redo-alt text-white">
                                    Reset</i></button>
                            <a href="{{ route('usergroup.index') }}" class="btn btn-md btn-success"><i
                                    class="fas fa-backspace">
                                    Kembali</i></a>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endsection
@endsection
