@extends('layouts.app')

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4 mb-3">Main Menu</h1>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-3">
                            <div class="card-body">
                                <h3>{{$totalRumahsakit}}</h3>
                                <h5>Rumah Sakit</h5>
                            </div>
                            <div class="card-body" style="text-align: end;">
                                <a href="{{route('rumahsakit.index')}}" class="btn btn-sm btn-flash-border-success" style="color: rgb(255, 255, 255)"><i class="fa-solid fa-arrow-right fa-xl"></i></a>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-3">
                            <div class="card-body">
                                <h3>{{$totalPasien}}</h3>
                                <h5>Pasien</h5>
                            </div>
                            <div class="card-body" style="text-align: end;">
                                <a href="{{route('pasien.index')}}" class="btn btn-sm btn-flash-border-success" style="color: rgb(255, 255, 255)"><i class="fa-solid fa-arrow-right fa-xl"></i></a>
                            </div>
                        </div>
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
    @if(session('success'))
        alert("{{ session('success') }}");
    @elseif(session('error'))
        alert("{{ session('error') }}");
    @endif
</script>
        
@endsection