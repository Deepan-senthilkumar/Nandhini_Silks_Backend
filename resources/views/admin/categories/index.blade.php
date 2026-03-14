@extends('admin.layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="card-glass p-8 rounded-3xl">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Category List</h2>
        <a href="{{ route('admin.categories.create') }}" class="bg-[#a91b43] text-white px-6 py-2 rounded-xl hover:bg-[#940437] transition-all">
            <i class="fas fa-plus mr-2"></i> Add Category
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-slate-500 text-sm border-b border-slate-100">
                    <th class="pb-4 font-medium">Image</th>
                    <th class="pb-4 font-medium">Name</th>
                    <th class="pb-4 font-medium">Order</th>
                    <th class="pb-4 font-medium">Status</th>
                    <th class="pb-4 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($categories as $category)
                <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-all">
                    <td class="py-4">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" class="w-12 h-12 rounded-lg object-cover">
                        @else
                            <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td class="py-4">
                        <div class="font-semibold text-slate-800">{{ $category->name }}</div>
                        <div class="text-xs text-slate-400">{{ $category->slug }}</div>
                    </td>
                    <td class="py-4 text-slate-600">{{ $category->display_order }}</td>
                    <td class="py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $category->status ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }}">
                            {{ $category->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="py-4 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-all">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" onclick="confirmDelete('{{ $category->id }}')" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-all">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#a91b43',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endpush
