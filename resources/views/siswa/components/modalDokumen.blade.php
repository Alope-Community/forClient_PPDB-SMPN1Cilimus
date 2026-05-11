<div class="modal fade" id="modalDokumen" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        
        <div class="modal-content border-0 shadow-lg rounded-4" 
             style="max-height: 90vh; display: flex; flex-direction: column;">

            <form 
                action="{{ route('pendaftaran.update', $pendaftaran->id) }}" 
                method="POST" 
                enctype="multipart/form-data"
                style="display: flex; flex-direction: column; height: 100%;"
            >
                @csrf
                @method('PUT')

                <!-- HEADER -->
                <div class="modal-header bg-primary text-white rounded-top-4" 
                     style="flex-shrink: 0;">
                    <h5 class="modal-title fw-semibold">
                        <i class="fas fa-file-alt me-2"></i> Edit Alamat & Dokumen
                    </h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY (SCROLLABLE) -->
                <div class="modal-body px-4 py-3" 
                    style="max-height: 70vh; overflow-y: auto;">

                    <!-- SECTION DATA KONTAK -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="fas fa-user me-2"></i> Data Kontak
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Agama</label>
                                <select name="agama" class="form-select">
                                    @foreach(['Islam','Kristen','Katolik','Hindu','Budha','Konghucu'] as $agama)
                                        <option value="{{ $agama }}" 
                                            {{ $pendaftaran->agama == $agama ? 'selected' : '' }}>
                                            {{ $agama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">No HP</label>
                                <input type="text" name="no_hp_siswa" 
                                    class="form-control"
                                    value="{{ $pendaftaran->no_hp_siswa }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Email</label>
                                <input type="email" name="email_siswa" 
                                    class="form-control"
                                    value="{{ $pendaftaran->email_siswa }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Titik Koordinat</label>
                                <input type="text" name="titik_koordinat" 
                                    class="form-control"
                                    value="{{ $pendaftaran->titik_koordinat }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label small text-muted">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" 
                                    class="form-control"
                                    rows="3">{{ $pendaftaran->alamat_lengkap }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Jarak Rumah (meter)</label>
                                <input type="number" step="0.01" 
                                    name="jarak_rumah" 
                                    class="form-control"
                                    value="{{ $pendaftaran->jarak_rumah }}">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- SECTION DOKUMEN -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-warning mb-3">
                            <i class="fas fa-folder-open me-2"></i> Dokumen Upload
                        </h6>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Kartu KIP</label>
                                <input type="file" name="kartu_kip" class="form-control">

                                @if($pendaftaran->kartu_kip)
                                    <a href="{{ route('dokumen.lihat', $pendaftaran->kartu_kip) }}" 
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary mt-2">
                                       <i class="fas fa-eye me-1"></i> Lihat File
                                    </a>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Screenshot Jarak</label>
                                <input type="file" name="screenshot_jarak" class="form-control">

                                @if($pendaftaran->screenshot_jarak)
                                    <a href="{{ route('dokumen.lihat', $pendaftaran->screenshot_jarak) }}" 
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-eye me-1"></i> Lihat File
                                    </a>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Kartu Keluarga</label>
                                <input type="file" name="kartu_keluarga" class="form-control">

                                @if($pendaftaran->kartu_keluarga)
                                    <a href="{{ route('dokumen.lihat', $pendaftaran->kartu_keluarga) }}" 
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-eye me-1"></i> Lihat File
                                    </a>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small text-muted">Sertifikat Kejuaraan</label>
                                <input type="file" name="sertifikat_kejuaraan" class="form-control">

                                @if($pendaftaran->jalur_pendaftaran == "prestasi_non_akademik" && $pendaftaran->sertifikat_kejuaraan)
                                    <a href="{{ route('dokumen.lihat', $pendaftaran->sertifikat_kejuaraan) }}" 
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-eye me-1"></i> Lihat File
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>

                    <hr>

                    <!-- SECTION SOSMED -->
                    <div>
                        <h6 class="fw-bold text-info mb-3">
                            <i class="fas fa-share-alt me-2"></i> Sosial Media
                        </h6>

                        @php
                            $sosmed = json_decode($pendaftaran->sosmed ?? '[]', true);
                        @endphp

                        <div class="mb-2">
                            @foreach(['Instagram','Tiktok','Facebook','Twitter'] as $item)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="sosmed[]"
                                        value="{{ $item }}"
                                        {{ in_array($item, $sosmed ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $item }}</label>
                                </div>
                            @endforeach
                        </div>

                        <input type="text"
                            name="sosmed_lainnya"
                            class="form-control"
                            placeholder="Lainnya..."
                            value="{{ $pendaftaran->sosmed_lainnya }}">
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3" 
                     style="flex-shrink: 0;">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>