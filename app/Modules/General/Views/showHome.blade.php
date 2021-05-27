@extends('layout')
@section('content')
<section class="content" id="app">

    @if (Auth::user()->isEmployee())
    <start-log :user="{{$user ?? null}}"> </start-log>
    @endif

    @if (Auth::user()->isAdmin())
    <show-logs :employees="{{$employees}}"> </show-logs>
    @endif
</section>
@section('scripts')
<script src="{{asset('/js/log.js')}}"></script>
@endsection
@endsection