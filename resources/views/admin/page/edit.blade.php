@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Page - Edit</div>

                    <div class="card-body">
                        {!! Form::open(['route' => ['pages.update', $page->id], 'method' => 'put']) !!}
                        <div class="box-body">
                            <div class="form-group @if($errors->has('thumbnail')) has-error @endif">
                                {!! Form::label('Thumbnail') !!}
                                {!! Form::text('thumbnail', $page->thumbnail, ['class' => 'form-control', 'placeholder' => 'Thumbnail']) !!}
                                @if ($errors->has('thumbnail'))
                                    <span class="help-block">{!! $errors->first('thumbnail') !!}</span>
                                @endif
                            </div>

                            <div class="form-group @if($errors->has('title')) has-error @endif">
                                {!! Form::label('Title') !!}
                                {!! Form::text('title', $page->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                                @if ($errors->has('title'))
                                    <span class="help-block">{!! $errors->first('title') !!}</span>
                                @endif
                            </div>

                            <div class="form-group @if($errors->has('sub_title')) has-error @endif">
                                {!! Form::label('Sub Title') !!}
                                {!! Form::text('sub_title', $page->sub_title, ['class' => 'form-control', 'placeholder' => 'Sub Title']) !!}
                                @if ($errors->has('sub_title'))
                                    <span class="help-block">{!! $errors->first('sub_title') !!}</span>
                                @endif
                            </div>

                            <div class="form-group @if($errors->has('details')) has-error @endif">
                                {!! Form::label('Details') !!}
                                {!! Form::textarea('details', $page->details, ['class' => 'form-control', 'placeholder' => 'Details', 'id' => 'details']) !!}
                                @if ($errors->has('details'))
                                    <span class="help-block">{!! $errors->first('details') !!}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                {!! Form::label('Publish') !!}
                                {!! Form::select('is_published', [1 => 'Publish', 0 => 'Draft'], isset($page->is_published) ? $page->is_published : null, ['class' => 'form-control', 'id' => 'is_published']) !!}
                            </div>
                        </div>
                        <div class="box-footer">
                            {!! Form::submit('Update',['class' => 'btn btn-sm btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            CKEDITOR.replace('details');
        });

        //outside of ready cos of deferred app.js
        $.each(['#is_published'], (i, id) => {
            $(id).select2({})
        })
    </script>
@endpush

@push('styles') 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush
