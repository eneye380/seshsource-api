<?php

namespace SeshSource\Http\Controllers\Api;

use SeshSource\Events;
use Illuminate\Http\Request;
use SeshSource\Http\Requests\StoreEvents;
use SeshSource\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class EventsController extends Controller
{

    /**
     * Add middlewares here instead of route file
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => [ 'index', 'show' ]]);
        $this->middleware('admin', ['only' => 'destroy']);
        $this->middleware('business', ['only' => [ 'update', 'update' ] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Events::paginate(10);

        return response()->json($events);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEvents $request)
    {

        $userId = $request->user()->id;
        $validated = $request->all();

        // @todo: Store images on filesystem + add filepath to requests
        // @todo: Use Carbon to format dates before inserting into DB

        /** 
         * Create slug for post
         */
        $slug = str_slug($request->input('title'));
        $next = 2;
        // Loop until we can query for the slug and it returns false
        while (Events::where('slug', '=', $slug)->first()) {
            $slug = $slug . '-' . $next;
            $next++;
        }

        /** 
         * Add any new values to the request object 
         * using Input's merge method
         */
        $validated['slug'] = $slug;
        $validated['organizer_id'] = $userId;

        $newEvent = Events::create($validated);

        return response()->json($newEvent);
    }

    /**
     * Display the specified resource based on the event slug
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $event = Events::whereSlug($slug)->firstOrFail();

        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEvents $request, $id)
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
