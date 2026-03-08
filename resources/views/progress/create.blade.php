@extends('layouts.app')

@section('content')
<div class="pm-shell">
    <div class="pm-container max-w-[88rem]">
        <section class="pm-hero pm-reveal">
            <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <span class="pm-hero-chip">Add Progress Update</span>
                    <h1 class="mt-4 font-heading text-5xl font-semibold leading-none text-stone-50 sm:text-6xl">
                        Tambahkan update project dengan konteks customer yang langsung terbaca.
                    </h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-stone-200/88 sm:text-base">
                        Pilih project, isi ringkasan progres, dan unggah foto bila diperlukan. Status project juga bisa langsung disesuaikan dari sini.
                    </p>
                </div>
                <a href="{{ route('progress.index') }}" class="pm-btn pm-btn-ghost">Kembali ke Progress</a>
            </div>
        </section>

        <form action="{{ route('progress.store') }}" method="POST" enctype="multipart/form-data" class="grid gap-6 xl:grid-cols-[minmax(0,1.45fr)_360px]">
            @csrf

            <section class="pm-panel pm-reveal">
                <div class="flex flex-col gap-2">
                    <p class="pm-kicker">Input Progress</p>
                    <h2 class="pm-section-title">Detail update project</h2>
                </div>

                <div class="mt-8 space-y-6">
                    <div class="pm-field">
                        <label for="project_id" class="pm-label">Project</label>
                        <select name="project_id" id="project_id" required class="pm-select">
                            <option value="">Pilih Project</option>
                            @foreach($projects as $project)
                                <option
                                    value="{{ $project->id }}"
                                    data-project-code="{{ $project->project_code }}"
                                    data-customer-code="{{ $project->user->customer_code ?? '-' }}"
                                    data-customer-name="{{ $project->customer_name }}"
                                    data-customer-email="{{ $project->customer_email }}"
                                    {{ old('project_id', $selectedProjectId ?? '') == $project->id ? 'selected' : '' }}
                                >
                                    {{ $project->project_code }} - {{ $project->customer_name }} ({{ $project->user->customer_code ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-form-grid">
                        <div class="pm-field">
                            <label for="tanggal_update" class="pm-label">Tanggal Update</label>
                            <input type="date" name="tanggal_update" id="tanggal_update" value="{{ old('tanggal_update', date('Y-m-d')) }}" required class="pm-input">
                            @error('tanggal_update')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pm-field">
                            <label for="status" class="pm-label">Status Project</label>
                            <select name="status" id="status" class="pm-select">
                                <option value="">Pilih Status</option>
                                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>Dalam Progress</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="on_hold" {{ old('status') == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                            </select>
                            @error('status')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pm-field">
                        <label for="deskripsi" class="pm-label">Deskripsi Progress</label>
                        <textarea name="deskripsi" id="deskripsi" rows="7" required class="pm-textarea" placeholder="Deskripsikan progress terbaru project ini secara singkat dan jelas.">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field">
                        <label for="foto" class="pm-label">Foto Progress</label>
                        <div class="pm-upload">
                            <div class="space-y-4" id="uploadPlaceholder">
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-stone-900 text-stone-50">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <input type="file" name="foto" id="foto" accept="image/*" class="hidden" onchange="previewImage(this)">
                                    <label for="foto" class="pm-btn pm-btn-secondary cursor-pointer">Upload Foto</label>
                                </div>
                                <p class="text-sm text-slate-500">PNG, JPG, GIF hingga 2MB</p>
                            </div>
                            <div id="imagePreview" class="hidden">
                                <img id="preview" class="mx-auto max-h-80 rounded-[1.2rem] object-cover" alt="Preview">
                            </div>
                        </div>
                        @error('foto')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex flex-col gap-3 border-t border-stone-200 pt-6 sm:flex-row sm:justify-end">
                    <a href="{{ route('progress.index') }}" class="pm-btn pm-btn-secondary">Batal</a>
                    <button type="submit" class="pm-btn pm-btn-primary">Simpan Progress</button>
                </div>
            </section>

            <aside class="space-y-6">
                <section class="pm-panel pm-reveal pm-delay-1">
                    <p class="pm-kicker">Project Summary</p>
                    <h2 class="mt-2 font-heading text-3xl font-semibold text-slate-800">Ringkasan customer</h2>
                    <div class="mt-6 space-y-3" id="projectSummary">
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">ID Project</p>
                            <p class="pm-meta-value" id="summaryProjectCode">-</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">ID Customer</p>
                            <p class="pm-meta-value" id="summaryCustomerCode">-</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">Nama Customer</p>
                            <p class="pm-meta-value" id="summaryCustomerName">Pilih project terlebih dahulu</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">Email Customer</p>
                            <p class="pm-meta-value break-all" id="summaryCustomerEmail">-</p>
                        </div>
                    </div>
                </section>

                <section class="pm-panel-muted pm-reveal pm-delay-2">
                    <p class="pm-kicker">Tips</p>
                    <div class="mt-3 space-y-3 text-sm leading-7 text-slate-600">
                        <p>Gunakan deskripsi singkat namun konkret agar histori progress mudah dipahami customer.</p>
                        <p>Jika status project berubah, ubah langsung dari form ini supaya dashboard project tetap sinkron.</p>
                    </div>
                </section>
            </aside>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('imagePreview').classList.remove('hidden');
            document.getElementById('preview').src = event.target.result;
            document.getElementById('uploadPlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

const projectSelect = document.getElementById('project_id');

function renderProjectSummary() {
    const selected = projectSelect.options[projectSelect.selectedIndex];
    if (!selected || !selected.value) {
        document.getElementById('summaryProjectCode').textContent = '-';
        document.getElementById('summaryCustomerCode').textContent = '-';
        document.getElementById('summaryCustomerName').textContent = 'Pilih project terlebih dahulu';
        document.getElementById('summaryCustomerEmail').textContent = '-';
        return;
    }

    document.getElementById('summaryProjectCode').textContent = selected.dataset.projectCode || '-';
    document.getElementById('summaryCustomerCode').textContent = selected.dataset.customerCode || '-';
    document.getElementById('summaryCustomerName').textContent = selected.dataset.customerName || '-';
    document.getElementById('summaryCustomerEmail').textContent = selected.dataset.customerEmail || '-';
}

projectSelect.addEventListener('change', renderProjectSummary);
renderProjectSummary();
</script>
@endsection
