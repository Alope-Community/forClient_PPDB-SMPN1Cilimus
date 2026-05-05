<div class="modal fade" id="modalOrtu" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow border-0 rounded-3">

            <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- HEADER -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-users me-2"></i>Edit Data Orang Tua
                    </h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY (SCROLLABLE) -->
                <div class="modal-body" 
                     style="max-height: 70vh; overflow-y: auto;">

                    <!-- AYAH -->
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-male text-primary me-2"></i>
                        <strong>Data Ayah</strong>
                    </div>
                    <hr class="mt-1 mb-3">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control"
                                value="{{ $pendaftaran->nama_ayah }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir_ayah" class="form-control"
                                value="{{ $pendaftaran->tempat_lahir_ayah }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir_ayah" class="form-control"
                                value="{{ $pendaftaran->tanggal_lahir_ayah }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Agama</label>
                            <select name="agama_ayah" class="form-select">
                                @foreach(['Islam','Kristen','Katolik','Hindu','Budha','Konghucu'] as $agama)
                                    <option value="{{ $agama }}"
                                        {{ $pendaftaran->agama_ayah == $agama ? 'selected' : '' }}>
                                        {{ $agama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan_ayah" class="form-control"
                                value="{{ $pendaftaran->pekerjaan_ayah }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pendidikan</label>
                            <select name="pendidikan_ayah" class="form-select">
                                @foreach(['SD','SMP','SMA','D1','D2','D3','S1','S2'] as $p)
                                    <option value="{{ $p }}"
                                        {{ $pendaftaran->pendidikan_ayah == $p ? 'selected' : '' }}>
                                        {{ $p }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- IBU -->
                    <div class="d-flex align-items-center mt-4 mb-2">
                        <i class="fas fa-female text-danger me-2"></i>
                        <strong>Data Ibu</strong>
                    </div>
                    <hr class="mt-1 mb-3">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control"
                                value="{{ $pendaftaran->nama_ibu }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir_ibu" class="form-control"
                                value="{{ $pendaftaran->tempat_lahir_ibu }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir_ibu" class="form-control"
                                value="{{ $pendaftaran->tanggal_lahir_ibu }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan_ibu" class="form-control"
                                value="{{ $pendaftaran->pekerjaan_ibu }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pendidikan</label>
                            <select name="pendidikan_ibu" class="form-select">
                                @foreach(['SD','SMP','SMA','D1','D2','D3','S1','S2'] as $p)
                                    <option value="{{ $p }}"
                                        {{ $pendaftaran->pendidikan_ibu == $p ? 'selected' : '' }}>
                                        {{ $p }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- KONTAK -->
                    <div class="d-flex align-items-center mt-4 mb-2">
                        <i class="fas fa-phone text-success me-2"></i>
                        <strong>Kontak & Alamat</strong>
                    </div>
                    <hr class="mt-1 mb-3">

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Alamat Orang Tua</label>
                            <textarea name="alamat_orang_tua" class="form-control" rows="2">{{ $pendaftaran->alamat_orang_tua }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">No HP Orang Tua</label>
                            <input type="text" name="no_hp_orang_tua" class="form-control"
                                value="{{ $pendaftaran->no_hp_orang_tua }}">
                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>