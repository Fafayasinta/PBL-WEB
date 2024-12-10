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
            'user'  => new UserResource($this->user),
            'nama_kegiatan' => $this->nama_kegiatan,
            'kategori' => new KategoriKegiatanResource($this->kategori),
            'beban_kegiatan' => new BebanKegiatanResource($this->beban_kegiatan),
            'tahun_id' => $this->tahun_id,
            'pic' => $this->pic,
            'cakupan_wilayah' => $this->cakupan_wilayah,
            'deskripsi' => $this->deskripsi,
            'waktu_mulai' => $this->waktu_mulai,
            'waktu_selesai' => $this->waktu_selesai,
            'deadline' => $this->deadline,
            'status' => $this->status,
            'progres' => $this->progres,
            'keterangan' => $this->keterangan,
            'icon' => 'storage/' . $this->icon,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
