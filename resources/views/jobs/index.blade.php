
@extends('app.layout')

@section('content')
    <table>
    <thead>
        <tr>
            <th style="border: 1px solid black">Title</th>
            <th style="border: 1px solid black">Country-City</th>
            <th style="border: 1px solid black">Profile</th>
            <th style="border: 1px solid black">Post Date</th>
            <th style="border: 1px solid black">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
            <tr>
                <td style="border: 1px solid black"><a href="jobs/{{$item['id']}}">{{ $item['title'] }}</a></td>
                <td style="border: 1px solid black">{{ $item['country']."-".$item['city'] }}</td>
                <td style="border: 1px solid black">{{ $item['profile'] }}</td>
                <td style="border: 1px solid black">{{ $item['posted_date'] }}</td>
                <td style="border: 1px solid black">
                <a style="padding:0 4px" href={{$item['link']}}> Apply </a><a style="padding:0 4px" href="jobs/{{$item['id']}}"> Details </a>
                <a class="location-link" style="padding:0 4px" data-city='{{$item['city']}}' data-country='{{$item['country']}}' href='#'>Location</a>
                </td>
            </tr>
        @empty
            <p>No data</p>
        @endforelse
    </tbody>
</table>

@endsection