<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->user_id,
            'username' => $this->username,
            'email' => $this->email,
            'nama' => $this->nama,
            'nip' => $this->nip,
            'level' => $this->level,
            'foto_profil' => $this->foto_profil == 'default-profile.jpg' ? null :  $this->foto_profil,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
