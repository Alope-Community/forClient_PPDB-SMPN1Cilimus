<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pendaftaran PPDB</title>

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color:#222;
            margin:30px;
        }

        .header{
            border-bottom:3px solid #000;
            padding-bottom:15px;
            margin-bottom:25px;
        }

        .header table{
            width:100%;
        }

        .logo{
            width:80px;
        }

        .school-name{
            font-size:22px;
            font-weight:bold;
            text-transform:uppercase;
        }

        .school-info{
            font-size:12px;
            line-height:1.5;
        }

        .title{
            text-align:center;
            margin-bottom:25px;
        }

        .title h2{
            margin:0;
            font-size:20px;
            text-transform:uppercase;
        }

        .card{
            border:1px solid #dcdcdc;
            border-radius:8px;
            padding:20px;
        }

        .table{
            width:100%;
            border-collapse:collapse;
        }

        .table td{
            padding:8px 5px;
            vertical-align:top;
        }

        .label{
            width:35%;
            font-weight:bold;
        }

        .status{
            display:inline-block;
            padding:6px 14px;
            border-radius:4px;
            background:#e8f5e9;
            color:#2e7d32;
            font-size:12px;
            font-weight:bold;
        }

        .note{
            margin-top:25px;
            padding:15px;
            background:#f7f7f7;
            border-left:4px solid #555;
            font-size:12px;
            line-height:1.6;
        }

        .footer{
            margin-top:50px;
        }

        .signature{
            width:100%;
        }

        .signature td{
            text-align:center;
            vertical-align:top;
        }

        .space{
            height:80px;
        }

        .small{
            font-size:11px;
            color:#777;
            text-align:center;
            margin-top:30px;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <table>
            <tr>
                <td width="15%">
                    <img src="{{ public_path('logo.png') }}" class="logo">
                </td>

                <td align="center">
                    <div class="school-name">
                        SMP NEGERI 1 CILIMUS
                    </div>

                    <div class="school-info">
                        Jl. Raya Cilimus No. 1<br>
                        Telp: (021) 123456789<br>
                        Email: info@smpn1cilimus.sch.id
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- TITLE -->
    <div class="title">
        <h2>Bukti Pendaftaran PPDB</h2>
        <p>Tahun Ajaran 2026/2027</p>
    </div>

    <!-- CONTENT -->
    <div class="card">

        <table class="table">

            <tr>
                <td class="label">Nomor Pendaftaran</td>
                <td>
                    : PPDB-{{ str_pad($pendaftaran->id, 5, '0', STR_PAD_LEFT) }}
                </td>
            </tr>

            <tr>
                <td class="label">Nama Lengkap</td>
                <td>: {{ $pendaftaran->nama_lengkap }}</td>
            </tr>

            <tr>
                <td class="label">NISN</td>
                <td>: {{ $pendaftaran->nisn }}</td>
            </tr>

            <tr>
                <td class="label">Jalur Pendaftaran</td>
                <td>
                    : {{ ucwords(str_replace('_', ' ', $pendaftaran->jalur_pendaftaran)) }}
                </td>
            </tr>

            <tr>
                <td class="label">Asal Sekolah</td>
                <td>: {{ $pendaftaran->asal_sd_mi }}</td>
            </tr>

            <tr>
                <td class="label">Email</td>
                <td>: {{ $pendaftaran->email_siswa ?? '-' }}</td>
            </tr>

            <tr>
                <td class="label">No HP</td>
                <td>: {{ $pendaftaran->no_hp_siswa }}</td>
            </tr>

            <tr>
                <td class="label">Tanggal Daftar</td>
                <td>
                    : {{ $pendaftaran->created_at->translatedFormat('d F Y') }}
                </td>
            </tr>

            <tr>
                <td class="label">Status</td>
                <td>
                    :
                    <span class="status">
                        {{ strtoupper($pendaftaran->status) }}
                    </span>
                </td>
            </tr>

        </table>

        <div class="note">
            Dokumen ini merupakan bukti resmi bahwa peserta telah melakukan
            pendaftaran PPDB secara online. Harap menyimpan dokumen ini
            untuk proses verifikasi dan daftar ulang.
        </div>

    </div>

    <!-- SIGNATURE -->
    <div class="footer">
        <table class="signature">
            <tr>
                <td width="60%"></td>

                <td>
                    Cilimus,
                    {{ now()->translatedFormat('d F Y') }}
                    <br>
                    Panitia PPDB

                    <div class="space"></div>

                    <u><b>Administrator PPDB</b></u>
                </td>
            </tr>
        </table>
    </div>

    <div class="small">
        Dokumen dicetak otomatis oleh sistem PPDB.
    </div>

</body>
</html>