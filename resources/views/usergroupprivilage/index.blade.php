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
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($usergroupprivilages as $usergroupprivilage)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $usergroupprivilage->id_usergroup }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('usergroupprivilage.destroy', $usergroupprivilage->id) }}" method="POST">

                                                <div onclick="findData({{ $usergroupprivilage->id }})" class="btn btn btn-primary">
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
                        $("#exampleModal form").attr('action', `http://localhost:8000/usergroupprivilage/${id}`);
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
                                <label class="font-weight-bold">ID User Group</label>
                                <select name="id_usergroup" class="form-control @error('id_usergroup') is-invalid @enderror">
                                    @foreach ($usergroups as $usergroup)
                                        <option value="{{ $usergroup->id }}">{{ $usergroup->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_usergroup')
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
                                <label class="font-weight-bold">ID User Group</label>
                                <select name="id_usergroup" class="form-control @error('id_usergroup') is-invalid @enderror">
                                    @foreach ($usergroups as $usergroup)
                                        <option value="{{ $usergroup->id }}">{{ $usergroup->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_usergroup')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="container pb-5">
                                @foreach ($userprivilages as $userprivilage)
                                    <h5>{{ $userprivilage->namemenu }}</h5>
                                    <div class="row mb-4">

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
