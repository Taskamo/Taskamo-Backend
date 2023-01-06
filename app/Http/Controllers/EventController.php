<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success(EventResource::collection(Event::all()->where('user_id', auth()->id())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventRequest $request
     * @return JsonResponse
     */
    public function store(StoreEventRequest $request): JsonResponse
    {
        $event = Event::create([
            'title' => $request['title'],
            'date' => $request['date'],
            'user_id' => auth()->id(),
        ]);

        return $this->success($event);
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return JsonResponse
     */
    public function show(Event $event): JsonResponse
    {
        return $this->success(EventResource::collection([$event]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventRequest $request
     * @param Event $event
     * @return JsonResponse
     */
    public function update(UpdateEventRequest $request, Event $event): JsonResponse
    {
        $event->update([
            'title' => $request['title'],
            'data' => $request['date'],
            'updated_at' => now()
        ]);

        return $this->success('Profile updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return JsonResponse
     */
    public function destroy(Event $event): JsonResponse
    {
        $event->delete();
        return $this->success('success');
    }
}
