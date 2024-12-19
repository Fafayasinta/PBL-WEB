<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengantar</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 20mm;
            line-height: 1.2;
            font-size: 12pt;
        }
        .kop-surat {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .kop-surat img {
            width: 70px;
            margin-right: 10px;
        }
        .kop-surat div {
            text-align: center;
            flex: 1;
        }
        .kop-surat h1 {
            margin: 0;
            font-size: 14pt;
            text-transform: uppercase;
        }
        .kop-surat h2 {
            margin: 0;
            font-size: 13pt;
        }
        .kop-surat p {
            margin: 0;
            font-size: 10pt;
        }
        hr {
            margin: 10px 0;
            border: 0;
            border-top: 1px solid black;
        }
        .judul-surat {
            text-align: center;
            margin: 10px 0;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
        }
        .nomor-surat {
            text-align: center;
            margin-bottom: 10px;
            font-size: 12pt;
        }
        .isi-surat {
            text-align: justify;
            font-size: 11pt;
        }
        .tabel-dosen {
            margin: 10px 0;
            border-collapse: collapse;
            width: 100%;
            font-size: 11pt;
        }
        .tabel-dosen th, .tabel-dosen td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
        .tabel-dosen th {
            background-color: #f2f2f2;
        }
        .tanda-tangan {
            margin-top: 30px;
            text-align: right;
        }
        .tanda-tangan p {
            margin: 0;
            font-size: 11pt;
        }
        .penandatangan {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <!-- Kop Surat -->
    <div class="kop-surat">
        <img src="{{ public_path('path/to/logo.png') }}" alt="Logo Institusi">
        <div>
            <h1>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h1>
            <h2>POLITEKNIK NEGERI MALANG</h2>
            <p>Jl. Soekarno Hatta No.9 Malang 65141</p>
            <p>Telp (0341) 404424 – 404425, Fax (0341) 404420</p>
        </div>
    </div>
    <hr>

    <!-- Judul Surat -->
    <div class="judul-surat">SURAT PENGANTAR</div>
    <div class="nomor-surat">Nomor: ..../PL2/JTI/{{ date('Y') }}</div>

    <!-- Isi Surat -->
    <div class="isi-surat">
        <p>
            Yth. Wakil Direktur IV<br>
            Politeknik Negeri Malang<br>
            di Tempat
        </p>
        <p>
            Dengan hormat, bersama ini kami mengajukan permohonan pembuatan <strong>Surat Tugas</strong>
            untuk dosen-dosen dari Jurusan Teknologi Informasi yang akan mengikuti kegiatan berikut:
        </p>
        <p>
            <table style="width: 100%; border-collapse: collapse; font-size: 11pt;">
                <tr>
                    <td style="width: 25%; vertical-align: top;"><strong>Nama Kegiatan</strong></td>
                    <td style="width: 2%; vertical-align: top;">:</td>
                    <td style="width: 73%;">{{ $kegiatan->nama_kegiatan }}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;"><strong>Tanggal</strong></td>
                    <td style="vertical-align: top;">:</td>
                    <td>
                        {{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->translatedFormat('d F Y') }} - 
                        {{ \Carbon\Carbon::parse($kegiatan->waktu_selesai)->translatedFormat('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;"><strong>Agenda</strong></td>
                    <td style="vertical-align: top;">:</td>
                    <td>
                        <ul style="margin: 0; padding-left: 20px;">
                            @forelse ($agendaList as $item)
                                <li>{{ $item }}</li>
                            @empty
                                <li>Agenda belum tersedia.</li>
                            @endforelse
                        </ul>
                    </td>
                </tr>
            </table>
        </p>        
        <p>
            Berikut adalah daftar nama dosen yang diusulkan untuk mendapatkan Surat Tugas:
        </p>
        <table class="tabel-dosen">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dosenList as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['jabatan'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>
            Demikian surat pengantar ini kami buat. Besar harapan kami agar Surat Tugas dapat segera diproses untuk mendukung kelancaran kegiatan tersebut.
        </p>
        <p>
            Atas perhatian dan kerjasamanya, kami sampaikan terima kasih.
        </p>
    </div>

    <!-- Tanda Tangan -->
    <div class="tanda-tangan">
        <p>Malang, {{ date('d F Y') }}</p>
        <p>a.n. Ketua Jurusan,</p>
        <div class="penandatangan">
            <p>(Rosa Andrie Asmara, ST., MT., Dr. Eng.)</p>
            <p>NIP. 198010102005011001</p>
        </div>
    </div>
</body>
</html>
