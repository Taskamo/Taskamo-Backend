<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['id' => "mixed", 'title' => "mixed", 'date_ago' => "string", 'month' => "string", 'day' => "int", 'year' => "int"])] public function toArray($request): array|JsonSerializable|Arrayable
    {
        $date = Carbon::parse($this['date'])->setYear(Carbon::now()->year);

        if ($date->gte(Carbon::now())) {
            $dateAgo = $date->ago();
        } else {
            $dateAgo = $date->addYear()->ago();
        }

        return [
            'id' => $this['id'],
            'title' => $this['title'],
            'date_ago' => $dateAgo,
            'month' => $date->monthName,
            'day' => $date->day,
            'year' => Carbon::parse($this['date'])->year
        ];
    }
}
