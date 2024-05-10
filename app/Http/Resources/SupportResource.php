<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_label' => $this->statusOptions[$this->status] ?? 'Not found status',
            'description' => $this->description,
            'date_update' => Carbon::make($this->updated_at)->format('d/m/Y H:i:s'),
            'user' => new UserResource($this->user),
            'lesson' => new LessonResource($this->whenLoaded('lesson')),
            'replies' => ReplyResource::collection($this->whenLoaded('replies')),
        ];
    }
}
