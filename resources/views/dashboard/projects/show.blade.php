@extends('layouts.app')

@section('content')
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

<div class="pm-shell">
    <div class="pm-container">
        <section class="pm-hero pm-reveal">
            <div class="relative z-10 flex flex-col gap-6 xl:flex-row xl:items-end xl:justify-between">
                <div class="max-w-3xl">
                    <span class="pm-hero-chip">Project Detail Workspace</span>
                    <h1 class="mt-4 font-heading text-5xl font-semibold leading-none text-stone-50 sm:text-6xl">
                        {{ $project->project_code }}
                    </h1>
                    <p class="mt-4 text-base text-stone-200/88">
                        {{ $project->customer_name }} · {{ $project->user->customer_code ?? 'Tanpa ID Customer' }}
                    </p>
                    <div class="mt-5 flex flex-wrap items-center gap-3">
                        <span class="{{ $statusClass }}">{{ $statusLabel }}</span>
                        <span class="pm-hero-chip">Total payment {{ number_format($totalPaid, 2) }}%</span>
                        <span class="pm-hero-chip">Dealing {{ optional($project->deal_date)->format('d M Y') }}</span>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    @if(auth()->user()->isOwner())
                        <a href="{{ route('progress.create', ['project_id' => $project->id]) }}" class="pm-btn pm-btn-primary">Tambah Progress</a>
                        <a href="{{ route('dashboard.projects.edit', $project) }}" class="pm-btn pm-btn-ghost">Edit Project</a>
                    @endif
                    <a href="{{ route('dashboard.projects.index') }}" class="pm-btn pm-btn-ghost">Kembali</a>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="pm-stat-card pm-reveal pm-delay-1">
                <p class="pm-stat-label">ID Customer</p>
                <p class="pm-stat-value text-[2rem]">{{ $project->user->customer_code ?? '-' }}</p>
                <p class="pm-stat-meta">Relasi customer untuk histori repeat order.</p>
            </div>
            <div class="pm-stat-card pm-reveal pm-delay-2">
                <p class="pm-stat-label">Termin Bayar</p>
                <p class="pm-stat-value">{{ $project->payments->count() }}</p>
                <p class="pm-stat-meta">Jumlah histori pembayaran project ini.</p>
            </div>
            <div class="pm-stat-card pm-reveal pm-delay-3">
                <p class="pm-stat-label">Progress Update</p>
                <p class="pm-stat-value">{{ $project->progressUpdates->count() }}</p>
                <p class="pm-stat-meta">Semua update pengerjaan yang sudah masuk.</p>
            </div>
            <div class="pm-stat-card pm-reveal pm-delay-4">
                <p class="pm-stat-label">Pembayaran</p>
                <p class="pm-stat-value">{{ number_format($totalPaid, 1) }}%</p>
                <p class="pm-stat-meta">Akumulasi termin yang telah dibayar.</p>
            </div>
        </section>

        <section class="grid gap-6 xl:grid-cols-[minmax(0,1.45fr)_360px]">
            <div class="space-y-6">
                <article class="pm-panel pm-reveal">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="pm-kicker">Overview Project</p>
                            <h2 class="mt-2 font-heading text-4xl font-semibold text-slate-800">Snapshot inti project</h2>
                        </div>
                        <div class="min-w-[220px]">
                            <div class="pm-progress-bar">
                                <span style="width: {{ $barWidth }}%;"></span>
                            </div>
                            <p class="mt-2 text-right text-sm font-semibold text-slate-600">{{ number_format($totalPaid, 2) }}% tercatat</p>
                        </div>
                    </div>

                    <div class="mt-8 pm-meta-list">
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">Nama Customer</p>
                            <p class="pm-meta-value">{{ $project->customer_name }}</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">Email</p>
                            <p class="pm-meta-value break-all">{{ $project->customer_email }}</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">No HP</p>
                            <p class="pm-meta-value">{{ $project->customer_phone ?? '-' }}</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">Status</p>
                            <p class="pm-meta-value">{{ $statusLabel }}</p>
                        </div>
                    </div>

                    @if($project->notes)
                        <div class="mt-6 rounded-[1.3rem] border border-stone-200 bg-white/70 p-4 text-sm leading-7 text-slate-600">
                            {{ $project->notes }}
                        </div>
                    @endif
                </article>

                <article class="pm-panel pm-reveal pm-delay-1">
                    <div class="flex flex-col gap-2">
                        <p class="pm-kicker">Payment Composer</p>
                        <h2 class="font-heading text-4xl font-semibold text-slate-800">Histori pembayaran</h2>
                    </div>

                    @if(auth()->user()->isOwner())
                        <form method="POST" action="{{ route('dashboard.projects.payments.store', $project) }}" enctype="multipart/form-data" class="mt-8 space-y-5">
                            @csrf
                            <div class="pm-form-grid">
                                <div class="pm-field">
                                    <label class="pm-label">Persentase (%)</label>
                                    <input type="number" step="0.01" min="0" max="100" name="payment_percent" value="{{ old('payment_percent') }}" required class="pm-input" placeholder="Contoh: 25">
                                </div>
                                <div class="pm-field">
                                    <label class="pm-label">Tanggal Bayar</label>
                                    <input type="date" name="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}" required class="pm-input">
                                </div>
                                <div class="pm-field">
                                    <label class="pm-label">Bukti Bayar</label>
                                    <input type="file" name="payment_proof" id="payment_proof" accept="image/*" class="pm-input file:mr-4 file:rounded-full file:border-0 file:bg-orange-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-orange-900 hover:file:bg-orange-200">
                                </div>
                                <div class="pm-field">
                                    <label class="pm-label">Catatan</label>
                                    <input type="text" name="notes" value="{{ old('notes') }}" class="pm-input" placeholder="Contoh: Termin 25%">
                                </div>
                            </div>

                            <div class="pm-upload">
                                <div id="paymentProofPlaceholder" class="space-y-3">
                                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-stone-900 text-stone-50">
                                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-slate-500">Preview bukti pembayaran baru akan tampil di sini.</p>
                                </div>
                                <img id="paymentProofPreview" src="" alt="Preview Bukti Pembayaran" class="hidden w-full rounded-[1.2rem] object-cover">
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="pm-btn pm-btn-primary">Tambah Histori Pembayaran</button>
                            </div>
                        </form>
                    @endif

                    @if(session('success'))
                        <div class="pm-notice-success mt-6">{{ session('success') }}</div>
                    @endif

                    @if($errors->any() && auth()->user()->isOwner())
                        <div class="pm-notice-error mt-6">
                            <p class="font-semibold">Gagal menyimpan histori pembayaran.</p>
                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="pm-timeline mt-8">
                        @forelse($project->payments as $payment)
                            <div class="pm-timeline-card">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                    <div>
                                        <p class="pm-timeline-date">{{ $payment->payment_date->format('d M Y') }}</p>
                                        <p class="mt-2 text-2xl font-bold text-slate-900">{{ number_format((float) $payment->payment_percent, 2) }}%</p>
                                        <p class="mt-2 text-sm leading-7 text-slate-600">{{ $payment->notes ?? 'Tanpa catatan termin.' }}</p>
                                    </div>

                                    <div class="flex flex-col gap-3 sm:items-end">
                                        @if($payment->payment_proof)
                                            <button
                                                type="button"
                                                onclick="openProjectMedia('{{ route('dashboard.projects.payments.proof', [$project, $payment]) }}', 'Bukti Pembayaran {{ $project->project_code }}')"
                                                class="pm-btn pm-btn-secondary"
                                            >
                                                Lihat Bukti
                                            </button>
                                        @endif

                                        @if(auth()->user()->isOwner())
                                            <form method="POST" action="{{ route('dashboard.projects.payments.destroy', [$project, $payment]) }}" onsubmit="return confirm('Hapus histori pembayaran ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="pm-btn pm-btn-danger w-full sm:w-auto">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="pm-empty">
                                <p class="pm-kicker">Belum Ada Histori</p>
                                <h3 class="mt-3 font-heading text-3xl font-semibold text-slate-800">Belum ada termin pembayaran.</h3>
                                <p class="mt-3 text-sm leading-7 text-slate-600">Tambahkan termin pertama agar customer bisa melihat perkembangan pembayaran project ini.</p>
                            </div>
                        @endforelse
                    </div>
                </article>
            </div>

            <div class="space-y-6">
                <article class="pm-panel pm-reveal pm-delay-2">
                    <p class="pm-kicker">Bukti Dealing</p>
                    <h2 class="mt-2 font-heading text-3xl font-semibold text-slate-800">Pembayaran awal</h2>
                    <div class="mt-5 overflow-hidden rounded-[1.4rem] border border-stone-200 bg-white">
                        @if($project->deal_payment_proof)
                            <button type="button" onclick="openProjectMedia('{{ route('dashboard.projects.deal-proof', $project) }}', 'Bukti Dealing {{ $project->project_code }}')" class="block w-full">
                                <img src="{{ route('dashboard.projects.deal-proof', $project) }}" alt="Deal proof" class="h-72 w-full object-cover">
                            </button>
                        @else
                            <div class="flex h-72 items-center justify-center px-6 text-center text-sm text-slate-500">
                                Bukti dealing belum diunggah.
                            </div>
                        @endif
                    </div>
                </article>

                <article class="pm-panel-muted pm-reveal pm-delay-3">
                    <p class="pm-kicker">Informasi Cepat</p>
                    <div class="mt-5 space-y-3">
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">ID Project</p>
                            <p class="pm-meta-value">{{ $project->project_code }}</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">ID Customer</p>
                            <p class="pm-meta-value">{{ $project->user->customer_code ?? '-' }}</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">Tanggal Dealing</p>
                            <p class="pm-meta-value">{{ optional($project->deal_date)->format('d M Y') ?? '-' }}</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">Status Project</p>
                            <p class="pm-meta-value">{{ $statusLabel }}</p>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section class="pm-panel pm-reveal pm-delay-2">
            <div class="flex flex-col gap-2">
                <p class="pm-kicker">Progress Timeline</p>
                <h2 class="font-heading text-4xl font-semibold text-slate-800">Riwayat progress project</h2>
            </div>

            <div class="mt-8 grid gap-5 lg:grid-cols-2">
                @forelse($project->progressUpdates as $progress)
                    @php
                        $progressStatusClass = match ($progress->status) {
                            'completed' => 'pm-badge pm-badge-success',
                            'on_hold' => 'pm-badge pm-badge-hold',
                            default => 'pm-badge pm-badge-progress',
                        };
                        $progressStatusLabel = $progress->status ? ucwords(str_replace('_', ' ', $progress->status)) : 'Update';
                    @endphp
                    <article class="pm-data-card">
                        @if($progress->foto)
                            <button
                                type="button"
                                onclick="openProjectMedia('{{ str_starts_with($progress->foto, 'data:') ? $progress->foto : asset($progress->foto) }}', 'Foto Progress {{ $project->project_code }}')"
                                class="block w-full overflow-hidden rounded-[1.3rem]"
                            >
                                <img src="{{ str_starts_with($progress->foto, 'data:') ? $progress->foto : asset($progress->foto) }}" alt="Foto Progress" class="h-56 w-full object-cover">
                            </button>
                        @endif

                        <div class="{{ $progress->foto ? 'mt-5' : 'mt-0' }} flex flex-col gap-4">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="pm-timeline-date">{{ $progress->tanggal_update->format('d M Y') }}</p>
                                    <h3 class="mt-2 text-xl font-bold text-slate-900">{{ $project->project_code }}</h3>
                                </div>
                                <span class="{{ $progressStatusClass }}">{{ $progressStatusLabel }}</span>
                            </div>
                            <p class="text-sm leading-7 text-slate-600">{{ $progress->deskripsi }}</p>
                        </div>
                    </article>
                @empty
                    <div class="pm-empty lg:col-span-2">
                        <p class="pm-kicker">Belum Ada Progress</p>
                        <h3 class="mt-3 font-heading text-3xl font-semibold text-slate-800">Timeline pengerjaan masih kosong.</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Tambahkan progress pertama dari halaman admin agar customer dapat memantau project ini.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>

<div id="projectMediaModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/70 p-4">
    <div class="pm-modal-panel">
        <div class="mb-4 flex items-center justify-between gap-4">
            <h3 id="projectMediaTitle" class="font-heading text-3xl font-semibold text-stone-50"></h3>
            <button type="button" onclick="closeProjectMedia()" class="flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-stone-50 hover:bg-white/20">
                <span class="sr-only">Tutup</span>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <img id="projectMediaImage" src="" alt="Project Media" class="max-h-[72vh] w-full rounded-[1.3rem] object-contain">
    </div>
</div>

<script>
const paymentProofInput = document.getElementById('payment_proof');
const paymentProofPreview = document.getElementById('paymentProofPreview');
const paymentProofPlaceholder = document.getElementById('paymentProofPlaceholder');
const projectMediaModal = document.getElementById('projectMediaModal');
const projectMediaImage = document.getElementById('projectMediaImage');
const projectMediaTitle = document.getElementById('projectMediaTitle');

if (paymentProofInput) {
    paymentProofInput.addEventListener('change', function() {
        const file = this.files && this.files[0] ? this.files[0] : null;

        if (!file) {
            paymentProofPreview.src = '';
            paymentProofPreview.classList.add('hidden');
            paymentProofPlaceholder.classList.remove('hidden');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(event) {
            paymentProofPreview.src = event.target.result;
            paymentProofPreview.classList.remove('hidden');
            paymentProofPlaceholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    });
}

function openProjectMedia(src, title) {
    projectMediaTitle.textContent = title;
    projectMediaImage.src = src;
    projectMediaModal.classList.remove('hidden');
    projectMediaModal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function closeProjectMedia() {
    projectMediaModal.classList.add('hidden');
    projectMediaModal.classList.remove('flex');
    projectMediaImage.src = '';
    document.body.classList.remove('overflow-hidden');
}

projectMediaModal.addEventListener('click', function(event) {
    if (event.target === projectMediaModal) {
        closeProjectMedia();
    }
});
</script>
@endsection
