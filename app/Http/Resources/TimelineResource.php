<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TimelineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $dateStart = Carbon::parse($this['start_at']);
        $dateEnd = Carbon::parse($this['end_at']);

        return [
            'id' => $this['id'],
            'title' => $this['title'],
            'description' => $this['description'],
            'start_at' => $dateStart,
            'end_at' => $dateEnd,
        ];
    }
}
