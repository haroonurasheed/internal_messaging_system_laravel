<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application outbox.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function compose(Request $request)
    {
        $users = DB::table('users as u')->get();
        if ($request->isMethod('post'))
        {
            $to     =   $request->get('user');
            $msg    =   $request->get('message');
            DB::table('messages')->insert([
                ['to'  =>  $to,'from' =>  Auth::id(),'message'  =>  $msg,'isactive' =>  1,'read' => 0, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]
            ]);

            return response()->json(array('status' => 'success' , 'msg' => 'Your message has been sent!'));
        }

        return view('mailing/compose',['users'=>$users]);
    }

    /**
     * Show the application inbox.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function inbox(Request $request)
    {
        $messages = DB::table('messages as m')
            ->select('m.*','users.id AS userID','users.email')
            ->join('users', 'm.from', '=', 'users.id')
            ->where('m.to' ,Auth::id() )
            ->get();
        return view('mailing/inbox',['messages'=>$messages]);
    }

    /**
     * Show the application outbox.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function outbox(Request $request)
    {
        $messages = DB::table('messages as m')
            ->select('m.*','users.id AS userID','users.email')
            ->join('users', 'm.to', '=', 'users.id')
            ->where('m.from' ,Auth::id() )
            ->get();
        return view('mailing/outbox',['messages'=>$messages]);
    }

    /**
     * Show the application msgdetail.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function msgdetail(Request $request)
    {
        $msgId      =   $request->route('id');
        $message    = DB::table('messages as m')
            ->select('m.*','users.id AS userID','users.email')
            ->join('users', 'm.from', '=', 'users.id')
            ->where('m.id' ,$msgId )->get();

        if(isset($message[0]))
        {
            $status = 'success';
            $data = ['read' => 1];
            DB::table('messages')->where('id',$msgId)->update($data);
        }
        else{$status = 'fail';}
        return view('mailing/msgdetail',['messages'=>$message, 'status' => $status]);
    }

    /**
     * Show the application msgsentdetail.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function msgsentdetail(Request $request)
    {
        $msgId      =   $request->route('id');
        $message    = DB::table('messages as m')
            ->select('m.*','users.id AS userID','users.email')
            ->join('users', 'm.to', '=', 'users.id')
            ->where('m.id' ,$msgId )->get();

        if(isset($message[0]))
        { $status = 'success';
            $data = ['read' => 1];
            DB::table('messages')->where('id',$msgId)->update($data);
        }
        else{$status = 'fail';}

        return view('mailing/msgsentdetail',['messages'=>$message, 'status' => $status]);
    }

}
