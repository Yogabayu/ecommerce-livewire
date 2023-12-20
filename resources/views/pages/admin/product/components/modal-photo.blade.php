        <!-- Modal -->
        <div class="modal fade" id="AddPhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" style="z-index: 9999">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Photo</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <form action="{{ route('addPhotos') }}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <label>Photo</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-tag"></i>
                                                    </div>
                                                </div>
                                                <input type="file" name="photos[]" class="form-control"
                                                    accept="image/jpeg, image/png" multiple required>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
