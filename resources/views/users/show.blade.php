@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('My profile') }}</div>

            <div class="card-body">
                <div class="row">
                    <label for="id" class="col-md-4 text-md-right">{{ __('ID') }}:</label>

                    <div class="col-md-6">
                        <span id="id" name="id">{{ $user->id }}</span>
                    </div>
                </div>

                <div class="row">
                    <label for="name" class="col-md-4 text-md-right">{{ __('Name') }}:</label>

                    <div class="col-md-6">
                        <span id="name" name="name">{{ $user->name }}</span>
                    </div>
                </div>

                <div class="row">
                    <label for="phone" class="col-md-4 text-md-right">{{ __('Phone') }}:</label>

                    <div class="col-md-6">
                        <span id="phone" name="phone">{{ $user->phone }}</span>
                    </div>
                </div>

                <div class="row">
                    <label for="document" class="col-md-4 text-md-right">{{ __('Document') }}:</label>

                    <div class="col-md-6">
                        <span id="document" name="document">{{ $user->document }}</span>
                    </div>
                </div>

                <div class="row">
                    <label for="birthdate" class="col-md-4 text-md-right">{{ __('Birthdate') }}:</label>

                    <div class="col-md-6">
                        <span id="birthdate" name="birthdate">{{ $user->birthdate }}</span>
                    </div>
                </div>

                <div class="row">
                    <label for="age" class="col-md-4 text-md-right">{{ __('Age') }}:</label>

                    <div class="col-md-6">
                        <span id="age" name="age">{{ $user->age }}</span>
                    </div>
                </div>

                <div class="row">
                    <label for="email" class="col-md-4 text-md-right">{{ __('E-Mail Address') }}:</label>

                    <div class="col-md-6">
                        <span id="email" name="email">{{ $user->email }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
