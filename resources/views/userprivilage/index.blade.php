@extends('dashboard')
@section('title')
    User Privilage
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <button type="button" class="btn btn-success mb-4" onclick="create()">
                            <i class="fas fa-folder-plus"> Tambah
                                User privilage</i>
                        </button>
                        <table class="table table-bordered">
                            <thead class="bg-dark">
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">ID User</th>
                                    <th scope="col">ID Menu</th>
                                    <th scope="col">view</th>
                                    <th scope="col">create</th>
                                    <th scope="col">update</th>
                                    <th scope="col">delete</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($userprivilages as $userprivilage)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $userprivilage->id_user }}</td>
                                        <td>{{ $userprivilage->id_menu }}</td>
                                        <td>{{ $userprivilage->has_view }}</td>
                                        <td>{{ $userprivilage->has_create }}</td>
                                        <td>{{ $userprivilage->has_update }}</td>
                                        <td>{{ $userprivilage->has_delete }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('userprivilage.destroy', $userprivilage->id) }}"
                                                method="POST">

                                                <div onclick="findData({{ $userprivilage->id }})"
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
            $.get("{{ url('userprivilage') }}", {},
                function(data, status) {
                    $("#staticBackdrop").modal('show');

                });
        }
        // FIND DATA USER GROUP
        function findData(id) {
            $.ajax({
                url: `{{ env('APP_URL') }}/userprivilage/find/${id}`,
                method: 'GET',
                accept: 'application/json',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        $("#edit_id_user_group").val(response.data.id_user);
                        $("#edit_id_menu_group").val(response.data.id_menu);
                        $("#edit_has_view_group").val(response.data.has_view);
                        $("#edit_has_create_group").val(response.data.has_create);
                        $("#edit_has_update_group").val(response.data.has_update);
                        $("#edit_has_delete_group").val(response.data.has_delete);
                        $("#exampleModal form").attr('action', `http://localhost:8000/userprivilage/${id}`);
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
                                <label class="font-weight-bold">Nama User</label>
                                <select name="id_user" class="form-control @error('id_user') is-invalid @enderror">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_user')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Menu</label>
                                <select name="id_menu" class="form-control @error('id_menu') is-invalid @enderror">
                                    @foreach ($mastermenus as $mastermenu)
                                        <option value="{{ $mastermenu->id }}">{{ $mastermenu->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_menu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has view</label>
                                <input type="text" class="form-control @error('has_view') is-invalid @enderror" name="has_view"
                                    value="{{ old('has_view') }}" placeholder="Masukkan Has view">

                                <!-- error message untuk name -->
                                @error('has_view')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Create</label>
                                <input type="text" class="form-control @error('has_create') is-invalid @enderror"
                                    name="has_create" value="{{ old('has_create') }}" placeholder="Masukkan Has Create">

                                <!-- error message untuk name -->
                                @error('has_create')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Update</label>
                                <input type="text" class="form-control @error('has_update') is-invalid @enderror"
                                    name="has_update" value="{{ old('has_update') }}" placeholder="Masukkan Has Update">

                                <!-- error message untuk name -->
                                @error('has_update')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Delete</label>
                                <input type="text" class="form-control @error('has_delete') is-invalid @enderror"
                                    name="has_delete" value="{{ old('has_delete') }}" placeholder="Masukkan Has Delete">

                                <!-- error message untuk name -->
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
                            <a href="{{ route('userprivilage.index') }}" class="btn btn-md btn-success"><i
                                    class="fas fa-backspace"> Kembali</i></a>
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

                        <form action="{{ route('userprivilage.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Nama User</label>
                                <select name="id_user" class="form-control @error('id_user') is-invalid @enderror">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_user')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Menu</label>
                                <select name="id_menu" class="form-control @error('id_menu') is-invalid @enderror">
                                    @foreach ($mastermenus as $mastermenu)
                                        <option value="{{ $mastermenu->id }}">{{ $mastermenu->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_menu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has view</label>
                                <input type="text" class="form-control @error('has_view') is-invalid @enderror" name="has_view"
                                    value="{{ old('has_view') }}" placeholder="Masukkan Has view">

                                <!-- error message untuk name -->
                                @error('has_view')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Create</label>
                                <input type="text" class="form-control @error('has_create') is-invalid @enderror"
                                    name="has_create" value="{{ old('has_create') }}" placeholder="Masukkan Has Create">

                                <!-- error message untuk name -->
                                @error('has_create')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Update</label>
                                <input type="text" class="form-control @error('has_update') is-invalid @enderror"
                                    name="has_update" value="{{ old('has_update') }}" placeholder="Masukkan Has Update">

                                <!-- error message untuk name -->
                                @error('has_update')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Delete</label>
                                <input type="text" class="form-control @error('has_delete') is-invalid @enderror"
                                    name="has_delete" value="{{ old('has_delete') }}" placeholder="Masukkan Has Delete">

                                <!-- error message untuk name -->
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
                            <a href="{{ route('userprivilage.index') }}" class="btn btn-md btn-success"><i
                                    class="fas fa-backspace">
                                    Kembali</i></a>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endsection
@endsection
