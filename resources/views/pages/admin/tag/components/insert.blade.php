<div x-cloak x-data="{ open: false, tagsInput: '' }">
    <button @click="open = true" class="btn btn-primary my-3">
        <i class="fas fa-add"></i> Add Data
    </button>

    <div x-show="open" @click.away="open = false">
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
                            <input type="text" class="form-control" placeholder="Enter tags (pisahkan dengan koma)"
                                name="tagsInput" x-model="tagsInput">
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
