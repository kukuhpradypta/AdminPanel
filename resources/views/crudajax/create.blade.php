                        <div class="form-group">
                            <label class="font-weight-bold">Nama</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" placeholder="Masukkan Nama crudajax">

                            <!-- error message untuk name -->
                            @error('name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" onclick="store()" class="btn btn-md btn-primary"><i class="fas fa-save">
                                Simpan</i></button>
                        <button type="reset" class="btn btn-md btn-warning"><i class="fas fa-redo-alt text-white">
                                Reset</i></button>
