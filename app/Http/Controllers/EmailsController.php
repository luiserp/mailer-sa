<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Http\Requests\EmailRequest;
use App\Models\Emails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmailsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $order = $request->get('order', 'id');

        if ($user->is_admin) {
            $emails = DB::table('emails')->join('users', 'users.id', '=', 'emails.user_id')
                ->orderBy("emails." . $order)
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('topic', 'like', '%' . $search . '%')
                        ->OrWhere('addressee', 'like', '%' . $search . '%');
                })
                ->select('emails.*', 'users.email')
                ->paginate(5);
        } else {
            $emails = DB::table('emails')->where('user_id', '=', $user->id)
                ->join('users', 'users.id', '=', 'emails.user_id')
                ->orderBy($order)
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('topic', 'like', '%' . $search . '%')
                        ->OrWhere('addressee', 'like', '%' . $search . '%');
                })
                ->select('emails.*', 'users.email')
                ->paginate(5);
        }
        // dd($emails);

        return Inertia::render(
            'Emails/Index',
            [
                'emails' => $emails
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Emails/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\EmailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $data = array_merge($validated, [
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        Emails::create($data);
        return redirect()->route('emails.index')->with('message', 'The Email was sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emails  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Emails $email)
    {
        return Inertia::render(
            'Emails/Show',
            [
                'email' => $email
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
