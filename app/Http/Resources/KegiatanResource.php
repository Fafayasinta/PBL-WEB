<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KegiatanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->kegiatan_id,
            'nama_kegiatan' => $this->nama_kegiatan,
            'kategori_kegiatan_id' => $this->kategori_kegiatan_id,
            'user_id' => $this->user_id,
            'beban_kegiatan_id' => $this->beban_kegiatan_id,
            'tahun_id' => $this->tahun_id,
            'pic' => $this->pic,
            'cakupan_wilayah' => $this->cakupan_wilayah,
            'deskripsi' => $this->deskripsi,
            'waktu_mulai' => $this->waktu_mulai,
            'waktu_selesai' => $this->waktu_selesai,
            'deadline' => $this->deadline,
            'status' => $this->status,
            'progres' => $this->progres
        ];
    }
}
