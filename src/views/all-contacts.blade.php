{{--<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href={{asset('vendor/lakm/contact/css/style.css')}}>

</head>
<body>
<h1 class="text-center">All Contact Us Inqueries</h1>
<div class="meta-data__wrapper">
    <div></div>
</div>--}}

@extends('layouts.app')

@section('header')
    <h1 class="text-center">All Contact Us Inqueries</h1>
    <div class="meta-data__wrapper">
        <div></div>
    </div
@endsection

@section('content')
    <table id="customers">

        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact No</th>
            <th>Created At</th>
            <th>Num of Inqueries</th>


        </tr>
        @foreach($contacts as $contact)
            <tr>
                <td>{{$contact->name}}</td>
                <td>{{$contact->email}}</td>
                <td>{{$contact->contact_number}}</td>
                <td>{{$contact->created_at}}</td>
                <td class="link-inqueries">
                    <a href="{{route('admins.user-contact', ['user' => $contact->email])}}" target="_blank">
                        {{$contact->num_of_inqueries}}
                    </a>
                </td>

            </tr>
        @endforeach
    </table>


@endsection

{{--
</body>
</html>--}}
