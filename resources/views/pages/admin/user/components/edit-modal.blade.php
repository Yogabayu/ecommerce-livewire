        <!-- Modal -->
        <div class="modal fade" id="editModal{{ $userId }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data </h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <form action="{{ route('user.update', $user->uuid) }}" enctype="multipart/form-data"
                                    method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label>NIK</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" placeholder="NIK"
                                                            name="nik" value="{{ $user->nik }}" required>
                                                        @error('nik')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>Nama</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                            placeholder="Nama user" name="name"
                                                            value="{{ $user->name }}" required>
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
                                                        <input type="email" class="form-control"
                                                            placeholder="E-mail user" name="email"
                                                            value="{{ $user->email }}" required>
                                                    </div>
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>Role</label>
                                                    <div class="input-group">
                                                        <select name="role_id" id="role_id{{ $user->id }}"
                                                            class="form-control" required>
                                                            <option selected>-</option>
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->id }}"
                                                                    @if ($user->role_id == $role->id) selected @endif>
                                                                    {{ $role->name }}
                                                                </option>
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
                                                        <input type="password" class="form-control"
                                                            placeholder="Password" name="password">
                                                    </div>
                                                    @error('password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>Photo</label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" name="photo"
                                                            id="photo{{ $user->id }}"
                                                            accept="image/jpeg, image/png"
                                                            onchange="previewPhoto(this)">
                                                    </div>

                                                    @error('photo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label>Photo Saat ini:</label>
                                                    <div class="input-group">
                                                        <img src="{{ url($path) }}" alt="current image"
                                                            class="mt-3"
                                                            style="max-width: 100px; max-height: 100px; data-toggle="tooltip"
                                                            title="{{ $user->name }}">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>Photo baru :</label>
                                                    <div class="input-group">
                                                        <img id="preview{{ $user->id }}" src="#"
                                                            alt="new image" class="mt-3"
                                                            style="max-width: 100px; max-height: 100px; display:none;" />
                                                    </div>
                                                </div>
                                            </div> --}}

                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary mr-1" type="submit">Update</button>
                                            <button class="btn btn-secondary" type="button"
                                                data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
