<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Session;
Use Illuminate\Support\Facades\Mail;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('User.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required',
            'email' => 'required|email'
        ]);
        $password           = str_random(6);
        $data               = $request->all();
        $data['password']   = bcrypt($password);
        $data['is_verified']= 1;

        $member = User::create($data);
        $member->sendVerification();

        //SetRole
        $memberRole         = Role::where('name','member')->first();
        $member->attachRole($memberRole);

        //sendMail
        Mail::send('auth.emails.invite',compact('member','password'), function ($m) use ($member){
            $m->to($member->email, $member->name)->subject('Anda Telah di Daftarkan oleh Admin Kami:)');
        });
        return redirect()->route('member.index')->with('alert-success', 'Berhasil menambahkan member '.$data['email'].' dengan Password '.$password);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        User::destroy($id);
        return redirect()->back()->with('alert-danger','Berhasil Menghapus Data!');

    }
}
