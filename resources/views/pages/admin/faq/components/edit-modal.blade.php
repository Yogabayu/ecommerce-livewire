        <!-- Modal -->
        <div class="modal fade" id="editModal{{ $faqId }}" tabindex="-1" role="dialog"
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
                                <form action="{{ route('faq.update', $faq->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="card">
                                        <div class="card-body">
                                            <label>Pertanyaan</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-tag"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control"
                                                    placeholder="Masukkan pertanyaan" name="question"
                                                    value="{{ $faq->question }}">
                                            </div>

                                            <label>Jawaban</label>
                                            <div class="input-group">
                                                <textarea class="summernote" name="answer">{{ $faq->answer }}</textarea>
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
