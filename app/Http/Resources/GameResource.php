<?php

namespace App\Http\Resources;

use App\Models\Game;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Game|GameResource $this */
        return [
            'id' => $this->id,
            'number_one' => $this->number_one,
            'number_two' => $this->number_two,
            'number_three' => $this->number_three,
            'author_name' => $this->author_name,
            'author_location' => $this->author_location,
            'author_email' => $this->author_email,
            'link' => $this->link,
            'link_title' => $this->link_title,
            'game_start' => $this->game_start,
            'game_end' => $this->game_end,
            'created_at' => $this->created_at,
        ];
    }
}
