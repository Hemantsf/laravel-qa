@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                
                <div class="card-header">
                <div class="d-flex align-items-center">
                <h2>All Questions</h2>
                <div class="ml-auto">
                <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask Question</a>                
                </div>
                </div>                
                </div>

                <div class="card-body">
                @include ('layouts._messages')

                @foreach($questions as  $row)
                <div class="media">
                <div class="d-flex flex-column counters">
                <div class="vote">
                <strong> {{  $row->votes }}</strong> {{ str_plural ('vote',  $row->votes) }}
                </div>
                <div class="status {{  $row->status }}">
                <strong> {{  $row->answers }}</strong> {{ str_plural ('answer',  $row->answers) }}
                </div>
                <div class="view">
                {{  $row->views ." " . str_plural ('view',  $row->views) }}
                </div>
                </div>

                <div class="media-body">
                <div class="d-flex align-items-center">                
                <h3 class="mt-0"><a href ="{{ $row->url }}">{{ $row->title }}</h3></a>
                <div class="ml-auto">
                @if( Auth::user()->can('update-question',$row )) 
                <a href="{{ route('questions.edit', $row->id )}}"  class="btn btn-sm btn-outline-info">Edit</a>
                @endif

                @if( Auth::user()->can('delete-question',$row ))
                <form class="form-delete" action ="{{ route('questions.destroy', $row->id ) }}" method="post">
                @method('DELETE')
                @csrf
                  <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you Sure..?')">Delete</button>
                </form>
                @endif
                </div>
                </div>
                
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
