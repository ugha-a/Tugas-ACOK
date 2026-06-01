@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Selamat datang di Sistem Manajemen Gudang</h1>
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <livewire:dashboard />
            </div>
            <div>
                <div class="bg-white rounded shadow p-4">Quick Links</div>
            </div>
        </div>
    </div>
@endsection
