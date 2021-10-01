@extends('vendor.contact.layouts.app')
@section('header')
    <div class="status">
        <h2 class="status__text">
            @if(session()->has('successed'))
                {{session()->get('successed')}}
            @endif
        </h2>
    </div>
    @if(count($replies) > 0)
    <h1 class="text-center">All Replies </h1>
    @else
        <h1 class="text-center error__text">Nothing Found</h1>
     @endif


        {{--    <button class="delete-btn" disabled="true">Delete Selected</button>--}}

@endsection

@section('content')
    <table id="customers">
        <tr>
            <th>No</th>
            <th><input class="select-all" type="checkbox" name="delete"/></th>
            <th>Id</th>
            <th>Subject</th>
            <th>Reply</th>
            <th>Inquery</th>
            <th class="date">Replied At</th>
{{--            <th>Delete</th>--}}

        </tr>
        @php
            $counter = 0
        @endphp
        @foreach($replies as $reply)
            <tr>
                <td>
                    {{++$counter}}
                </td>
                <td>
                    <input class="select-box" type="checkbox" value='{{$reply->id}}' name="delete[]"/>
                </td>
                <td>{{$reply->id}}</td>
                <td>{{$reply->subject}}</td>
                <td>{{$reply->message}}</td>
               <td><a href="{{route('contactUs.inquery', $reply->contact_id)}}">{{$reply->contact_id}}</a></td>
                <td class="date">{{$reply->created_at}}</td>
              {{--  <td>
                    <form method="post" action="{{route('contactUs.replyDelete', $reply->id)}}">
                        @csrf
                        @method('delete')
                        <input type="submit" class="delete-row" value="delete"/>
                    </form>
                </td>--}}

            </tr>
        @endforeach
    </table>
@endsection

@section('script')
    <script>
        {{--deleteButton.addEventListener('click', () => {deleteSelected("{{route('contactUs.manyReplyDelete')}}")})--}}
    </script>
@endsection


