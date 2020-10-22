@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @if(Session::has('message')) 
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ Session('message')}}
                    </div>
                @endif
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Gallery - List
                    <a href="{{ route('galleries.create') }}" class="btn btn-sm btn-primary float-right">Add New</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" width="60">#</th>
                                <th scope="col">Url</th>
                                <th scope="col" width="200">Created By</th>
                                <th scope="col" width="150">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($galleries as $gallery)
                            <tr>
                                <td> {{ $gallery->id }}</td>
                                <td> <a href="{{ asset('storage/galleries/' . $gallery->image_url) }}" style="text-decoration: none;" target="_blank">{{ asset('storage/galleries/' . $gallery->image_url) }}</a></td>
                                <td> {{ $gallery->user->name }}</td>
                                <td>
                                    <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    {!! Form::open(['route' => ['galleries.destroy', $gallery->id,], 'method' => 'delete', 'style' => 'display:inline',]) !!}
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
