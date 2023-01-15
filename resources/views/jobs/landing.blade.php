@extends('app.layout')

@section('content')
    <div>{{ $data['title'] }}</div>
    <div>{{ $data['country'] . '-' . $data['city'] }}</div>
    <div>{{ $data['profile'] }}</div>
    <div>{{ $data['posted_date'] }}</div>
    <a href={{ $data['link'] }}>Apply</a>
    <br>
    <a href={{ $data['link'] }}>View Location</a>
    <div>{!! $data['description'] !!}</div>
@endsection
