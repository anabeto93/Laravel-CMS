@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Category - List
                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary float-right">Add New</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" width="60">#</th>
                                <th scope="col">Name</th>
                                <th scope="col" width="200">Created By</th>
                                <th scope="col" width="150">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td> {{ $category->id }}</td>
                                <td> {{ $category->name }}</td>
                                <td> {{ $category->user->name }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    {!! Form::open(['route' => ['categories.edit', $category->id,], 'method' => 'delete', 'style' => 'display:inline',]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
