@php
    $indexRouteName = 'pro-bono.index';
    $showRouteName = 'pro-bono.show';
@endphp

@extends('frontend.layouts.app')

@section('title', $item->title.' | Advocated')

@section('content')
    @include('frontend.partials.content-show')
@endsection
