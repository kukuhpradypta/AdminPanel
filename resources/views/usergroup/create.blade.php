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
                            <div class="form-group">
                                <label class="font-weight-bold">Sort</label>
                                <input type="text" class="form-control @error('sort') is-invalid @enderror" name="sort"
                                    value="{{ old('sort') }}" placeholder="Masukkan Sort usergroup">

                                <!-- error message untuk sort -->
                                @error('sort')
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
                                            <label class="form-check-label"
                                                for="has_create_{{ $userprivilage->id_menu }}">
                                                create
                                            </label>
                                        </div>
                                        <div class="col-4 form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="has_update_{{ $userprivilage->id_menu }}"
                                                {{ $userprivilage->has_update ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="has_update_{{ $userprivilage->id_menu }}">
                                                Update
                                            </label>
                                        </div>
                                        <div class="col-4 form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="has_delete_{{ $userprivilage->id_menu }}"
                                                {{ $userprivilage->has_delete ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="has_delete_{{ $userprivilage->id_menu }}">
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
    </div>

@endsection
