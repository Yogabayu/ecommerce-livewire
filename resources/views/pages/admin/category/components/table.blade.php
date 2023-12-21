<table class="table-striped table" id="table-1">
    <thead>
        <tr>
            <th class="text-center">
                No.
            </th>
            <th class="text-center">Gambar</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Jumlah produk yang memakai</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($categories as $category)
            <tr>
                <td class="text-center">
                    {{ $no++ }}
                </td>
                <td class="text-center">
                    <img src="{{ Storage::url('categories/' . $category->image) }}" alt="{{ $category->name }}"
                        class="rounded-circle" width="35" data-toggle="tooltip" title="{{ $category->name }}">
                </td>
                <td class="text-center">{{ $category->name }}</td>
                <td class="text-center">{{ $category->prod_count }}</td>
                <td class="text-center">
                    @if ($category->status == 1)
                        <a href="{{ route('category-visibility', $category->slug) }}">
                            <button type="button" class="btn btn-success btn-sm">
                                Ditampilkan
                            </button>
                        </a>
                    @else
                        <a href="{{ route('category-visibility', $category->slug) }}">
                            <button type="button" class="btn btn-danger btn-sm">Disembunyikan</button>
                        </a>
                    @endif
                </td>
                <td class="text-center">
                    <a class="btn btn-info btn-sm" title="Edit" data-toggle="modal"
                        data-target="#editModal{{ $category->id }}" data-backdrop="false">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form id="deleteForm{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}"
                        method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" title="Delete"
                            onclick="confirmDelete('{{ route('category.destroy', $category->id) }}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @include('pages.admin.category.components.edit-modal', [
                'categoryId' => $category->id,
            ])
        @endforeach
    </tbody>
</table>
