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
                                            <input class="form-check-input privilege-input" type="checkbox" value=""
                                                id="{{ $mm->id }}_has_view" data-id_menu="{{ $mm->id }}"
                                                data-section="has_view">
                                            <label class="form-check-label" for="{{ $mm->id }}_has_view">
                                                view
                                            </label>
                                        </div>
                                        <div class="col-4 form-check">
                                            <input class="form-check-input privilege-input" type="checkbox" value=""
                                                id="{{ $mm->id }}_has_create" data-id_menu="{{ $mm->id }}"
                                                data-section="has_create">
                                            <label class="form-check-label" for="{{ $mm->id }}_has_create">
                                                create
                                            </label>
                                        </div>
                                        <div class="col-4 form-check">
                                            <input class="form-check-input privilege-input" type="checkbox" value=""
                                                id="{{ $mm->id }}_has_update" data-id_menu="{{ $mm->id }}"
                                                data-section="has_update">
                                            <label class="form-check-label" for="{{ $mm->id }}_has_update">
                                                Update
                                            </label>
                                        </div>
                                        <div class="col-4 form-check">
                                            <input class="form-check-input privilege-input" type="checkbox" value=""
                                                id="{{ $mm->id }}_has_delete" data-id_menu="{{ $mm->id }}"
                                                data-section="has_delete">
                                            <label class="form-check-label" for="{{ $mm->id }}_has_delete">
                                                Delete
                                            </label>
                                        </div>
                                    </div>
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

                        <form id="formCreateUserGroup" action="{{ route('usergroup.store') }}" method="POST"
                            enctype="multipart/form-data">

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
                                            <input class="form-check-input privilege-input" type="checkbox" value=""
                                                id="{{ $mm->id }}_has_view" data-id_menu="{{ $mm->id }}"
                                                data-section="has_view">
                                            <label class="form-check-label" for="{{ $mm->id }}_has_view">
                                                view
                                            </label>
                                        </div>
                                        <div class="col-4 form-check">
                                            <input class="form-check-input privilege-input" type="checkbox" value=""
                                                id="{{ $mm->id }}_has_create" data-id_menu="{{ $mm->id }}"
                                                data-section="has_create">
                                            <label class="form-check-label" for="{{ $mm->id }}_has_create">
                                                create
                                            </label>
                                        </div>
                                        <div class="col-4 form-check">
                                            <input class="form-check-input privilege-input" type="checkbox" value=""
                                                id="{{ $mm->id }}_has_update" data-id_menu="{{ $mm->id }}"
                                                data-section="has_update">
                                            <label class="form-check-label" for="{{ $mm->id }}_has_update">
                                                Update
                                            </label>
                                        </div>
                                        <div class="col-4 form-check">
                                            <input class="form-check-input privilege-input" type="checkbox" value=""
                                                id="{{ $mm->id }}_has_delete" data-id_menu="{{ $mm->id }}"
                                                data-section="has_delete">
                                            <label class="form-check-label" for="{{ $mm->id }}_has_delete">
                                                Delete
                                            </label>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <input type="hidden" name="privileges" id="inputPrivileges" />
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
        <script>
            $("#formCreateUserGroup").submit(function(e) {
                let privilege_component = $("#staticBackdrop .privilege-input");
                let raw_priv = [];
                for (let i = 0; i < privilege_component.length; i++) {
                    let el = $(privilege_component[i]);
                    let id_menu = el.data('id_menu');
                    let is_checked = el.prop('checked');
                    let section = el.data('section')
                    raw_priv.push({
                        id_menu,
                        is_checked,
                        section
                    });
                }

                // FIND UNIQUE ID
                let privileges = [];
                let unique_id = [...new Set(raw_priv.map(item => item.id_menu))];
                for (let i = 0; i < unique_id.length; i++) {
                    let id = unique_id[i];
                    let privilege = raw_priv.filter(el => el.id_menu == id);
                    let obj_priv = {};
                    for (let j = 0; j < privilege.length; j++) {
                        let data = privilege[j];
                        obj_priv[data.section] = data.is_checked ? 1 : 0;
                        obj_priv['id_menu'] = data.id_menu;
                    }
                    privileges.push(obj_priv);
                }
                $("#inputPrivileges").val(JSON.stringify(privileges))
            });
        </script>
    @endsection
@endsection
