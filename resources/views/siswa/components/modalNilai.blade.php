<div class="modal fade" id="modalNilai" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" 
                method="POST" 
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- HEADER -->
                <div class="modal-header bg-success text-white rounded-top-4">
                    <h5 class="modal-title fw-semibold">
                        <i class="fas fa-chart-line me-2"></i> Edit Nilai & Prestasi
                    </h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY -->
                <div class="modal-body px-4 py-3">

                    <!-- ALERT -->
                    <div class="alert alert-warning small">
                        Gunakan titik (.) untuk desimal — contoh: <strong>440.70</strong>
                    </div>

                    <!-- ================= NILAI ================= -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-success mb-3">
                            <i class="fas fa-book me-2"></i> Nilai Raport
                        </h6>

                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label small text-muted">Bahasa Indonesia</label>
                                <input type="number" step="0.01"
                                    name="nilai_bindo"
                                    id="edit_bindo"
                                    class="form-control text-center"
                                    value="{{ $pendaftaran->nilai_bindo }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small text-muted">Matematika</label>
                                <input type="number" step="0.01"
                                    name="nilai_matematika"
                                    id="edit_mtk"
                                    class="form-control text-center"
                                    value="{{ $pendaftaran->nilai_matematika }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small text-muted">IPA</label>
                                <input type="number" step="0.01"
                                    name="nilai_ipa"
                                    id="edit_ipa"
                                    class="form-control text-center"
                                    value="{{ $pendaftaran->nilai_ipa }}">
                            </div>

                            <!-- TOTAL -->
                            <div class="col-12">
                                <div class="bg-light rounded-3 p-3 d-flex justify-content-between align-items-center mt-2">
                                    <span class="fw-semibold text-muted">Jumlah Nilai</span>
                                    <input type="number" step="0.01"
                                        name="jumlah_nilai"
                                        id="edit_total"
                                        class="form-control w-auto text-center fw-bold border-0 bg-transparent text-success"
                                        value="{{ $pendaftaran->jumlah_nilai }}"
                                        readonly>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- ================= PRESTASI ================= -->
                    <div id="editPrestasiSection"
                        style="{{ in_array($pendaftaran->jalur_pendaftaran, ['prestasi_akademik','prestasi_non_akademik']) ? '' : 'display:none;' }}">
                        
                        <hr>

                        <h6 class="fw-bold text-primary mb-3">
                            <i class="fas fa-trophy me-2"></i> Prestasi Kejuaraan
                        </h6>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Event / Tahun</label>
                                <input type="text"
                                    name="event_kejuaraan"
                                    class="form-control"
                                    value="{{ $pendaftaran->event_kejuaraan }}">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small text-muted">Tingkat</label>
                                <select name="tingkat_kejuaraan" class="form-select">
                                    <option value="">Pilih</option>
                                    @foreach(['Kecamatan','Kabupaten','Provinsi','Nasional'] as $t)
                                        <option value="{{ $t }}"
                                            {{ $pendaftaran->tingkat_kejuaraan == $t ? 'selected' : '' }}>
                                            {{ $t }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small text-muted">Peringkat</label>
                                <select name="peringkat" class="form-select">
                                    <option value="">Pilih</option>
                                    @foreach(['Juara 1','Juara 2','Juara 3'] as $p)
                                        <option value="{{ $p }}"
                                            {{ $pendaftaran->peringkat == $p ? 'selected' : '' }}>
                                            {{ $p }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Penyelenggara</label>
                                <input type="text"
                                    name="penyelenggara"
                                    class="form-control"
                                    value="{{ $pendaftaran->penyelenggara }}">
                            </div>

                            <!-- FILE -->
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Sertifikat Kejuaraan</label>
                                <input type="file"
                                    name="sertifikat_kejuaraan"
                                    class="form-control">

                                @if($pendaftaran->sertifikat_kejuaraan)
                                    <a href="{{ asset('storage/' . $pendaftaran->sertifikat_kejuaraan) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-eye me-1"></i> Lihat File
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>