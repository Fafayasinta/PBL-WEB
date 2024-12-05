@extends('layouts.app')

@section('content')
<div class="card p-4">
    <div class="card mt-4 rounded">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Kegiatan Non JTI</h4>
            @if(Auth::user()->role == 'PIC')
            <button class="btn btn-primary" onclick="modalTambahKegiatan()">
                Tambah Kegiatan
            </button>
            @endif
            <select class="form-control w-auto" name="filter_bulan">
                @foreach($bulan as $key => $bln)
                    <option value="{{ $key }}">{{ $bln }}</option>
                @endforeach
            </select>
        </div>             
        <div class="card-body">
            <table class="table table-bordered table-hover" id="tabelKegiatan">
                <thead>
                    <tr>
                        <th>Nama Kegiatan</th>
                        <th>Kategori</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Akhir</th>
                        <th>PIC</th>
                        <th>Progress</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kegiatans as $kegiatan)
                    @if($kegiatan->kategori == 'NON-JTI') 
                    <tr>
                        <td>{{ $kegiatan->nama_kegiatan }}</td>
                        <td>{{ $kegiatan->kategori_kegiatan }}</td>
                        <td>{{ $kegiatan->waktu_mulai }}</td>
                        <td>{{ $kegiatan->waktu_selesai }}</td>
                        <td>{{ $kegiatan->pic }}</td>
                        <td>
                            @php
                                $color = '';
                                if($kegiatan->progres <= 25) $color = '#f87171';
                                elseif($kegiatan->progres <= 50) $color = '#facc15';
                                elseif($kegiatan->progres <= 75) $color = '#34d399';
                                else $color = '#10b981';
                            @endphp
                            <div style="background-color: {{ $color }}; color: white; padding: 5px; border-radius: 20px; text-align: center; width: 80px;">
                                {{ $kegiatan->progres }}%
                            </div>
                        </td>
                        <td>{{ $kegiatan->status }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="detailKegiatan({{ $kegiatan->id }})">
                                <i class="fas fa-eye"></i>
                            </button>
                            @if(Auth::user()->role == 'PIC' && Auth::user()->id == $kegiatan->user_id)
                                <button class="btn btn-warning btn-sm" onclick="editKegiatan({{ $kegiatan->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="hapusKegiatan({{ $kegiatan->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection