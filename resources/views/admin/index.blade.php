@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Latest Categories</div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" width="60">№</th>
                                <th scope="col" width="60">Name</th>
                                <th scope="col" width="200">Created By</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->user->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="card mt-4">
                    <div class="card-header">Latest News</div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" width="60">№</th>
                                <th scope="col" width="60">Title</th>
                                <th scope="col" width="200">Created By</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($news as $newsItem)
                                <tr>
                                    <td>{{ $newsItem->id }}</td>
                                    <td>{{ $newsItem->title }}</td>
                                    <td>{{ $newsItem->user->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Latest Article</div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" width="60">№</th>
                                <th scope="col" width="60">Title</th>
                                <th scope="col" width="200">Created By</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{ $article->id }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->user->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Latest Information</div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" width="60">№</th>
                                <th scope="col" width="60">Title</th>
                                <th scope="col" width="200">Created By</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($information as $info)
                                <tr>
                                    <td>{{ $info->id }}</td>
                                    <td>{{ $info->title }}</td>
                                    <td>{{ $info->user->name }}</td>
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
