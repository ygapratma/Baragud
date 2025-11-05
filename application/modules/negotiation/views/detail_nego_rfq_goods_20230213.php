<script src="<?php echo base_url(); ?>assets/plugins/custom/jquery-maskMoney/jquery.maskMoney.js"></script>
<div class="card shadow-sm">
    <div class="card-header bg-success">
        <div class="card-toolbar">
            <a href="<?php echo site_url('negotiation/rfq_goods'); ?>" class="btn btn-sm btn-bg-white btn-icon me-2 mb-2">
                <i class="las la-arrow-left fs-1 text-success"></i>
            </a>
        </div>
        <h3 class="card-title text-white"><?php echo $title; ?></h3>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-bg-white btn-icon me-2 mb-2" onclick="return KTDataTables.init();">
                <i class="las la-sync fs-1 text-success"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="kt_datatable_detail_nego_rfq_goods" class="align-middle table table-row-bordered gy-5">
            <thead>
                <tr class="fw-bold fs-6 text-muted">
                    <th class="min-w-50px text-center">No.</th>
                    <th class="min-w-50px text-center">Kode Material</th>
                    <th class="min-w-125px text-center">Nama Material</th>
                    <th class="min-w-50px text-center">Jumlah Permintaan</th>
                    <th class="min-w-50px text-center">Satuan Permintaan</th>
                    <th class="min-w-50px text-center">Status</th>
                    <th class="min-w-50px text-center">Harga Sesuai Permintaan</th>
                    <th class="min-w-200px text-center">Harga Permintaan Ekuivalen</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="kt_modal_det_nego_rfq_goods" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="min-width:1280px;">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Pengisian Nego RFQ</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-danger ms-2" data-kt-det-nego-rfq-goods-modal-action="close" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>

            <form id="kt_modal_det_nego_rfq_goods_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" enctype="multipart/form-data" action="<?php echo site_url('negotiation/save_negotiation'); ?>">
                <!--begin::Modal body-->
                <div class="modal-body py-4 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_det_nego_rfq_goods_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_det_nego_rfq_goods_header" data-kt-scroll-wrappers="#kt_modal_det_nego_rfq_goods_scroll" data-kt-scroll-offset="300px" style="max-height: 144px;">
                        <div class="fw-bold">
                            <h4 class="text-gray-900 fw-bolder">RFQ No : <span id="txt_rfq_no"></span> | <span id="txt_material_code"></span></h4>
                        </div>
                        <input type="hidden" name="nomor_rfq" id="nomor_rfq">
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Kode Material</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="kode_barang" id="kode_barang" class="form-control form-control-solid" readonly="true" placeholder="Kode Material">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Nama Material</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="deskripsi_barang" id="deskripsi_barang" class="form-control form-control-solid" readonly="true" placeholder="Nama Material">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6"></label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <textarea class="form-control form-control-solid" readonly="true"  name="deskripsi_material" id="deskripsi_material" rows="4"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Jumlah Permintaan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="number" name="jumlah_permintaan" id="jumlah_permintaan" class="form-control form-control-solid" readonly="true" placeholder="Jumlah Permintaan">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Satuan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="satuan" id="satuan" class="form-control form-control-solid" readonly="true" placeholder="Satuan">
                                <!-- <input type="hidden" name="satuan" id="satuan">
                                <input type="hidden" name="deskripsi_satuan" id="deskripsi_satuan"> -->
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Status Ketersediaan Barang</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <div class="align-items-center mt-3">
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid me-5">
                                        <input class="form-check-input" name="ketersediaan_barang" id="ketersediaan_barang" disabled type="radio" value="0">
                                        <span class="fw-bold ps-2 fs-6">Tersedia</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <input class="form-check-input" name="ketersediaan_barang" id="ketersediaan_barang" disabled type="radio" value="1" checked="true">
                                        <span class="fw-bold ps-2 fs-6">Indent</span>
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <div id="form_status_ketersediaan_barang">
                            <!--Begin::Input Group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Jumlah Tersedia</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="number" name="jumlah_tersedia" id="jumlah_tersedia" class="form-control form-control-solid" readonly="true" placeholder="Jumlah Tersedia" min="0">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input Group-->
                            <!--Begin::Input Group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Jumlah Indent</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="number" name="jumlah_inden" id="jumlah_inden" class="form-control form-control-solid" readonly="true" placeholder="Jumlah Indent" min="0">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input Group-->
                            <!--Begin::Input Group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Lama Indent (Hari)</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="number" name="lama_inden" id="lama_inden" class="form-control form-control-solid" readonly="true" placeholder="Lama Indent (Hari)" min="0">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input Group-->
                        </div>
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Mata Uang</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                <!-- <input type="text" name="currency" class="form-control" placeholder="Mata Uang"> -->
                                <select class="form-select form-select-solid" disabled name="mata_uang" id="mata_uang" data-control="select2" data-dropdown-parent="#kt_modal_det_nego_rfq_goods" data-placeholder="Pilih Mata Uang">
                                    <?php
                                    foreach ($currencies as $currency) {
                                    ?>
                                        <option value="<?php echo $currency->kode_uang; ?>"><?php echo $currency->kode_uang; ?> (<?php echo $currency->deskripsi; ?>)</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Harga Satuan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                <input type="text" name="harga_satuan" id="harga_satuan" class="form-control form-control-solid mask-money" readonly="true" placeholder="Harga Satuan">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Label-->
                            <label class="col-lg-1 col-form-label required fw-bold fs-6">Per</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row fv-plugins-icon-container">
                                <!-- <input type="text" name="unit_measure" class="form-control" placeholder="Satuan"> -->
                                <select class="form-select form-select-solid" disabled name="per_harga_satuan" id="per_harga_satuan" data-control="select2" data-dropdown-parent="#kt_modal_det_nego_rfq_goods" data-placeholder="Pilih Satuan">
                                    <?php
                                    foreach ($UoMs as $UoM) {
                                    ?>
                                        <option value="<?php echo $UoM->satuan; ?>"><?php echo $UoM->satuan; ?> (<?php echo $UoM->deskripsi_satuan; ?>)</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Harga Satuan Nego</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                <input type="text" name="harga_satuan_nego" id="harga_satuan_nego" class="form-control mask-money" placeholder="Harga Satuan Nego">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">Keterangan Nego</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <!-- <input class="form-control" name="notes" placeholder="Keterangan"/> -->
                                <textarea class="form-control" name="keterangan_nego" id="keterangan_nego" placeholder="Keterangan Nego" rows="5"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Apakah ada konversi?</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <div class="align-items-center mt-3">
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid me-5">
                                        <input class="form-check-input" name="konversi" id="konversi" disabled type="radio" value="1">
                                        <span class="fw-bold ps-2 fs-6">Ya</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <input class="form-check-input" name="konversi" id="konversi" disabled type="radio" value="0" checked="true">
                                        <span class="fw-bold ps-2 fs-6">Tidak</span>
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6" id="form_convertion">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Masukkan Satuan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <table class="table table-row-dashed table-row-gray-300 gy-7 align-middle">
                                    <thead>
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <th class="text-center min-w-150px">Keterangan</th>
                                            <th class="text-center min-w-30px">Jumlah</th>
                                            <th class="text-center min-w-50px">Satuan</th>
                                            <th class="text-center min-w-20px"></th>
                                            <th class="text-center min-w-80px">Konversi Jumlah</th>
                                            <th class="text-center min-w-50px">Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Satuan Konversi</td>
                                            <td class="text-center">1</td>
                                            <td class="text-center">
                                                <input type="text" name="per_harga_satuan_text" id="per_harga_satuan_text" class="form-control form-control-solid text-center" readonly="true">
                                            </td>
                                            <td class="text-center">=</td>
                                            <td class="text-center">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control form-control-solid" name="jumlah_konversi" id="jumlah_konversi" placeholder="Konversi Jumlah" readonly="true">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <!-- <input type="text" name="measurement" class="form-control form-control-solid" readonly="true"> -->
                                                <select class="form-select form-select-solid" disabled name="satuan_konversi" id="satuan_konversi" data-control="select2" data-dropdown-parent="#kt_modal_det_nego_rfq_goods" data-placeholder="Pilih Satuan">
                                                    <?php
                                                    foreach ($UoMs as $UoM) {
                                                    ?>
                                                        <option value="<?php echo $UoM->satuan; ?>"><?php echo $UoM->satuan; ?> (<?php echo $UoM->deskripsi_satuan; ?>)</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Masa Berlaku Harga</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input class="form-control form-control-solid" name="masa_berlaku_harga" id="masa_berlaku_harga" readonly="true" placeholder="Masa Berlaku Harga" id="kt_daterangepicker_3" />
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">Keterangan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <!-- <input class="form-control" name="notes" placeholder="Keterangan"/> -->
                                <textarea class="form-control form-control-solid" name="keterangan" id="keterangan" placeholder="Keterangan" rows="5" readonly="true"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Dibuat Oleh</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input class="form-control form-control-solid" name="dibuat_oleh" id="dibuat_oleh" placeholder="Dibuat oleh" readonly="true"/>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">File Brosur</label>
                            <div class="col-lg-8 fv-row fv-plugins-icon-container" id="input_file">
                                
                            </div>
                        </div>
                        <!--end::Input Group-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_det_nego_rfq_goods_cancel" class="btn btn-light me-3">Tutup</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_det_nego_rfq_goods_submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
                <div></div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="kt_modal_det_nego_rfq_goods_ekuivalen" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">kt_modal_det_nego_rfq_goods
    <div class="modal-dialog modal-lg modal-dialog-centered" style="min-width:1280px;">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Pengisian Ekuivalen</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-light ms-2" data-kt-det-nego-rfq-goods-ekuivalen-modal-action="close" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>

            <form id="kt_modal_det_nego_rfq_goods_ekuivalen_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" enctype="multipart/form-data" action="<?php echo site_url('negotiation/save_negotiation_eqiv'); ?>">
                <!--begin::Modal body-->
                <div class="modal-body py-4 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_det_nego_rfq_goods_ekuivalen_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_det_nego_rfq_goods_ekuivalen_header" data-kt-scroll-wrappers="#kt_modal_det_nego_rfq_goods_ekuivalen_scroll" data-kt-scroll-offset="300px" style="max-height: 144px;">
                        <div class="fw-bold">
                            <h4 class="text-gray-900 fw-bolder">RFQ No : <span id="txt_rfq_no_eqiv"></span> | <span id="txt_material_code_eqiv"></span> | <span id="txt_seq_eqiv"></span></h4>
                        </div>
                        <input type="hidden" name="nomor_rfq_eqiv" id="nomor_rfq_eqiv">
                        <input type="hidden" name="ekuivalen" id="ekuivalen">
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Kode Material</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="kode_barang_eqiv" id="kode_barang_eqiv" class="form-control form-control-solid" readonly="true" placeholder="Kode Material">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Nama Material Eqiv</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="deskripsi_barang_eqiv" id="deskripsi_barang_eqiv" class="form-control form-control-solid" readonly="true" placeholder="Nama Material">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6"></label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <textarea class="form-control form-control-solid" readonly="true"  name="deskripsi_material_eqiv" id="deskripsi_material_eqiv" rows="4"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Jumlah Permintaan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="number" name="jumlah_permintaan_eqiv" id="jumlah_permintaan_eqiv" class="form-control form-control-solid" readonly="true" placeholder="Jumlah Permintaan">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Satuan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="satuan_eqiv" id="satuan_eqiv" class="form-control form-control-solid" readonly="true" placeholder="Satuan">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Spesifikasi</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <textarea rows="5" name="spesifikasi_eqiv" id="spesifikasi_eqiv" class="form-control form-control-solid" readonly="true" placeholder="Spesifikasi"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Merek</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="merek_eqiv" id="merek_eqiv" class="form-control form-control-solid" placeholder="Merek" readonly="true">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Tipe</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="tipe_eqiv" id="tipe_eqiv" class="form-control form-control-solid" placeholder="Tipe" readonly="true">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Buatan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="buatan_eqiv" id="buatan_eqiv" class="form-control form-control-solid" placeholder="Buatan" readonly="true">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Status Ketersediaan Barang</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <div class="align-items-center mt-3">
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid me-5">
                                        <input class="form-check-input" name="ketersediaan_barang_eqiv" id="ketersediaan_barang_eqiv" disabled type="radio" value="0" checked="true">
                                        <span class="fw-bold ps-2 fs-6">Tersedia</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <input class="form-check-input" name="ketersediaan_barang_eqiv" id="ketersediaan_barang_eqiv" disabled type="radio" value="1">
                                        <span class="fw-bold ps-2 fs-6">Indent</span>
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <div id="form_status_ketersediaan_barang_eqiv">
                            <!--Begin::Input Group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Jumlah Tersedia</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="number" name="jumlah_tersedia_eqiv" id="jumlah_tersedia_eqiv" class="form-control form-control-solid" readonly="true" placeholder="Jumlah Tersedia" min="0">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input Group-->
                            <!--Begin::Input Group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Jumlah Indent</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="number" name="jumlah_inden_eqiv" id="jumlah_inden_eqiv" class="form-control form-control-solid" readonly="true" placeholder="Jumlah Indent" min="0">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input Group-->
                            <!--Begin::Input Group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Lama Indent (Hari)</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="number" name="lama_inden_eqiv" id="lama_inden_eqiv" class="form-control form-control-solid" readonly="true" placeholder="Lama Indent (Hari)" min="0">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input Group-->
                        </div>
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Mata Uang</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <select class="form-select form-select-solid" name="mata_uang_eqiv" id="mata_uang_eqiv" disabled data-control="select2" data-dropdown-parent="#kt_modal_det_nego_rfq_goods_ekuivalen" data-placeholder="Pilih Mata Uang">
                                    <?php
                                    foreach ($currencies as $currency) {
                                    ?>
                                        <option value="<?php echo $currency->kode_uang; ?>"><?php echo $currency->kode_uang; ?> (<?php echo $currency->deskripsi; ?>)</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Harga Satuan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                <input type="text" name="harga_satuan_eqiv" id="harga_satuan_eqiv" readonly="true" class="form-control form-control-solid mask-money" placeholder="Harga Satuan">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Label-->
                            <label class="col-lg-1 col-form-label required fw-bold fs-6">Per</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row fv-plugins-icon-container">
                                <select class="form-select form-select-solid" disabled name="per_harga_satuan_eqiv" id="per_harga_satuan_eqiv" data-control="select2" data-dropdown-parent="#kt_modal_det_nego_rfq_goods_ekuivalen" data-placeholder="Pilih Satuan">
                                    <?php
                                    foreach ($UoMs as $UoM) {
                                    ?>
                                        <option value="<?php echo $UoM->satuan; ?>"><?php echo $UoM->satuan; ?> (<?php echo $UoM->deskripsi_satuan; ?>)</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Harga Satuan Nego</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                <input type="text" name="harga_satuan_nego_eqiv" id="harga_satuan_nego_eqiv" class="form-control mask-money" placeholder="Harga Satuan Nego">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">Keterangan Nego</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <textarea class="form-control" name="keterangan_nego_eqiv" id="keterangan_nego_eqiv" placeholder="Keterangan Nego" rows="5"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Apakah ada konversi?</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <div class="align-items-center mt-3">
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid me-5">
                                        <input class="form-check-input" name="konversi_eqiv" id="konversi_eqiv" disabled type="radio" value="1">
                                        <span class="fw-bold ps-2 fs-6">Ya</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <input class="form-check-input" name="konversi_eqiv" id="konversi_eqiv" disabled type="radio" value="0" checked="true">
                                        <span class="fw-bold ps-2 fs-6">Tidak</span>
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6" id="form_convertion_eqiv">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Masukkan Satuan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <table class="table table-row-dashed table-row-gray-300 gy-7 align-middle">
                                    <thead>
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <th class="text-center min-w-80px">Keterangan</th>
                                            <th class="text-center min-w-50px">Jumlah</th>
                                            <th class="text-center min-w-50px">Satuan</th>
                                            <th class="text-center min-w-20px"></th>
                                            <th class="text-center min-w-80px">Konversi Jumlah</th>
                                            <th class="text-center min-w-50px">Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Satuan Konversi</td>
                                            <td class="text-center">1</td>
                                            <td class="text-center">
                                                <input type="text" name="per_harga_satuan_text_eqiv" id="per_harga_satuan_text_eqiv" class="form-control form-control-solid text-center" readonly="true">
                                            </td>
                                            <td class="text-center">=</td>
                                            <td class="text-center">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control form-control-solid" name="jumlah_konversi_eqiv" id="jumlah_konversi_eqiv" readonly="true" placeholder="Konversi Jumlah">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <select class="form-select form-select-solid" disabled name="satuan_konversi_eqiv" id="satuan_konversi_eqiv" data-control="select2" data-dropdown-parent="#kt_modal_det_nego_rfq_goods_ekuivalen" data-placeholder="Pilih Satuan">
                                                    <?php
                                                    foreach ($UoMs as $UoM) {
                                                    ?>
                                                        <option value="<?php echo $UoM->satuan; ?>"><?php echo $UoM->satuan; ?> (<?php echo $UoM->deskripsi_satuan; ?>)</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Masa Berlaku Harga</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input class="form-control form-control-solid" readonly="true" name="masa_berlaku_harga_eqiv" id="masa_berlaku_harga_eqiv" placeholder="Masa Berlaku Harga" id="kt_daterangepicker_4" />
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">Keterangan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <textarea class="form-control form-control-solid" name="keterangan_eqiv" id="keterangan_eqiv" readonly="true" placeholder="Keterangan" rows="5"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Dibuat Oleh</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input class="form-control form-control-solid" name="dibuat_oleh_eqiv" id="dibuat_oleh_eqiv" placeholder="Dibuat Oleh" readonly="true"/>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">File Brosur</label>
                            <div class="col-lg-8 fv-row fv-plugins-icon-container" id="input_file_eqiv">
                            </div>
                        </div>
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_det_nego_rfq_goods_ekuivalen_cancel" class="btn btn-light me-3">Tutup</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_det_nego_rfq_goods_ekuivalen_submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
                <div></div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="kt_modal_additional_price" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="min-width:990px;">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Biaya Lainnya</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-light ms-2" data-kt-additional-price-modal-action="close" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>

            <form id="kt_modal_additional_price_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" action="<?php echo site_url('negotiation/save_additional_price'); ?>">
                <!--begin::Modal body-->
                <div class="modal-body py-4 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7 mt-5" id="kt_modal_additional_price_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_additional_price_header" data-kt-scroll-wrappers="#kt_modal_additional_price_scroll" data-kt-scroll-offset="300px" style="max-height: 144px;">
                        <!-- <div class="fw-bold">
                            <h4 class="text-gray-900 fw-bolder">Biaya Lainnya</h4>
                        </div> -->
                        <input type="hidden" name="id_rfq_other" value="<?php echo $this->uri->segment(3); ?>">
                        <!--Begin::Input Group-->
                        <div class="row mb-6" id="el_add_1">
                            <!--begin::Label-->
                            <div class="col-lg-3 fv-row fv-plugins-icon-container">
                                <select class="form-select form-select-solid" name="add_price_type[]" id="add_price_type_1" disabled data-control="select2" data-dropdown-parent="#kt_modal_additional_price" data-placeholder="Pilih Biaya Lainnya">
                                    <option value="ZFR1_Freight Cost - Taxable">Freight Cost - Taxable</option>
                                    <option value="ZFR2_Freight Cost - Non Taxable">Freight Cost - Non Taxable</option>
                                    <option value="ZFIN_Freight & Insurance">Freight & Insurance</option>
                                    <option value="ZINS_Insurance">Insurance</option>
                                </select>
                            </div>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-2 fv-row fv-plugins-icon-container">
                                <input type="text" name="add_price[]" id="add_price_1" class="form-control form-control-solid text-end add_price_val" readonly="true" placeholder="">
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row fv-plugins-icon-container">
                                <input type="text" name="add_price_nego[]" id="add_price_nego_1" class="form-control add_price_nego_val" placeholder="Negosiasi">
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                <select class="form-select form-select-solid" name="add_currency[]" id="add_currency_1" disabled data-control="select2" data-dropdown-parent="#kt_modal_additional_price" data-placeholder="Pilih Mata Uang">
                                    <?php
                                    foreach ($currencies as $currency) {
                                    ?>
                                        <option value="<?php echo $currency->kode_uang; ?>" <?php echo ($currency->kode_uang == 'IDR') ? 'selected' : ''; ?>><?php echo $currency->kode_uang; ?> (<?php echo $currency->deskripsi; ?>)</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 ms-5 col-form-label fw-bold fs-6">Keterangan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <textarea rows="6" name="add_notes" id="add_notes" class="form-control" placeholder="Keterangan"></textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_additional_price_cancel" class="btn btn-light me-3">Tutup</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_additional_price_submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
                <div></div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
"use strict";

const modal_additional_container = document.querySelector("#kt_modal_additional_price");
const modal_additional = new bootstrap.Modal(modal_additional_container);

var KTDataTables = (function() {
    var e;
    const target_modal_eqiv = document.querySelector("#kt_modal_det_nego_rfq_goods_ekuivalen .modal-content");
    const blockModalEQIV = new KTBlockUI(target_modal_eqiv);
    const loading = new KTBlockUI(document.querySelector("#kt_content"), {
        overlayClass: "bg-dark bg-opacity-10",
    });
    return {
        init: function() {
            e = $("#kt_datatable_detail_nego_rfq_goods").DataTable({
                processing: !0,
                serverSide: !0,
                destroy: !0,
                scrollX: !0,
                dom: "<'row'<'col-sm-6 col-md-6 col-lg-6 d-flex align-items-center'B><'col-sm-6 col-md-6 col-lg-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-1'l><'col-sm-12 col-md-3'i><'col-sm-12 col-md-8'p>>",
                buttons: [
                    {
                        text: 'Biaya Lainnya',
                        className: 'btn btn-sm btn-success',
                        action: function ( e, dt, node, config ) {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('negotiation/show_additional_price') ?>",
                                data: { id: $('input[name=id_rfq_other]').val() },
                                beforeSend: function() {
                                    loading.block();
                                },
                                success: function(response) {
                                    var obj = jQuery.parseJSON(response);
                                    if(obj.data.length > 0) {
                                        if(obj.data.length > 1) {
                                            for(var i = 0; i < obj.data.length - 1; i++) {
                                                Elements.add_row();
                                            }
                                        }

                                        $("div[id^=el_add_]").each( function(key, value) {
                                            $("#add_price_type_"+(key+1)).val(obj.data[key].kode_biaya+'_'+obj.data[key].deskripsi_biaya).trigger('change');
                                            $("#add_price_"+(key+1)).maskMoney('mask', parseInt(obj.data[key].jumlah_biaya));
                                            $("#add_currency_"+(key+1)).val($.trim(obj.data[key].mata_uang)).trigger('change');
                                        }),
                                        $("#add_currency_").val($.trim(obj.data[0].keterangan)),
                                        loading.release(), modal_additional.show();
                                    } else {
                                        loading.release(), modal_additional.show();
                                    }
                                },
                                error: function() {
                                    loading.release();
                                }
                            });
                        }
                    }
                ],
                paging: !0,
                ordering: !0,
                searching: !0,
                ajax: {
                    type: "POST",
                    url: "<?php echo site_url('negotiation/det_rfq_goods/' . $this->uri->segment(3)); ?>"
                },
                columns: [
                    {
                        data: 'number',
                        className: 'text-center',
                        sortable: false,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'kode_barang',
                        className: 'text-center'
                    },
                    {
                        data: 'deskripsi_barang',
                        className: 'text-center'
                    },
                    {
                        data: 'jumlah_permintaan',
                        className: 'text-center'
                    },
                    {
                        data: 'satuan',
                        className: 'text-center'
                    },
                    {
                        data: 'status',
                        className: 'text-center'
                    },
                    {
                        data: 'actions',
                        className: 'text-center',
                        sortable: false,
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'actions_equivalen',
                        className: 'text-center',
                        sortable: false,
                        searchable: false,
                        orderable: false
                    }
                ],
                lengthMenu: [
                    [5, 10, 15, 25, -1],
                    [5, 10, 15, 25, "All"]
                ],
                pageLength: 10,
                order: [1, 'ASC']
            }),
            $("#kt_datatable_detail_nego_rfq_goods tbody").on('click', 'button.rfq_form', function() {

                // Get DataTables row data
                var data = e.row($(this).parents('tr')).data();

                // Initialize modal form element
                var modal_form = $("#kt_modal_det_nego_rfq_goods_form");

                // Set Form Title
                $("#kt_modal_det_nego_rfq_goods h4 span#txt_rfq_no").text(data.nomor_rfq);
                $("#kt_modal_det_nego_rfq_goods h4 span#txt_material_code").text(data.kode_barang);

                // Get inputs array from modal form
                var $input = modal_form.closest('div').find('input[type="hidden"], input.form-control, select.form-select, input.form-check-input, textarea.form-control');
                
                // Loop inputs array to set value from DataTables row
                $input.each( function(index, element) {
                    
                    // Get element class name
                    var element_class = element.getAttribute('class');

                    // Remove space character from element class name
                    var class_input = (element_class !== null) ? element_class.split(' ') : ['form-control'];

                    // Get inputs name
                    var element_name = element.getAttribute('name');

                    // Check if element has object in DataTables data row
                    if(data.hasOwnProperty(element_name)) {

                        if(class_input[0] == 'form-select') {

                            // If class name select, initialize to select2
                            $('#' + element_name).val(data[element_name]).trigger('change');

                        } else if(class_input[0] == 'form-check-input') {

                            // If class name checkbox or radio, set value to checked
                            if(element.value == data[element_name]) {

                                $('#' + element_name + '[value="' + data[element_name] + '"]').prop('checked', true);

                            }

                            // Show / Hide element if checkbox or radio is checked
                            if($('#' + element_name + ':checked').val() == 0) {
                                
                                if(element_name == 'ketersediaan_barang') {
                                    $("#form_status_ketersediaan_barang").hide();
                                } else {
                                    $("#form_convertion").hide();
                                }

                            } else {

                                if(element_name == 'ketersediaan_barang') {
                                    $("#form_status_ketersediaan_barang").show();
                                } else {
                                    $("#form_convertion").show();
                                }

                            }
                        } else {

                            if(element_name == 'per_harga_satuan_text') {

                                $('#' + element_name).val(data['per_harga_satuan']);

                            } else if(element_name == 'satuan') {

                                $('#' + element_name).val(data[element_name] + ' (' + $.trim(data['deskripsi_satuan']) + ')');

                            } else if(element_name == 'harga_satuan' || element_name == 'harga_satuan_nego') {

                                $('#' + element_name).maskMoney('mask', data[element_name]);

                            } else if (element_name == 'deskripsi_material') {

                                var txt_desc_mat = (data[element_name] == '' || data[element_name] == null) ? '' : data[element_name];
                                var txt_dipakai  = (data['dipakai_untuk'] == '' || data['dipakai_untuk'] == null) ? '' : data['dipakai_untuk']; 
                                $('#' + element_name).val(txt_desc_mat + '\n' + txt_dipakai);

                            } else {

                                $('#' + element_name).val(data[element_name]);

                            }
                        }
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('negotiation/get_uploaded_rfq_files'); ?>",
                    data: {
                        val_1: '<?php echo $this->uri->segment(3); ?>',
                        val_2: 0
                    },
                    success: function(response) {
                        var obj = jQuery.parseJSON(response);
                        var i_file = '';
                        if (obj.code == 0) {
                            var uploaded_files = obj.data.length;
                            if (uploaded_files > 0) {
                                $.each(obj.data, function(index, value) {
                                    i_file += '<div class="row mb-3">';
                                    i_file += '<div class="col-lg-8" id="row_' + index + '"><input class="form-control form-control-solid" type="text" disabled value="' + value.nama_berkas_asli + '"></div>';
                                    i_file += '<div class="col-lg-2" id="link_' + index + '">';
                                    i_file += '<a href="<?php echo site_url('negotiation/download/'); ?>' + value.nama_berkas + '" class="btn btn-icon btn-sm btn-success me-2"><i class = "fas fa-download"></i></a>';
                                    i_file += '</div>';
                                    i_file += '</div>';
                                });
                            } else {
                                i_file += '<div class="row mb-3">';
                                i_file += '<div class="col-lg-8" id="row"><input class="form-control form-control-solid" type="text" disabled value="Tidak ada berkas yang diupload"></div>';
                                i_file += '</div>';
                            }
                        } else {
                            i_file += '<div class="row mb-3">';
                            i_file += '<div class="col-lg-8" id="row"><input class="form-control form-control-solid" type="text" disabled value="Tidak ada berkas yang diupload"></div>';
                            i_file += '</div>';
                        }
                        $("#input_file").html(i_file);
                    }
                });
            }),
            $('#kt_datatable_detail_nego_rfq_goods tbody').on('click', 'button.eqiv_form_1, button.eqiv_form_2, button.eqiv_form_3, button.eqiv_form_4', function() {
                blockModalEQIV.release();
                // Get DataTables row data
                var data = e.row($(this).parents('tr')).data();

                // Get button id
                var btn_id = $(this).attr('id');

                // Get sequence rfq (urutan rfq)
                var sequence_rfq =  btn_id.replace('btn_eqiv_', '');

                // Initialize modal form element
                var modal_form_eqiv = $("#kt_modal_det_nego_rfq_goods_ekuivalen_form");

                // Set Form Title
                $("#kt_modal_det_nego_rfq_goods_ekuivalen h4 span#txt_rfq_no_eqiv").text(data.nomor_rfq);
                $("#kt_modal_det_nego_rfq_goods_ekuivalen h4 span#txt_material_code_eqiv").text(data.kode_barang);
                $("#kt_modal_det_nego_rfq_goods_ekuivalen h4 span#txt_seq_eqiv").text(sequence_rfq);

                var total_request = data.jumlah_permintaan;

                // Get inputs array from modal equivalent form
                var $inputs = modal_form_eqiv.closest('div').find('input[type="hidden"], input.form-control, select.form-select, input.form-check-input, textarea.form-control');

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('negotiation/get_det_nego_goods_eqiv'); ?>",
                    data: {
                        nomor_rfq: data.nomor_rfq,
                        kode_barang: data.kode_barang,
                        ekuivalen: sequence_rfq
                    },
                    beforeSend: function() {
                        blockModalEQIV.block();
                    },
                    success: function(response) {
                        blockModalEQIV.release();
                        var obj = jQuery.parseJSON(response);
                        if(obj.code == 0) {
                            var data = obj.data;
                            $inputs.each(function(index, element) {
                                
                                // Get element class name
                                var element_class = element.getAttribute('class');

                                // Remove space character from element class name
                                var class_input = (element_class !== null) ? element_class.split(' ') : ['form-control'];

                                // Get inputs name
                                var $name = element.getAttribute('name');
                                console.log($name);
                                if($name !== null) {
                                    var element_name = $name.replace('_eqiv', '');
                                    console.log(element_name);
                                }

                                // Check if element has object in DataTables data row
                                if(data.hasOwnProperty(element_name)) {

                                    if(class_input[0] == 'form-select') {

                                        // If class name select, initialize to select2
                                        $('#' + $name).val(data[element_name]).trigger('change');

                                    } else if(class_input[0] == 'form-check-input') {

                                        // If class name checkbox or radio, set value to checked
                                        if(element.value == data[element_name]) {

                                            $('#' + $name + '[value="' + data[element_name] + '"]').prop('checked', true);

                                        }

                                        // Show / Hide element if checkbox or radio is checked
                                        if($('#' + $name + ':checked').val() == 0) {
                                            
                                            if($name == 'ketersediaan_barang_eqiv') {
                                                $("#form_status_ketersediaan_barang_eqiv").hide();
                                            } else {
                                                $("#form_convertion_eqiv").hide();
                                            }

                                        } else {

                                            if($name == 'ketersediaan_barang_eqiv') {
                                                $("#form_status_ketersediaan_barang_eqiv").show();
                                            } else {
                                                $("#form_convertion_eqiv").show();
                                            }

                                        }
                                    } else {

                                        if($name == 'per_harga_satuan_eqiv_text') {

                                            $('#' + $name).val(data['per_harga_satuan']);

                                        } else if($name == 'satuan_eqiv') {

                                            $('#' + $name).val(data[element_name] + ' (' + $.trim(data['deskripsi_satuan']) + ')');

                                        } else if($name == 'harga_satuan_eqiv' || $name == 'harga_satuan_nego_eqiv') {

                                            if(data[element_name] !== null) {
                                                $('#' + $name).maskMoney('mask', parseInt(data[element_name]));
                                            } else {
                                                $('#' + $name).val();
                                            }

                                        } else if($name == 'jumlah_tersedia_eqiv' || $name == 'jumlah_inden_eqiv' || $name == 'lama_inden_eqiv') {

                                            $('#' + $name).val(parseFloat(data[element_name]));

                                        } else if($name == 'jumlah_permintaan_eqiv') {
                                            
                                            $('#' + $name).val(parseFloat(total_request));

                                        }else if ($name == 'deskripsi_material') {

                                            var txt_desc_mat = (data[element_name] == '' || data[element_name] == null) ? '' : data[element_name];
                                            var txt_dipakai  = (data['dipakai_untuk'] == '' || data['dipakai_untuk'] == null) ? '' : data['dipakai_untuk']; 
                                            $('#' + element_name).val(txt_desc_mat + '\n' + txt_dipakai);

                                        } else {

                                            $('#' + $name).val(data[element_name]);

                                        }
                                    }
                                }

                            });

                            var i_file = '';
                            if (obj.files.length > 0) {
                                $.each(obj.files, function(index, value) {
                                    i_file += '<div class="row mb-3">';
                                    i_file += '<div class="col-lg-8" id="row_eqiv_' + index + '"><input class="form-control form-control-solid" type="text" disabled value="' + value.nama_berkas_asli + '"></div>';
                                    i_file += '<div class="col-lg-2" id="link_eqiv_' + index + '">';
                                    i_file += '<a href="<?php echo site_url('negotiation/download/'); ?>' + value.nama_berkas + '" class="btn btn-icon btn-sm btn-success me-2"><i class = "fas fa-download"></i></a>';
                                    i_file += '</div>';
                                    i_file += '</div>';
                                });
                            } else {
                                i_file += '<div class="row mb-3">';
                                i_file += '<div class="col-lg-8" id="row_eqiv"><input class="form-control form-control-solid" type="text" disabled value="Tidak ada berkas yang diupload"></div>';
                                i_file += '</div>';
                            }
                            $("#input_file_eqiv").html(i_file);
                            
                        } else {

                            Swal.fire({
                                text: "Maaf, data tidak ditemukan.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Tutup",
                                allowOutsideClick: false,
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                },
                            }).then(function(t) {
                                t.dismiss,
                                $("#kt_modal_det_nego_rfq_goods_ekuivalen").modal('hide');
                            });

                        }
                    },
                    error: function() {
                        blockModalEQIV.release();
                    }
                })
            });
        }
    };
})();

var KTModalForm = (function() {
    var m_det_nego, m_det_nego_container, f_det_nego, b_det_nego_submit, b_det_nego_cancel, b_det_nego_close, fv_det_nego;
    var m_det_nego_eqiv, m_det_nego_eqiv_container, f_det_nego_eqiv, b_det_nego_eqiv_submit, b_det_nego_eqiv_cancel, b_det_nego_eqiv_close, fv_det_nego_eqiv;
    var btn_submit, btn_cancel, btn_close, form_additional;
    return {
        det_nego_rfq_form: function() {
            (m_det_nego_container = document.querySelector("#kt_modal_det_nego_rfq_goods")) &&
            (
                (m_det_nego = new bootstrap.Modal(m_det_nego_container)),
                (f_det_nego = document.querySelector("#kt_modal_det_nego_rfq_goods_form")),
                (b_det_nego_submit = document.getElementById("kt_modal_det_nego_rfq_goods_submit")),
                (b_det_nego_cancel = document.getElementById("kt_modal_det_nego_rfq_goods_cancel")),
                (b_det_nego_close = document.querySelector('[data-kt-det-nego-rfq-goods-modal-action="close"]')),
                (
                    fv_det_nego = FormValidation.formValidation(f_det_nego, {
                        fields: {
                            harga_satuan_nego: {
                                validators: {
                                    notEmpty: {
                                        message: "Harga Satuan Nego tidak boleh kosong"
                                    },
                                    callback: {
                                        message: 'Harga Satuan Nego tidak boleh lebih besar dari Harga Satuan',
                                        callback: function(input) {
                                            const inputHargaSatuan = f_det_nego.querySelector('[name="harga_satuan"]');
                                            // const convertion = selectedCheckbox ? selectedCheckbox.value : '';
                                            console.log(input.value.replace(/[.]/g, ''));
                                            console.log(inputHargaSatuan.value.replace(/[.]/g, ""));
                                            return (parseFloat(input.value.replace(/[.]/g, '')) < parseFloat(inputHargaSatuan.value.replace(/[.]/g, "")))
                                                // The field is valid if user picks
                                                // a given convertion from the list
                                                ?
                                                true
                                                // Otherwise, the field value is required
                                                :
                                                (parseFloat(input.value.replace(/[.]/g, '')) <= parseFloat(inputHargaSatuan.value.replace(/[.]/g, "")));
                                        }
                                    }
                                }
                            },
                            // keterangan_nego: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Keterangan Nego tidak boleh kosong"
                            //         }
                            //     }
                            // }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger({
                                event: 'keyup'
                            }),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: ""
                            })
                        },
                    })
                ),
                // Submit Button Action
                b_det_nego_submit.addEventListener("click", function(event) {
                    event.preventDefault(),
                    fv_det_nego && fv_det_nego.validate().then(function(v) {
                        // Set data to send from form
                        var formData = new FormData(f_det_nego);
                        "Valid" == v ?
                        (
                            Swal.fire({
                                text: "Pastikan data yang Anda isi sudah benar dan dapat dipertanggung jawabkan, karena data yang telah disimpan akan terkirim langsung ke Socfindo",
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: "Ya, Simpan",
                                cancelButtonText: "Kembali",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                    cancelButton: "btn btn-active-light"
                                },
                            }).then(function(r) {
                                r.value ?
                                (
                                    $.ajax({
                                        type: 'POST',
                                        url: f_det_nego.getAttribute('action'),
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        beforeSend: function() {
                                            b_det_nego_submit.setAttribute("data-kt-indicator", "on"), (b_det_nego_submit.disabled = !0),
                                            (b_det_nego_cancel.disabled = !0), (b_det_nego_close.disabled = !0);
                                        },
                                        success: function(response) {
                                            var obj = jQuery.parseJSON(response);
                                            b_det_nego_submit.removeAttribute("data-kt-indicator"), (b_det_nego_submit.disabled = !1),
                                            (b_det_nego_cancel.disabled = !1), (b_det_nego_close.disabled = !1);
                                            Swal.fire({
                                                text: obj.msg,
                                                icon: obj.status,
                                                buttonsStyling: !1,
                                                confirmButtonText: "Tutup",
                                                customClass: {
                                                    confirmButton: "btn btn-primary"
                                                }
                                            }).then(
                                                function(t) {
                                                    t.isConfirmed && (obj.code == 0) ? (KTDataTables.init(), fv_det_nego.resetForm(true), m_det_nego.hide()) : r.dismiss;
                                                }
                                            );
                                        },
                                        error: function() {
                                            b_det_nego_submit.removeAttribute("data-kt-indicator"), (b_det_nego_submit.disabled = !1),
                                            (b_det_nego_cancel.disabled = !1), (b_det_nego_close.disabled = !1);
                                            Swal.fire({
                                                text: "Terjadi masalah koneksi",
                                                icon: "error",
                                                buttonsStyling: !1,
                                                confirmButtonText: "Tutup",
                                                customClass: {
                                                    confirmButton: "btn btn-primary"
                                                }
                                            }).then(
                                                function(t) {
                                                    t.isConfirmed && r.dismiss;
                                                }
                                            );
                                        }
                                    })
                                )
                                :
                                "cancel" === r.dismiss;
                            })
                        )
                        :
                        Swal.fire({
                            text: "Maaf, masih ada field yang kosong, silahkan diisi.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Tutup",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            },
                        });
                    })
                }),
                b_det_nego_cancel.addEventListener("click", function(event) {
                    fv_det_nego.resetForm(true), m_det_nego.hide();
                }),
                b_det_nego_close.addEventListener("click", function(event) {
                    fv_det_nego.resetForm(true), m_det_nego.hide();
                })
            );
        },
        det_nego_rfq_eqiv_form: function() {
            (m_det_nego_eqiv_container = document.querySelector("#kt_modal_det_nego_rfq_goods_ekuivalen")) &&
            (
                (m_det_nego_eqiv = new bootstrap.Modal(m_det_nego_eqiv_container)),
                (f_det_nego_eqiv = document.querySelector("#kt_modal_det_nego_rfq_goods_ekuivalen_form")),
                (b_det_nego_eqiv_submit = document.getElementById("kt_modal_det_nego_rfq_goods_ekuivalen_submit")),
                (b_det_nego_eqiv_cancel = document.getElementById("kt_modal_det_nego_rfq_goods_ekuivalen_cancel")),
                (b_det_nego_eqiv_close = document.querySelector('[data-kt-det-nego-rfq-goods-ekuivalen-modal-action="close"]')),
                (
                    fv_det_nego_eqiv = FormValidation.formValidation(f_det_nego_eqiv, {
                        fields: {
                            harga_satuan_nego_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Harga Satuan Nego tidak boleh kosong"
                                    },
                                    callback: {
                                        message: "Harga Satuan Nego tidak boleh kosong",
                                        callback: function(input) {
                                            const inputHargaSatuanEqiv = f_det_nego_eqiv.querySelector('[name="harga_satuan_eqiv"]');

                                            // return (parseFloat(input.value.replace(/[.]/g, '')) < parseFloat(inputHargaSatuanEqiv.value.replace(/[.]/g, "")))
                                            //     // The field is valid if user picks
                                            //     // a given convertion from the list
                                            //     ?
                                            //     true
                                            //     // Otherwise, the field value is required
                                            //     :
                                            //     (parseFloat(input.value.replace(/[.]/g, '')) <= parseFloat(inputHargaSatuanEqiv.value.replace(/[.]/g, "")));

                                            if(parseFloat(input.value.replace(/[.]/g, '')) > parseFloat(inputHargaSatuanEqiv.value.replace(/[.]/g, ""))){
                                                return {
                                                    valid: false,
                                                    message: "Harga Satuan Nego tidak boleh lebih dari Harga Satuan"
                                                }
                                            } else {
                                                return true;
                                            }
                                        }
                                    }
                                }
                            },
                            // keterangan_nego_eqiv: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Keterangan Nego tidak boleh kosong"
                            //         }
                            //     }
                            // }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger({
                                event: 'keyup'
                            }),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: ""
                            })
                        },
                    })
                ),
                // Submit Button Action
                b_det_nego_eqiv_submit.addEventListener("click", function(event) {
                    event.preventDefault(),
                    fv_det_nego_eqiv && fv_det_nego_eqiv.validate().then(function(v) {
                        // Set data to send from form
                        var formData = new FormData(f_det_nego_eqiv);
                        "Valid" == v ?
                        (
                            Swal.fire({
                                text: "Pastikan data yang Anda isi sudah benar dan dapat dipertanggung jawabkan, karena data yang telah disimpan akan terkirim langsung ke Socfindo",
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: "Ya, Simpan",
                                cancelButtonText: "Kembali",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                    cancelButton: "btn btn-active-light"
                                },
                            }).then(function(r) {
                                r.value ?
                                (
                                    $.ajax({
                                        type: 'POST',
                                        url: f_det_nego_eqiv.getAttribute('action'),
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        beforeSend: function() {
                                            b_det_nego_eqiv_submit.setAttribute("data-kt-indicator", "on"), (b_det_nego_eqiv_submit.disabled = !0),
                                            (b_det_nego_eqiv_cancel.disabled = !0), (b_det_nego_eqiv_close.disabled = !0);
                                        },
                                        success: function(response) {
                                            var obj = jQuery.parseJSON(response);
                                            b_det_nego_eqiv_submit.removeAttribute("data-kt-indicator"), (b_det_nego_eqiv_submit.disabled = !1),
                                            (b_det_nego_eqiv_cancel.disabled = !1), (b_det_nego_eqiv_close.disabled = !1);
                                            Swal.fire({
                                                text: obj.msg,
                                                icon: obj.status,
                                                buttonsStyling: !1,
                                                confirmButtonText: "Tutup",
                                                customClass: {
                                                    confirmButton: "btn btn-primary"
                                                }
                                            }).then(
                                                function(t) {
                                                    t.isConfirmed && (obj.code == 0) ? (KTDataTables.init(), fv_det_nego_eqiv.resetForm(true), m_det_nego_eqiv.hide()) : r.dismiss;
                                                }
                                            );
                                        },
                                        error: function() {
                                            b_det_nego_eqiv_submit.removeAttribute("data-kt-indicator"), (b_det_nego_eqiv_submit.disabled = !1),
                                            (b_det_nego_eqiv_cancel.disabled = !1), (b_det_nego_eqiv_close.disabled = !1);
                                            Swal.fire({
                                                text: "Terjadi masalah koneksi",
                                                icon: "error",
                                                buttonsStyling: !1,
                                                confirmButtonText: "Tutup",
                                                customClass: {
                                                    confirmButton: "btn btn-primary"
                                                }
                                            }).then(
                                                function(t) {
                                                    t.isConfirmed && r.dismiss;
                                                }
                                            );
                                        }
                                    })
                                )
                                :
                                "cancel" === r.dismiss;
                            })
                        )
                        :
                        Swal.fire({
                            text: "Maaf, masih ada field yang kosong, silahkan diisi.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Tutup",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            },
                        });
                    })
                }),
                b_det_nego_eqiv_cancel.addEventListener("click", function(event) {
                    fv_det_nego_eqiv.resetForm(true), m_det_nego_eqiv.hide();
                }),
                b_det_nego_eqiv_close.addEventListener("click", function(event) {
                    fv_det_nego_eqiv.resetForm(true), m_det_nego_eqiv.hide();
                })
            )
        },
        additional_form: function() {
                (form_additional = document.querySelector("#kt_modal_additional_price_form")),
                (btn_submit = document.getElementById("kt_modal_additional_price_submit")),
                (btn_cancel = document.getElementById("kt_modal_additional_price_cancel")),
                (btn_close = document.querySelector('[data-kt-additional-price-modal-action="close"]')),
                btn_submit.addEventListener("click", function(e) {
                    e.preventDefault();
                    var count_invalid = 0;
                    $('input[name="add_price_nego[]"]').each(function(key, value) {
                        if($(this).val() == '') {
                            count_invalid = count_invalid + 1;
                        }
                    });
                    var count_element = $('input[name="add_price_nego[]"]').length;
                    if(count_invalid === count_element) {
                        Swal.fire({
                            text: "Silahkan isi salah 1 dari "+ count_element +" data biaya lainnya.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Tutup",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            },
                        });
                    } else {
                        $('div[id^="el_add_"]').each(function(key, value) {
                            $("#"+value.id).find('select[id^="add_price_type_').removeAttr('disabled');
                        });

                        var formData = new FormData(form_additional);
                        $.ajax({
                            type: 'POST',
                            url: form_additional.getAttribute('action'),
                            data: formData,
                            processData: false,
                            contentType: false,
                            beforeSend: function() {
                                btn_submit.setAttribute("data-kt-indicator", "on"),(btn_submit.disabled = !0);
                            },
                            success: function(response) {
                                var obj = jQuery.parseJSON(response);
                                btn_submit.removeAttribute("data-kt-indicator"),(btn_submit.disabled = !1);
                                Swal.fire({
                                    text: obj.msg,
                                    icon: obj.status,
                                    buttonsStyling: !1,
                                    confirmButtonText: "Tutup",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(
                                    function(t) {
                                        t.isConfirmed && (obj.code == 0) ? (modal_additional.hide(), Elements.on_close_modal()) : r.dismiss;
                                    }
                                );
                            },
                            error: function() {
                                btn_submit.removeAttribute("data-kt-indicator"),(btn_submit.disabled = !1);
                                Swal.fire({
                                    text: "Terjadi masalah koneksi",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Tutup",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(
                                    function(t) {
                                        t.isConfirmed && r.dismiss;
                                    }
                                );
                            }
                        })
                    }
                }),
                btn_cancel.addEventListener("click", function(e) {
                    modal_additional.hide(), Elements.on_close_modal();
                }),
                btn_close.addEventListener("click", function(e) {
                    modal_additional.hide(), Elements.on_close_modal();
                })
            }
    }
})();

var MaskMoney = (function() {
    return {
        init: function() {
            $(".mask-money").maskMoney({
                thousands: '.',
                decimal: ',',
                affixesStay: false,
                precision: 0
            });
        }
    }
})();

var Elements = (function() {
    return {
        add_row: function() {
            // get the last DIV which ID starts with ^= "klon"
            var $div = $('div[id^="el_add_"]:last');
            var num = parseInt( $div.prop("id").match(/\d+/g), 10 );
            
            if($('div[id^="el_add_"]').length < 4) {

                $('div[id^="el_add_"]').each(function(key, value) {
                    $("#"+value.id).find('select[id^="add_price_type_').select2('destroy');
                    $("#"+value.id).find('select[id^="add_currency_').select2('destroy');
                });
                
                // Read the Number from that DIV's ID (i.e: 3 from "klon3")
                // And increment that number by 1
                var next = num+1;

                // Clone it and assign the new ID (i.e: from num 4 to ID "klon4")
                var $klon = $div.clone().prop('id', 'el_add_'+next );
                
                $klon.closest('div').find('select[id^="add_price_type_"]').prop('id', 'add_price_type_'+next);
                $klon.closest('div').find('input[id^="add_price_"]').prop('id', 'add_price_'+next).val('');
                $klon.closest('div').find('select[id^="add_currency_"]').prop('id', 'add_currency_'+next);
                $klon.closest('div').find('input[id^="add_price_nego_"]').prop('id', 'add_price_nego_'+next).val('');

                // Finally insert $klon wherever you want
                $div.after( $klon );

                $('div[id^="el_add_"]').each(function(key, value) {
                    $("#"+value.id).find('select[id^="add_price_type_').select2();
                    $("#"+value.id).find('select[id^="add_currency_').select2();
                });
            }

            Elements.inputMask();
        },
        inputMask: function() {
            $("input[id^=add_price_], input[id^=add_price_nego_]").maskMoney({
                thousands: '.',
                decimal: ',',
                affixesStay: false,
                precision: 0
            });
        },
        on_close_modal: function() {
            modal_additional_container.addEventListener('hidden.bs.modal', function () {
                $('div[id^="el_add_"]').not(':first').remove();
            });
        }
    }
})();

KTUtil.onDOMContentLoaded((function() {
    KTDataTables.init();
    KTModalForm.det_nego_rfq_form();
    KTModalForm.det_nego_rfq_eqiv_form();
    KTModalForm.additional_form();
    MaskMoney.init();
    Elements.inputMask();
    $("#kt_daterangepicker_3").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: new Date().getFullYear() - 5,
        maxYear: parseInt(moment().format("YYYY"),10)
        // maxYear: new Date().getFullYear() + 5
    }, function(start, end, label) {
        var years = moment().diff(start, "years");
        alert("You are " + years + " years old!");
    });
}));
</script>