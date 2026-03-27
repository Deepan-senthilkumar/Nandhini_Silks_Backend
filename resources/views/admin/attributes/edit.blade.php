@extends('admin.layouts.admin')

@section('title', 'Edit Attribute')

@section('content')
<div class="card-glass p-6 rounded-2xl max-w-2xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.attributes.index') }}" class="mr-4 text-slate-400 hover:text-slate-600 transition-all">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 class="text-lg font-bold text-slate-800">Edit Attribute</h2>
    </div>

    <form action="{{ route('admin.attributes.update', $attribute->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Attribute Name</label>
                <input type="text" name="name" id="attributeName" value="{{ old('name', $attribute->name) }}" class="w-full px-4 py-2 rounded-xl border border-slate-100 focus:outline-none focus:border-[#a91b43] text-sm transition-all" required>
                @error('name') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Attribute Slug (auto-generated)</label>
                <input type="text" name="slug" id="attributeSlug" value="{{ old('slug', $attribute->slug) }}" class="w-full px-4 py-2 rounded-xl border border-slate-100 focus:outline-none focus:border-[#a91b43] text-sm transition-all" required>
                @error('slug') <p class="text-rose-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Status</label>
                <div class="flex bg-slate-100 p-1 rounded-xl w-fit">
                    <label class="relative flex-1">
                        <input type="radio" name="status" value="1" class="sr-only peer" {{ old('status', $attribute->status) == '1' ? 'checked' : '' }}>
                        <div class="px-4 py-1.5 rounded-lg text-xs font-bold cursor-pointer transition-all peer-checked:bg-white peer-checked:text-emerald-600 peer-checked:shadow-sm text-slate-500 hover:text-slate-700">
                            Active
                        </div>
                    </label>
                    <label class="relative flex-1">
                        <input type="radio" name="status" value="0" class="sr-only peer" {{ old('status', $attribute->status) == '0' ? 'checked' : '' }}>
                        <div class="px-4 py-1.5 rounded-lg text-xs font-bold cursor-pointer transition-all peer-checked:bg-white peer-checked:text-rose-600 peer-checked:shadow-sm text-slate-500 hover:text-slate-700">
                            Inactive
                        </div>
                    </label>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-[#a91b43] text-white py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-[#a91b43]/20 hover:bg-[#940437] transition-all">
                    Update Attribute
                </button>
            </div>
        </div>
    </form>
</div>
@push('scripts')
<script>
    document.getElementById('attributeName').addEventListener('input', function() {
        document.getElementById('attributeSlug').value = slugify(this.value);
    });
</script>
@endpush
@endsection
