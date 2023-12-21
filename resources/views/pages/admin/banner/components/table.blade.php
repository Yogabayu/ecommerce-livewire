<table class="table-striped table" id="table-1">
    <thead>
        <tr>
            <th class="text-center">
                No.
            </th>
            <th>Photo</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($banners as $banner)
            @php
                $path = Storage::url('banners/' . $banner->banner_img);
            @endphp
            <tr>
                <td>
                    {{ $no++ }}
                </td>
                <td>
                    <img src="{{ url($path) }}" alt="Banner Photo" class="rounded-circle" width="35"
                        data-toggle="tooltip" title="banner">
                </td>
                <td>
                    @if ($banner->is_see)
                        <a href="{{ route('bannerVisibility', $banner->id) }}">
                            <button type="button" class="btn btn-success btn-sm">
                                Ditampilkan
                            </button>
                        </a>
                    @else
                        <a href="{{ route('bannerVisibility', $banner->id) }}">
                            <button type="button" class="btn btn-danger btn-sm">Disembunyikan</button>
                        </a>
                    @endif
                </td>
                <td>
                    <a class="btn btn-info btn-sm" title="Edit" data-toggle="modal"
                        data-target="#editModal{{ $banner->id }}" data-backdrop="false">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form id="deleteForm{{ $banner->id }}" action="{{ route('user.destroy', $banner->id) }}"
                        method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" title="Delete"
                            onclick="confirmDelete('{{ route('banner.destroy', $banner->id) }}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @include('pages.admin.banner.components.edit-modal', [
                'bannerId' => $banner->id,
            ])
        @endforeach
    </tbody>
</table>
{{-- @push('scripts')
    <script>
        function previewPhoto(input) {
            const userId = "{{ $banner->id }}";
            const preview = document.getElementById(`preview${userId}`);
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush --}}
