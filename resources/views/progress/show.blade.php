@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">Detail Progress</h1>
                <a href="{{ route('progress.index') }}" class="text-indigo-600 hover:text-indigo-700">Kembali</a>
            </div>

            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <p><span class="font-semibold">ID Project:</span> {{ $progress->id_project }}</p>
                    <p><span class="font-semibold">Tanggal Update:</span> {{ $progress->tanggal_update->format('d M Y') }}</p>
                    <p><span class="font-semibold">Customer:</span> {{ $progress->project->customer_name ?? $progress->user->name ?? '-' }}</p>
                    <p><span class="font-semibold">Status:</span> {{ $progress->status ?? '-' }}</p>
                </div>

                <div>
                    <h2 class="font-semibold mb-2">Deskripsi</h2>
                    <p class="text-gray-700">{{ $progress->deskripsi }}</p>
                </div>

                @if($progress->foto)
                    <div>
                        <h2 class="font-semibold mb-2">Foto Progress</h2>
                        <img src="{{ str_starts_with($progress->foto, 'data:') ? $progress->foto : asset($progress->foto) }}" alt="Progress photo" class="max-w-full rounded-lg border border-gray-200">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
