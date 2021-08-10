@extends('layouts.app')

@section('content')
<h1 class="cover-heading">{{ __('Dashboard') }}</h1>
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
<p class="lead">
    <a href="#" class="btn btn-lg btn-secondary">{{ __('You are logged in!') }}</a>
</p>
@endsection