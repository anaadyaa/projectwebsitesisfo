@extends('layouts.main')

@section('title', 'Edit Nilai Siswa')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-star mr-2 text-primary"></i>Edit Nilai Siswa</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Nilai</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('nilai._form')
                </form>
            </div>
        </div>
    </div>
@endsection
