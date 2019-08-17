@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Questions</div>

                <div class="card-body">
                @foreach($questions as  $row)
                <div class="media">
                <div class="media-body">
                <h3 class="mt-0"><a href ="{{ $row->url }}">{{ $row->title }}</h3></a>
                <p class="lead">
                Asked by
                <a href ="{{ $row->user->url }}"> {{ $row->user->name }} </a>
                <small class="text-muted">{{ $row->created_at }} </small>
                </p>
                
                {{ str_limit($row->body,250) }}
                
                </div>
                </div>
                <hr>
                @endforeach

                {!! $questions->render() !!}
                <!-- {{ $questions-> render() }} -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
