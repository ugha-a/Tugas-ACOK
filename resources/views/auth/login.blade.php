@extends('layouts.app')

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center">
        <div class="w-full max-w-md mx-auto px-4">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <div class="flex items-center justify-center mb-6">
                    <div class="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 0 0 1 1h3v6h8v-6h3a1 1 0 0 0 1-1V7" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 3v4M8 3v4" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-semibold text-center mb-4">Selamat Datang</h3>
                <p class="text-center text-sm text-gray-500 mb-6">Silakan masuk untuk mengelola gudang</p>

                <form method="POST" action="{{ route('login.process') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input name="email" value="{{ old('email') }}" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input name="password" type="password" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</button>
                        <a href="#" class="text-sm text-gray-500 hover:underline">Lupa password?</a>
                    </div>
                    @if($errors->any())
                        <div class="mt-4 text-red-600">{{ $errors->first() }}</div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
