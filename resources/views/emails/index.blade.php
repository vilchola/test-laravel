@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}  
                </div>
            @endif
            <h1 class="display-3">Emails</h1>
            <div>
                <a style="margin: 10px;" href="{{ route('emails.create')}}" class="btn btn-primary">New email</a>
            </div> 
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Subject</td>
                        <td>Receiver</td>
                        <td>Message</td>
                        <td>User</td>
                        <td>Sended</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emails as $email)
                    <tr>
                        <td>{{ $email->id }}</td>
                        <td>{{ $email->subject }}</td>
                        <td>{{ $email->receiver }}</td>
                        <td>{{ $email->message }}</td>
                        <td>{{ $email->user->name }}</td>
                        <td>{{ $email->sended }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            {{ $emails->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
