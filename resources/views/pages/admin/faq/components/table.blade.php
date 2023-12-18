<table class="table-striped table" id="table-1">
    <thead>
        <tr>
            <th class="text-center">
                No.
            </th>
            <th class="text-center">Pertanyaan</th>
            <th class="text-center">Jawaban</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($faqs as $faq)
            <tr>
                <td class="text-center">
                    {{ $no++ }}
                </td>
                <td class="text-center">{{ $faq->question }}</td>
                <td class="text-center">{!! $faq->answer !!}</td>
                <td class="text-center">
                    <a class="btn btn-info btn-sm" title="Edit" data-toggle="modal"
                        data-target="#editModal{{ $faq->id }}" data-backdrop="false">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form id="deleteForm{{ $faq->id }}" action="{{ route('faq.destroy', $faq->id) }}"
                        method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" title="Delete"
                            onclick="confirmDelete('{{ route('faq.destroy', $faq->id) }}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @include('pages.admin.faq.components.edit-modal', [
                'faqId' => $faq->id,
            ])
        @endforeach
    </tbody>
</table>
