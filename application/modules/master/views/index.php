
<div class="card shadow-sm mb-5 mb-xl-10">
    <div class="card-header bg-success">
        <h3 class="card-title text-white"><?php echo $title; ?></h3>
        <!-- <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-icon btn-bg-white me-2 mb-2">
                <i class="las la-sync fs-1 text-success"></i>
            </button>
        </div> -->
    </div>
    <div class="card-body px-9 pt-7 pb-1">
        <!--begin::Row-->
        <div class="row mb-7">
            <div class="col-lg-6">
                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Kode Vendor</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800"><?php echo $vendor->kode_vendor; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Tanggal Registrasi</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 d-flex align-items-center">
                        <span class="fs-6 text-gray-800"><?php echo date('d-m-Y', strtotime($vendor->tanggal_registrasi)); ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Nama Perusahaan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fs-6 text-gray-800"><?php echo $vendor->nama_perusahaan; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">No. Surat Permohonan Rekanan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fs-6 text-gray-800"><?php echo $vendor->no_surat_rekanan; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">No. SPPKP</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6"><?php echo $vendor->no_sppkp; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Alamat</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 d-flex align-items-center">
                        <span class="fs-6 text-gray-800"><?php echo $vendor->alamat_perusahaan; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Kabupaten/ Kota</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fs-6 text-gray-800"><?php echo $vendor->kabkot; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Provinsi</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fs-6 text-gray-800"><?php echo $vendor->provinsi; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Negara</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fs-6 text-gray-800"><?php echo $vendor->negara; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Kode Pos</label>
                    <div class="col-lg-8">
                        <span class="fs-6 text-gray-800"><?php echo $vendor->kode_pos; ?></span>
                    </div>
                </div>
                <!--end::Input group-->
            </div>
            <div class="col-lg-6">
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">No. Telepon</label>
                    <!--begin::Label-->
                    <!--begin::Label-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fw-bold fs-6 text-gray-800"><?php echo $vendor->no_telepon; ?></span>
                    </div>
                    <!--begin::Label-->
                </div>
                <!--end::Input group-->
                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">No. HP</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800"><?php echo $vendor->no_hp; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">No. Fax</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bolder fw-bold text-gray-800 fs-6"><?php echo $vendor->no_fax; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Email</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 d-flex align-items-center">
                        <span class="fw-bolder fs-6 text-gray-800"><?php echo $vendor->email_perusahaan; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">NPWP</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fs-6 text-gray-800"><?php echo $vendor->no_npwp; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Alamat NPWP</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fs-6 text-gray-800"><?php echo $vendor->alamat_npwp; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Nama Marketing</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fs-6 text-gray-800"><?php echo $vendor->nama_marketing; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">No. HP Marketing</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bolder fw-bold text-gray-800 fs-6"><?php echo $vendor->no_hp_marketing; ?></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            </div>
        </div>
        <!--end::Row-->
    </div>
</div>

<div class="card">
    <!--begin::Card header-->
    <div class="card-header bg-success">
        <!--begin::Title-->
        <div class="card-title">
            <h3 class="card-title text-white">Nomor Rekening Perusahaan</h3>
        </div>
        <!--end::Title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Addresses-->
        <div class="row gx-9 gy-6">
            <?php
            for ($i = 0; $i < 5; $i++) {
            ?>
                <?php $number = $i + 1; ?>
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Address-->
                    <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                        <!--begin::Details-->
                        <div class="d-flex flex-column py-2">
                            <div class="d-flex align-items-center fs-5 fw-bolder mb-5">Rekening <?php echo $number; ?>
                            </div>
                            <?php
                            $rekening   = 'rekening0' . $number;
                            $atas_nama  = 'atas_nama0' . $number;
                            $mata_uang  = 'mata_uang0' . $number;
                            $nama_bank  = 'nama_bank0' . $number;
                            ?>
                            <div class="fs-6 fw-bold text-gray-600"><?php echo $vendor->$rekening; ?>
                                <br><?php echo $vendor->$atas_nama; ?>
                                <br><?php echo $vendor->$mata_uang; ?>
                                <br><?php echo $vendor->$nama_bank; ?>
                            </div>
                        </div>
                        <!--end::Details-->
                    </div>
                    <!--end::Address-->
                </div>
                <!--end::Col-->
            <?php } ?>
        </div>
        <!--end::Addresses-->
    </div>
    <!--end::Card body-->
</div>