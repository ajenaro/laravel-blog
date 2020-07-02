@extends('admin.layout')

@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Crear Post</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                    <li class="breadcrumb-item active">Crear</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')

    @if($post->photos->count())
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Imágenes</h5>
                <div class="card-body">
                    <div class="row">
                        @foreach($post->photos as $photo)
                            <div class="col-md-2">
                                <form method="POST" action="{{ route('admin.photo.destroy', $photo) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-xs" style="position: absolute; margin: 5px;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <img class="img-fluid" src="{{ url('/storage/' . $photo->url) }}">
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text"
                                   name="title"
                                   value="{{ old('title', $post->title) }}"
                                   class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                   placeholder="Título de la publicación">
                            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            <label for="body">Contenido</label>
                            <textarea name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" placeholder="Contenido de la publicación">{{ old('body', $post->body) }}</textarea>
                            {!! $errors->first('body', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            <label for="body">iframe (Ancho: 100% Alto: 480)</label>
                            <textarea rows="2" name="iframe" class="form-control textarea" placeholder="Contenido embebido (vídeo o audio)">{{ old('iframe', $post->iframe) }}</textarea>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="published_at">Fecha de publicación</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                                </div>
                                <input type="text"
                                       name="published_at"
                                       value="{{ old('published_at', $post->published_at ? $post->published_at->format('d/m/Y') : '') }}"
                                       class="form-control"
                                       id="published_at">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Categorías</label>
                            <select name="category_id" class="form-control select2bs4 {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                                <option value="">Selecciona</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            <label for="tags">Etiquetas</label>
                            <select name="tags[]" class="select2bs4" multiple="multiple" data-placeholder="Selecciona una o varias etiquetas" style="width: 100%;">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="excerpt">Extracto</label>
                            <textarea name="excerpt" class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" placeholder="Extracto de la publicación">{{ old('excerpt', $post->excerpt) }}</textarea>
                            {!! $errors->first('excerpt', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            <div class="dropzone"></div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Guardar Publicación</button>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </form>



@endsection

@push('styles')
    <!-- date picker -->
    <link rel="stylesheet" href="/adminlte/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Dropzone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.css">
@endpush

@push('scripts')
    <!-- date-picker -->
    <script src="/adminlte/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="/adminlte/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <!-- Summernote -->
    <script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- include summernote lang -->
    <script src="/adminlte/plugins/summernote/lang/summernote-es-ES.js"></script>
    <!-- Select2 -->
    <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
    <!-- Dropzone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
    <script>
        //Date range picker
        $('#published_at').datepicker({
            language: 'es',
            todayHighlight: true,
            format: 'dd/mm/yyyy',
            autoclose: true,
        })

        $(function () {
            // Summernote
            $('textarea[name="body"]').summernote({
                lang: 'es-ES',
                height: 250
            })
        })

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            tags: true
        })

        let myDropzone = new Dropzone('.dropzone', {
            url: '/admin/posts/{{ $post->url }}/photos',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra las imágenes aquí para subirlas',
            paramName: 'photo',
            acceptedFiles: 'image/*',
            maxFilesize: 2
        });

        myDropzone.on('error', function(file, res) {

            let msg = res.errors.photo[0];
            $('.dz-error-message:last > span').text(msg);
        });

        Dropzone.autoDiscover = false;

    </script>
@endpush
