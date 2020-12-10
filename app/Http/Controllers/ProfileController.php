<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use DB;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::with('role' , 'profile')->paginate(3);
        //dd($users->all());
        
        return view ('admin.profiles.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        //dd($request->all());
        if($request->has('thumbnail')){
            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
            $path = $request->thumbnail->storeAs('images/profile', $name, 'public');
        }else{
            $path = "profile.png";
        }
        if($request->password1==$request->password2)
        {
        $user = User :: create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        }else{
            return back()->with('message', "Password dont match");
        }
        if ($user)
        {
            $profile = Profile :: create([
                'name' => $request->name,
                'user_id' => $user->id,
                'address' => $request->address,
                'phone' => $request->phone,
                'thumbnail' => $path,
                
            ]);    
        }
        return back()->with('message',"added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('profile')->where('id','=', $id)->first();
        //dd($user);
        return view('admin.profiles.create' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //dd($request);
        //dd($profile);
        if($request->has('thumbnail')){
            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
            $path = $request->thumbnail->storeAs('images/profile', $name, 'public');
        }else
        {
            $path = $profile->thumbnail;
        }
        $user = User::with('profile')->where('id','=', $profile->user_id)->first();
        $user->email = $request->email;
        if ($request->has('password1'))
        {
            if($request->password1==$request->password2)
            {
                $user->password = bcrypt($request->password1);
            }
        }
        else
        {
            $user->password = $user->password;
        }
        $user->save();
        $profile->name = $request->name;
        $profile->address = $request->address;
        $profile->phone = $request->phone;
        $profile->thumbnail = $path;
        $profile->save();

        return back()->with('message', "Updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //dd($profile);
        $profile->delete();
        DB::table('users')->where('id','=',$profile->user_id)->delete();
        return redirect()->route('admin.profile.index');
    }
}
