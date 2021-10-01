@extends('vendor.contact.layouts.app')

@section('header')
    <h1 class="text-center">Replies</h1>
    <div class="meta-data__wrapper">
        <div>
        </div>
    </div>
@endsection

@section('content')
        <table id="customers">
            <tr>
                <th>Id</th>
                <th>No</th>
                <th>Subject</th>
                <th>Message</th>
                <th class="date">Replied</th>

            </tr>
            @foreach($replies as $key => $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$key + 1}}</td>
                    <td>{{$reply->subject}}</td>
                    <td class="description">
                        <p>{{$reply->message}}</p>
                    </td>
                    <td class="date">{{$reply->created_at}}</td>
                </tr>
            @endforeach
        </table>
@endsection
