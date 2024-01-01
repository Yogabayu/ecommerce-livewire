        <!-- Modal -->
        <div class="modal fade" id="editModal{{ $bannerId }}" tabindex="-1" role="dialog"
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
                                <form action="{{ route('banner.update', $banner->id) }}" enctype="multipart/form-data"
                                    method="post">
                                    @csrf
                                    @method('put')
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Gambar Banner</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-voicemail"></i>
                                                        </div>
                                                    </div>
                                                    <input type="file" class="form-control" name="banner_img">
                                                    @error('banner_img')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Banner Saat ini:</label>
                                                <div class="input-group">
                                                    <img src="{{ asset('storage/public/banners/' . $banner->banner_img)}}" alt="banner" class="mt-3"
                                                        style="max-width: 100px; max-height: 100px; data-toggle="tooltip"
                                                        title="banner">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Apakah Akan ditampilkan di aplikasi ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-person"></i>
                                                        </div>
                                                    </div>
                                                    <select class="form-control" name="is_see" id="is_see">
                                                        <option value="0"
                                                            @if ($banner->is_see == 0) selected @endif>Tidak
                                                            ditampilkan</option>
                                                        <option value="1"
                                                            @if ($banner->is_see == 1) selected @endif>Di
                                                            tampilkan</option>
                                                    </select>
                                                </div>
                                                @error('is_see')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                            <button class="btn btn-secondary" type="button"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
