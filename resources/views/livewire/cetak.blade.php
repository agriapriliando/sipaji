<!-- Each sheet element should have the class "sheet" -->
<!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
<section class="sheet padding-15mm" x-data="{
    today: new Date().toISOString().slice(0, 10), // format awal: yyyy-mm-dd
    get todayFormatted() {
        return new Date(this.today).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });
    }
}">
    <div id="buttoncetak" class="button-87 noprint absolute">
        <button class="btn-print">
            <span style="margin-right: 10px;">
                <i class="fa-solid fa-print" onclick="window.print()"></i>
            </span>
            <span style="margin-right: 12px;">
                <a href="{{ route('edit', ['jenis' => $jenis, 'id' => $datasurat->id]) }}" class="text-white">
                    <i class="fa-solid fa-pencil"></i>
                </a>
            </span>
            <span>
                <a href="{{ route('home') }}" class="text-white">
                    <i class="fa-solid fa-home"></i>
                </a>
            </span>
        </button>
    </div>
    @if ($jenis === 'pembatalan')
        <div>
            <table class="customTable" style="width: 550px;">
                <div>
                    <!-- Preview hasil -->
                    <p style="text-align: right;" x-text="`Kasongan, ${todayFormatted}`"></p>
                </div>
                <tr>
                    <td width="10px;">Nomor</td>
                    <td width="10px">: </td>
                    <td width="350px;"> Lepas </td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td style="width: 5px;">: </td>
                    <td>1 Berkas </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Perihal</td>
                    <td style="width: 5px; vertical-align: top;">:</td>
                    <td style="width: 200px;">Mohon Pembatalan Calon Jemaah Haji dan Pengembalian Setoran BPIH Setor
                        Awal An. <span class="bold">{{ $datasurat->nama }}</span> <span class="bold">{{ $datasurat->bin_binti ? 'Binti ' . $datasurat->bin_binti : '-' }}</span> Nomor Porsi
                        <span class="bold">{{ $datasurat->nomor_porsi }} </span>
                    </td>
                </tr>
            </table>
            <table class="customTable" style="margin-top: 18px;">
                <tr>
                    <td style="width: 100px;"></td>
                    <td>Kepada :</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Yth. Kepala Kantor Kementerian Agama Kab. Katingan</td>
                </tr>
                <tr>
                    <td></td>
                    <td>di - Kasongan</td>
                </tr>
            </table>
            <table class="customTable" style="margin-top: 18px;">
                <tr>
                    <td style="width: 100px;"></td>
                    <td>Assalamu'alaikum Wr. Wb. </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Dengan hormat,</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Yang bertanda tangan di bawah ini :</td>
                </tr>
            </table>
            <table class="customTable" style="width: 650px;">
                <tbody>
                    <tr>
                        <td width="55px;"></td>
                        <td width="25px;">Nama</td>
                        <td width="10px;">: </td>
                        <td width="220px;">
                            <span class="bold">{{ $datasurat->nama }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Bin/Binti</td>
                        <td>: </td>
                        <td>
                            {{ $datasurat->bin_binti ? $datasurat->bin_binti : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Tempat Tgl Lahir</td>
                        <td>: </td>
                        <td>
                            <span>{{ $datasurat->ttl_tempat }}, {{ $datasurat->ttl_tanggal->translatedFormat('d F Y') }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pekerjaan</td>
                        <td>: </td>
                        <td>
                            <span>{{ $datasurat->pekerjaan }}</span>
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td></td>
                        <td>Alamat</td>
                        <td>: </td>
                        <td>
                            <span>
                                {{ $datasurat->alamat }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="customTable" style="margin-top: 18px;">
                <tr>
                    <td width="100px;"></td>
                    <td>Dengan ini mengajukan permohonan sebagaimana perihal di atas dikarenakan alasan
                        <span class="bold">{{ $datasurat->alasan_pembatalan }}</span>.
                        Bersama ini kami lampirkan berkas persyaratan sebagai berikut.
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <ol>
                            <li>Copy KTP yang bersangkutan</li>
                            <li>Bukti Asli Setoran Awal BPIH yang dikeluarkan oleh BPS BPIH</li>
                            <li>Asli Aplikasi Transfer Setoran Awal BPIH</li>
                            <li>SPPH</li>
                            <li>Copy Buku Tabungan Haji yang masih aktif atas nama Jemaah Haji yang Bersangkutan dan
                                Memperlihatkan Aslinya</li>
                        </ol>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Demikian untuk dapat diproses lebih lanjut dan terima kasih atas kerja samanya.</td>
                </tr>
            </table>
            <table class="customTable" style="width:100%; margin-top: 12px;">
                <tbody>
                    <tr>
                        <td style="width: 60%;"></td>
                        <td>Pemohon</td>
                    </tr>
                    <tr height="100px">
                        <td></td>
                        <td>
                            <span style="border: 1px solid black;">Materai Rp 10.000</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><span class="bold">{{ $datasurat->nama }}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
</section>
