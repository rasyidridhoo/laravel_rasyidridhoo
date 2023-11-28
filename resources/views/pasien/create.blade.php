@extends('layouts.app')

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-3 mb-3">Tambah Data Pasien</h1>
            <div class="card mb-4">
                <div class="card-header">
                
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{route('pasien.store')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="nama" class="col-md-3 col-form-label">Nama Pasien</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="nama" name="nama" autocomplete="off" value="{{old('nama')}}" required>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="alamat" class="col-md-3 col-form-label">Alamat</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" autocomplete="off" required>{{old('alamat')}}</textarea>
                                </div>
                            </div>


                            <div class="form-group row mt-3">
                                <label for="telepon" class="col-md-3 col-form-label">Telepon</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="telepon" name="telepon" autocomplete="off" value="{{old('telepon')}}" required>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label class="col-md-3 col-form-label">Nama Rumah Sakit</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="rumahsakit_id" id="rumahsakit_id" required>
                                        <option selected="selected" disabled selected hidden value="{{old('rumahsakit_id')}}">Pilih Rumah Sakit</option>
                                        @foreach($rumahsakitSelectList as $item)
                                            <option value="{{ $item->id }}" {{ old('rumahsakit_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                            </option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                    @if ($errors->any())
                                        <div class="alert alert-danger mt-3 mb-2" id="error-message">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li class="text-dark">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                            </div>
                            
                            <div class="modal-footer mt-5">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2023</div>
            </div>
        </div>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
    $(document).ready(function() {
        @if ($errors->any())
            setTimeout(function() {
                $('#error-message').fadeOut('slow');
            }, 3000);
        @endif
    });
</script>

@endsection