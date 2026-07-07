@extends('admin.layouts.app')

@section('title', 'Dasbor')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Card Statistik -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold">Total Pengguna</h3>
        <p class="text-3xl text-primary dark:text-primary mt-2">1,234</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold">Artikel Terbit</h3>
        <p class="text-3xl text-secondary dark:text-secondary mt-2">456</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold">Komentar</h3>
        <p class="text-3xl text-gray-600 dark:text-gray-300 mt-2">789</p>
    </div>
</div>
@endsection
