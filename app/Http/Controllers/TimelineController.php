<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimelineRequest;
use App\Http\Requests\UpdateTimelineRequest;
use App\Http\Resources\TimelineResource;
use App\Models\Timeline;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request['date']) {
            return $this->success(TimelineResource::collection(Timeline::where('user_id', auth()->id())->whereDate('start_at', Carbon::parse($request['date'])->toDateString())->orWhereDate('end_at', Carbon::parse($request['date'])->toDateString())->get()));
        }

        return $this->success(TimelineResource::collection(Timeline::all()->where('user_id', auth()->id())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTimelineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimelineRequest $request)
    {
        $timeline = Timeline::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'start_at' => $request['start_at'],
            'end_at' => $request['end_at'],
            'user_id' => auth()->id(),
        ]);

        return $this->success($timeline);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function show(Timeline $timeline)
    {
        return $this->success(TimelineResource::collection([$timeline]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTimelineRequest  $request
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimelineRequest $request, Timeline $timeline)
    {
        $timeline->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'start_at' => $request['start_at'],
            'end_at' => $request['end_at'],
        ]);

        return $this->success('Timeline updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timeline $timeline)
    {
        $timeline->delete();
        return $this->success('success');
    }
}
