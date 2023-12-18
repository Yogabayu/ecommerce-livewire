<table class="table-striped table" id="table-1">
    <thead>
        <tr>
            <th class="text-center">
                No.
            </th>
            <th class="text-center">Tag</th>
            <th class="text-center">Jumlah produk yang memakai</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($tags as $tag)
            <tr>
                <td class="text-center">
                    {{ $no++ }}
                </td>
                <td class="text-center">{{ $tag->name }}</td>
                <td class="text-center">{{ $tag->tag_count }}</td>
                <td class="text-center">
                    <a class="btn btn-info btn-sm" title="Edit" data-toggle="modal"
                        data-target="#editModal{{ $tag->id }}" data-backdrop="false">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form id="deleteForm{{ $tag->id }}" action="{{ route('tag.destroy', $tag->id) }}"
                        method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" title="Delete"
                            onclick="confirmDelete('{{ route('tag.destroy', $tag->id) }}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @include('pages.admin.tag.components.edit-modal', [
                'tagId' => $tag->id,
            ])
        @endforeach
    </tbody>
</table>
