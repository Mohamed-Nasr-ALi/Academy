<?php
$i=1;
?>
@extends('adminlte::page')

@section('title', 'Academy')

@section('content_header')
    <h1>Posts</h1>
    @include('admin.postsnav')
@endsection

@section('content')
    <div class="form-group m-2">
        <form action="{{ route('posts.index') }}" method="get">

            <div class="row">

                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="search" value="{{ request()->search }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> search</button>
                </div>

            </div>
        </form><!-- end of form -->
    </div>
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">All POSTS :- {{$posts->total()}}</h3>
            <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->

                <a class="btn btn-success" href="{{route('posts.create')}}">ADD Post</a>

            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if(session('msg'))
                <div class="card text-white bg-success mb-3" style="max-width: 20rem;">
                    <div class="card-header">Success {{session('msg')}}</div>
                </div>
            @endif
            @if(count($posts)>0)
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-4">
                            <ul class="thumbnail">
                                <div class="panel panel-info">
                                    <div class="panel-heading text-center">{{$post->title}}</div>
                                    <div class="panel-body">
                                        <img src="{{asset('storage/thumbnails/'.$post->image)}}" alt="Lights" class="img-thumbnail" style="height: 250px !important;">
                                    </div>
                                </div>
                                <ul class="breadcrumb">
                                    <li>Category:- &nbsp; {{$post->category->name}}</li>
                                    <li>Type:- &nbsp; {{$post->type->name}}</li>
                                    <li>Semester:- &nbsp; {{$post->semester->name}}</li>
                                    <li>Status:- &nbsp;
                                        @if($post->status==0)
                                            DisActive
                                        @else
                                            Active
                                        @endif
                                    </li>
                                </ul>
                                <blockquote>
                                    <p>{{$post->info}}</p>
                                    <small>{{$post->time}} &nbsp;//<cite title="Source Title">{{$post->year}}</cite></small><br>
                                    <form action="{{route('posts.destroy',$post->id)}}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button onclick="return confirm('Are you sure you want to Remove?');" type="submit" class="btn btn-danger">Remove Post</button>
                                    </form>
                                </blockquote>
                                <div class="btn-group btn-group-justified">
                                    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info">Edit Post</a>
                                </div>
                            </ul>
                        </div>
                    @endforeach
                </div>
                @else
                    <h2>not found</h2>
            @endif
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div style="width: 100%;text-align: center">
                {{ $posts->appends(request()->query())->links() }}
            </div>
        </div>
        <!-- box-footer -->
    </div>
    <!-- /.box -->
@endsection

