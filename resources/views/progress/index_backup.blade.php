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

            @if(isset($progressList) && $progressList->count() > 0)
                <div class="grid gap-6">
                    @foreach($progressList as $progress)
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300">
                            <div class="md:flex">
                                <!-- Image Section -->
                                <div class="md:w-1/3">
                                    @if($progress->image)
                                        <img src="{{ asset('storage/' . $progress->image) }}" alt="{{ $progress->project_name }}" class="w-full h-64 md:h-full object-cover">
                                    @else
                                        <div class="w-full h-64 md:h-full gradient-bg flex items-center justify-center">
                                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Content Section -->
                                <div class="md:w-2/3 p-8">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h3 class="text-2xl font-heading font-bold text-gray-900 mb-2">{{ $progress->project_name }}</h3>
                                            @if(Auth::user()->role === 'owner')
                                                <p class="text-purple-600 font-semibold">Customer: {{ $progress->customer->name }}</p>
                                            @endif
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <span class="px-4 py-2 rounded-full text-sm font-semibold
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
                                    </div>
                                    
                                    <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($progress->description, 200) }}</p>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-6 text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $progress->created_at->format('d M Y') }}
                                            </div>
                                            @if($progress->estimated_completion)
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Target: {{ $progress->estimated_completion->format('d M Y') }}
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center space-x-3">
                                            @if(Auth::user()->role === 'owner')
                                                <a href="{{ route('progress.edit', $progress) }}" class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 font-semibold rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    Edit
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-32 h-32 mx-auto mb-8 gradient-bg rounded-2xl flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H9z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900 mb-4">
                        @if(Auth::user()->role === 'owner')
                            Belum Ada Progress Update
                        @else
                            Belum Ada Progress untuk Anda
                        @endif
                    </h3>
                    <p class="text-gray-600 max-w-md mx-auto mb-8">
                        @if(Auth::user()->role === 'owner')
                            Mulai menambahkan progress update untuk project pelanggan Anda.
                        @else
                            Progress update akan muncul di sini ketika owner menambahkan update untuk project Anda.
                        @endif
                    </p>
                    @if(Auth::user()->role === 'owner')
                        <a href="{{ route('progress.create') }}" class="inline-flex items-center px-8 py-4 gradient-bg text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah Progress Pertama
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                                @if($progress->foto && file_exists(public_path($progress->foto)))
                                    <img src="{{ asset($progress->foto) }}" alt="Progress Update" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $progress->id_project }}</h3>
                                        <span class="text-sm text-gray-500">{{ $progress->tanggal_update->format('d M Y') }}</span>
                                    </div>
                                    
                                    @if(auth()->user()->isOwner())
                                        <p class="text-sm text-gray-600 mb-2">
                                            <strong>Customer:</strong> {{ $progress->user->name }}
                                        </p>
                                    @endif
                                    
                                    <p class="text-gray-700 mb-4">{{ Str::limit($progress->deskripsi, 100) }}</p>
                                    
                                    <div class="flex justify-between items-center">
                                        <button onclick="viewProgress({{ $progress->id }})" 
                                                class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                                            Lihat Detail
                                        </button>
                                        
                                        @if(auth()->user()->isOwner())
                                            <div class="flex space-x-2">
                                                <a href="{{ route('progress.edit', $progress) }}" 
                                                   class="text-yellow-600 hover:text-yellow-700">
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
                                            </div>
                                        @endif
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
                            @if(auth()->user()->isOwner())
                                Mulai tambahkan progress update untuk customer Anda.
                            @else
                                Progress update dari tim kami akan ditampilkan di sini.
                            @endif
                        </p>
                        @if(auth()->user()->isOwner())
                            <a href="{{ route('progress.create') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">
                                Tambah Progress Pertama
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
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
const progressData = @json($progressUpdates);

function viewProgress(progressId) {
    const progress = progressData.find(p => p.id === progressId);
    if (!progress) return;
    
    document.getElementById('modal-title').textContent = 'Progress: ' + progress.id_project;
    
    let content = `
        <div class="space-y-4">
            ${progress.foto && progress.foto !== '' ? 
                `<img src="/company-interior/public/${progress.foto}" alt="Progress Update" class="w-full h-auto rounded-lg">` : 
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
