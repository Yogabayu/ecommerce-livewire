<div x-cloak x-data="{ open: false }">
    <button @click="open = true" class="btn btn-primary my-3">
        <i class="fas fa-add"></i> Add Data
    </button>

    <div x-show="open" @click.away="open = false">
        <div class="col-12 col-md-12 col-lg-12">
            <form action="{{ route('banner.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('post')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Gambar Banner</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-voicemail"></i>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="banner_img"
                                        accept=".jpg,.png,.jpeg" required>
                                    @error('banner_img')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Apakah Akan ditampilkan sebagai hero image ?</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-person"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" name="is_hero" id="is_hero">
                                        <option value="0">Tidak ditampilkan</option>
                                        <option value="1">Tampilkan Sebagai Hero Image</option>
                                    </select>
                                </div>
                                @error('is_hero')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Apakah Akan ditampilkan di aplikasi ?</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-person"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" name="is_see" id="is_see">
                                        <option value="0">Tidak ditampilkan</option>
                                        <option value="1">Di tampilkan</option>
                                    </select>
                                </div>
                                @error('is_see')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="form-group col-md-6 col-12">
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
                            </div> --}}
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
