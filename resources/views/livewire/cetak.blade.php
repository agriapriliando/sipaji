<!-- Each sheet element should have the class "sheet" -->
<!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
<section class="sheet padding-15mm" x-data="{
    btnprint: true,
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
                @if ($datasurat->status_surveys == true)
                    <i class="fa-solid fa-print" onclick="window.print()"></i>
                @elseif ($datasurat->status_surveys == false)
                    <i x-show="btnprint" class="fa-solid fa-print" role="button" tabindex="0" id="btnPrintIcon" title="Cetak"></i>
                @endif
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
    <!-- Modal Survei -->
    <style>
        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background-color: #ccc;
            /* Example: light gray background */
            color: #666;
            /* Example: darker gray text */
            pointer-events: none;
            /* Prevents click events */
        }
    </style>
    <div id="customModal" class="modal-overlay" wire:ignore>
        <div class="modal-box" x-data="{ kepuasan: '' }">
            <h5>Survei Kepuasan</h5>

            <form id="surveyForm" wire:submit.prevent="submitSurvey">
                <p>Bagaimana tingkat kepuasan Anda terhadap layanan ini?</p>

                <label>
                    <input type="radio" name="kepuasan" value="1" x-model="kepuasan" wire:model="kepuasan"> Puas
                </label><br>
                <label>
                    <input type="radio" name="kepuasan" value="0" x-model="kepuasan" wire:model="kepuasan"> Tidak Puas
                </label>

                <!-- error client-side -->
                <div id="errKepuasan" style="color:red;font-size:0.85em;margin-top:6px;"></div>
                <!-- error server-side -->
                @error('kepuasan')
                    <div style="color:red;font-size:0.85em;margin-top:6px;">{{ $message }}</div>
                @enderror

                <div style="margin-top:15px; text-align:right;">
                    <button type="button" class="btn-cancel" id="btnCancel">Batal</button>
                    <button x-on:click="btnprint = false" type="submit" class="btn-submit" id="btnSubmit" :disabled="kepuasan === ''"
                        :class="{ 'opacity-50 cursor-not-allowed': kepuasan === '' }">
                        Kirim & Cetak
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Survei -->
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
                        <td>Pemohon,</td>
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
    @if ($jenis === 'pelimpahan')
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
                    <td>1 (satu) Berkas </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Perihal</td>
                    <td style="width: 5px; vertical-align: top;">:</td>
                    <td style="width: 200px;">Mohon Pelimpahan Nomor Porsi Jamaah Haji An. <span class="bold">{{ $datasurat->nama_asal }}</span> Nomor Porsi
                        <span class="bold">{{ $datasurat->nomor_porsi }}</span>
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
            <table class="customTable" style="width: 700px;">

                <tbody>
                    <tr>
                        <td width="55px;"></td>
                        <td width="25px;" style="vertical-align: top;">Nama</td>
                        <td width="10px;" style="vertical-align: top;">: </td>
                        <td width="250px;">
                            <span>{{ $datasurat->nama_penerima }}</span>
                            <span class="noprint" style="font-style: italic;">(Nama Penerima Pelimpahan)</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="vertical-align: top;">Bin/Binti</td>
                        <td style="vertical-align: top;">: </td>
                        <td>
                            <span>{{ $datasurat->bin_binti ? $datasurat->bin_binti : '-' }}</span>
                            <span class="noprint" style="font-style: italic;">(Nama Ayah Penerima Pelimpahan)</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Tempat Tgl Lahir</td>
                        <td>: </td>
                        <td>
                            <span>Kandangan, 21 Juli 1959</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pekerjaan</td>
                        <td>: </td>
                        <td>
                            <span>Mengurus Rumah Tangga </span>
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td></td>
                        <td>Alamat</td>
                        <td>: </td>
                        <td>
                            <span>
                                Jalan Banama RT RW Desan Samba, Kec Katingan Tengah,
                                Kab. Katingan, Prov Kalteng
                            </span>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Nomor HP</td>
                        <td>: </td>
                        <td>
                            <span>085249441182 </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="customTable" style="margin-top: 18px;">
                <tr>
                    <td width="100px;"></td>
                    <td>Dengan ini mengajukan permohonan sebagaimana perihal di atas dikarenakan
                        <span class="bold">{{ $datasurat->alasan_pelimpahan }}</span>.
                        Bersama ini kami lampirkan berkas persyaratan sebagai berikut.
                    </td>
                </tr>
                <tr x-data="{ persyaratan: @entangle('jenis_persyaratan') }">
                    <td></td>
                    <td>
                        <select name="persyaratan" x-model="persyaratan" x-on:click="$wire.savepersyaratan(persyaratan)" class="noprint" style="margin-bottom: 5px">
                            <option value="">Pilih Alasan</option>
                            <option value="Meninggal Dunia">Meninggal Dunia</option>
                            <option value="Sakit Permanen">Sakit Permanen</option>
                        </select>

                        <!-- Hanya tampil jika sudah memilih -->
                        <ol x-show="persyaratan" x-cloak>
                            <li x-show="persyaratan === 'Meninggal Dunia'">Surat Akta Kematian dari Disdukcapil</li>
                            <li x-show="persyaratan === 'Sakit Permanen'">Surat Keterangan dari Dokter</li>

                            <li>Asli Bukti Setoran Awal dan/atau Lunas Bipih</li>
                            <li>Asli SPPH/Nomor Porsi</li>
                            <li>Asli Surat Kuasa Penunjukan Pelimpahan</li>
                            <li>Asli Surat Keterangan Tanggung Jawab Mutlak</li>
                            <li>KTP (Penerima Pelimpahan)</li>
                            <li>Kartu Keluarga (Penerima Pelimpahan)</li>
                            <li>Akte Kelahiran/Surat Kenal Lahir (Penerima Pelimpahan)</li>
                            <li>Akta Nikah/Buku Nikah (Penerima Pelimpahan)</li>
                            <li>Foto 3 X 4 = 5 Lembar (standar haji dengan latar putih)</li>
                            <li>Buku Tabungan Haji bagi (Penerima Pelimpahan)</li>
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
                        <td>Pemohon,</td>
                    </tr>
                    <tr height="100px">
                        <td></td>
                        <td>
                            <span style="border: 1px solid black;">Materai Rp 10.000</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><span class="bold">{{ $datasurat->nama_penerima }}</span>.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
</section>
@push('styles')
    <style>
        /* Overlay */
        .modal-overlay {
            display: none;
            /* hidden default */
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        /* Box */
        .modal-box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: fadeIn .3s ease;
        }

        /* Button style */
        .btn-cancel {
            background: #ccc;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            margin-right: 5px;
            cursor: pointer;
        }

        .btn-submit {
            background: #007bff;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media print {
            #customModal {
                display: none !important
            }
        }
    </style>
@endpush
@script
    <script>
        (function() {
            const modalEl = document.getElementById('customModal');
            const btnPrint = document.getElementById('btnPrintIcon');
            const btnCancel = document.getElementById('btnCancel');
            const form = document.getElementById('surveyForm');
            const errEl = document.getElementById('errKepuasan');

            function openModal() {
                modalEl.style.display = 'flex';
            }

            function closeModal() {
                modalEl.style.display = 'none';
            }

            btnPrint?.addEventListener('click', openModal);
            btnPrint?.addEventListener('keydown', e => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    openModal();
                }
            });
            btnCancel?.addEventListener('click', closeModal);

            // VALIDASI client-side: cegah submit jika belum pilih
            form?.addEventListener('submit', function(e) {
                const selected = form.querySelector('input[name="kepuasan"]:checked');
                if (!selected) {
                    console.log('Belum pilih kepuasan');
                    e.preventDefault(); // hentikan Livewire submit
                    errEl.textContent = 'Silakan pilih salah satu (Puas / Tidak Puas).';
                    return false;
                }
                errEl.textContent = '';
                // lanjut: Livewire akan submit via AJAX
            });

            // Event sukses dari Livewire → tutup modal → cetak
            $wire.on('survey-saved', (event) => {
                closeModal();
                setTimeout(() => window.print(), 200);
            });
        })();
    </script>
@endscript
