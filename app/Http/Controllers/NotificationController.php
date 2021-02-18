<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::where('donation_id',null)->with('user')->get();

        return view('notifications.index',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->userType == 'donator'){
            $users = User::where('type',2)->get();
            if(User::where('type',2)->exists()){
                foreach($users as $user){
                    $notification = new Notification();
                    $notification->title = $request->title;
                    $notification->description = $request->description;
                    $notification->user_id = $user->id;
                    $notification->save();
                }
            }
        }
        else if($request->userType == 'rider'){
            $users = User::where('type',1)->get();
            if(User::where('type',1)->exists()){
                foreach($users as $user){
                    $notification = new Notification();
                    $notification->title = $request->title;
                    $notification->description = $request->description;
                    $notification->user_id = $user->id;
                    $notification->save();
                }
            }
        }
        else{
            if(User::where('type','!=',null)->exists()){
                $users = User::where('type','!=',null)->get();
                foreach($users as $user){
                    $notification = new Notification();
                    $notification->title = $request->title;
                    $notification->description = $request->description;
                    $notification->user_id = $user->id;
                    $notification->save();
                }
            }
        }

        return redirect()->route('notifications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Notification::where('id',$id)->delete();

        return redirect()->route('notifications.index');
    }

    public function userNotification()
    {
        $users = User::where('type','!=',null)->get();
        return view('notifications.user-notification',compact('users'));
    }

    public function userNotificationStore(Request $request)
    {
        $notification = new Notification();
        $notification->title = $request->title;
        $notification->description = $request->description;
        $notification->user_id = $request->id;
        $notification->save();
    }
}
