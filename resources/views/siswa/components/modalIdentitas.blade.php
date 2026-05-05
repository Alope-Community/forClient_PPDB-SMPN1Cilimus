<div class="modal fade" id="modalIdentitas" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- HEADER -->
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title fw-semibold">
                        <i class="fas fa-id-card me-2"></i> Edit Identitas Diri
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY (SCROLLABLE) -->
                <div class="modal-body px-4 py-3" 
                     style="max-height: 70vh; overflow-y: auto;">

                    <!-- DATA UTAMA -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="fas fa-user me-2"></i> Data Utama
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Asal SD/MI</label>
                                <input type="text" name="asal_sd_mi" class="form-control"
                                    value="{{ $pendaftaran->asal_sd_mi }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Jalur Pendaftaran</label>
                                <select name="jalur_pendaftaran" class="form-select">
                                    <option value="domisili" {{ $pendaftaran->jalur_pendaftaran == 'domisili' ? 'selected' : '' }}>Domisili</option>
                                    <option value="afirmasi" {{ $pendaftaran->jalur_pendaftaran == 'afirmasi' ? 'selected' : '' }}>Afirmasi</option>
                                    <option value="prestasi_akademik" {{ $pendaftaran->jalur_pendaftaran == 'prestasi_akademik' ? 'selected' : '' }}>Prestasi Akademik</option>
                                    <option value="prestasi_non_akademik" {{ $pendaftaran->jalur_pendaftaran == 'prestasi_non_akademik' ? 'selected' : '' }}>Prestasi Non Akademik</option>
                                    <option value="mutasi" {{ $pendaftaran->jalur_pendaftaran == 'mutasi' ? 'selected' : '' }}>Mutasi</option>
                                </select>
                            </div>

                            <div class="col-md-8">
                                <label class="form-label small text-muted">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control"
                                    value="{{ $pendaftaran->nama_lengkap }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small text-muted">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="Laki-laki" {{ $pendaftaran->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $pendaftaran->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small text-muted">NISN</label>
                                <input type="text" name="nisn" class="form-control"
                                    value="{{ $pendaftaran->nisn }}">
                            </div>

                            <div class="col-md-8">
                                <label class="form-label small text-muted">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control"
                                    value="{{ $pendaftaran->tempat_lahir }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control"
                                    value="{{ $pendaftaran->tanggal_lahir }}">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- TAMBAHAN -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-success mb-3">
                            <i class="fas fa-star me-2"></i> Data Tambahan
                        </h6>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Pernah PAUD/TK</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="pernah_paud" value="1"
                                            {{ $pendaftaran->pernah_paud ? 'checked' : '' }}>
                                        <label class="form-check-label">PAUD</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="pernah_tk" value="1"
                                            {{ $pendaftaran->pernah_tk ? 'checked' : '' }}>
                                        <label class="form-check-label">TK</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="tidak_pernah" value="1"
                                            {{ $pendaftaran->tidak_pernah ? 'checked' : '' }}>
                                        <label class="form-check-label">Tidak Pernah</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Hobby</label>
                                <input type="text" name="hobby" class="form-control"
                                    value="{{ $pendaftaran->hobby }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Cita-cita</label>
                                <input type="text" name="cita_cita" class="form-control"
                                    value="{{ $pendaftaran->cita_cita }}">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- FISIK & KELUARGA -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-warning mb-3">
                            <i class="fas fa-child me-2"></i> Data Fisik & Keluarga
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Tinggi Badan</label>
                                <input type="number" name="tinggi_badan" class="form-control"
                                    value="{{ $pendaftaran->tinggi_badan }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small text-muted">Berat Badan</label>
                                <input type="number" name="berat_badan" class="form-control"
                                    value="{{ $pendaftaran->berat_badan }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small text-muted">Lingkar Kepala</label>
                                <input type="number" name="lingkar_kepala" class="form-control"
                                    value="{{ $pendaftaran->lingkar_kepala }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Anak Ke</label>
                                <input type="number" name="anak_ke" class="form-control"
                                    value="{{ $pendaftaran->anak_ke }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Jumlah Saudara</label>
                                <input type="number" name="jumlah_saudara" class="form-control"
                                    value="{{ $pendaftaran->jumlah_saudara }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label small text-muted">Memiliki KIP</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="memiliki_kip" value="Ya"
                                            {{ $pendaftaran->memiliki_kip == 'Ya' ? 'checked' : '' }}>
                                        <label class="form-check-label">Ya</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="memiliki_kip" value="Tidak"
                                            {{ $pendaftaran->memiliki_kip == 'Tidak' ? 'checked' : '' }}>
                                        <label class="form-check-label">Tidak</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label small text-muted">Alamat</label>
                                <textarea name="alamat_lengkap" class="form-control" rows="3">{{ $pendaftaran->alamat_lengkap }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>