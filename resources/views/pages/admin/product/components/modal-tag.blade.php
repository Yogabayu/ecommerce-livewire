        <!-- Modal -->
        <div class="modal fade" id="AddTagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" style="z-index: 9999">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Tag</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <form action="{{ route('tag.store') }}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('post')
                                    <div class="card">
                                        <div class="card-body">
                                            <label>Tags</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-tag"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter tags (pisahkan dengan koma)" name="tagsInput"
                                                    x-model="tagsInput">
                                            </div>
                                            <p class="text-danger">contoh: Tag1,Tag2,Tag3</p>
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
