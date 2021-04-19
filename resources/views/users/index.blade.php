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
            <h1 class="display-3">Users</h1>
            <div>
                <form action="{{ route('users.search') }}" method="get">
                    @csrf
                    @method('GET')
                    <input type="text" id="search" name="search" class="col-md-4 col-form-label text-md-right" value="{{ old('search') }}" autocomplete="search">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Search') }}
                    </button>
                    <a href="{{ route('users.create')}}" class="btn btn-primary">New user</a>
                </form>
            </div> 
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>@sortablelink('id')</td>
                        <td>@sortablelink('email')</td>
                        <td>@sortablelink('name')</td>
                        <td>@sortablelink('phone')</td>
                        <td>@sortablelink('document')</td>
                        <td>@sortablelink('birthdate')</td>
                        <td>Age</td>
                        <td colspan="2">Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->document }}</td>
                        <td>{{ $user->birthdate }}</td>
                        <td>{{ $user->age }}</td>
                        <td>
                            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">
                            {{ $users->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
