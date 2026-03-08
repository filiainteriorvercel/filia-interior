@extends('layouts.app')

@section('content')
@php
    $projectItems = method_exists($projects, 'getCollection') ? $projects->getCollection() : collect($projects);
    $projectTotal = method_exists($projects, 'total') ? $projects->total() : $projectItems->count();
    $visibleCustomers = $projectItems->pluck('user.customer_code')->filter()->unique()->count();
    $visiblePayments = $projectItems->sum(fn ($project) => $project->payments->count());
    $averagePaid = $projectItems->count() ? $projectItems->avg(fn ($project) => (float) $project->payments->sum('payment_percent')) : 0;
@endphp

<div class="pm-shell">
    <div class="pm-container">
        <section class="pm-hero pm-reveal">
            <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <span class="pm-hero-chip">Project Management Desk</span>
                    <h1 class="mt-4 font-heading text-5xl font-semibold leading-none text-stone-50 sm:text-6xl">
                        Semua project, payment, dan histori customer dalam satu ruang kerja.
                    </h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-stone-200/88 sm:text-base">
                        Kelola ID project, repeat order customer, bukti dealing, dan termin pembayaran dengan tampilan yang lebih cepat dipindai saat meeting atau demo.
                    </p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    @if(auth()->user()->isOwner())
                        <a href="{{ route('dashboard.projects.create') }}" class="pm-btn pm-btn-primary">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Project
                        </a>
                    @endif
                    <a href="{{ route('progress.index') }}" class="pm-btn pm-btn-ghost">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Lihat Progress
                    </a>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="pm-stat-card pm-reveal pm-delay-1">
                <p class="pm-stat-label">Total Project</p>
                <p class="pm-stat-value">{{ $projectTotal }}</p>
                <p class="pm-stat-meta">Semua data project yang tersimpan.</p>
            </div>
            <div class="pm-stat-card pm-reveal pm-delay-2">
                <p class="pm-stat-label">Customer Terlihat</p>
                <p class="pm-stat-value">{{ $visibleCustomers }}</p>
                <p class="pm-stat-meta">Customer unik pada halaman saat ini.</p>
            </div>
            <div class="pm-stat-card pm-reveal pm-delay-3">
                <p class="pm-stat-label">Histori Payment</p>
                <p class="pm-stat-value">{{ $visiblePayments }}</p>
                <p class="pm-stat-meta">Termin pembayaran yang sedang tampil.</p>
            </div>
            <div class="pm-stat-card pm-reveal pm-delay-4">
                <p class="pm-stat-label">Rata Pembayaran</p>
                <p class="pm-stat-value">{{ number_format((float) $averagePaid, 1) }}%</p>
                <p class="pm-stat-meta">Rata-rata progress pembayaran halaman ini.</p>
            </div>
        </section>

        <section class="pm-panel pm-reveal">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="pm-kicker">Filter dan Pencarian</p>
                    <h2 class="mt-2 font-heading text-3xl font-semibold text-slate-800">Cari project dengan cepat</h2>
                </div>

                <form method="GET" action="{{ route('dashboard.projects.index') }}" class="w-full max-w-3xl">
                    <div class="grid gap-3 sm:grid-cols-[minmax(0,1fr)_auto]">
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.65a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                            </svg>
                            <input
                                type="text"
                                name="q"
                                value="{{ $search ?? '' }}"
                                placeholder="Cari ID project, customer ID, nama, nomor HP, atau email"
                                class="pm-input pl-12"
                            >
                        </div>
                        <button type="submit" class="pm-btn pm-btn-primary w-full sm:w-auto">Cari Data</button>
                    </div>
                </form>
            </div>
        </section>

        @if(session('success'))
            <div class="pm-notice-success pm-reveal">{{ session('success') }}</div>
        @endif

        @if($projectItems->isNotEmpty())
            <section class="pm-card-grid">
                @foreach($projects as $project)
                    @php
                        $totalPaid = (float) $project->payments->sum('payment_percent');
                        $barWidth = $totalPaid > 0 ? min(100, max(10, $totalPaid)) : 0;
                        $statusClass = match ($project->status) {
                            'completed' => 'pm-badge pm-badge-success',
                            'on_hold' => 'pm-badge pm-badge-hold',
                            'cancelled' => 'pm-badge pm-badge-danger',
                            default => 'pm-badge pm-badge-progress',
                        };
                        $statusLabel = ucwords(str_replace('_', ' ', $project->status));
                    @endphp

                    <article class="pm-data-card pm-reveal" style="animation-delay: {{ 0.06 * $loop->index }}s;">
                        <div class="flex flex-col gap-5">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <p class="pm-kicker">ID Project</p>
                                    <h3 class="mt-2 text-2xl font-bold text-slate-900">{{ $project->project_code }}</h3>
                                    <p class="mt-2 text-sm text-slate-600">
                                        {{ $project->customer_name }} · {{ $project->user->customer_code ?? 'Tanpa ID Customer' }}
                                    </p>
                                </div>
                                <span class="{{ $statusClass }}">{{ $statusLabel }}</span>
                            </div>

                            <div class="pm-progress-bar">
                                <span style="width: {{ $barWidth }}%;"></span>
                            </div>

                            <div class="pm-meta-list">
                                <div class="pm-meta-item">
                                    <p class="pm-meta-label">Pembayaran</p>
                                    <p class="pm-meta-value">{{ number_format($totalPaid, 2) }}%</p>
                                </div>
                                <div class="pm-meta-item">
                                    <p class="pm-meta-label">Tanggal Dealing</p>
                                    <p class="pm-meta-value">{{ optional($project->deal_date)->format('d M Y') ?? '-' }}</p>
                                </div>
                                <div class="pm-meta-item">
                                    <p class="pm-meta-label">No HP</p>
                                    <p class="pm-meta-value">{{ $project->customer_phone ?? '-' }}</p>
                                </div>
                                <div class="pm-meta-item">
                                    <p class="pm-meta-label">Email</p>
                                    <p class="pm-meta-value break-all">{{ $project->customer_email }}</p>
                                </div>
                            </div>

                            <div class="pm-divider"></div>

                            <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                                <a href="{{ route('dashboard.projects.show', $project) }}" class="pm-btn pm-btn-primary">Detail Project</a>
                                @if(auth()->user()->isOwner())
                                    <a href="{{ route('dashboard.projects.edit', $project) }}" class="pm-btn pm-btn-secondary">Edit</a>
                                    <form method="POST" action="{{ route('dashboard.projects.destroy', $project) }}" onsubmit="return confirm('Yakin ingin menghapus project ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="pm-btn pm-btn-danger w-full sm:w-auto">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </section>
        @else
            <section class="pm-empty pm-reveal">
                <p class="pm-kicker">Belum Ada Data</p>
                <h2 class="mt-3 font-heading text-4xl font-semibold text-slate-800">Belum ada project yang bisa ditampilkan.</h2>
                <p class="mx-auto mt-4 max-w-xl text-sm leading-7 text-slate-600 sm:text-base">
                    Mulai dari membuat project baru untuk customer atau gunakan kolom pencarian lain jika Anda sedang mencari repeat order tertentu.
                </p>
                @if(auth()->user()->isOwner())
                    <div class="mt-6">
                        <a href="{{ route('dashboard.projects.create') }}" class="pm-btn pm-btn-primary">Tambah Project Pertama</a>
                    </div>
                @endif
            </section>
        @endif

        <div class="pm-panel">
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection
