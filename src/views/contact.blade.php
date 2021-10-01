@extends('vendor.contact.layouts.app')

@section('content')

    <div class="contact-form__wrapper">
        @if(Session::has('successed'))
            <div class="status">
                <h2 class="status__text">{{Session::get('successed')}}</h2>
            </div>
        @endif

        <h1>Contact Us</h1>

        <form class="contact-form" action={{'contact'}} method="post">
            @csrf
            <div class="contact-form__wrapper">

                <div class="contact-form__item">
                    <label for="name">Name <span>*</span></label>
                    <input type="text" id="name" class="{{ $errors->has('name') ? 'error' : ''}}" name="name"
                           placeholder="Name" value="{{ old('name') }}">
                </div>

                @error('name')
                <span>{{$message}}</span>
                @enderror
            </div>

            <div class="contact-form__wrapper">
                <div class="contact-form__item">
                    <label for="name">Email <span>*</span></label>
                    <input type="text" id="emal" class="{{ $errors->has('name') ? 'error' : ''}}" name="email"
                           placeholder="Email" value="{{ old('email') }}">
                </div>

                @error('email')
                <span>{{$message}}</span>
                @enderror
            </div>

            <div class="contact-form__wrapper">
                <div class="contact-form__item">
                    <label for="contact">Contact No <span>*</span></label>
                    <input type="text" id="contact" class="{{ $errors->has('name') ? 'error' : ''}}"
                           name="contact_number" placeholder="Contact number"
                           value="{{ old('contact_number') }}">
                </div>

                @error('contact_number')
                <span>{{$message}}</span>
                @enderror
            </div>

            <div class="contact-form__wrapper">

                <div class="contact-form__item">

                    <label for="description">Description <span>*</span></label>
                    <textarea id="description" class="{{ $errors->has('name') ? 'error' : ''}}" name="description" rows="10"
                              placeholder="Description">{{ old('description') }}</textarea>
                </div>

                @error('description')
                <span>{{$message}}</span>
                @enderror
            </div>

            <div class="contact-form__item">
                <input class="contact-form__button" type="submit">
            </div>
        </form>
    </div>

@endsection


