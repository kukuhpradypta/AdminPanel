@extends('dashboard')

@section('title')
    Create User Group
@endsection
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
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
    </div>

@endsection
