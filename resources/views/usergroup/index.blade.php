@extends('dashboard')
@section('title')
    User Group
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <button type="button" class="btn btn-success mb-4" onclick="create()">
                            <i class="fas fa-folder-plus"> Tambah
                                User Group</i>
                        </button>
                        <table class="table table-bordered">
                            <thead class="bg-dark">
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($usergroups as $usergroup)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $usergroup->name }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('usergroup.destroy', $usergroup->id) }}" method="POST">

                                                <div onclick="findData({{ $usergroup->id }})" class="btn btn btn-primary">
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
                                        Data usergroup belum Tersedia.
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


        $(document).ready(function() {});

        function create() {
            $.get("{{ url('usergroup') }}", {},
                function(data, status) {
                    $("#staticBackdrop").modal('show');

                });
        }
        // FIND DATA USER GROUP
        function findData(id) {
            $.ajax({
                url: `{{ env('APP_URL') }}/usergroup/find/${id}`,
                method: 'GET',
                accept: 'application/json',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        $("#edit_nama_group").val(response.data.name);
                        $("#exampleModal form").attr('action', `http://localhost:8000/usergroup/${id}`);
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
                                    name="name" value="{{ old('name', $usergroup->name) }}"
                                    placeholder="Masukkan Nama usergroup">

                                <!-- error message untuk name -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="container pb-5">
                                @foreach ($usergroupprivilages as $userprivilage)
                                    @foreach ($mastermenus as $mm)
                                        <h5>{{ $mm->name }}</h5>


                                        <div class="row mb-4">

                                            <div class="col-4 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="has_view_{{ $userprivilage->id_menu }}"
                                                    {{ $userprivilage->has_view ? 'checked' : '' }}>
                                                <label class="form-check-label" for="has_view_{{ $userprivilage->id_menu }}">
                                                    view
                                                </label>
                                            </div>
                                            <div class="col-4 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="has_create_{{ $userprivilage->id_menu }}"
                                                    {{ $userprivilage->has_create ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="has_create_{{ $userprivilage->id_menu }}">
                                                    create
                                                </label>
                                            </div>
                                            <div class="col-4 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="has_update_{{ $userprivilage->id_menu }}"
                                                    {{ $userprivilage->has_update ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="has_update_{{ $userprivilage->id_menu }}">
                                                    Update
                                                </label>
                                            </div>
                                            <div class="col-4 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="has_delete_{{ $userprivilage->id_menu }}"
                                                    {{ $userprivilage->has_delete ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="has_delete_{{ $userprivilage->id_menu }}">
                                                    Delete
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
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

                        <form action="{{ route('usergroup.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" placeholder="Masukkan Nama usergroup">

                                <!-- error message untuk name -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="container pb-5">
                                @foreach ($mastermenus as $mm)
                                    <h5>{{ $mm->name }}</h5>
                                    <div class="row mb-4">
                                        <div class="col-4 form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="has_view_{{ $userprivilage->id_menu }}"
                                                {{ $userprivilage->has_view ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_view_{{ $userprivilage->id_menu }}">
                                                view
                                            </label>
                                        </div>
                                        <div class="col-4 form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="has_create_{{ $userprivilage->id_menu }}"
                                                {{ $userprivilage->has_create ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_create_{{ $userprivilage->id_menu }}">
                                                create
                                            </label>
                                        </div>
                                        <div class="col-4 form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="has_update_{{ $userprivilage->id_menu }}"
                                                {{ $userprivilage->has_update ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_update_{{ $userprivilage->id_menu }}">
                                                Update
                                            </label>
                                        </div>
                                        <div class="col-4 form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="has_delete_{{ $userprivilage->id_menu }}"
                                                {{ $userprivilage->has_delete ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_delete_{{ $userprivilage->id_menu }}">
                                                Delete
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- <div class="container pb-5">
                                @foreach ($usergroupprivilages as $userprivilage)
                                    @foreach ($mastermenus as $mm)
                                        <h5>{{ $mm->name }}</h5>


                                        <div class="row mb-4">

                                            <div class="col-4 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="has_view_{{ $userprivilage->id_menu }}"
                                                    {{ $userprivilage->has_view ? 'checked' : '' }}>
                                                <label class="form-check-label" for="has_view_{{ $userprivilage->id_menu }}">
                                                    view
                                                </label>
                                            </div>
                                            <div class="col-4 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="has_create_{{ $userprivilage->id_menu }}"
                                                    {{ $userprivilage->has_create ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="has_create_{{ $userprivilage->id_menu }}">
                                                    create
                                                </label>
                                            </div>
                                            <div class="col-4 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="has_update_{{ $userprivilage->id_menu }}"
                                                    {{ $userprivilage->has_update ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="has_update_{{ $userprivilage->id_menu }}">
                                                    Update
                                                </label>
                                            </div>
                                            <div class="col-4 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="has_delete_{{ $userprivilage->id_menu }}"
                                                    {{ $userprivilage->has_delete ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="has_delete_{{ $userprivilage->id_menu }}">
                                                    Delete
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div> --}}

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
