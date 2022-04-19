@extends('dashboard')

@section('title')
    Create User
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form id="formCreateUser" action="{{ route('user.store') }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf



                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" placeholder="Masukkan Nama user">

                                <!-- error message untuk name -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" placeholder="Masukkan Email user">

                                <!-- error message untuk email -->
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Password</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror"
                                    name="password" value="{{ old('password') }}" placeholder="Masukkan Password user">

                                <!-- error message untuk password -->
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Role</label>
                                <select type="text" class="form-control" name="role">
                                    @foreach ($role as $roleuser)
                                        <option value="{{ $roleuser->name }}">{{ $roleuser->name }}</option>
                                    @endforeach
                                </select>

                                <!-- error message untuk password -->
                                @error('role')
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
                            <a href="{{ route('user.index') }}" class="btn btn-md btn-success"><i
                                    class="fas fa-backspace">
                                    Kembali</i></a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $("#formCreateUser").submit(function(e) {
            let privilege_component = $("#privilege-input");
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
