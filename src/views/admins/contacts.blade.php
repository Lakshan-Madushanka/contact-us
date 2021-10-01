@extends('vendor.contact.layouts.app')

@section('header')
    @if(url()->current() == route('contactUs.inquery', count($inqueries)>0 ? $inqueries->first()->id : 'null'))
    <h1 class="text-center">Related Inqueries</h1>
    @elseif(count($inqueries)>0)
        <h1 class="text-center">All Inqueries for email : <span class="info"> {{$inqueries->first()->email}}</span></h1>
    @else
        <h1 class="text-center">All Inquery</h1>
    @endif
    <div class="meta-data__wrapper">
        <div>
        </div>
    </div>
    <button class="delete-btn" disabled="true">Delete Selected</button>

@endsection

@section('content')
    <table id="customers">
        <tr>
            <th>No</th>
            <th><input class="select-all" type="checkbox" name="delete"/></th>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact No</th>
            <th>Description</th>
            <th class="date">Created At</th>
            <th class="reply">Reply</th>
            <th>Delete</th>
        </tr>

        @if(count($inqueries) === 0)
            <h2 class="error__text search__error">Noting Found</h2>
        @else
            @foreach($inqueries as $key => $inquery)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>
                        <input class="select-box" type="checkbox" value='{{$inquery->id}}' name="delete[]"/>
                    </td>
                    <td>{{$inquery->id}}</td>
                    <td>{{$inquery->name}}</td>
                    <td>{{$inquery->email}}</td>
                    <td>{{$inquery->contact_number}}</td>
                    {{-- @if(strlen($inquery->description) > 250)
                         <td>{{substr($inquery->description ,0, 50 )}}...</td>
                     @else
                         <td>{{$inquery->description }}</td>
                     @endif--}}
                    <td class="description">
                        <p>{{$inquery->description }}</p>
                    </td>

                    <td class="date">{{$inquery->created_at}}</td>
                    &nbsp;&nbsp;
                    @if($inquery->replies_count > 0)

                        <td>
                            <a href="{{route('contactUs.admins.reply', ['contact' => $inquery->id])}}">reply</a>&nbsp;
                            (<a href="{{route('contactUs.admins.getReply', $inquery->id)}}">{{$inquery->replies_count}}</a>)
                        </td>

                    @else
                        <td class="no_reply">
                            <a href="{{route('contactUs.admins.reply', ['contact' => $inquery->id])}}">
                                reply
                            </a> &nbsp;
                            <span>(0)</span>
                            @endif
                        </td>
                        <td>
                            <form method="post"
                                  action="{{route('contactUs.deleteContactById', ['contact' => $inquery->id])}}">
                                @csrf
                                @method('delete')
                                <input class="delete-row" type="submit" value="delete"/>
                            </form>
                        </td>
                </tr>
            @endforeach
        @endif
    </table>
@endsection

@section('script')
    <script>
        deleteButton.addEventListener('click', () => {
            deleteSelected("{{route('contactUs.deleteManyContactsById')}}")
        })
    </script>
@endsection