<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaiVietResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);

        // return [
        //     'bai_viet_id' => $this->id,
        //     'tieu_de' => $this->tieu_de,
        //     'noi_dung' => $this->noi_dung,
        //     'created_at' => $this->created_at->format('d-m-Y'),
        // ];
    }
}
