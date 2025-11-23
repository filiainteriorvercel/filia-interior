@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Edit Portfolio</h1>
                    <a href="{{ route('dashboard.portfolios.index') }}" class="text-gray-600 hover:text-gray-900">
                        &larr; Kembali
                    </a>
                </div>

                <form action="{{ route('dashboard.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Judul -->
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Project</label>
                            <input type="text" id="judul" name="judul" value="{{ old('judul', $portfolio->judul) }}" required
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            @error('judul')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select id="category" name="category" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                <option value="">Pilih Kategori</option>
                                <option value="residential" {{ old('category', $portfolio->category) == 'residential' ? 'selected' : '' }}>Residential</option>
                                <option value="commercial" {{ old('category', $portfolio->category) == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                <option value="luxury" {{ old('category', $portfolio->category) == 'luxury' ? 'selected' : '' }}>Luxury</option>
                            </select>
                            @error('category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $portfolio->lokasi) }}" required
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            @error('lokasi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto -->
                        <div>
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto Project (Biarkan kosong jika tidak diubah)</label>
                            <input type="file" id="foto" name="foto" accept="image/*"
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Max: 2MB.</p>
                            @if($portfolio->foto)
                                <div class="mt-2">
                                    <p class="text-xs text-gray-500 mb-1">Foto Saat Ini:</p>
                                    <img src="{{ Str::startsWith($portfolio->foto, 'data:image') ? $portfolio->foto : asset($portfolio->foto) }}" alt="Current Image" class="h-20 w-auto rounded border border-gray-200">
                                </div>
                            @endif
                            @error('foto')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" required
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">{{ old('deskripsi', $portfolio->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition duration-300">
                            Update Portfolio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
