<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['events'] = Event::get();
        return Inertia::render('Event/Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Event/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        try {
            Event::create([
                'id' => Str::uuid(),
                'name' => $request->name,
                'slug' => $request->slug
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return Redirect::route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['event'] = Event::where('id', $id)->first();
        return Inertia::render('Event/Show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['event'] = Event::where('id', $id)->first();
        return Inertia::render('Event/Edit', $data);
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
        try {
            $event = Event::where('id', $id)->first();
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->save();
            return Redirect::route('events.show', $id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return Redirect::route('events.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $event = Event::where('id', $id)->first();
            $event->delete();
            return Redirect::route('events.index');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return Redirect::route('events.index');
        }
    }
}