@extends('dashboard')

@section('title')
    Create Master Menu
@endsection
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('mastermenu.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" placeholder="Masukkan Name">

                                <!-- error message untuk name -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Icon</label>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon"
                                    value="{{ old('icon') }}" placeholder="Masukkan Icon">

                                <!-- error message untuk name -->
                                @error('icon')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Url</label>
                                <input type="text" class="form-control @error('url') is-invalid @enderror" name="url"
                                    value="{{ old('url') }}" placeholder="Masukkan URL">

                                <!-- error message untuk name -->
                                @error('url')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Sort</label>
                                <input type="text" class="form-control @error('sort') is-invalid @enderror" name="sort"
                                    value="{{ old('sort') }}" placeholder="Masukkan Sort">

                                <!-- error message untuk name -->
                                @error('sort')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Menu Group</label>
                                <input type="text" class="form-control @error('menugroup') is-invalid @enderror" name="menugroup"
                                    value="{{ old('menugroup') }}" placeholder="Masukkan Nama menugroup">

                                <!-- error message untuk name -->
                                @error('menu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Is Hidden</label>
                                <input type="text" class="form-control @error('ishidden') is-invalid @enderror" name="ishidden"
                                    value="{{ old('ishidden') }}" placeholder="Masukkan Is Hidden">

                                <!-- error message untuk name -->
                                @error('ishidden')
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
