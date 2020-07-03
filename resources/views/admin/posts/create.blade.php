<!-- Modal -->
<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST" action="{{ route('admin.posts.store', '#create-modal') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">Post Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title') }}"
                               class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                               placeholder="Título de la publicación">
                        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save Post</button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    let postModal = $('#postModal');

    if (window.location.hash === '#create-modal') {
        postModal.modal('show');
    }

    postModal.on('hide.bs.modal', function(e) {
        window.location.hash = '#';
    });

    postModal.on('shown.bs.modal', function(e) {
        $('#title').focus();
        window.location.hash = '#create-modal';
    });
</script>
@endpush
