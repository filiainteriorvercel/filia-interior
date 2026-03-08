@extends('layouts.app')

@section('content')
@php
    $progressCount = $progressUpdates->count();
    $completedCount = $progressUpdates->where('status', 'completed')->count();
    $inProgressCount = $progressUpdates->where('status', 'in_progress')->count();
@endphp

<div class="pm-shell">
    <div class="pm-container">
        <section class="pm-hero pm-reveal">
            <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <span class="pm-hero-chip">Progress Monitor</span>
                    <h1 class="mt-4 font-heading text-5xl font-semibold leading-none text-stone-50 sm:text-6xl">
                        Progress update yang lebih mudah dibaca, dicari, dan dipresentasikan.
                    </h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-stone-200/88 sm:text-base">
                        @if(Auth::user()->role === 'owner')
                            Pantau seluruh update project pelanggan dan lompat cepat ke project yang perlu ditindak.
                        @else
                            Lihat seluruh perkembangan project Anda dalam tampilan timeline yang lebih jelas.
                        @endif
                    </p>
                </div>
                @if(Auth::user()->role === 'owner')
                    <a href="{{ route('progress.create') }}" class="pm-btn pm-btn-primary">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Progress
                    </a>
                @endif
            </div>
        </section>

        <section class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="pm-stat-card pm-reveal pm-delay-1">
                <p class="pm-stat-label">Total Update</p>
                <p class="pm-stat-value">{{ $progressCount }}</p>
                <p class="pm-stat-meta">Semua progress yang sedang tampil.</p>
            </div>
            <div class="pm-stat-card pm-reveal pm-delay-2">
                <p class="pm-stat-label">Sedang Berjalan</p>
                <p class="pm-stat-value">{{ $inProgressCount }}</p>
                <p class="pm-stat-meta">Project yang masih aktif di halaman ini.</p>
            </div>
            <div class="pm-stat-card pm-reveal pm-delay-3">
                <p class="pm-stat-label">Selesai</p>
                <p class="pm-stat-value">{{ $completedCount }}</p>
                <p class="pm-stat-meta">Update yang sudah berstatus selesai.</p>
            </div>
        </section>

        @if(session('success'))
            <div class="pm-notice-success pm-reveal">{{ session('success') }}</div>
        @endif

        @if(Auth::user()->role === 'owner')
            <section class="pm-panel pm-reveal">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="pm-kicker">Search</p>
                        <h2 class="mt-2 font-heading text-3xl font-semibold text-slate-800">Temukan update yang relevan</h2>
                    </div>
                    <form method="GET" action="{{ route('progress.index') }}" class="w-full max-w-3xl">
                        <div class="grid gap-3 sm:grid-cols-[minmax(0,1fr)_auto]">
                            <div class="relative">
                                <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.65a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                                </svg>
                                <input
                                    type="text"
                                    name="q"
                                    value="{{ $search ?? '' }}"
                                    placeholder="Cari ID project, customer, email, nomor HP, atau deskripsi progress"
                                    class="pm-input pl-12"
                                >
                            </div>
                            <button type="submit" class="pm-btn pm-btn-primary w-full sm:w-auto">Cari</button>
                        </div>
                    </form>
                </div>
            </section>
        @endif

        @if($progressUpdates->count() > 0)
            <section class="grid gap-5 xl:grid-cols-2">
                @foreach($progressUpdates as $progress)
                    @php
                        $statusClass = match ($progress->status) {
                            'completed' => 'pm-badge pm-badge-success',
                            'on_hold' => 'pm-badge pm-badge-hold',
                            default => 'pm-badge pm-badge-progress',
                        };
                        $statusLabel = $progress->status ? ucwords(str_replace('_', ' ', $progress->status)) : 'Update';
                    @endphp
                    <article class="pm-data-card pm-reveal" style="animation-delay: {{ 0.06 * $loop->index }}s;">
                        <div class="flex h-full flex-col gap-5">
                            @if($progress->foto && $progress->foto !== '')
                                <button type="button" onclick="viewProgress({{ $progress->id }})" class="block overflow-hidden rounded-[1.4rem]">
                                    <img src="{{ str_starts_with($progress->foto, 'data:') ? $progress->foto : asset($progress->foto) }}" alt="Progress Update" class="h-60 w-full object-cover">
                                </button>
                            @else
                                <div class="flex h-60 items-center justify-center rounded-[1.4rem] bg-gradient-to-br from-stone-900 to-slate-700 text-stone-50">
                                    <svg class="h-14 w-14 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="pm-kicker">Project {{ $progress->id_project }}</p>
                                    @if(Auth::user()->role === 'owner' && $progress->user)
                                        <p class="mt-2 text-sm text-slate-600">Customer: {{ $progress->user->name }}</p>
                                    @endif
                                </div>
                                <span class="{{ $statusClass }}">{{ $statusLabel }}</span>
                            </div>

                            <p class="text-sm leading-7 text-slate-600">{{ $progress->deskripsi }}</p>

                            <div class="mt-auto flex flex-col gap-3 border-t border-stone-200 pt-4 sm:flex-row sm:items-center sm:justify-between">
                                <time class="text-sm font-semibold text-slate-500">{{ $progress->tanggal_update->format('d M Y') }}</time>

                                <div class="flex flex-wrap items-center gap-3">
                                    <button type="button" onclick="viewProgress({{ $progress->id }})" class="pm-link">Lihat Detail</button>
                                    @if(Auth::user()->role === 'owner')
                                        <a href="{{ route('progress.edit', $progress) }}" class="pm-link">Edit</a>
                                        <form method="POST" action="{{ route('progress.destroy', $progress) }}" onsubmit="return confirm('Yakin ingin menghapus progress ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="pm-link text-red-700 hover:text-red-800">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </section>
        @else
            <section class="pm-empty pm-reveal">
                <p class="pm-kicker">Belum Ada Progress</p>
                <h2 class="mt-3 font-heading text-4xl font-semibold text-slate-800">Belum ada progress update yang bisa ditampilkan.</h2>
                <p class="mx-auto mt-4 max-w-xl text-sm leading-7 text-slate-600 sm:text-base">
                    @if(auth()->user()->role === 'owner')
                        Mulai dengan menambahkan progress pertama untuk project customer.
                    @else
                        Progress dari tim akan tampil di sini begitu project mulai diperbarui.
                    @endif
                </p>
                @if(auth()->user()->role === 'owner')
                    <div class="mt-6">
                        <a href="{{ route('progress.create') }}" class="pm-btn pm-btn-primary">Tambah Progress Pertama</a>
                    </div>
                @endif
            </section>
        @endif
    </div>
</div>

<div id="progressModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/70 p-4">
    <div class="pm-modal-panel max-w-4xl">
        <div class="mb-4 flex items-center justify-between gap-4">
            <h3 id="modal-title" class="font-heading text-3xl font-semibold text-stone-50"></h3>
            <button type="button" onclick="closeProgressModal()" class="flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-stone-50 hover:bg-white/20">
                <span class="sr-only">Tutup</span>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="modal-content"></div>
    </div>
</div>

<script>
const progressData = @json($progressUpdates ?? []);
const baseUrl = "{{ url('/') }}";
const progressModal = document.getElementById('progressModal');

function viewProgress(progressId) {
    const progress = progressData.find(item => item.id === progressId);
    if (!progress) return;

    document.getElementById('modal-title').textContent = 'Progress ' + progress.id_project;

    let fotoSrc = '';
    if (progress.foto && progress.foto !== '') {
        fotoSrc = progress.foto.startsWith('data:') ? progress.foto : `${baseUrl}/${progress.foto}`;
    }

    document.getElementById('modal-content').innerHTML = `
        <div class="space-y-5">
            ${progress.foto && progress.foto !== '' ? `<img src="${fotoSrc}" alt="Progress Update" class="max-h-[60vh] w-full rounded-[1.3rem] object-contain">` : ''}
            <div class="grid gap-4 md:grid-cols-2">
                <div class="rounded-[1.2rem] border border-white/10 bg-white/6 p-4">
                    <p class="text-[11px] uppercase tracking-[0.22em] text-stone-200/70">ID Project</p>
                    <p class="mt-2 text-lg font-semibold text-stone-50">${progress.id_project}</p>
                </div>
                <div class="rounded-[1.2rem] border border-white/10 bg-white/6 p-4">
                    <p class="text-[11px] uppercase tracking-[0.22em] text-stone-200/70">Tanggal Update</p>
                    <p class="mt-2 text-lg font-semibold text-stone-50">${new Date(progress.tanggal_update).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
                </div>
                ${progress.user ? `
                    <div class="rounded-[1.2rem] border border-white/10 bg-white/6 p-4 md:col-span-2">
                        <p class="text-[11px] uppercase tracking-[0.22em] text-stone-200/70">Customer</p>
                        <p class="mt-2 text-lg font-semibold text-stone-50">${progress.user.name}</p>
                    </div>
                ` : ''}
            </div>
            <div class="rounded-[1.2rem] border border-white/10 bg-white/6 p-4">
                <p class="text-[11px] uppercase tracking-[0.22em] text-stone-200/70">Deskripsi</p>
                <p class="mt-3 text-sm leading-7 text-stone-100/88">${progress.deskripsi}</p>
            </div>
        </div>
    `;

    progressModal.classList.remove('hidden');
    progressModal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function closeProgressModal() {
    progressModal.classList.add('hidden');
    progressModal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}

progressModal.addEventListener('click', function(event) {
    if (event.target === progressModal) {
        closeProgressModal();
    }
});
</script>
@endsection
