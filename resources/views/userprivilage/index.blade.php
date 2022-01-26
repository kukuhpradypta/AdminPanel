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
                        <a href="{{ route('userprivilage.create') }}" class="btn btn-md btn-success mb-3"><i
                                class="fas fa-folder-plus"> Tambah
                                User Privilage</i></a>
                        <table class="table table-bordered">
                            <thead class="bg-dark">
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">ID User</th>
                                    <th scope="col">ID Menu</th>
                                    <th scope="col">Nama Menu</th>
                                    <th scope="col">Tambah</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">hapus</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($userprivilages as $userprivilage)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $userprivilage->id_user }}</td>
                                        <td>{{ $userprivilage->id_menu }}</td>
                                        <td>{{ $userprivilage->namemenu }}</td>
                                        <td>{{ $userprivilage->has_create }}</td>
                                        <td>{{ $userprivilage->has_update }}</td>
                                        <td>{{ $userprivilage->has_delete }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('userprivilage.destroy', $userprivilage->id) }}" method="POST">

                                                <div onclick="findData({{ $userprivilage->id }})" class="btn btn btn-primary">
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
                        $("#edit_namemenu_group").val(response.data.namemenu);
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
                                <label class="font-weight-bold">ID User</label>
                                <input id="edit_id_user_group" type="text" class="form-control @error('id_user') is-invalid @enderror"
                                    name="id_user" value="{{ old('id_user', $userprivilage->id_user) }}"
                                    placeholder="Masukkan ID User">

                                <!-- error message untuk id user -->
                                @error('id_user')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">ID Menu</label>
                                <input id="edit_id_menu_group" type="text" class="form-control @error('id_menu') is-invalid @enderror"
                                    name="id_menu" value="{{ old('id_menu', $userprivilage->id_menu) }}"
                                    placeholder="Masukkan ID Menu">

                                <!-- error message untuk id menu -->
                                @error('id_menu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Menu</label>
                                <input id="edit_namemenu_group" type="text" class="form-control @error('namemenu') is-invalid @enderror"
                                    name="namemenu" value="{{ old('namemenu', $userprivilage->namemenu) }}"
                                    placeholder="Masukkan Nama Menu">

                                <!-- error message untuk nama menu -->
                                @error('namemenu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Create</label>
                                <input id="edit_has_create_group" type="text" class="form-control @error('has_create') is-invalid @enderror"
                                    name="has_create" value="{{ old('has_create', $userprivilage->has_create) }}"
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
                                <input id="edit_has_update_group" type="text" class="form-control @error('has_update') is-invalid @enderror"
                                    name="has_update" value="{{ old('has_update', $userprivilage->has_update) }}"
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
                                <input id="edit_has_delete_group" type="text" class="form-control @error('has_delete') is-invalid @enderror"
                                    name="has_delete" value="{{ old('has_delete', $userprivilage->has_delete) }}"
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
                            <a href="{{ route('userprivilage.index') }}" class="btn btn-md btn-success"><i
                                    class="fas fa-backspace"> Kembali</i></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endsection
