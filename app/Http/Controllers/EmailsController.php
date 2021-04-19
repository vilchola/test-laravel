<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class EmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $emails = Email::where('user_id', $request->user()->id)->paginate(env('RECORDS_PER_PAGE'));
        return view('emails.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emails.create');
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
            'subject' => ['required', 'string', 'max:255'],
            'receiver' => ['required', 'email', 'max:250'],
            'message' => ['required', 'string', 'max:1024'],
        ]);

        $user = new Email([
            'subject' => $request->get('subject'),
            'receiver' => $request->get('receiver'),
            'message' => $request->get('message'),
            'sended' => false,
            'user_id' => $request->user()->id,
        ]);
        $user->save();
        return redirect('/emails')->with('success', 'Email saved!');
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

        $emails = Email::with(['user' => function($query) use ($search) {
                $query->orWhere('email', 'like', '%'.$search.'%');
            }])
            ->search($search)
            ->orderBy('created_at', 'desc')
            ->paginate(env('RECORDS_PER_PAGE'));
        
        return response()->json($emails, 200);
    }
}
