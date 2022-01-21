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
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">

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

@endsection
