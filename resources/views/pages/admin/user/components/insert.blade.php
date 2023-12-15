@push('style')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endpush

<div x-cloak x-data="{ open: false }">
    <button @click="open = true" class="btn btn-primary my-3">
        <i class="fas fa-add"></i> Add Data
    </button>

    <div x-show="open" @click.away="open = false">
        <div class="col-12 col-md-12 col-lg-12">
            <form action="{{ route('user.store') }}" enctype="multipart/form-data" method="post">
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
                                    <input type="number" class="form-control" placeholder="NIK" name="nik"
                                        required>
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
                                    <input type="text" class="form-control" placeholder="Nama user" name="name"
                                        required>
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
                                    <input type="email" class="form-control" placeholder="E-mail user" name="email"
                                        required>
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
                                    <select name="role_id" id="role_id" class="form-control" required>
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
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                        required>
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
                                    <input type="file" class="form-control" name="photo" required
                                        accept="image/jpeg, image/png" onchange="previewPhotoInput(this)">
                                </div>
                                @error('photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <img id="preview0" src="#" alt="Your image" class="mt-3"
                                    style="max-width: 100px; max-height: 100px; display:none;" />
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                        <button class="btn btn-secondary" @click="open = false">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
