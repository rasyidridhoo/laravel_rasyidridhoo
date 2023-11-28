@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-3 mb-3">Data Pasien</h1>
            
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <a href="/pasien/create"><button type="button" class="btn btn-primary">Tambah Data</button></a>                   
                        </div>
                        <div class="col">
                            <div class="row justify-content-end">
                                <div class="col-auto">
                                    <select class="form-select form-select" style="width: 200px" name="rumahsakit" id="rumahsakit">
                                        <option value="">Filter Rumah Sakit</option>
                                        @foreach($rumahsakitList as $id => $nama)
                                            <option value="{{ $id }}">{{ $nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>    
                    </div>                 
                </div>
                
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>Alamat</th>
                                <th>No Telpon</th>
                                <th>Nama Rumah Sakit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasienList as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->alamat}}</td>
                                    <td>{{$item->telepon}}</td>
                                    <td>{{$item->rumahsakit->nama}}</td>
                                
                                    <td>
                                        <div class="row">
                                            <div class="col-auto">
                                                <a href="/pasien/{{$item->id}}/edit" class="btn btn-success">Edit</a>
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
</div>

<script>
    @if(session('success'))
        alert("{{ session('success') }}");
    @elseif(session('error'))
        alert("{{ session('error') }}");
    @endif

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function() {

        $('#rumahsakit').on('change', function() {
            filterData();
        });

        function filterData() {
            var rumahsakitId = $('#rumahsakit').val();

            $.ajax({
                type: 'GET',
                url: '{{ route("filter.pasien") }}',
                data: { rumahsakit: rumahsakitId },
                success: function(response) {
                    $('#dataTable tbody').empty();

                    if (response.message) {
                        var colspanValue = "6"; 
                        var messageRow = $('<tr><td colspan="' + colspanValue + '">' + response.message + '</td></tr>');
                        messageRow.find('td').css('text-align', 'center'); 
                        $('#dataTable tbody').append(messageRow);
                    } else {
                        $.each(response.pasienList, function(index, item) {
                            var row = '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + (item.nama ? item.nama : '') + '</td>' +
                                '<td>' + (item.alamat ? item.alamat : '') + '</td>' +
                                '<td>' + (item.telepon ? item.telepon : '') + '</td>' +
                                '<td>' + (item.rumahsakit && item.rumahsakit.nama ? item.rumahsakit.nama : '') + '</td>' +
                                '<td>' +
                                '<div class="row">' +
                                '<div class="col-auto">' +
                                '<a href="/pasien/' + (item.id ? item.id : '') + '/edit" class="btn btn-success">Edit</a>' +
                                '</div>' +
                                '<div class="col-auto">' +
                                '<form action="/pasien/' + (item.id ? item.id : '') + '/delete" method="POST">' +
                                '@method('DELETE')' +
                                '@csrf' +
                                '<input value="Delete" type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure to delete this data? Pasien : ' + (item.nama ? item.nama : '') + '\')">' +
                                '</form>' +
                                '</div>' +
                                '</div>' +
                                '</td>' +
                                '</tr>';
                            $('#dataTable tbody').append(row);
                        });
                    }

                    $('#dataTable').DataTable();
                }
            });
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    $(document).ready(function() {
        $('.delete-btn').on('click', function() {
            let pasienId = $(this).data('id');
            let pasienNama = $(this).data('nama');
            
            if (confirm('Are you sure to delete this data? Pasien : ' + pasienNama)) {
                $.ajax({
                    url: '/pasien/' + pasienId + '/delete', 
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message); 
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