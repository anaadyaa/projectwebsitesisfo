@extends('layouts.main')

@section('title', 'Edit Data Siswa')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-user-graduate mr-2 text-primary"></i>Edit Data Siswa</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Siswa</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('siswa._form')
                </form>
            </div>
        </div>
    </div>
@endsection
