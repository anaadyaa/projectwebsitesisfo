@extends('layouts.main')

@section('title', 'Input Nilai Siswa')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-star mr-2 text-primary"></i>Input Nilai Siswa</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Input Nilai</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('nilai.store') }}" method="POST">
                    @csrf
                    @include('nilai._form')
                </form>
            </div>
        </div>
    </div>
@endsection
