@php
    function makeInt($angka)
    {
        if ($angka < -0.0000001) {
            return ceil($angka - 0.0000001);
        } else {
            return floor($angka + 0.0000001);
        }
    }
    
    function konvhijriah($tanggal)
    {
        $array_bulan = ['Muharram', 'Safar', 'Rabiul Awwal', 'Rabiul Akhir', 'Jumadil Awwal', 'Jumadil Akhir', 'Rajab', "Sya'ban", 'Ramadhan', 'Syawwal', 'Zulqaidah', 'Zulhijjah'];
    
        $date = makeInt(substr($tanggal, 8, 2));
        $month = makeInt(substr($tanggal, 5, 2));
        $year = makeInt(substr($tanggal, 0, 4));
    
        if ($year > 1582 || ($year == '1582' && $month > 10) || ($year == '1582' && $month == '10' && $date > 14)) {
            $jd = makeInt((1461 * ($year + 4800 + makeInt(($month - 14) / 12))) / 4) + makeInt((367 * ($month - 2 - 12 * makeInt(($month - 14) / 12))) / 12) - makeInt((3 * makeInt(($year + 4900 + makeInt(($month - 14) / 12)) / 100)) / 4) + $date - 32075;
        } else {
            $jd = 367 * $year - makeInt((7 * ($year + 5001 + makeInt(($month - 9) / 7))) / 4) + makeInt((275 * $month) / 9) + $date + 1729777;
        }
    
        $wd = $jd % 7;
        $l = $jd - 1948440 + 10632;
        $n = makeInt(($l - 1) / 10631);
        $l = $l - 10631 * $n + 354;
        $z = makeInt((10985 - $l) / 5316) * makeInt((50 * $l) / 17719) + makeInt($l / 5670) * makeInt((43 * $l) / 15238);
        $l = $l - makeInt((30 - $z) / 15) * makeInt((17719 * $z) / 50) - makeInt($z / 16) * makeInt((15238 * $z) / 43) + 29;
        $m = makeInt((24 * $l) / 709);
        $d = $l - makeInt((709 * $m) / 24);
        $y = 30 * $n + $z - 30;
        $g = $m - 1;
        $final = "$d $array_bulan[$g] $y H";
        return $final;
    }
    
    function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
        $temp = '';
        if ($nilai < 12) {
            $temp = ' ' . $huruf[$nilai];
        } elseif ($nilai < 20) {
            $temp = penyebut($nilai - 10) . ' belas';
        } elseif ($nilai < 100) {
            $temp = penyebut($nilai / 10) . ' puluh' . penyebut($nilai % 10);
        } elseif ($nilai < 200) {
            $temp = ' seratus' . penyebut($nilai - 100);
        } elseif ($nilai < 1000) {
            $temp = penyebut($nilai / 100) . ' ratus' . penyebut($nilai % 100);
        } elseif ($nilai < 2000) {
            $temp = ' seribu' . penyebut($nilai - 1000);
        } elseif ($nilai < 1000000) {
            $temp = penyebut($nilai / 1000) . ' ribu' . penyebut($nilai % 1000);
        } elseif ($nilai < 1000000000) {
            $temp = penyebut($nilai / 1000000) . ' juta' . penyebut($nilai % 1000000);
        } elseif ($nilai < 1000000000000) {
            $temp = penyebut($nilai / 1000000000) . ' milyar' . penyebut(fmod($nilai, 1000000000));
        } elseif ($nilai < 1000000000000000) {
            $temp = penyebut($nilai / 1000000000000) . ' trilyun' . penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }
    
    function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = 'minus ' . trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }
        return $hasil;
    }
    $angka = $lampiran_file;
@endphp
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <style>
        /** Define the margins of your page **/
        @page {
            margin: 100px 25px;
        }

        /* @media print {
            footer {
                page-break-after: always;
            }
        } */

        body {
            line-height: 108%;
            font-family: Calibri;
            font-size: 11pt;
            margin-left: 50px;
            margin-right: 10px;
        }

        p {
            margin: 0pt 0pt 8pt
        }

        table {
            margin-top: 0pt;
            margin-bottom: 8pt
        }

        .Default {
            margin-bottom: 0pt;
            line-height: normal;
            font-family: Cambria;
            font-size: 12pt;
            color: #000000
        }

        header {
            position: absolute;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
        }

        footer {
            position: fixed;
            bottom: -40px;
            left: 0px;
            right: 0px;
            margin-left: 50px;
            margin-right: 10px;
            height: 50px;
        }

        main {
            text-align: justify;
            text-justify: inter-word;
            margin-top: 120px;


        }
    </style>
</head>

<body>
    <!-- Define header and footer blocks before your content -->
    <header>
        <div>
            <img style="width: 100%; " src="{{ public_path('/images/kop_header.png') }}">
            <br><br><br><br><br><br>
        </div>


    </header>

    <footer>
        <br>
        <div>
            <img style="width: 100%; " src="{{ public_path('/images/kop_footer.png') }}">
        </div>

    </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
        <br>
        <table style="margin-bottom:0pt;">
            <tbody>
                <tr>
                    <td
                        style="width:245.95pt; #000000;  solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal; font-size:12pt;"><span
                                style="font-family:'Calibri Light';">Nomor : {{ $arsip->nomor_surat }}</span>
                    </td>
                    <td
                        style="width:245.95pt;   solid #000000; padding-right:5.03pt; text-align:right; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal; font-size:12pt;"><span
                                style="font-family:'Calibri Light';">{{ konvhijriah(date($arsip->tanggal_arsip)) }}</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td
                        style="width:245.95pt;   solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal; font-size:12pt;"><span
                                style="font-family:'Calibri Light';">Lamp.</span><span
                                style="font-family:'Calibri Light';">&nbsp;&nbsp;</span><span
                                style="font-family:'Calibri Light';">:
                                {{ $lampiran_file . ' (' . terbilang($angka) . ' lembar)' }}
                            </span><span style="width:18.93pt; display:inline-block;">&nbsp;</span></p>
                    </td>
                    <td
                        style="width:245.95pt;   solid #000000; padding-right:5.03pt; text-align:right; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal; font-size:12pt;"><span
                                style="font-family:'Calibri Light';">{{ Carbon\Carbon::parse($arsip->tanggal_arsip)->isoFormat('dddd, D MMMM Y') }}
                                M</span>
                        </p>
                    </td>

                </tr>
                <tr>
                    <td
                        style="width:245.95pt;   solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal; font-size:12pt;"><span
                                style="font-family:'Calibri Light';">Hal&nbsp;</span><span
                                style="width:17pt; display:inline-block;">&nbsp;</span><span
                                style="font-family:'Calibri Light';">:
                                <b>{{ $arsip->perihal_isi_deskripsi }}</b></span><span
                                style="font-family:'Calibri Light';">&nbsp;&nbsp;</span><strong><span
                                    style="font-family:'Calibri Light';"></span></strong>
                        </p>
                    </td>
                    <td
                        style="width:245.95pt;    solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal; font-size:12pt;"><span
                                style="font-family:'Calibri Light';">&nbsp;</span></p>
                    </td>
                </tr>
                <br>
                <tr>
                    <td
                        style="width:245.95pt;   solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal; font-size:12pt;"><strong><span
                                    style="font-family:Cambria;">Kepada Yth.,</span></strong></p>
                    </td>
                    <td
                        style="width:222.95pt;    solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal; font-size:12pt;"><span
                                style="font-family:'Calibri Light';">&nbsp;</span></p>
                    </td>
                </tr>
                <tr>
                    <td
                        style="width:222.95pt;   solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal; font-size:12pt;"><strong><span
                                    style="font-family:Cambria;"><b><i>(terlampir)</i></b> </span></strong>
                        </p>
                    </td>
                    <td
                        style="width:222.95pt;    solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal; font-size:12pt;"><span
                                style="font-family:'Calibri Light';">&nbsp;</span></p>
                    </td>
                </tr>
                <tr>
                    <td style="width:222.95pt;  padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal; font-size:12pt;"><strong><span
                                    style="font-family:Cambria;">di &ndash;</span></strong><strong><span
                                    style="font-family:Cambria;">&nbsp;&nbsp;</span></strong><strong><span
                                    style="font-family:Cambria;">Tempat</span></strong>
                        </p>
                    </td>
                    <td style="width:222.95pt;   padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal; font-size:12pt;"><span
                                style="font-family:'Calibri Light';">&nbsp;</span></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p>&nbsp;</p>

        <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt;"><span
                style="font-family:Cambria;font-size:12pt;">{!! $arsip->isi_surat !!}</span></p>

        <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt;"><strong><em><span
                        style="font-family:Cambria;">&nbsp;</span></em></strong></p>
        <p style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:12pt;"><strong><em><span
                        style="font-family:Cambria;">&nbsp;</span></em></strong></p>
        <p
            style="margin-bottom:0pt; text-align:justify; line-height:normal; font-size:10.5pt; background-color:#ffffff;">
            <span style="font-family:Arial; color:#444444;">&nbsp;</span>
        </p>
        <p style="margin-bottom:0pt; text-align:center; line-height:normal;"><strong><span
                    style="font-family:Cambria; text-transform:uppercase;">PENGURUS CABANG NAHDLATUL ULAMA
                </span></strong></p>
        <p style="margin-bottom:0pt; text-align:center; line-height:normal;"><strong><span
                    style="font-family:Cambria; text-transform:uppercase;">LEMBAGA AMIL ZAKAT INFAQ SHODAQOH NAHDLATUL
                    ULAMA CILACAP&nbsp;</span></strong></p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <table style="margin-bottom:0pt;">
            <tbody>
                <tr>
                    <td style="width:45.75pt;  padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal;">&nbsp;</p>
                    </td>
                    <td style="width:200.95pt;  padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <center>
                            <p style="margin-bottom:0pt; text-align:center; line-height:normal;"><strong><span
                                        style="font-family:Cambria;">Ketua</span></strong></p>
                            <p style="margin-bottom:0pt; text-align:center; line-height:normal;"><strong><span
                                        style="font-family:Cambria;">&nbsp;</span></strong></p>
                            <p style="margin-bottom:0pt; text-align:center; line-height:normal;"><strong><span
                                        style="font-family:Cambria;">&nbsp;</span></strong></p>
                            <p style="margin-bottom:0pt; text-align:center; line-height:normal;"><strong><span
                                        style="font-family:Cambria;">&nbsp;</span></strong></p>
                            <p style="margin-bottom:0pt; text-align:center; line-height:normal;"><strong><span
                                        style="font-family:Cambria;">&nbsp;</span></strong></p>
                            <p style="margin-bottom:0pt; text-align:center; line-height:normal;"><strong><span
                                        style="font-family:Cambria;">
                                        @if ($nama_ketua != null)
                                            {{ $nama_ketua }}
                                    </span>
                                @else
                                    ( Ketua Belum Terdaftar )
                                    </span>
                                    @endif
                                </strong>
                            </p>
                        </center>
                    </td>
                    <td style="width:31.75pt;  padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal;">&nbsp;</p>
                    </td>
                    <td style="width:130.95pt;  padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <center>
                            <p style="margin-bottom:0pt; text-align:center; line-height:normal;"><strong><span
                                        style="font-family:Cambria;">Sekretaris</span></strong></p>
                            <p style="margin-bottom:0pt; line-height:normal;">&nbsp;</p>
                            <p style="margin-bottom:0pt; line-height:normal;">&nbsp;</p>
                            <p style="margin-bottom:0pt; line-height:normal;">&nbsp;</p>
                            <p style="margin-bottom:0pt; line-height:normal;">&nbsp;</p>
                            <p style="margin-bottom:0pt; line-height:normal;"><strong><span
                                        style="font-family:Cambria;">
                                        @if ($nama_sekretaris != null)
                                            {{ $nama_sekretaris }}
                                    </span>
                                @else
                                    ( Sekretaris Belum Terdaftar )
                                    </span>
                                    @endif
                                </strong>
                            </p>
                        </center>
                    </td>
                    <td style="width:67.1pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-bottom:0pt; line-height:normal;">&nbsp;</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p>&nbsp;</p>

    </main>
</body>

</html>
