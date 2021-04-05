@extends('layouts.app')

@section('stylesheet')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Create News </div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'news.store']) !!}
                        <div class="form-group @if($errors->has('thumbnail')) has-error @endif">
                            {!! Form::label('Thumbnail') !!}
                            {!! Form::text('thumbnail', null, ['class' => 'form-control', 'placeholder' => 'Thumbnail']) !!}
                            @if ($errors->has('thumbnail'))
                                <span class="help-block">{!! $errors->first('thumbnail') !!}</span>@endif
                        </div>

                        <div class="form-group @if($errors->has('title')) has-error @endif">
                            {!! Form::label('Title') !!}
                            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                            @if ($errors->has('title'))
                                <span class="help-block">{!! $errors->first('title') !!}</span>@endif
                        </div>

                        <div class="form-group @if($errors->has('short_describe')) has-error @endif">
                            {!! Form::label('Sub Title') !!}
                            {!! Form::text('short_describe', null, ['class' => 'form-control', 'placeholder' => 'Sub Title']) !!}
                            @if ($errors->has('short_describe'))
                                <span class="help-block">{!! $errors->first('short_describe') !!}</span>@endif
                        </div>

                        <div class="form-group @if($errors->has('post_content')) has-error @endif">
                            {!! Form::label('Details') !!}
                            {!! Form::textarea('post_content', null, ['class' => 'form-control', 'placeholder' => 'Details']) !!}
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
                            <input class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" type="number" name="position" id="position" value="{{ old('position', '') }}" step="1">
                            @if($errors->has('position'))
                                <span class="help-block">{!! $errors->first('position') !!}</span>@endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('Publish') !!}
                            {!! Form::select('is_published', [1 => 'Publish', 0 => 'Draft'], null, ['class' => 'form-control']) !!}
                        </div>

                        {!! Form::submit('Create',['class' => 'btn btn-sm btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
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
            });
        });
    </script>
@endsection