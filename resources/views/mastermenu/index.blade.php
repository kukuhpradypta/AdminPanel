@extends('dashboard')
@section('title')
    Master Menu
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('mastermenu.create') }}" class="btn btn-md btn-success mb-3"><i
                                class="fas fa-folder-plus"> Tambah
                                Master Menu</i></a>
                        <table class="table table-bordered">
                            <thead class="bg-dark">
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Sort</th>
                                    <th scope="col">Menu Group</th>
                                    <th scope="col">Is Hidden</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($mastermenus as $mastermenu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mastermenu->name }}</td>
                                        <td>{{ $mastermenu->icon }}</td>
                                        <td>{{ $mastermenu->url }}</td>
                                        <td>{{ $mastermenu->sort }}</td>
                                        <td>{{ $mastermenu->menugroup }}</td>
                                        <td>{{ $mastermenu->ishidden }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('mastermenu.destroy', $mastermenu->id) }}" method="POST">
                                                <a href="{{ route('mastermenu.edit', $mastermenu->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Mastermenu belum Tersedia.
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
    </script>


@endsection
