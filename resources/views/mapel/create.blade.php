@extends('layouts.main')

@section('title', 'Tambah Data Mata Pelajaran')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-book mr-2 text-primary"></i>Tambah Mata Pelajaran</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Mata Pelajaran</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('mapel.store') }}" method="POST">
                    @csrf
                    @include('mapel._form')
                </form>
            </div>
        </div>
    </div>
@endsection
