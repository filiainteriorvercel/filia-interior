@extends('layouts.app')

@section('content')
@php
    $totalProjects = $userProjects->count();
    $totalPayments = $userProjects->sum(fn ($project) => $project->payments->count());
    $avgPaid = $totalProjects ? $userProjects->avg(fn ($project) => (float) $project->payments->sum('payment_percent')) : 0;
@endphp

<div class="pm-shell">
    <div class="pm-container">
        <section class="pm-hero pm-reveal">
            <div class="relative z-10 grid gap-8 xl:grid-cols-[minmax(0,1.2fr)_320px]">
                <div>
                    <span class="pm-hero-chip">Customer Project Room</span>
                    <h1 class="mt-4 font-heading text-5xl font-semibold leading-none text-stone-50 sm:text-6xl">
                        Selamat datang, {{ auth()->user()->name }}.
                    </h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-stone-200/88 sm:text-base">
                        Pantau semua project Anda, lihat histori payment, dan buka bukti transaksi tanpa harus berpindah-pindah halaman.
                    </p>
                </div>

                <div class="rounded-[1.7rem] border border-white/10 bg-white/10 p-5 backdrop-blur-md">
                    <p class="pm-kicker text-stone-200/80">Customer Snapshot</p>
                    <div class="mt-4 space-y-3 text-stone-100">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-stone-200/70">ID Customer</p>
                            <p class="mt-1 text-xl font-semibold">{{ auth()->user()->customer_code ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-stone-200/70">Email</p>
                            <p class="mt-1 break-all text-sm">{{ auth()->user()->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-stone-200/70">Status Akun</p>
                            <span class="mt-2 inline-flex rounded-full bg-white/12 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em]">{{ auth()->user()->role }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="pm-stat-card pm-reveal pm-delay-1">
                <p class="pm-stat-label">Total Project</p>
                <p class="pm-stat-value">{{ $totalProjects }}</p>
                <p class="pm-stat-meta">Seluruh project yang terhubung ke akun Anda.</p>
            </div>
            <div class="pm-stat-card pm-reveal pm-delay-2">
                <p class="pm-stat-label">Histori Payment</p>
                <p class="pm-stat-value">{{ $totalPayments }}</p>
                <p class="pm-stat-meta">Jumlah termin pembayaran yang telah dicatat.</p>
            </div>
            <div class="pm-stat-card pm-reveal pm-delay-3">
                <p class="pm-stat-label">Rata Pembayaran</p>
                <p class="pm-stat-value">{{ number_format((float) $avgPaid, 1) }}%</p>
                <p class="pm-stat-meta">Rata-rata progres pembayaran semua project.</p>
            </div>
        </section>

        @if($userProjects->isNotEmpty())
            <section class="space-y-6">
                @foreach($userProjects as $project)
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
                    <article class="pm-panel pm-reveal" style="animation-delay: {{ 0.08 * $loop->index }}s;">
                        <div class="flex flex-col gap-6">
                            <div class="flex flex-col gap-4 xl:flex-row xl:items-end xl:justify-between">
                                <div>
                                    <p class="pm-kicker">Project Anda</p>
                                    <h2 class="mt-2 font-heading text-4xl font-semibold text-slate-900">{{ $project->project_code }}</h2>
                                    <p class="mt-3 text-sm text-slate-600">
                                        ID Customer {{ auth()->user()->customer_code ?? '-' }} · Dealing {{ optional($project->deal_date)->format('d M Y') ?? '-' }}
                                    </p>
                                </div>
                                <div class="flex flex-col gap-3 sm:min-w-[280px]">
                                    <div class="flex items-center justify-between text-sm font-semibold text-slate-600">
                                        <span>{{ $statusLabel }}</span>
                                        <span>{{ number_format($totalPaid, 2) }}%</span>
                                    </div>
                                    <div class="pm-progress-bar">
                                        <span style="width: {{ $barWidth }}%;"></span>
                                    </div>
                                    <div class="flex justify-end">
                                        <span class="{{ $statusClass }}">{{ $statusLabel }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]">
                                <section class="rounded-[1.4rem] border border-stone-200 bg-white/70 p-5">
                                    <div class="flex items-center justify-between gap-3">
                                        <div>
                                            <p class="pm-kicker">Progress Timeline</p>
                                            <h3 class="mt-2 text-xl font-bold text-slate-900">Update pengerjaan</h3>
                                        </div>
                                        <span class="rounded-full bg-stone-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                            {{ $project->progressUpdates->count() }} update
                                        </span>
                                    </div>

                                    <div class="pm-timeline mt-6">
                                        @forelse($project->progressUpdates->take(5) as $progress)
                                            <div class="pm-timeline-card">
                                                <div class="flex items-start justify-between gap-4">
                                                    <div>
                                                        <p class="pm-timeline-date">{{ $progress->tanggal_update->format('d M Y') }}</p>
                                                        <p class="mt-2 text-sm leading-7 text-slate-600">{{ $progress->deskripsi }}</p>
                                                    </div>
                                                    <span class="pm-badge pm-badge-progress">{{ $progress->status ? ucwords(str_replace('_', ' ', $progress->status)) : 'Update' }}</span>
                                                </div>

                                                @if($progress->foto)
                                                    <div class="mt-4">
                                                        <button
                                                            type="button"
                                                            onclick="viewImage('{{ str_starts_with($progress->foto, 'data:') ? $progress->foto : asset($progress->foto) }}', 'Foto Progress {{ $project->project_code }}')"
                                                            class="pm-link"
                                                        >
                                                            Lihat Foto
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        @empty
                                            <div class="rounded-[1.2rem] border border-dashed border-stone-200 px-4 py-8 text-center text-sm text-slate-500">
                                                Belum ada progress update untuk project ini.
                                            </div>
                                        @endforelse
                                    </div>
                                </section>

                                <section class="rounded-[1.4rem] border border-stone-200 bg-white/70 p-5">
                                    <div class="flex items-center justify-between gap-3">
                                        <div>
                                            <p class="pm-kicker">Payment Timeline</p>
                                            <h3 class="mt-2 text-xl font-bold text-slate-900">Histori pembayaran</h3>
                                        </div>
                                        <span class="rounded-full bg-stone-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                            {{ $project->payments->count() }} termin
                                        </span>
                                    </div>

                                    <div class="pm-timeline mt-6">
                                        @if($project->deal_payment_proof)
                                            <div class="pm-timeline-card border-emerald-200 bg-emerald-50/70">
                                                <p class="pm-timeline-date">Dealing · {{ optional($project->deal_date)->format('d M Y') ?? '-' }}</p>
                                                <p class="mt-2 text-sm leading-7 text-slate-600">Bukti pembayaran awal project tersedia.</p>
                                                <div class="mt-4">
                                                    <button
                                                        type="button"
                                                        onclick="viewImage('{{ route('dashboard.projects.deal-proof', $project) }}', 'Bukti Dealing {{ $project->project_code }}')"
                                                        class="pm-link"
                                                    >
                                                        Lihat Bukti
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                        @forelse($project->payments as $payment)
                                            <div class="pm-timeline-card">
                                                <div class="flex items-start justify-between gap-4">
                                                    <div>
                                                        <p class="pm-timeline-date">{{ $payment->payment_date->format('d M Y') }}</p>
                                                        <p class="mt-2 text-xl font-bold text-slate-900">{{ number_format((float) $payment->payment_percent, 2) }}%</p>
                                                        <p class="mt-2 text-sm leading-7 text-slate-600">{{ $payment->notes ?? 'Tanpa catatan termin.' }}</p>
                                                    </div>
                                                    <span class="pm-badge pm-badge-success">Tercatat</span>
                                                </div>

                                                @if($payment->payment_proof)
                                                    <div class="mt-4">
                                                        <button
                                                            type="button"
                                                            onclick="viewImage('{{ route('dashboard.projects.payments.proof', [$project, $payment]) }}', 'Bukti Pembayaran {{ $project->project_code }}')"
                                                            class="pm-link"
                                                        >
                                                            Lihat Bukti
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        @empty
                                            <div class="rounded-[1.2rem] border border-dashed border-stone-200 px-4 py-8 text-center text-sm text-slate-500">
                                                Belum ada histori pembayaran progress.
                                            </div>
                                        @endforelse
                                    </div>
                                </section>
                            </div>
                        </div>
                    </article>
                @endforeach
            </section>
        @else
            <section class="pm-empty pm-reveal">
                <p class="pm-kicker">Belum Ada Project</p>
                <h2 class="mt-3 font-heading text-4xl font-semibold text-slate-800">Project Anda belum tersedia.</h2>
                <p class="mx-auto mt-4 max-w-xl text-sm leading-7 text-slate-600 sm:text-base">
                    Project akan muncul di sini setelah admin membuat data project untuk akun Anda.
                </p>
                <div class="mt-6">
                    <a href="{{ route('contact') }}" class="pm-btn pm-btn-primary">Hubungi Tim Kami</a>
                </div>
            </section>
        @endif
    </div>
</div>

<div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/70 p-4">
    <div class="pm-modal-panel max-w-4xl">
        <div class="mb-4 flex items-center justify-between gap-4">
            <h3 id="imageModalTitle" class="font-heading text-3xl font-semibold text-stone-50"></h3>
            <button type="button" onclick="closeImageModal()" class="flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-stone-50 hover:bg-white/20">
                <span class="sr-only">Tutup</span>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <img id="imageModalSrc" src="" alt="Detail Bukti" class="max-h-[72vh] w-full rounded-[1.3rem] object-contain">
    </div>
</div>

<script>
const imageModal = document.getElementById('imageModal');

function viewImage(src, title) {
    document.getElementById('imageModalTitle').textContent = title;
    document.getElementById('imageModalSrc').src = src;
    imageModal.classList.remove('hidden');
    imageModal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function closeImageModal() {
    imageModal.classList.add('hidden');
    imageModal.classList.remove('flex');
    document.getElementById('imageModalSrc').src = '';
    document.body.classList.remove('overflow-hidden');
}

imageModal.addEventListener('click', function(event) {
    if (event.target === imageModal) {
        closeImageModal();
    }
});
</script>
@endsection
