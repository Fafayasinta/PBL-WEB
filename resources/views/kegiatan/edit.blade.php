@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Kegiatan</h3>
            </div>

            <form action="{{ route('kegiatan.update', $kegiatan->kegiatan_id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Kegiatan</label>
                                <input type="text" class="form-control" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" required>
                            </div>

                            <div class="form-group">
                                <label>PIC</label>
                                <input type="text" class="form-control" name="pic" value="{{ $kegiatan->pic }}" required>
                            </div>

                            <div class="form-group">
                                <label>Jenis Kegiatan</label>
                                <select class="form-control" name="kategori_kegiatan_id" required>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->kategori_kegiatan_id }}" 
                                            {{ $kegiatan->kategori_kegiatan_id == $k->kategori_kegiatan_id ? 'selected' : '' }}>
                                            {{ $k->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="Belum Proses" {{ $kegiatan->status == 'Belum Proses' ? 'selected' : '' }}>Belum Proses</option>
                                    <option value="Proses" {{ $kegiatan->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="Selesai" {{ $kegiatan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Beban Kerja</label>
                                <select class="form-control" name="beban_kegiatan_id" required>
                                    @foreach($bebanKerja as $b)
                                        <option value="{{ $b->beban_kegiatan_id }}"
                                            {{ $kegiatan->beban_kegiatan_id == $b->beban_kegiatan_id ? 'selected' : '' }}>
                                            {{ $b->nama_beban }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Waktu Mulai</label>
                                <input type="date" class="form-control" name="waktu_mulai" 
                                    value="{{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('Y-m-d') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Waktu Selesai</label>
                                <input type="date" class="form-control" name="waktu_selesai" 
                                    value="{{ \Carbon\Carbon::parse($kegiatan->waktu_selesai)->format('Y-m-d') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Deadline</label>
                                <input type="date" class="form-control" name="deadline" 
                                    value="{{ \Carbon\Carbon::parse($kegiatan->deadline)->format('Y-m-d') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="4" required>{{ $kegiatan->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection