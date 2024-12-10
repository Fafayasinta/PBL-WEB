<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengantar Pengajuan Surat Tugas</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 50px;
            line-height: 1.5;
        }
        .kop-surat {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .kop-surat img {
            width: 100px;
            margin-right: 20px;
        }
        .kop-surat div {
            text-align: center;
            flex: 1;
        }
        .kop-surat h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }
        .kop-surat h2 {
            margin: 0;
            font-size: 16px;
        }
        .kop-surat p {
            margin: 0;
            font-size: 14px;
        }
        hr {
            margin: 20px 0;
            border: 1px solid black;
        }
        .judul-surat {
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            text-decoration: underline;
            font-size: 18px;
        }
        .nomor-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .isi-surat {
            text-align: justify;
            font-size: 14px;
        }
        .tabel-dosen {
            margin: 20px 0;
            border-collapse: collapse;
            width: 100%;
        }
        .tabel-dosen th, .tabel-dosen td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .tabel-dosen th {
            background-color: #f2f2f2;
        }
        .tanda-tangan {
            margin-top: 30px;
            text-align: left;
        }
        .tanda-tangan p {
            margin: 0;
        }
        .tanda-tangan .penandatangan {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <img src="{{ asset('adminlte/dist/img/polinema.png') }}" alt="Logo Institusi">
        <div>
            <h1>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h1>
            <h2>POLITEKNIK NEGERI MALANG</h2>
            <p>Jl. Soekarno Hatta No.9 Malang 65141</p>
            <p>Telp (0341) 404424 – 404425, Fax (0341) 404420</p>
        </div>
    </div>
    <hr>

    <div class="judul-surat">SURAT PENGANTAR</div>
    <div class="nomor-surat">Nomor: ..../PL2/JTI/2024</div>

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
            <strong>Nama Kegiatan</strong>: {{$kegiatan -> kegiatan_nama }}<br>
            <strong>Tanggal</strong>: {{$kegiatan-> waktu_mulai - $kegiatan-> waktu_selesai}} <br>
            <strong>Agenda</strong>: 
            <ul>
                //tabel t_kegiatan_agenda
                @if
                <li>Workshop Pengembangan Digital Learning</li>
                <li>Diskusi Panel "Teknologi dan Pendidikan Masa Depan"</li>
                <li>Studi Banding Infrastruktur Teknologi Informasi</li>
                @endif
            </ul>
        </p>
        <p>
            Berikut adalah daftar nama dosen yang diusulkan untuk mendapatkan Surat Tugas:
        </p>
        <table class="tabel-dosen">
            
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIDN</th>
                <th>Jabatan</th>
            </tr> 
            //tabel t_kegiatan_anggota
            @foreach ($dosen as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nidn }}</td>
                <td>{{ $item->jabatan }}</td>
                <td>1</td>
                <td>Fitria Ramadhani Prihandiva</td>
                <td>1234567890</td>
                <td>Dosen</td>
            </tr>
            @endforeach
            
        </table>
        <p>
            Demikian surat pengantar ini kami buat. Besar harapan kami agar Surat Tugas dapat segera diproses untuk mendukung kelancaran kegiatan tersebut.
        </p>
        <p>
            Atas perhatian dan kerjasamanya, kami sampaikan terima kasih.
        </p>
    </div>

    <div class="tanda-tangan">
        <p>Malang, 1 Desember 2024</p>
        <p>a.n. Ketua Jurusan,</p>
        <div class="penandatangan">
            <p>(Rosa Andrie Asmara, ST., MT., Dr. Eng.)</p>
            <p>NIP. 198010102005011001</p>
        </div>
    </div>
</body>
</html>
