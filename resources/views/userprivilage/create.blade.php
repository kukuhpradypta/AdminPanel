@extends('dashboard')

@section('title')
    Create User Privilage
@endsection
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('userprivilage.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">ID User</label>
                                <input type="text" class="form-control @error('id_user') is-invalid @enderror" name="id_user"
                                    value="{{ old('id_user') }}" placeholder="Masukkan ID User">

                                <!-- error message untuk name -->
                                @error('id_user')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">ID Menu</label>
                                <input type="text" class="form-control @error('id_menu') is-invalid @enderror" name="id_menu"
                                    value="{{ old('id_menu') }}" placeholder="Masukkan ID Menu">

                                <!-- error message untuk name -->
                                @error('id_menu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Menu</label>
                                <input type="text" class="form-control @error('namemenu') is-invalid @enderror" name="namemenu"
                                    value="{{ old('namemenu') }}" placeholder="Masukkan Nama Menu">

                                <!-- error message untuk name -->
                                @error('namemenu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Create</label>
                                <input type="text" class="form-control @error('has_create') is-invalid @enderror" name="has_create"
                                    value="{{ old('has_create') }}" placeholder="Masukkan Has Create">

                                <!-- error message untuk name -->
                                @error('has_create')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Update</label>
                                <input type="text" class="form-control @error('has_update') is-invalid @enderror" name="has_update"
                                    value="{{ old('has_update') }}" placeholder="Masukkan Has Update">

                                <!-- error message untuk name -->
                                @error('has_update')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Has Delete</label>
                                <input type="text" class="form-control @error('has_delete') is-invalid @enderror" name="has_delete"
                                    value="{{ old('has_delete') }}" placeholder="Masukkan Has Delete">

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
    </div>

@endsection
