@extends('layouts.main')

@section('title', 'Edit Data Kelas')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-door-open mr-2 text-primary"></i>Edit Data Kelas</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Kelas</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kelas.update', $kela->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('kelas._form')
                </form>
            </div>
        </div>
    </div>
@endsection
