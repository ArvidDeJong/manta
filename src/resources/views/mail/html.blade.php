@extends('emails.layouts.html')

@section('title', $subject)

@section('content')
    {!! $content !!}
@endsection
