<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;


class MessagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        $currentUserId = Auth::user()->id;

        // All threads, ignore deleted/archived participants
        $threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
        // $threads = Thread::forUser($currentUserId)->latest('updated_at')->get();

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();

        $data_employee = DB::select('select id, nip, name, sex,harbour_master_name from vw_employee_profile ');     
        if(Auth::user()->roles->is_admin){
            return view('messenger.index', compact('threads', 'currentUserId', 'data_employee'));
        } else{
            return Redirect::to('/messages/user');
        }
    }

    public function user()
    {
        $currentUserId = Auth::user()->id;

        // All threads, ignore deleted/archived participants
        $threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
        // $threads = Thread::forUser($currentUserId)->latest('updated_at')->get();

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();

        $data_employee = DB::select('select id, nip, name, sex,harbour_master_name from vw_employee_profile ');     
        return view('messenger.user', compact('threads', 'currentUserId', 'data_employee'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        return view('messenger.show', compact('thread', 'users'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('messenger.create', compact('users'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        try{
            $rules = array(
                'subject' => 'required',
                'message' => 'required'
            );

            $validator = Validator::make(Input::all(), $rules);
            //custom validation

            // if the validator fails, redirect back to the form
            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();

                $input = input::all();

            }

            $input = Input::all();

            $thread = Thread::create(
                [
                    'subject' => $input['subject'],
                ]
            );

            // Message
            Message::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => Auth::user()->id,
                    'body'      => $input['message'],
                ]
            );

            // Sender
            Participant::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => Auth::user()->id,
                    'last_read' => new Carbon,
                ]
            );

            // Recipients
            if (Input::has('recipients')) {
                $thread->addParticipants($input['recipients']);
            }

            return redirect('messages');

        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/messages')->withErrors($message);
        }       

        return Redirect::to('/messages');
    }
    

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        $thread->activateAllParticipants();

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => Input::get('message'),
            ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipants(Input::get('recipients'));
        }

        return redirect('messages/' . $id);
    }

    public function delete($id){
        try {
            $thread = Thread::findOrFail($id);
            $participant = Participant::where('thread_id', $thread->id)->forceDelete();
            $message = Message::where('thread_id', $thread->id)->forceDelete();
            $thread->forceDelete($id);
            return redirect('messages');
        } catch (ModelNotFoundException $e) {
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', 'The thread with ID: ' . $id . ' was not found.');
            return Redirect::to('/messages')->withErrors($message);
        }

    }
}
