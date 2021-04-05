@extends('layouts.app')

@section('stylesheet')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Information Article - edit</div>

                    <div class="card-body">
                        {!! Form::open(['route' => ['information.update', $information->id], 'method' => 'put']) !!}
                        <div class="form-group @if($errors->has('thumbnail')) has-error @endif">
                            {!! Form::label('Thumbnail') !!}
                            {!! Form::text('thumbnail', $information->thumbnail, ['class' => 'form-control', 'placeholder' => 'Thumbnail']) !!}
                            @if ($errors->has('thumbnail'))
                                <span class="help-block">{!! $errors->first('thumbnail') !!}</span>@endif
                        </div>

                        <div class="form-group @if($errors->has('title')) has-error @endif">
                            {!! Form::label('Title') !!}
                            {!! Form::text('title', $information->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                            @if ($errors->has('title'))
                                <span class="help-block">{!! $errors->first('title') !!}</span>@endif
                        </div>

                        <div class="form-group @if($errors->has('short_describe')) has-error @endif">
                            {!! Form::label('Sub Title') !!}
                            {!! Form::text('short_describe', $information->short_describe, ['class' => 'form-control', 'placeholder' => 'Sub Title']) !!}
                            @if ($errors->has('short_describe'))
                                <span class="help-block">{!! $errors->first('short_describe') !!}</span>@endif
                        </div>

                        <div class="form-group @if($errors->has('post_content')) has-error @endif">
                            {!! Form::label('Content') !!}
                            {!! Form::textarea('post_content', $information->post_content, ['class' => 'form-control', 'placeholder' => 'Content']) !!}
                            @if ($errors->has('post_content'))
                                <span class="help-block">{!! $errors->first('post_content') !!}</span>@endif
                        </div>

                        <div class="form-group @if($errors->has('category_id')) has-error @endif">
                            {!! Form::label('ApiCategory') !!}
                            {!! Form::select('category_id[]', $categories, null, ['class' => 'form-control', 'id' => 'category_id', 'multiple' => 'multiple']) !!}
                            @if ($errors->has('category_id'))
                                <span class="help-block">{!! $errors->first('category_id') !!}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="position">Position</label>
                            <input class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" type="number" name="position" id="position" value="{{ old('position', $information->position) }}" step="1">
                            @if ($errors->has('position'))
                                <span class="help-block">{!! $errors->first('position') !!}</span>@endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('Publish') !!}
                            {!! Form::select('is_published', [1 => 'Publish', 0 => 'Draft'], null, ['class' => 'form-control']) !!}
                        </div>

                        {!! Form::submit('Update',['class' => 'btn btn-sm btn-warning']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            CKEDITOR.replace('post_content');
            $('#category_id').select2({
                placeholder: "Select categories"
            }).val({!! json_encode($information->categories()->allRelatedIds()) !!}).trigger('change');
        });
    </script>
@endsection