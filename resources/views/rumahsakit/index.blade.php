@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-3 mb-3">Data Rumah Sakit</h1>
            
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <a href="/rumahsakit/create"><button type="button" class="btn btn-primary">Tambah Data</button></a>                   
                        </div>
                              
                    </div>                 
                </div>
                
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Rumah Sakit</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rumahsakits as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->alamat}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->telepon}}</td>
                                
                                    <td>
                                        <div class="row">
                                            <div class="col-auto">
                                                <a href="/rumahsakit/{{$item->id}}/edit" class="btn btn-success">Edit</a>
                                            </div>
                                            <div class="col-auto">
                                                <button class="btn btn-danger delete-btn" data-id="{{$item->id}}" data-nama="{{$item->nama}}">Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    @if(session('success'))
        alert("{{ session('success') }}");
    @elseif(session('error'))
        alert("{{ session('error') }}");
    @endif
</script>

<script>
    $(document).ready(function() {
        $('.delete-btn').on('click', function() {
            let rumahSakitId = $(this).data('id');
            let rumahSakitNama = $(this).data('nama');
            
            if (confirm('Are you sure to delete this data? Rumah Sakit : ' + rumahSakitNama)) {
                $.ajax({
                    url: '/rumahsakit/' + rumahSakitId + '/delete',
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message); // Menampilkan pesan dari server
                        // Reload halaman jika berhasil menghapus
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Error deleting data: ' + xhr.responseText);
                    }
                });
            }
        });
    });
</script>

@endsection