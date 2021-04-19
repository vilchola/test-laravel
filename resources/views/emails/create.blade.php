@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Add a email') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('emails.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="subject" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>

                        <div class="col-md-6">
                            <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required autocomplete="subject" autofocus>

                            @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="receiver" class="col-md-4 col-form-label text-md-right">{{ __('To') }}</label>

                        <div class="col-md-6">
                            <input id="receiver" type="email" class="form-control @error('receiver') is-invalid @enderror" name="receiver" value="{{ old('receiver') }}" required autocomplete="receiver">

                            @error('receiver')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                        <div class="col-md-6">
                            <textarea id="message" name="message" rows="4" class="form-control @error('message') is-invalid @enderror" required>
                                {{ old('message') }}
                            </textarea>

                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add email') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
