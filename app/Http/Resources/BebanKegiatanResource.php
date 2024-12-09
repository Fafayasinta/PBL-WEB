<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BebanKegiatanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->beban_kegiatan_id,
            'nama_beban' => $this->nama_beban,
            'deskripsi' => $this->deskripsi,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
