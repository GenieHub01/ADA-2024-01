@extends('layouts.app')

@section('content')
    <h1>{{ config('app.name') }} - Contact Us</h1>

    @if (session('contact'))
        <div class="flash-success">
            {{ session('contact') }}
        </div>
    @else
        <p>
            If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
        </p>

        <div class="form">
            <form id="contact-form" method="POST" action="{{ route('contact') }}">
                @csrf
                <p class="note">Fields with <span class="required">*</span> are required.</p>

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                </div>

                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}">
                </div>

                @error('subject')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="subject" maxlength="128" value="{{ old('subject') }}">
                </div>

                @error('body')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" rows="6">{{ old('body') }}</textarea>
                </div>

                @if (captcha_enabled())
                    @error('verifyCode')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <label for="verifyCode">Verify Code</label>
                        <div>
                            {!! captcha_img() !!}
                            <input type="text" name="verifyCode" id="verifyCode">
                        </div>
                        <div class="hint">Please enter the letters as they are shown in the image above.<br>Letters are not case-sensitive.</div>
                    </div>
                @endif

                <div class="row buttons">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    @endif
@endsection