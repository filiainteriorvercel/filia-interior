@extends('layouts.app')

@section('content')
<div class="pm-shell">
    <div class="pm-container max-w-[88rem]">
        <section class="pm-hero pm-reveal">
            <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <span class="pm-hero-chip">Edit Project</span>
                    <h1 class="mt-4 font-heading text-5xl font-semibold leading-none text-stone-50 sm:text-6xl">
                        Perbarui detail project tanpa kehilangan histori customer dan dealing.
                    </h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-stone-200/88 sm:text-base">
                        Semua perubahan tetap mengacu ke project yang sama, sehingga pembayaran, progress, dan akses customer tetap sinkron.
                    </p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('dashboard.projects.show', $project) }}" class="pm-btn pm-btn-ghost">Kembali ke Detail</a>
                    <a href="{{ route('dashboard.projects.index') }}" class="pm-btn pm-btn-ghost">Semua Project</a>
                </div>
            </div>
        </section>

        <form method="POST" action="{{ route('dashboard.projects.update', $project) }}" enctype="multipart/form-data" class="grid gap-6 xl:grid-cols-[minmax(0,1.5fr)_360px]">
            @csrf
            @method('PUT')

            <section class="pm-panel pm-reveal">
                <div class="flex flex-col gap-2">
                    <p class="pm-kicker">Update Detail</p>
                    <h2 class="pm-section-title">Informasi Project</h2>
                </div>

                <div class="mt-8 pm-form-grid">
                    <div class="pm-field">
                        <label for="project_code" class="pm-label">ID Project</label>
                        <input type="text" id="project_code" name="project_code" value="{{ old('project_code', $project->project_code) }}" required class="pm-input">
                        @error('project_code')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
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
                                    {{ old('user_id', $project->user_id) == $customer->id ? 'selected' : '' }}
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
                        <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', $project->customer_name) }}" required class="pm-input">
                        @error('customer_name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field">
                        <label for="customer_phone" class="pm-label">No HP Customer</label>
                        <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', $project->customer_phone) }}" class="pm-input">
                        @error('customer_phone')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field">
                        <label for="customer_email" class="pm-label">Email Customer</label>
                        <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email', $project->customer_email) }}" required class="pm-input">
                        @error('customer_email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field">
                        <label for="deal_date" class="pm-label">Tanggal Dealing</label>
                        <input type="date" id="deal_date" name="deal_date" value="{{ old('deal_date', optional($project->deal_date)->format('Y-m-d')) }}" required class="pm-input">
                        @error('deal_date')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field">
                        <label for="status" class="pm-label">Status Project</label>
                        <select id="status" name="status" required class="pm-select">
                            <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="on_hold" {{ old('status', $project->status) == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                            <option value="cancelled" {{ old('status', $project->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field">
                        <label for="deal_payment_proof" class="pm-label">Ganti Bukti Pembayaran Dealing</label>
                        <input type="file" id="deal_payment_proof" name="deal_payment_proof" accept="image/*" class="pm-input file:mr-4 file:rounded-full file:border-0 file:bg-orange-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-orange-900 hover:file:bg-orange-200">
                        @error('deal_payment_proof')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field md:col-span-2">
                        <label for="notes" class="pm-label">Catatan</label>
                        <textarea id="notes" name="notes" rows="5" class="pm-textarea">{{ old('notes', $project->notes) }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex flex-col gap-3 border-t border-stone-200 pt-6 sm:flex-row sm:justify-end">
                    <a href="{{ route('dashboard.projects.show', $project) }}" class="pm-btn pm-btn-secondary">Batal</a>
                    <button type="submit" class="pm-btn pm-btn-primary">Update Project</button>
                </div>
            </section>

            <aside class="space-y-6">
                <section class="pm-panel pm-reveal pm-delay-1">
                    <p class="pm-kicker">Snapshot Aktif</p>
                    <h2 class="mt-2 font-heading text-3xl font-semibold text-slate-800">Data customer terkait</h2>
                    <div class="mt-6 space-y-3">
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">ID Customer</p>
                            <p class="pm-meta-value" id="summaryCustomerCode">{{ $project->user->customer_code ?? '-' }}</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">Nama</p>
                            <p class="pm-meta-value" id="summaryCustomerName">{{ $project->customer_name }}</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">Email</p>
                            <p class="pm-meta-value break-all" id="summaryCustomerEmail">{{ $project->customer_email }}</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">No HP</p>
                            <p class="pm-meta-value" id="summaryCustomerPhone">{{ $project->customer_phone ?? '-' }}</p>
                        </div>
                    </div>
                </section>

                <section class="pm-panel-muted pm-reveal pm-delay-2">
                    <p class="pm-kicker">Bukti Saat Ini</p>
                    <div class="mt-4 overflow-hidden rounded-[1.4rem] border border-stone-200 bg-white">
                        @if($project->deal_payment_proof)
                            <img src="{{ route('dashboard.projects.deal-proof', $project) }}" alt="Bukti Pembayaran Dealing" class="h-60 w-full object-cover">
                        @else
                            <div class="flex h-60 items-center justify-center px-6 text-center text-sm text-slate-500">
                                Belum ada bukti pembayaran dealing pada project ini.
                            </div>
                        @endif
                    </div>
                </section>

                <section class="pm-panel-muted pm-reveal pm-delay-3">
                    <p class="pm-kicker">Preview Bukti Baru</p>
                    <div class="pm-upload mt-4">
                        <div id="proofPlaceholder" class="{{ $project->deal_payment_proof ? 'hidden' : '' }} space-y-3">
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-stone-900 text-stone-50">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="text-sm text-slate-500">Upload file baru untuk melihat preview.</p>
                        </div>
                        <img id="proofPreview" src="" alt="Preview Bukti Baru" class="hidden w-full rounded-[1.2rem] object-cover">
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
        return;
    }

    customerName.value = selected.dataset.name || '';
    customerEmail.value = selected.dataset.email || '';
    customerPhone.value = selected.dataset.phone || '';

    document.getElementById('summaryCustomerCode').textContent = selected.dataset.code || '-';
    document.getElementById('summaryCustomerName').textContent = selected.dataset.name || '-';
    document.getElementById('summaryCustomerEmail').textContent = selected.dataset.email || '-';
    document.getElementById('summaryCustomerPhone').textContent = selected.dataset.phone || '-';
}

function renderProofPreview(input) {
    const file = input.files && input.files[0] ? input.files[0] : null;

    if (!file) {
        proofPreview.classList.add('hidden');
        proofPreview.src = '';
        if (!{{ $project->deal_payment_proof ? 'true' : 'false' }}) {
            proofPlaceholder.classList.remove('hidden');
        }
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
</script>
@endsection
