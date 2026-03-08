@extends('layouts.app')

@section('content')
<div class="pm-shell">
    <div class="pm-container max-w-[88rem]">
        <section class="pm-hero pm-reveal">
            <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <span class="pm-hero-chip">Edit Progress</span>
                    <h1 class="mt-4 font-heading text-5xl font-semibold leading-none text-stone-50 sm:text-6xl">
                        Sesuaikan update project tanpa kehilangan konteks histori sebelumnya.
                    </h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-stone-200/88 sm:text-base">
                        Anda dapat mengganti project, memperbarui deskripsi, menyesuaikan status, dan menambah foto progress baru dari halaman ini.
                    </p>
                </div>
                <a href="{{ route('progress.index') }}" class="pm-btn pm-btn-ghost">Kembali ke Progress</a>
            </div>
        </section>

        <form method="POST" action="{{ route('progress.update', $progress) }}" enctype="multipart/form-data" class="grid gap-6 xl:grid-cols-[minmax(0,1.45fr)_360px]">
            @csrf
            @method('PUT')

            <section class="pm-panel pm-reveal">
                <div class="flex flex-col gap-2">
                    <p class="pm-kicker">Edit Update</p>
                    <h2 class="pm-section-title">Detail progress</h2>
                </div>

                <div class="mt-8 space-y-6">
                    <div class="pm-field">
                        <label for="project_id" class="pm-label">Project</label>
                        <select id="project_id" name="project_id" required class="pm-select">
                            <option value="">Pilih Project</option>
                            @foreach($projects as $projectItem)
                                <option
                                    value="{{ $projectItem->id }}"
                                    data-project-code="{{ $projectItem->project_code }}"
                                    data-customer-code="{{ $projectItem->user->customer_code ?? '-' }}"
                                    data-customer-name="{{ $projectItem->customer_name }}"
                                    data-customer-email="{{ $projectItem->customer_email }}"
                                    {{ (old('project_id') ?? $progress->project_id) == $projectItem->id ? 'selected' : '' }}
                                >
                                    {{ $projectItem->project_code }} - {{ $projectItem->customer_name }} ({{ $projectItem->user->customer_code ?? '-' }})
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
                            <input type="date" id="tanggal_update" name="tanggal_update" value="{{ old('tanggal_update') ?? $progress->tanggal_update->format('Y-m-d') }}" required class="pm-input">
                            @error('tanggal_update')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pm-field">
                            <label for="status" class="pm-label">Status Progress</label>
                            <select id="status" name="status" class="pm-select">
                                <option value="">Pilih Status</option>
                                <option value="in_progress" {{ (old('status') ?? $progress->status) == 'in_progress' ? 'selected' : '' }}>Dalam Progress</option>
                                <option value="completed" {{ (old('status') ?? $progress->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="on_hold" {{ (old('status') ?? $progress->status) == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                            </select>
                            @error('status')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pm-field">
                        <label for="deskripsi" class="pm-label">Deskripsi Progress</label>
                        <textarea id="deskripsi" name="deskripsi" rows="7" required class="pm-textarea">{{ old('deskripsi') ?? $progress->deskripsi }}</textarea>
                        @error('deskripsi')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pm-field">
                        <label for="foto" class="pm-label">{{ $progress->foto ? 'Ganti Foto Progress' : 'Foto Progress' }}</label>
                        <div class="pm-upload">
                            <div class="space-y-4" id="uploadPlaceholder">
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-stone-900 text-stone-50">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <input id="foto" name="foto" type="file" accept="image/*" class="hidden" onchange="previewImage(this)">
                                    <label for="foto" class="pm-btn pm-btn-secondary cursor-pointer">Upload Foto Baru</label>
                                </div>
                                <p class="text-sm text-slate-500">Kosongkan jika tidak ingin mengganti foto.</p>
                            </div>

                            <div id="image-preview" class="hidden">
                                <img id="preview-img" src="" alt="Preview" class="mx-auto max-h-80 rounded-[1.2rem] object-cover">
                                <button type="button" onclick="removeImage()" class="pm-link mt-4">Hapus Foto Baru</button>
                            </div>
                        </div>

                        @error('foto')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex flex-col gap-3 border-t border-stone-200 pt-6 sm:flex-row sm:justify-end">
                    <a href="{{ route('progress.index') }}" class="pm-btn pm-btn-secondary">Batal</a>
                    <button type="submit" class="pm-btn pm-btn-primary">Update Progress</button>
                </div>
            </section>

            <aside class="space-y-6">
                <section class="pm-panel pm-reveal pm-delay-1">
                    <p class="pm-kicker">Ringkasan Project</p>
                    <h2 class="mt-2 font-heading text-3xl font-semibold text-slate-800">Konteks customer</h2>
                    <div class="mt-6 space-y-3" id="projectSummary">
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">ID Project</p>
                            <p class="pm-meta-value" id="summaryProjectCode">{{ $progress->id_project }}</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">ID Customer</p>
                            <p class="pm-meta-value" id="summaryCustomerCode">{{ $progress->project->user->customer_code ?? '-' }}</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">Nama Customer</p>
                            <p class="pm-meta-value" id="summaryCustomerName">{{ $progress->project->customer_name ?? '-' }}</p>
                        </div>
                        <div class="pm-meta-item">
                            <p class="pm-meta-label">Email Customer</p>
                            <p class="pm-meta-value break-all" id="summaryCustomerEmail">{{ $progress->project->customer_email ?? '-' }}</p>
                        </div>
                    </div>
                </section>

                @if($progress->foto)
                    <section class="pm-panel-muted pm-reveal pm-delay-2">
                        <p class="pm-kicker">Foto Saat Ini</p>
                        <div class="mt-4 overflow-hidden rounded-[1.3rem] border border-stone-200 bg-white">
                            <img src="{{ str_starts_with($progress->foto, 'data:') ? $progress->foto : asset($progress->foto) }}" alt="Current Progress Photo" class="h-72 w-full object-cover">
                        </div>
                    </section>
                @endif
            </aside>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('preview-img').src = event.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
            document.getElementById('uploadPlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    document.getElementById('foto').value = '';
    document.getElementById('image-preview').classList.add('hidden');
    document.getElementById('uploadPlaceholder').classList.remove('hidden');
}

const projectSelect = document.getElementById('project_id');

function renderProjectSummary() {
    const selected = projectSelect.options[projectSelect.selectedIndex];
    if (!selected || !selected.value) {
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
