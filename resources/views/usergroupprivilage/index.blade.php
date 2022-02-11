@extends('dashboard')
@section('title')
    User Group Privilage
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <button type="button" class="btn btn-success mb-4" onclick="create()">
                            <i class="fas fa-folder-plus"> Tambah
                                User Group privilage</i>
                        </button>
                        <table class="table table-bordered">
                            <thead class="bg-dark">
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">ID User Group</th>
                                    <th scope="col">ID Menu</th>
                                    <th scope="col">view</th>
                                    <th scope="col">create</th>
                                    <th scope="col">update</th>
                                    <th scope="col">delete</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($usergroupprivilages as $usergroupprivilage)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $usergroupprivilage->id_usergroup }}</td>
                                        <td>{{ $usergroupprivilage->id_menu }}</td>
                                        <td>{{ $usergroupprivilage->has_view }}</td>
                                        <td>{{ $usergroupprivilage->has_create }}</td>
                                        <td>{{ $usergroupprivilage->has_update }}</td>
                                        <td>{{ $usergroupprivilage->has_delete }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('usergroupprivilage.destroy', $usergroupprivilage->id) }}"
                                                method="POST">

                                                <div onclick="findData({{ $usergroupprivilage->id }})"
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
            $.get("{{ url('usergroupprivilage') }}", {},
                function(data, status) {
                    $("#staticBackdrop").modal('show');

                });
        }
        // FIND DATA USER GROUP
        function findData(id) {
            $.ajax({
                url: `{{ env('APP_URL') }}/usergroupprivilage/find/${id}`,
                method: 'GET',
                accept: 'application/json',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        $("#edit_id_usergroup_group").val(response.data.id_usergroup);
                        $("#edit_id_menu_group").val(response.data.id_menu);
                        $("#edit_has_view_group").val(response.data.has_view);
                        $("#edit_has_create_group").val(response.data.has_create);
                        $("#edit_has_update_group").val(response.data.has_update);
                        $("#edit_has_delete_group").val(response.data.has_delete);
                        $("#exampleModal form").attr('action',
                            `http://localhost:8000/usergroupprivilage/${id}`);
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
                                <label class="font-weight-bold">user group</label>
                                <input id="edit_id_user_group" type="text"
                                    class="form-control @error('id_usergroup') is-invalid @enderror" name="id_usergroup"
                                    value="{{ old('id_usergroup', $usergroupprivilage->id_usergroup) }}"
                                    placeholder="Masukkan user group">

                                <!-- error message untuk has view -->
                                @error('id_usergroup')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">nama menu</label>
                                <input id="edit_id_menu_group" type="text"
                                    class="form-control @error('id_menu') is-invalid @enderror" name="id_menu"
                                    value="{{ old('id_menu', $usergroupprivilage->id_menu) }}"
                                    placeholder="Masukkan nama menu">

                                <!-- error message untuk has view -->
                                @error('id_menu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has view</label>
                                <input id="edit_has_view_group" type="text"
                                    class="form-control @error('has_view') is-invalid @enderror" name="has_view"
                                    value="{{ old('has_view', $usergroupprivilage->has_view) }}"
                                    placeholder="Masukkan Has view">

                                <!-- error message untuk has view -->
                                @error('has_view')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Create</label>
                                <input id="edit_has_create_group" type="text"
                                    class="form-control @error('has_create') is-invalid @enderror" name="has_create"
                                    value="{{ old('has_create', $usergroupprivilage->has_create) }}"
                                    placeholder="Masukkan Has Create">

                                <!-- error message untuk has create -->
                                @error('has_create')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Update</label>
                                <input id="edit_has_update_group" type="text"
                                    class="form-control @error('has_update') is-invalid @enderror" name="has_update"
                                    value="{{ old('has_update', $usergroupprivilage->has_update) }}"
                                    placeholder="Masukkan Has Update">

                                <!-- error message untuk has update -->
                                @error('has_update')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Delete</label>
                                <input id="edit_has_delete_group" type="text"
                                    class="form-control @error('has_delete') is-invalid @enderror" name="has_delete"
                                    value="{{ old('has_delete', $usergroupprivilage->has_delete) }}"
                                    placeholder="Masukkan has delete">

                                <!-- error message untuk has delete -->
                                @error('has_delete')
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

                        <form action="{{ route('usergroupprivilage.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">user group</label>
                                <input id="edit_id_user_group" type="text"
                                    class="form-control @error('id_usergroup') is-invalid @enderror" name="id_usergroup"
                                    value="{{ old('id_usergroup', $usergroupprivilage->id_usergroup) }}"
                                    placeholder="Masukkan user group">

                                <!-- error message untuk has view -->
                                @error('id_usergroup')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">nama menu</label>
                                <input id="edit_id_menu_group" type="text"
                                    class="form-control @error('id_menu') is-invalid @enderror" name="id_menu"
                                    value="{{ old('id_menu', $usergroupprivilage->id_menu) }}"
                                    placeholder="Masukkan nama menu">

                                <!-- error message untuk has view -->
                                @error('id_menu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has view</label>
                                <input id="edit_has_view_group" type="text"
                                    class="form-control @error('has_view') is-invalid @enderror" name="has_view"
                                    value="{{ old('has_view', $usergroupprivilage->has_view) }}"
                                    placeholder="Masukkan Has view">

                                <!-- error message untuk has view -->
                                @error('has_view')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Create</label>
                                <input id="edit_has_create_group" type="text"
                                    class="form-control @error('has_create') is-invalid @enderror" name="has_create"
                                    value="{{ old('has_create', $usergroupprivilage->has_create) }}"
                                    placeholder="Masukkan Has Create">

                                <!-- error message untuk has create -->
                                @error('has_create')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Update</label>
                                <input id="edit_has_update_group" type="text"
                                    class="form-control @error('has_update') is-invalid @enderror" name="has_update"
                                    value="{{ old('has_update', $usergroupprivilage->has_update) }}"
                                    placeholder="Masukkan Has Update">

                                <!-- error message untuk has update -->
                                @error('has_update')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Delete</label>
                                <input id="edit_has_delete_group" type="text"
                                    class="form-control @error('has_delete') is-invalid @enderror" name="has_delete"
                                    value="{{ old('has_delete', $usergroupprivilage->has_delete) }}"
                                    placeholder="Masukkan has delete">

                                <!-- error message untuk has delete -->
                                @error('has_delete')
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
