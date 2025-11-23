@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Kelola Portfolio</h1>
                    <a href="{{ route('dashboard.portfolios.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        + Tambah Portfolio
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="py-3 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Foto</th>
                                <th class="py-3 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
                                <th class="py-3 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                                <th class="py-3 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Lokasi</th>
                                <th class="py-3 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($portfolios as $portfolio)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 border-b">
                                        <img src="{{ Str::startsWith($portfolio->foto, 'data:image') ? $portfolio->foto : asset($portfolio->foto) }}" alt="{{ $portfolio->judul }}" class="w-20 h-16 object-cover rounded">
                                    </td>
                                    <td class="py-3 px-4 border-b font-medium">{{ $portfolio->judul }}</td>
                                    <td class="py-3 px-4 border-b">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                            {{ ucfirst($portfolio->category) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 border-b text-gray-500">{{ $portfolio->lokasi }}</td>
                                    <td class="py-3 px-4 border-b">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('dashboard.portfolios.edit', $portfolio->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                            <form action="{{ route('dashboard.portfolios.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus portfolio ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if(count($portfolios) == 0)
                    <div class="text-center py-8 text-gray-500">
                        Belum ada data portfolio. Silakan tambahkan portfolio baru.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
