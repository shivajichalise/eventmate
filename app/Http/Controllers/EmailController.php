<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Notifications\ParticipationRequestNotification;
use App\Notifications\EventRemainderNotification;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class EmailController extends Controller
{
    public function index()
    {
        return view('emails.index');
    }

    public function askToParticipate(): RedirectResponse
    {
        try {
            $users = User::doesntHave('payments')->get();
            Notification::send($users, new ParticipationRequestNotification());
            return back()->with(['success' => 'Email sent successfully to the users who\'ve not registered to an event yet.']);
        } catch (Exception $e) {
            return back()->with(['error' => 'Email could not be sent.']);
        }
    }

    public function remainder(): RedirectResponse
    {
        try {
            $events = Event::ongoing()->with(['subEvents.ticket', 'venue'])->get();
            foreach($events as $event) {
                foreach($event->subEvents as $sub_event) {
                    $attendees = $sub_event->attendees()->get();
                    Notification::send($attendees, new EventRemainderNotification($sub_event));
                }
            }

            return back()->with(['success' => 'Email sent successfully to the users who\'ve not registered to an event yet.']);
        } catch (Exception $e) {
            return back()->with(['error' => 'Email could not be sent.']);
        }
    }
}
