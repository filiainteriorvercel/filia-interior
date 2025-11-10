@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Dashboard Customer</h1>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                        {{ auth()->user()->role }}
                    </span>
                </div>

                <!-- Welcome Message -->
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-6 rounded-lg mb-8">
                    <h2 class="text-xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}!</h2>
                    <p>Pantau progress pemesanan interior Anda secara real-time di sini.</p>
                </div>

                <!-- Progress Updates Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Progress Pemesanan Anda</h3>
                    
                    @if(count($userProgressUpdates) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($userProgressUpdates as $progress)
                                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                                    @if($progress->foto)
                                        @if(str_starts_with($progress->foto, 'data:'))
                                            {{-- Base64 image from Vercel - use directly --}}
                                            <img src="{{ $progress->foto }}" alt="Progress Update" class="w-full h-48 object-cover">
                                        @else
                                            {{-- File path from local - use asset() helper --}}
                                            <img src="{{ asset($progress->foto) }}" alt="Progress Update" class="w-full h-48 object-cover">
                                        @endif
                                    @else
                                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                            <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <div class="p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-semibold text-gray-900">{{ $progress->id_project }}</h4>
                                            <span class="text-xs text-gray-500">{{ $progress->tanggal_update->format('d M Y') }}</span>
                                        </div>
                                        <p class="text-gray-600 text-sm">{{ $progress->deskripsi }}</p>
                                        
                                        @if($progress->foto)
                                            <button onclick="viewProgressImage('{{ str_starts_with($progress->foto, 'data:') ? $progress->foto : asset($progress->foto) }}', '{{ $progress->id_project }}', '{{ $progress->deskripsi }}')"  
                                                    class="mt-3 text-blue-600 hover:text-blue-700 text-sm font-medium">
                                                Lihat Detail →
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-lg">
                            <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Progress Update</h3>
                            <p class="text-gray-500 mb-6">
                                Progress update dari tim kami akan ditampilkan di sini. Biasanya update pertama akan muncul setelah project dimulai.
                            </p>
                            <a href="{{ route('contact') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                                Hubungi Tim Kami
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- View All Progress -->
                    <div class="bg-white p-6 rounded-lg border border-gray-200 hover:shadow-lg transition duration-300">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Semua Progress</h3>
                            <p class="text-gray-600 mb-4">Lihat semua update progress pemesanan Anda</p>
                            <a href="{{ route('progress.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                                Lihat Semua
                            </a>
                        </div>
                    </div>

                    <!-- Contact Support -->
                    <div class="bg-white p-6 rounded-lg border border-gray-200 hover:shadow-lg transition duration-300">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Hubungi Tim</h3>
                            <p class="text-gray-600 mb-4">Ada pertanyaan? Hubungi tim customer service kami</p>
                            <a href="{{ route('contact') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>

                    <!-- View Portfolio -->
                    <div class="bg-white p-6 rounded-lg border border-gray-200 hover:shadow-lg transition duration-300">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Portfolio</h3>
                            <p class="text-gray-600 mb-4">Lihat galeri portfolio karya terbaik kami</p>
                            <a href="{{ route('portfolio') }}" class="inline-block bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition duration-300">
                                Lihat Portfolio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Progress Image Modal -->
<div id="progressModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-4xl w-full max-h-full overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-start mb-4">
                <h3 id="modal-title" class="text-2xl font-bold text-gray-900"></h3>
                <button onclick="closeProgressModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="modal-image" class="mb-4"></div>
            <div id="modal-description" class="text-gray-700"></div>
        </div>
    </div>
</div>

<script>
function viewProgressImage(imageSrc, title, description) {
    document.getElementById('modal-title').textContent = 'Progress: ' + title;
    document.getElementById('modal-image').innerHTML = '<img src="' + imageSrc + '" alt="Progress Update" class="w-full h-auto rounded-lg">';
    document.getElementById('modal-description').textContent = description;
    document.getElementById('progressModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeProgressModal() {
    document.getElementById('progressModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Close modal when clicking outside
document.getElementById('progressModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeProgressModal();
    }
});
</script>
@endsection
