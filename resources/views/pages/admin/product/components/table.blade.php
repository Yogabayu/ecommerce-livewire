<table class="table-striped table" id="table-1">
    <thead>
        <tr>
            <th class="text-center">
                No.
            </th>
            @if (auth()->user()->role_id == 1)
                <th class="text-center" data-toggle="tooltip" title="Yang upload">User</th>
            @endif
            <th class="text-center">Photo</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Harga</th>
            <th class="text-center">Status</th>
            <th class="text-center" data-toggle="tooltip"
                title="Gambar akan diletakkan di layar awal sebagai gambar utama">Hero?</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($products as $p)
            <tr>
                <td class="text-center">
                    {{ $no++ }}
                </td>
                @if (auth()->user()->role_id == 1)
                    <td class="text-center">
                        {{ $p->user->name }}
                    </td>
                @endif
                <td class="text-center">
                    <img src="{{ asset('storage/public/photos/' . $p->productPhoto[0]->photo) }}"
                        alt="{{ $p->name }}" class="img-fluid">
                </td>
                <td class="text-center">{{ $p->name }}</td>
                <td class="text-center">Rp{{ $p->price }},-</td>
                <td class="text-center">
                    @if ($p->publish == 1)
                        <a href="{{ route('changeVisibility', $p->id) }}">
                            <button type="button" class="btn btn-success btn-sm">
                                Ditampilkan
                            </button>
                        </a>
                    @else
                        <a href="{{ route('changeVisibility', $p->id) }}">
                            <button type="button" class="btn btn-danger btn-sm">Disembunyikan</button>
                        </a>
                    @endif
                </td>
                <td class="text-center">
                    @if ($p->is_hero == 1)
                        <a href="{{ route('changeHero', $p->slug) }}">
                            <button type="button" class="btn btn-success btn-sm">
                                Hero
                            </button>
                        </a>
                    @else
                        <a href="{{ route('changeHero', $p->slug) }}">
                            <button type="button" class="btn btn-danger btn-sm">-</button>
                        </a>
                    @endif
                </td>
                <td class="text-center">
                    <a class="btn btn-info btn-sm" title="Edit" href="{{ route('product.show', $p->id) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-warning btn-sm" title="Edit" href="{{ route('product.edit', $p->id) }}">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form id="deleteForm{{ $p->id }}" action="{{ route('product.destroy', $p->id) }}"
                        method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" title="Delete"
                            onclick="confirmDelete('{{ route('product.destroy', $p->id) }}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
