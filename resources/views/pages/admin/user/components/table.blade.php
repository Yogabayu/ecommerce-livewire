<table class="table-striped table" id="table-1">
    <thead>
        <tr>
            <th class="text-center">
                No.
            </th>
            <th>Photo</th>
            <th>NIK</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($users as $user)
            @php
                $path = Storage::url('photos/' . $user->photo);
            @endphp
            <tr>
                <td>
                    {{ $no++ }}
                </td>
                <td>
                    <img src="{{ url($path) }}" alt="User Photo" class="rounded-circle" width="35"
                        data-toggle="tooltip" title="{{ $user->name }}">
                </td>
                <td>{{ $user->nik }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a class="btn btn-info btn-sm" title="Edit" data-toggle="modal"
                        data-target="#editModal{{ $user->id }}" data-backdrop="false">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form id="deleteForm{{ $user->id }}" action="{{ route('user.destroy', $user->uuid) }}"
                        method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" title="Delete"
                            onclick="confirmDelete('{{ route('user.destroy', $user->uuid) }}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @include('pages.admin.user.components.edit-modal', [
                'userId' => $user->id,
            ])
        @endforeach
    </tbody>
</table>
@push('scripts')
    <script>
        function previewPhoto(input) {
            const userId = "{{ $user->id }}";
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
@endpush
