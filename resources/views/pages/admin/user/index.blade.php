@extends('layouts.admin.app')

@section('title')
    User
@endsection

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>User</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div x-data="{ open: false }">
                                    <button @click="open = true" class="btn btn-primary my-3">
                                        <i class="fas fa-add"></i> Add Data
                                    </button>

                                    <div x-show="open" @click.away="open = false">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <form action="{{ route('user.store') }}" enctype="multipart/form-data"
                                                method="post">
                                                @csrf
                                                @method('post')
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-6 col-12">
                                                                <label>NIK</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <i class="fas fa-voicemail"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input type="number" class="form-control"
                                                                        placeholder="NIK" name="nik" required>
                                                                    @error('nik')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6 col-12">
                                                                <label>Nama</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <i class="fas fa-person"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Nama user" name="name" required>
                                                                </div>
                                                                @error('name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6 col-12">
                                                                <label>E-mail</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <i class="fas fa-envelope"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input type="email" class="form-control"
                                                                        placeholder="E-mail user" name="email" required>
                                                                </div>
                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-6 col-12">
                                                                <label>Role</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <i class="fas fa-building"></i>
                                                                        </div>
                                                                    </div>
                                                                    <select name="role_id" id="role_id"
                                                                        class="form-control" required>
                                                                        <option selected>-</option>
                                                                        @foreach ($roles as $role)
                                                                            <option value="{{ $role->id }}">
                                                                                {{ $role->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('role_id')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6 col-12">
                                                                <label>Password</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <i class="fas fa-lock"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="Password" name="password" required>
                                                                </div>
                                                                @error('password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-6 col-12">
                                                                <label>Photo</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <i class="fas fa-image"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input type="file" class="form-control"
                                                                        name="photo" required
                                                                        accept="image/jpeg, image/png">
                                                                </div>
                                                                @error('photo')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-right">
                                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                                        <button class="btn btn-secondary" type="reset">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive" wire:ignore>
                                    <table class="table-striped table" id="table-1" wire:key={{ uniqid() }}>
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
                                                        <img src="{{ url($path) }}" alt="User Photo"
                                                            class="rounded-circle" width="35" data-toggle="tooltip"
                                                            title="{{ $user->name }}">
                                                    </td>
                                                    <td>{{ $user->nik }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm" title="Edit" data-toggle="modal"
                                                            data-target="#editModal{{ $user->id }}"
                                                            data-backdrop="false">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form id="deleteForm{{ $user->id }}"
                                                            action="{{ route('user.destroy', $user->uuid) }}"
                                                            method="POST" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                title="Delete"
                                                                onclick="confirmDelete({{ $user->id }})">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @include('pages.admin.user.modal.edit-modal', [
                                                    'userId' => $user->id,
                                                ])
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

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
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $("#table-1").dataTable({
            responsive: true,
            paging: true,
            pagingType: 'full_numbers',
        });
    </script>
    <script>
        function confirmDelete(id) {
            if (window.confirm("Are you sure you want to delete this user?")) {
                document.getElementById('deleteForm' + id).submit();
            }
        }
    </script>
@endpush
