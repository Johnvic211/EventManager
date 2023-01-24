<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::get();
        return view('contents.events.index')->with('events', $events);
    }

    public function create()
    {
        return view('contents.events.add');

    }

    public function store(StoreEventRequest $request)
    {
        try {
            Event::create([
                'event' => $request->event,
                'venue' => $request->venue,
                'date' => $request->date,
                'description' => $request->description
            ]);

            return redirect()->route('events.index')->with('success', 'Event has been published.');

        } catch(\Throwable $th) {
            return back()->with('error', 'Oops, something went wrong.');
        }

        if(Event::where('event', $request->event)->exists()){
            return 'Event name is already used.';
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Event $event)
    {
        return view('contents.events.edit')->with('event', $event);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        try {
            $event->update([
                'event' => $request->event,
                'venue' => $request->venue,
                'date' => $request->date,
                'description' => $request->description
            ]);

            return redirect()->route('events.index')->with('success', $event->event . ' has been updated.');
        } catch(\Throwable $th) {
            return back()->with('error', 'Oops, something went wrong.');
        }
    }

    public function destroy(Event $event)
    {
        try {
            $eventName = $event->event;
            $event->delete();

            return redirect()->route('events.index')->with('success', $eventName . ' has been deleted.');
        } catch(\Throwable $th) {
            return back()->with('error', 'Oops something went wrong');
        }
    }
}
