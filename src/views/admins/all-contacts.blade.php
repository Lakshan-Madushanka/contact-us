@extends('vendor.contact.layouts.app')

@section('header')
    <div class="status">
        <h2 class="status__text"></h2>
        <h2 class="error__text"></h2>

    </div>
    <h1 class="text-center">All Contact Us Inqueries</h1>
    <div class="filters">
        <form class="filter-form">
            <h4 class="filter-form__header">Filters</h4>
            <label>
                <input class="ans" value="answered" type="radio" name="filter"/>All Replied
            </label>
            <label>
                <input class="not_ans" type="radio" value="not_answered" name="filter"/>Not Replied
            </label>
            <label>
                <input class="all" type="radio" value="all_answered" name="filter"/>All
            </label>

        </form>

        <form class="search-form" method="get" action="{{route('contactUs.admins.contacts-search')}}">
            <input type="search" class="search" name="search" placeholder="search inquery">
            <button class="search-btn">Search</button>
        </form>

        <form class="orderBy-form">
            <h4 class="filter-form__header">Sort By</h4>
            <label>
                <input class="date_asc" type="radio" value="date_asc" name="filter"/>Date Asc
            </label>
            <label>
                <input class="last_replied" type="radio" value="last_replied" name="filter"/>Last Replied
            </label>
        </form>
    </div>
    <button class="delete-btn" disabled="true">Delete Selected</button>

@endsection

@section('content')
    <table id="customers">
        <tr>
            <th>No</th>
            <th><input class="select-all" type="checkbox" name="delete"/></th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact No</th>
            <th>Num of Inqueries</th>
            <th>Replies</th>
            <th>Not Answered</th>
            <th>Last Inquery</th>
            <th class="date">Delete</th>

        </tr>
        @if(count($contacts) === 0)
            <h2 class="error__text search__error">Noting Found</h2>
        @else
            @php
                $counter = 0;
            @endphp
            @foreach($contacts as $contact)
                <tr>
                    <td>
                        {{++$counter}}
                    </td>

                    <td>
                        <input class="select-box" type="checkbox" value='{{$contact->id}}' name="delete[]"/>
                    </td>
                    <td>{{$contact->name}}</td>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->contact_number}}</td>
                    <td class="link-inqueries">
                        <a href="{{route('contactUs.admins.user-contact', ['user' => $contact->email])}}"
                           target="_blank">
                            {{$contact->num_of_inqueries}}
                        </a>
                    </td>
                    <td>{{$contact->replies_count}}</td>
                    <td>{{$contact->not_answered}}</td>
                    <td class="date">{{$contact->created_at}}</td>
                    <td>
                        <form method="post"
                              action="{{route('contactUs.deleteContactByMail', ['email' => $contact->email])}}">
                            @csrf
                            @method('delete')
                            <input type="submit" class="delete-row" value="delete"/>
                        </form>
                    </td>

                </tr>
            @endforeach
        @endif
    </table>
@endsection

@section('script')

    <script>
        let selectBoxElm = document.querySelectorAll('.select-box');

        let dataTable = document.querySelector("#customers")
        let filterElements = document.querySelectorAll(".filters input[name = 'filter']")

        const getTable = function () {
            searchErrorElement.textContent = '';

            let url = new URL("{{route('contactUs.admins.contacts-filter')}}");
            let params = url.searchParams;
            let route = "{{route('contactUs.admins.contacts-filter')}}";
            let filters = []

            for (let i = 0; i < filterElements.length; i++) {
                if (filterElements[i].checked) {
                    params.append(filterElements[i].value, true);
                }
            }
            route = url.href;

            let table = `<tr>
                <th>No</No>
                <th>
                  <input class="select-all" type="checkbox" name="delete"/>
                </th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Num of Inqueries</th>
                <th>Replies</th>
                <th>Not Answered</th>
                <th>Last Inquery</th>
                <th>Delete</th>


            </tr>`;

            fetch(route, {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }).then(data => data.json()).then(data => {
                    if (!Array.isArray(data)) {
                        tempData = []
                        tempData.push(data[1])

                        data = tempData
                    }

                    let counter = 0
                    data.forEach((item) => {

                        let viewRoute = "{{route('contactUs.admins.user-contact', ':id')}}/";
                        viewRoute = viewRoute.replace(':id', item['email'])

                        let deleteRoute = "{{route('contactUs.deleteContactByMail', ':id')}}/"
                        deleteRoute = deleteRoute.replace(':id', item['email'])

                        let csrf = '@csrf';
                        let method = '@method('delete')';
                        table += `<tr>
                                    <td>${++counter}</td>
                                    <td>
                                          <input class="select-box" type="checkbox" value="${item['id']}" name="deletea[]"/>
                                     </td>
                                      <td> ${item['name']} </td>
                                      <td> ${item['email']} </td>
                                      <td> ${item['contact_number']} </td>
                                      <td class="link-inqueries">
                                        <a href = "${viewRoute}" target="_blank">${item['num_of_inqueries']} </a>
                                      </td>
                                      <td> ${item['replies_count']} </td>
                                      <td> ${item['not_answered']} </td>
                                      <td> ${item['created_at']} </td>
                                      <td>
                                      <form method="post" action="${deleteRoute}">
                                             ${csrf}
                                             ${method}
                                       <input type="submit" class="delete-row" value="delete"/>
                                     </form>
                                    </td>

                                  </tr>`
                    })
                }
            ).then(() => {
                    dataTable.innerHTML = table
                    deleteButtonDisableStyle();
                    let selectAllButton = document.querySelector('.select-all');
                    selectBoxElm = document.querySelectorAll('.select-box');
                    let deleteButton = document.querySelector('.delete-btn');


                    deleteButtonEnable(selectBoxElm)
                    deleteButton.addEventListener('click', () => {
                        deleteSelected("{{route('contactUs.deleteManyContactsByMail')}}", selectBoxElm)
                    })
                }
            ).catch(err => {
                console.log(err)
                deleteButton.textContent = 'Delete Selected'
                errorElement.textContent = "Error Occured !"
            })
        }

        for (let i = 0; i < filterElements.length; i++) {
            filterElements[i].addEventListener('click', getTable)
        }

        deleteButton.addEventListener('click', () => {
            deleteSelected("{{route('contactUs.deleteManyContactsByMail')}}", selectBoxElm)
        })

    </script>

@endsection


