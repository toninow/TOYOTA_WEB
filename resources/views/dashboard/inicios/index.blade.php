@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>INICIO</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('inicios.create') }}"> Create New Post</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


        <div class="card-deck">
            @foreach ($inicios as $inicio)
            <div class="card">
                <img class="card-img-top" src="{{ Storage::url($inicio->image) }}" height="450" width="75" alt="Card image cap" />
                <div class="card-body">
                    <h5 class="card-title">{{ $inicio->title }}</h5>
                    <p class="card-text">{{ $inicio->category }}</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"><form action="{{ route('inicios.destroy', $inicio->id) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('inicios.edit', $inicio->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form></small>
                </div>
            </div>
            @endforeach
        </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
