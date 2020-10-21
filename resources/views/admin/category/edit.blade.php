@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Category - Edit
                    </div>

                    <div class="card-body">
                        {!! Form::open(['route' => ['categories.update', $category->id],]) !!}
                        {{ method_field('PUT') }}
                        <div class="form-group @if($errors->has('thumbnail')) has-error @endif">
                            {!! Form::label('Thumbnail') !!}
                            {!! Form::text('thumbnail', $category->thumbnail, ['class' => 'form-control', 'placeholder' => 'Thumbnail',]) !!}
                            @if($errors->has('thumbnail')) 
                                <span class="help-block text-danger">
                                    {!! $errors->first('thumbnail') !!}
                                </span>
                            @endif
                        </div>
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            {!! Form::label('Name') !!}
                            {!! Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'Name',]) !!}
                            @if($errors->has('name')) 
                                <span class="help-block text-danger">
                                    {!! $errors->first('name') !!}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('Publish') !!}
                            {!! Form::select('is_published', [1 => 'Publish', 0 => 'Draft'], null, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
