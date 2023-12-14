<x-slot name="title">
    User
</x-slot>

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 50% !important;
            padding: 0.5em 0.9em !important;
        }
    </style>
@endpush

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
                            <div class="row">
                                <div x-data="{ open: false }">
                                    <button @click="open = true" class="btn btn-primary my-3">
                                        <i class="fas fa-add"></i> Add Data
                                    </button>

                                    <div x-show="open" @click.away="open = false">
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <form wire:submit.prevent="addUser" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label>NIK</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <i class="fas fa-voicemail"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input type="number" class="form-control"
                                                                        placeholder="NIK" name="nik"
                                                                        wire:model="nik" required>
                                                                    @error('nik')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <i class="fas fa-person"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Nama user" name="name"
                                                                        wire:model="name" required>
                                                                </div>
                                                                @error('name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>E-mail</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <i class="fas fa-envelope"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input wire:model="email" type="email"
                                                                        class="form-control" placeholder="E-mail user"
                                                                        name="email" required>
                                                                </div>
                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Role</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <i class="fas fa-building"></i>
                                                                        </div>
                                                                    </div>
                                                                    <select wire:model="role_id" class="form-control"
                                                                        required>
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
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <i class="fas fa-lock"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input wire:model="password" type="password"
                                                                        class="form-control" placeholder="Password"
                                                                        name="password" required>
                                                                </div>
                                                                @error('password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Photo</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <i class="fas fa-image"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input wire:model="photo" type="file"
                                                                        class="form-control" name="photo" required
                                                                        accept="image/jpeg, image/png">
                                                                </div>
                                                                @error('photo')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="card-footer text-right">
                                                            <button class="btn btn-primary mr-1" type="submit"
                                                                @click.away="open = false">Submit</button>
                                                            <button class="btn btn-secondary"
                                                                type="reset">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
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
                                            <tr>
                                                <td>
                                                    {{ $no++ }}
                                                </td>
                                                <td>
                                                    <img src="{{ asset('admin/' . $user->photo) }}" alt="User Photo"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title="{{ $user->name }}">
                                                </td>
                                                <td>{{ $user->nik }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td></td>
                                            </tr>
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

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $("#table-1").dataTable({
            responsive: true,
            pagingType: 'full_numbers',
        });
    </script>
@endpush
