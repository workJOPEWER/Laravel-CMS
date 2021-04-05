@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ Session('message') }}
                    </div>
                @endif

                @if(Session::has('delete-message'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ Session('delete-message') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        News - list
                        <a href="{{ route('news.create') }}" class="btn btn-sm btn-primary float-right">Add
                            New</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" width="60">№</th>
                                <th scope="col">Title</th>
                                <th scope="col" width="200">Created By</th>
                                <th scope="col" width="120">Action</th>
                                <th scope="col" width="60">Position</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($news as $newItem)
                                <tr>
                                    <td>{{ $newItem->id }}</td>
                                    <td>{{ $newItem->title }}</td>
                                    <td>{{ $newItem->user->name }}</td>
                                    <td>{{ $newItem->position }}</td>

                                    <td>
                                        <a href="{{ route('news.edit', $newItem->id) }}"
                                           class="btn btn-sm btn-primary">Edit</a>
                                        {!! Form::open(['route' => ['news.destroy', $newItem->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $news -> links()}}
                        </div>
                        <style>
                            svg {
                                width: 25px;
                            }

                            nav .flex a {
                                display: none;
                            }
                            nav .flex span{
                                display: none;
                            }
                            nav p {
                                margin-top: 35px;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection