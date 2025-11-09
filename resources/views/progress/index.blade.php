@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-heading text-2xl font-bold text-gray-900">
                        Progress Update
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">
                        @if(Auth::user()->role === 'owner')
                            Kelola progress semua project pelanggan
                        @else
                            Lihat progress project Anda
                        @endif
                    </p>
                </div>
                @if(Auth::user()->role === 'owner')
                    <a href="{{ route('progress.create') }}" class="inline-flex items-center px-6 py-3 gradient-bg text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Progress
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            @if(isset($progressUpdates) && $progressUpdates->count() > 0)
                <div class="grid gap-6">
                    @foreach($progressUpdates as $progress)
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300">
                            <div class="md:flex">
                                <!-- Image Section -->
                                <div class="md:w-1/3">
                                    @if($progress->foto && $progress->foto !== '')
                                        <img src="{{ str_starts_with($progress->foto, 'data:') ? $progress->foto : asset($progress->foto) }}" alt="Progress Update" class="w-full h-64 md:h-full object-cover">
                                    @else
                                        <div class="w-full h-64 md:h-full gradient-bg flex items-center justify-center">
                                            <svg class="h-16 w-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content Section -->
                                <div class="md:w-2/3 p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-xl font-heading font-bold text-gray-900 mb-2">
                                                Project: {{ $progress->id_project }}
                                            </h3>
                                            @if(Auth::user()->role === 'owner' && $progress->user)
                                                <p class="text-sm text-gray-600">Customer: {{ $progress->user->name }}</p>
                                            @endif
                                        </div>
                                        
                                        @if($progress->status)
                                            <div class="flex items-center space-x-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                                    @if($progress->status === 'completed') bg-green-100 text-green-800
                                                    @elseif($progress->status === 'in_progress') bg-blue-100 text-blue-800  
                                                    @else bg-yellow-100 text-yellow-800
                                                    @endif">
                                                    @if($progress->status === 'completed') Selesai
                                                    @elseif($progress->status === 'in_progress') Dalam Progress
                                                    @else On Hold
                                                    @endif
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <p class="text-gray-700 mb-4 line-clamp-3">{{ $progress->deskripsi }}</p>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-500">
                                            <time>{{ $progress->tanggal_update->format('d M Y') }}</time>
                                        </div>

                                        <div class="flex items-center space-x-3">
                                            <button onclick="viewProgress({{ $progress->id }})" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">
                                                Lihat Detail
                                            </button>
                                            
                                            @if(Auth::user()->role === 'owner')
                                                <a href="{{ route('progress.edit', $progress) }}" class="text-blue-600 hover:text-blue-700">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                
                                                <form method="POST" action="{{ route('progress.destroy', $progress) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus progress ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-700">
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
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
                        @if(auth()->user()->role === 'owner')
                            Mulai tambahkan progress update untuk customer Anda.
                        @else
                            Progress update dari tim kami akan ditampilkan di sini.
                        @endif
                    </p>
                    @if(auth()->user()->role === 'owner')
                        <a href="{{ route('progress.create') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">
                            Tambah Progress Pertama
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Progress Detail Modal -->
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
                <div id="modal-content">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script>
    const progressData = @json($progressUpdates ?? []);
    const baseUrl = "{{ url('/') }}";

    function viewProgress(progressId) {
        const progress = progressData.find(p => p.id === progressId);
        if (!progress) return;
        
        document.getElementById('modal-title').textContent = 'Progress: ' + progress.id_project;
        
        // Check if foto is base64 or file path
        let fotoSrc = '';
        if (progress.foto && progress.foto !== '') {
            fotoSrc = progress.foto.startsWith('data:') ? progress.foto : `${baseUrl}/${progress.foto}`;
        }
        
        let content = `
            <div class="space-y-4">
                ${progress.foto && progress.foto !== '' ? 
                    `<img src="${fotoSrc}" alt="Progress Update" class="w-full h-auto rounded-lg">` : 
                    `<div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                        <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>`
                }
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">ID Project</h4>
                        <p class="text-gray-700">${progress.id_project}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Tanggal Update</h4>
                        <p class="text-gray-700">${new Date(progress.tanggal_update).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
                    </div>
                    ${progress.user ? `
                        <div class="md:col-span-2">
                            <h4 class="font-semibold text-gray-900 mb-2">Customer</h4>
                            <p class="text-gray-700">${progress.user.name}</p>
                        </div>
                    ` : ''}
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 mb-2">Deskripsi</h4>
                    <p class="text-gray-700">${progress.deskripsi}</p>
                </div>
            </div>
        `;
        
        document.getElementById('modal-content').innerHTML = content;
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
