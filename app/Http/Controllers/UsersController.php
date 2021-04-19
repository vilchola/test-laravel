<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::sortable()->paginate(env('RECORDS_PER_PAGE'));
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:250', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/[0-9]/', 'regex:/[A-Z]/', 'regex:/[@$!%*#?&.]/'],
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['string', 'max:10', 'regex:/[0-9]/'],
            'document' => ['required', 'string', 'max:11'],
            'birthdate' => ['required', 'date', 'before_or_equal:-18 years'],
        ]);

        $user = new User([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'document' => $request->get('document'),
            'birthdate' => $request->get('birthdate')
        ]);
        $user->save();
        return redirect('/users')->with('success', 'User saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = $request->user();
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'password' => ['nullable', 'string', 'min:8', 'confirmed', 'regex:/[0-9]/', 'regex:/[A-Z]/', 'regex:/[@$!%*#?&.]/'],
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['string', 'max:10', 'regex:/[0-9]/'],
            'birthdate' => ['required', 'date', 'before_or_equal:-18 years'],
        ]);

        $user = User::find($id);
        if (!empty($request->get('password'))) {
            $user->password =  $request->get('password');
        }
        $user->name = $request->get('name');
        $user->phone = $request->get('phone');
        $user->birthdate = $request->get('birthdate');
        $user->save();

        return redirect('/users')->with('success', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success', 'User deleted!');
    }

    /**
     * Search the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->get('search');

        $users = User::search($search)
            ->paginate(env('RECORDS_PER_PAGE'));
        
        // return response()->json($users, 200);
        return view('users.index', compact('users'));
    }
}
