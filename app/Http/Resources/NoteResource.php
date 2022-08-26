<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'subject_id' => $this->subject_id,
            'subject' => $this->subject->name,
            'description' => $this->description,
            'published' => $this->created_at->format('d F, Y'),
            'url' => route('note.show', $this->slug),
        ];
    }
}
