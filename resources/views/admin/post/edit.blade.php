@extends('admin.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование сообщения: <b>{{ $post->title }}</b></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12 py-3">
                        <form action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group w-25">
                                <input name="title" type="text" class="form-control" aria-label="name" placeholder="Название сообщения"
                                value="{{ old('title', $post->title ?? null) }}">
                                @error('title')
                                    <div class="text-danger">Необходимо какое-то сообщение</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea id="summernote" name="content">{{ old('content', $post->content ?? null) }}</textarea>
                                @error('content')
                                    <div class="text-danger">Это поле необходимо заполнить</div>
                                @enderror
                            </div>

                            <div class="form-group w-50">
                                <label for="exampleInputFile">Добавить главное изображение</label>
                                @empty($post->main_image)
                                    @else
                                    <div class="mb-2">
                                        <img src="{{ url('storage/' . $post->main_image) }}" alt="{{ $post->main_image }}" class="w-25">
                                    </div>
                                @endempty
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="main_image">
                                        <label class="custom-file-label">Выберите изображение</label>
                                    </div>
                                    <div class="input-group-append"><span class="input-group-text">Загрузка</span></div>
                                </div>
                                @error('main_image')
                                <div class="text-danger">Необходимо добавить изображение</div>
                                @enderror
                            </div>
                            <div class="form-group w-50">
                                <label for="exampleInputFile">Добавить превью</label>
                                @empty($post->main_image)
                                    @else
                                    <div class="mb-2">
                                        <img src="{{ url('storage/' . $post->preview_image) }}" alt="{{ $post->preview_image }}" class="w-25">
                                    </div>
                                @endempty
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="preview_image">
                                        <label class="custom-file-label">Выберите изображение</label>
                                    </div>
                                    <div class="input-group-append"><span class="input-group-text">Загрузка</span></div>
                                </div>
                                @error('preview_image')
                                <div class="text-danger">Необходимо добавить изображение</div>
                                @enderror
                            </div>
                            <div class="form-group w-50">
                                <label>Выберите категорию</label>
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                {{ $category->id == $post->category_id ? ' selected': '' }}
                                        >{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Теги</label>
                                <div>
                                <select name="tag_ids[]" class="select2 w-50" data-placeholder="Выберите теги" multiple="multiple">
                                    @foreach($tags as $tag)
                                        <option {{ is_array($post->tags->pluck('id')->toArray()) && in_array($tag->id, $post->tags->pluck('id')->toArray()) ? ' selected': '' }} value="{{ $tag->id }}">{{ $tag->title }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Обновить">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.content -->

    </div>
@endsection