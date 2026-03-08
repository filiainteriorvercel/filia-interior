@extends('layouts.app')

@section('content')
<div class="pm-shell">
    <div class="pm-container max-w-[88rem]">
        <section class="pm-hero pm-reveal">
            <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <span class="pm-hero-chip">Create New Project</span>
                    <h1 class="mt-4 font-heading text-5xl font-semibold leading-none text-stone-50 sm:text-6xl">
                        Buat project baru dengan data customer dan dealing yang rapi sejak awal.
                    </h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-stone-200/88 sm:text-base">
                        Form ini menyimpan snapshot customer, tanggal dealing, dan bukti pembayaran awal agar histori repeat order lebih mudah dipantau.
                    </p>
                </div>
                <a href="{{ route('dashboard.projects.index') }}" class="pm-btn pm-btn-ghost">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Project
                </a>
            </div>
        </section>

        <form method="POST" action="{{ route('dashboard.projects.store') }}" enctype="multipart/form-data" class="grid gap-6 xl:grid-cols-[minmax(0,1.5fr)_360px]">
            @csrf

            <section class="pm-panel pm-reveal">
                <div class="flex flex-col gap-2">
                    <p class="pm-kicker">Data Utama</p>
                    <h2 class="pm-section-title">Informasi Project</h2>
                </div>

                <div class="mt-8 pm-form-grid">
                    <div class="pm-field">
                        <span class="pm-label">ID Project</span>
                        <div class="pm-input flex items-center justify-between gap-4 bg-stone-100 text-slate-700">
                            <div>
                                <p class="font-semibold">Dibuat otomatis oleh sistem</p>
                                <p class="text-sm text-slate-500">Format akan mengikuti urutan project baru, misalnya `PRJ-0007`.</p>
                            </div>
                            <span class="rounded-full bg-stone-900 px-3 py-1 text-xs font-semibold tracking-[0.24em] text-stone-50">AUTO</span>
                        </div>
                    </div>

                    <div class="pm-field">
                        <label for="user_id" class="pm-label">Customer</label>
                        <select id="user_id" name="user_id" required class="pm-select">
                            <option value="">Pilih Customer</option>
                            @foreach($customers as $customer)
                                <option
                                    value="{{ $customer->id }}"
                                    data-name="{{ $customer->name }}"
                                    data-email="{{ $customer->email }}"
                                    data-phone="{{ $customer->phone }}"
                                    data-code="{{ $customer->customer_code ?? '-' }}"
                                    {{ old('user_id') == $customer->id ? 'selected' : '' }}
                                >
                                    {{ $customer->customer_code ?? '-' }} - {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field">
                        <label for="customer_name" class="pm-label">Nama Customer</label>
                        <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required class="pm-input">
                        @error('customer_name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field">
                        <label for="customer_phone" class="pm-label">No HP Customer</label>
                        <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" class="pm-input">
                        @error('customer_phone')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field">
                        <label for="customer_email" class="pm-label">Email Customer</label>
                        <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required class="pm-input">
                        @error('customer_email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field">
                        <label for="deal_date" class="pm-label">Tanggal Dealing</label>
                        <input type="date" id="deal_date" name="deal_date" value="{{ old('deal_date', date('Y-m-d')) }}" required class="pm-input">
                        @error('deal_date')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field">
                        <label for="status" class="pm-label">Status Project</label>
                        <select id="status" name="status" required class="pm-select">
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="on_hold" {{ old('status') == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field">
                        <label for="deal_payment_proof" class="pm-label">Bukti Pembayaran Dealing</label>
                        <input type="file" id="deal_payment_proof" name="deal_payment_proof" accept="image/*" class="pm-input file:mr-4 file:rounded-full file:border-0 file:bg-orange-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-orange-900 hover:file:bg-orange-200">
                        @error('deal_payment_proof')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field md:col-span-2">
                        <label for="notes" class="pm-label">Catatan</label>
                        <textarea id="notes" name="notes" rows="5" class="pm-textarea" placeholder="Catatan internal project, kebutuhan customer, atau poin dealing lainnya.">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex flex-col gap-3 border-t border-stone-200 pt-6 sm:flex-row sm:justify-end">
                    <a href="{{ route('dashboard.projects.index') }}" class="pm-btn pm-btn-secondary">Batal</a>
                    <button type="submit" class="pm-btn pm-btn-primary">Simpan Project</button>
                </div>
            </section>

            <aside class="space-y-6">
                <section class="pm-panel pm-reveal pm-delay-1">
                    <p class="pm-kicker">Preview Snapshot</p>
                    <h2 class="mt-2 font-heading text-3xl font-semibold text-slate-800">Ringkasan customer</h2>
                    <div id="customerSummary" class="mt-6 space-y-3">
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">ID Customer</p>
                            <p class="pm-meta-value" id="summaryCustomerCode">-</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">Nama</p>
                            <p class="pm-meta-value" id="summaryCustomerName">Belum dipilih</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">Email</p>
                            <p class="pm-meta-value break-all" id="summaryCustomerEmail">-</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">No HP</p>
                            <p class="pm-meta-value" id="summaryCustomerPhone">-</p>
                        </div>
                    </div>
                </section>

                <section class="pm-panel-muted pm-reveal pm-delay-2">
                    <p class="pm-kicker">Guideline</p>
                    <div class="mt-3 space-y-3 text-sm leading-7 text-slate-600">
                        <p>ID project sekarang dibuat otomatis oleh sistem agar urutan project konsisten dan tidak bentrok.</p>
                        <p>Snapshot customer disimpan di project, jadi histori tetap aman walau data profil customer berubah.</p>
                        <p>Upload bukti dealing sejak awal supaya timeline pembayaran lengkap dari termin pertama.</p>
                    </div>
                </section>

                <section class="pm-panel-muted pm-reveal pm-delay-3">
                    <p class="pm-kicker">Preview Bukti</p>
                    <div class="pm-upload mt-4">
                        <div id="proofPlaceholder" class="space-y-3">
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-stone-900 text-stone-50">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="text-sm text-slate-500">Preview bukti dealing akan muncul di sini.</p>
                        </div>
                        <img id="proofPreview" src="" alt="Preview Bukti Dealing" class="hidden w-full rounded-[1.2rem] object-cover">
                    </div>
                </section>
            </aside>
        </form>
    </div>
</div>

<script>
const customerSelect = document.getElementById('user_id');
const customerName = document.getElementById('customer_name');
const customerEmail = document.getElementById('customer_email');
const customerPhone = document.getElementById('customer_phone');
const proofInput = document.getElementById('deal_payment_proof');
const proofPreview = document.getElementById('proofPreview');
const proofPlaceholder = document.getElementById('proofPlaceholder');

function renderCustomerSummary() {
    const selected = customerSelect.options[customerSelect.selectedIndex];

    if (!selected || !selected.value) {
        document.getElementById('summaryCustomerCode').textContent = '-';
        document.getElementById('summaryCustomerName').textContent = 'Belum dipilih';
        document.getElementById('summaryCustomerEmail').textContent = '-';
        document.getElementById('summaryCustomerPhone').textContent = '-';
        return;
    }

    if (!customerName.value) customerName.value = selected.dataset.name || '';
    if (!customerEmail.value) customerEmail.value = selected.dataset.email || '';
    if (!customerPhone.value) customerPhone.value = selected.dataset.phone || '';

    document.getElementById('summaryCustomerCode').textContent = selected.dataset.code || '-';
    document.getElementById('summaryCustomerName').textContent = selected.dataset.name || '-';
    document.getElementById('summaryCustomerEmail').textContent = selected.dataset.email || '-';
    document.getElementById('summaryCustomerPhone').textContent = selected.dataset.phone || '-';
}

function renderProofPreview(input) {
    const file = input.files && input.files[0] ? input.files[0] : null;

    if (!file) {
        proofPreview.classList.add('hidden');
        proofPlaceholder.classList.remove('hidden');
        proofPreview.src = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function(event) {
        proofPreview.src = event.target.result;
        proofPreview.classList.remove('hidden');
        proofPlaceholder.classList.add('hidden');
    };
    reader.readAsDataURL(file);
}

customerSelect.addEventListener('change', renderCustomerSummary);
proofInput.addEventListener('change', function() {
    renderProofPreview(this);
});

renderCustomerSummary();
renderProofPreview(proofInput);
</script>
@endsection
