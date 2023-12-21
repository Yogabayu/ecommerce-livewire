        <!-- Modal -->
        <div class="modal fade" id="editModal{{ $categoryId }}" tabindex="-1" role="dialog"
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
                                <form action="{{ route('category-update', $category->slug) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-person"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Nama Gambar"
                                                        name="name" value="{{ $category->name }}">
                                                </div>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-person"></i>
                                                        </div>
                                                    </div>
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="--" selected>Pilih Status</option>
                                                        <option value="1"
                                                            @if ($category->status == 1) selected @endif>
                                                            Ditampilkan</option>
                                                        <option value="0"
                                                            @if ($category->status == 0) selected @endif>
                                                            Disembunyikan</option>
                                                    </select>
                                                </div>
                                                @error('slug')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Gambar</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-image"></i>
                                                        </div>
                                                    </div>
                                                    <input type="file" class="form-control" name="image"
                                                        accept="image/jpeg, image/png"
                                                        onchange="previewPhotoInput(this)">
                                                </div>
                                                @error('photo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                <img id="preview0" src="#" alt="Your image" class="mt-3"
                                                    style="max-width: 100px; max-height: 100px; display:none;" />
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
                </div>
            </div>
        </div>
