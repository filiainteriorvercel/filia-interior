@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Edit Progress Update</h1>
                    <p class="text-gray-600 mt-2">Update informasi progress untuk project {{ $progress->id_project }}</p>
                </div>

                <form method="POST" action="{{ route('progress.update', $progress) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Customer Selection -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Customer <span class="text-red-500">*</span>
                        </label>
                        <select id="user_id" name="user_id" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('user_id') border-red-500 @enderror">
                            <option value="">Pilih Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" 
                                        {{ (old('user_id') ?? $progress->user_id) == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Project ID -->
                    <div>
                        <label for="id_project" class="block text-sm font-medium text-gray-700 mb-2">
                            ID Project <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="id_project" name="id_project" 
                               value="{{ old('id_project') ?? $progress->id_project }}" required
                               placeholder="Masukkan ID project (contoh: INT-2024-001)"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('id_project') border-red-500 @enderror">
                        @error('id_project')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Update Date -->
                    <div>
                        <label for="tanggal_update" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Update <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggal_update" name="tanggal_update" 
                               value="{{ old('tanggal_update') ?? $progress->tanggal_update->format('Y-m-d') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('tanggal_update') border-red-500 @enderror">
                        @error('tanggal_update')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Description -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi Progress <span class="text-red-500">*</span>
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="5" required
                                  placeholder="Jelaskan detail progress yang telah dicapai..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') ?? $progress->deskripsi }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status Progress
                        </label>
                        <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('status') border-red-500 @enderror">
                            <option value="">Pilih Status</option>
                            <option value="in_progress" {{ (old('status') ?? $progress->status) == 'in_progress' ? 'selected' : '' }}>Dalam Progress</option>
                            <option value="completed" {{ (old('status') ?? $progress->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="on_hold" {{ (old('status') ?? $progress->status) == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Photo Display -->
                    @php
                        use Illuminate\Support\Facades\Storage;
                        $fotoPath = $progress->foto;
                        $fotoExists = $fotoPath && (\Illuminate\Support\Str::startsWith($fotoPath, 'images/')
                            ? file_exists(public_path($fotoPath))
                            : Storage::disk('public')->exists($fotoPath));
                    @endphp
                    @if($fotoExists)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Foto Saat Ini
                            </label>
                            <div class="mb-4">
                                <img src="{{ \Illuminate\Support\Str::startsWith($fotoPath, 'images/') ? asset($fotoPath) : asset('storage/' . $fotoPath) }}" alt="Current Progress Photo" 
                                     class="h-48 w-full object-cover rounded-lg border border-gray-200">
                            </div>
                        </div>
                    @endif

                    <!-- Photo Upload -->
                    <div>
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $progress->foto ? 'Ganti Foto Progress' : 'Foto Progress' }}
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition duration-300">
                            <div class="space-y-1 text-center">
                                <svg id="upload-icon" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload file</span>
                                        <input id="foto" name="foto" type="file" accept="image/*" class="sr-only" onchange="previewImage(this)">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 10MB</p>
                                @if($progress->foto)
                                    <p class="text-xs text-blue-600">Kosongkan jika tidak ingin mengubah foto</p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Image Preview -->
                        <div id="image-preview" class="mt-4 hidden">
                            <img id="preview-img" src="" alt="Preview" class="h-48 w-full object-cover rounded-lg">
                            <button type="button" onclick="removeImage()" class="mt-2 text-red-600 hover:text-red-700 text-sm font-medium">
                                Hapus Foto Baru
                            </button>
                        </div>
                        
                        @error('foto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between pt-6">
                        <a href="{{ route('progress.index') }}" 
                           class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-300">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300 inline-flex items-center">
                            <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Update Progress
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
            document.getElementById('upload-icon').parentElement.parentElement.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    document.getElementById('foto').value = '';
    document.getElementById('image-preview').classList.add('hidden');
    document.getElementById('upload-icon').parentElement.parentElement.classList.remove('hidden');
}

// Drag and Drop functionality
const dropZone = document.querySelector('.border-dashed');
const fileInput = document.getElementById('foto');

dropZone.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.classList.add('border-indigo-500', 'bg-indigo-50');
});

dropZone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.classList.remove('border-indigo-500', 'bg-indigo-50');
});

dropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    this.classList.remove('border-indigo-500', 'bg-indigo-50');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files;
        previewImage(fileInput);
    }
});
</script>
@endsection
