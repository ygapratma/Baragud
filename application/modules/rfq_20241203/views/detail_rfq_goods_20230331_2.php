
<script src="<?php echo base_url(); ?>assets/plugins/custom/jquery-maskMoney/jquery.maskMoney.js"></script>
<div class="card shadow-sm">
    <div class="card-header bg-success">
        <div class="card-toolbar">
            <a href="<?php echo site_url('rfq/rfq_goods'); ?>" class="btn btn-sm btn-bg-white btn-icon me-2 mb-2">
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
        <table id="kt_datatable_detail_rfq_goods" class="align-middle table table-row-bordered gy-5">
            <thead>
                <tr class="fw-bold fs-6 text-muted">
                    <th class="min-w-50px text-center">No.</th>
                    <th class="min-w-50px text-center">Kode Material</th>
                    <th class="min-w-125px text-center">Nama Material</th>
                    <!-- <th class="min-w-125px text-center">Berkas</th> -->
                    <th class="min-w-50px text-center">Jumlah Permintaan</th>
                    <th class="min-w-50px text-center">Satuan Permintaan</th>
                    <th class="min-w-50px text-center">Status</th>
                    <th class="min-w-50px text-center">Harga Sesuai Permintaan</th>
                    <!-- <th class="min-w-50px text-center">Status Harga Ekuivalen</th> -->
                    <th class="min-w-200px text-center">Harga Permintaan Ekuivalen</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="kt_modal_det_rfq_goods" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="min-width:1280px;">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Pengisian RFQ</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-light ms-2" data-kt-det-rfq-goods-modal-action="close" aria-label="Close">
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

            <form id="kt_modal_det_rfq_goods_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" enctype="multipart/form-data" action="<?php echo site_url('rfq/save_rfq'); ?>">
                <!--begin::Modal body-->
                <div class="modal-body py-4 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_det_rfq_goods_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_det_rfq_goods_header" data-kt-scroll-wrappers="#kt_modal_det_rfq_goods_scroll" data-kt-scroll-offset="300px" style="max-height: 144px;">
                        <div class="fw-bold">
                            <h4 class="text-gray-900 fw-bolder">RFQ No : <span id="txt_rfq_no"></span> | <span id="txt_material_code"></span></h4>
                        </div>
                        <input type="hidden" name="id_rfq">
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Kode Material</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="material_code" class="form-control form-control-solid" readonly="true" placeholder="Kode Material">
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
                                <input type="text" name="material_name" class="form-control form-control-solid" readonly="true" placeholder="Nama Material">
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
                                <textarea class="form-control form-control-solid" readonly="true"  name="material_desc" rows="4"></textarea>
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
                                <input type="number" name="request_total" class="form-control form-control-solid" readonly="true" placeholder="Jumlah Permintaan">
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
                                <input type="text" name="measurement" class="form-control form-control-solid" readonly="true" placeholder="Satuan">
                                <input type="hidden" name="r_measurement">
                                <input type="hidden" name="desc_measure">
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
                                        <input class="form-check-input" name="available" type="radio" value="0">
                                        <span class="fw-bold ps-2 fs-6">Tersedia</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <input class="form-check-input" name="available" type="radio" value="1" checked="true">
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
                                    <input type="number" name="available_total" id="available_total" class="form-control" placeholder="Jumlah Tersedia" min="0">
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
                                    <input type="number" name="indent_total" id="indent_total" class="form-control form-control-solid" readonly="true" placeholder="Jumlah Indent" min="0">
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
                                    <input type="number" name="indent_day" id="indent_day" class="form-control" placeholder="Lama Indent (Hari)" min="0">
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
                                <select class="form-select form-select-solid" name="currency" id="currency" data-control="select2" data-dropdown-parent="#kt_modal_det_rfq_goods" data-placeholder="Pilih Mata Uang">
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
                            <label class="col-lg-4 col-form-label fw-bold fs-6">Harga Satuan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                <input type="text" name="unit_price" class="form-control" placeholder="Harga Satuan">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Label-->
                            <label class="col-lg-1 col-form-label required fw-bold fs-6">Per</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row fv-plugins-icon-container">
                                <!-- <input type="text" name="unit_measure" class="form-control" placeholder="Satuan"> -->
                                <select class="form-select form-select-solid" disabled name="unit_measure" id="unit_measure" data-control="select2" data-dropdown-parent="#kt_modal_det_rfq_goods" data-placeholder="Pilih Satuan">
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
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Apakah ada konversi?</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <div class="align-items-center mt-3">
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid me-5">
                                        <input class="form-check-input" name="convert" type="radio" value="1">
                                        <span class="fw-bold ps-2 fs-6">Ya</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <input class="form-check-input" name="convert" type="radio" value="0" checked="true">
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
                                                <input type="text" name="convertion_measure" class="form-control form-control-solid text-center" readonly="true">
                                            </td>
                                            <td class="text-center">=</td>
                                            <td class="text-center">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control" name="convertion_qty" placeholder="Konversi Jumlah">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <!-- <input type="text" name="measurement" class="form-control form-control-solid" readonly="true"> -->
                                                <select class="form-select form-select-solid" disabled name="convertion_measurement" id="convertion_measurement" data-control="select2" data-dropdown-parent="#kt_modal_det_rfq_goods" data-placeholder="Pilih Satuan">
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
                            <label class="col-lg-4 col-form-label fw-bold fs-6">Masa Berlaku Harga</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container" id="mbh_rfq">
                                <input class="form-control form-control-solid" name="ed_price" placeholder="Masa Berlaku Harga" id="kt_daterangepicker_3" readonly/>
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
                                <textarea class="form-control" name="notes" placeholder="Keterangan" rows="5"></textarea>
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
                                <input class="form-control" name="created_by" placeholder="Dibuat oleh" />
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">File Brosur</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container" id="input_file">
                                <!-- <span class="form-text text-muted">File yang diperbolehkan JPG, JPEG, PNG, & PDF.</span> -->
                                <span class="form-text text-muted">File yang diperbolehkan .PDF</span>
                                <div class="mb-3">
                                    <input class="form-control rfq_file" type="file"  name="rfq_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control rfq_file" type="file" name="rfq_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control rfq_file" type="file" name="rfq_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control rfq_file" type="file" name="rfq_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control rfq_file" type="file" name="rfq_file[]">
                                </div>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
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
                    <button type="reset" id="kt_modal_det_rfq_goods_cancel" class="btn btn-light me-3">Tutup</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_det_rfq_goods_submit" class="btn btn-primary">
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
<div class="modal fade" tabindex="-1" id="kt_modal_det_rfq_goods_ekuivalen" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="min-width:1280px;">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Pengisian Ekuivalen</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-light ms-2" data-kt-det-rfq-goods-ekuivalen-modal-action="close" aria-label="Close">
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

            <form id="kt_modal_det_rfq_goods_ekuivalen_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" enctype="multipart/form-data" action="<?php echo site_url('rfq/save_eqiv'); ?>">
                <!--begin::Modal body-->
                <div class="modal-body py-4 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_det_rfq_goods_ekuivalen_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_det_rfq_goods_ekuivalen_header" data-kt-scroll-wrappers="#kt_modal_det_rfq_goods_ekuivalen_scroll" data-kt-scroll-offset="300px" style="max-height: 144px;">
                        <div class="fw-bold">
                            <h4 class="text-gray-900 fw-bolder">RFQ No : <span id="txt_rfq_no_eqiv"></span> | <span id="txt_material_code_eqiv"></span> | <span id="txt_seq_eqiv"></span></h4>
                        </div>
                        <input type="hidden" name="id_rfq_eqiv">
                        <input type="hidden" name="id_eqiv">
                        <!-- <input type="hidden" name="seq_eqiv"> -->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Kode Material</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="material_code_eqiv" class="form-control form-control-solid" readonly="true" placeholder="Kode Material">
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
                                <input type="text" name="material_name_eqiv" class="form-control form-control-solid" readonly="true" placeholder="Nama Material">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6"> </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <textarea class="form-control form-control-solid" readonly="true" name="material_desc_eqiv" rows="4"></textarea>
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
                                <input type="number" name="request_total_eqiv" class="form-control form-control-solid" readonly="true" placeholder="Jumlah Permintaan">
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
                                <input type="text" name="measurement_eqiv" class="form-control form-control-solid" readonly="true" placeholder="Satuan">
                                <input type="hidden" name="r_measurement_eqiv">
                                <input type="hidden" name="desc_measure_eqiv">
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
                                <textarea rows="5" name="specification_eqiv" class="form-control" placeholder="Spesifikasi"></textarea>
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
                                <input type="text" name="merk_eqiv" class="form-control" placeholder="Merek">
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
                                <input type="text" name="type_eqiv" class="form-control" placeholder="Tipe">
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
                                <input type="text" name="made_eqiv" class="form-control" placeholder="Buatan">
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
                                        <input class="form-check-input" name="available_eqiv" type="radio" value="0" checked="true">
                                        <span class="fw-bold ps-2 fs-6">Tersedia</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <input class="form-check-input" name="available_eqiv" type="radio" value="1">
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
                                    <input type="number" name="available_total_eqiv" id="available_total_eqiv" class="form-control" placeholder="Jumlah Tersedia" min="0">
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
                                    <input type="number" name="indent_total_eqiv" id="indent_total_eqiv" class="form-control form-control-solid" readonly="true" placeholder="Jumlah Indent" min="0">
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
                                    <input type="number" name="indent_day_eqiv" id="indent_day_eqiv" class="form-control" placeholder="Lama Indent (Hari)" min="0">
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
                                <!-- <input class="form-control" name="currency_eqiv" placeholder="Mata Uang" id="" /> -->
                                <select class="form-select form-select-solid" name="currency_eqiv" id="currency_eqiv" data-control="select2" data-dropdown-parent="#kt_modal_det_rfq_goods_ekuivalen" data-placeholder="Pilih Mata Uang">
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
                            <label class="col-lg-4 col-form-label fw-bold fs-6">Harga Satuan</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                <input type="text" name="unit_price_eqiv" class="form-control" placeholder="Harga Satuan">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Label-->
                            <label class="col-lg-1 col-form-label required fw-bold fs-6">Per</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row fv-plugins-icon-container">
                                <!-- <input type="text" name="unit_measure_eqiv" class="form-control" placeholder="Satuan"> -->
                                <select class="form-select form-select-solid" disabled name="unit_measure_eqiv" id="unit_measure_eqiv" data-control="select2" data-dropdown-parent="#kt_modal_det_rfq_goods_ekuivalen" data-placeholder="Pilih Satuan">
                                    <?php
                                    foreach ($UoMs as $UoM) {
                                    ?>
                                        <option value="<?php echo $UoM->satuan; ?>"><?php echo $UoM->satuan; ?> (<?php echo $UoM->deskripsi_satuan; ?>)</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="temp_unit_measure_eqiv">
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
                                        <input class="form-check-input" name="convert_eqiv" type="radio" value="1">
                                        <span class="fw-bold ps-2 fs-6">Ya</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <input class="form-check-input" name="convert_eqiv" type="radio" value="0" checked="true">
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
                                                <input type="text" name="convertion_measure_eqiv" class="form-control form-control-solid text-center" readonly="true">
                                            </td>
                                            <td class="text-center">=</td>
                                            <td class="text-center">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control" name="convertion_qty_eqiv" placeholder="Konversi Jumlah">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <!-- <input type="text" name="measurement_eqiv" class="form-control form-control-solid" readonly="true"> -->
                                                <select class="form-select form-select-solid" disabled name="convert_measurement_eqiv" id="convert_measurement_eqiv" data-control="select2" data-dropdown-parent="#kt_modal_det_rfq_goods_ekuivalen" data-placeholder="Pilih Satuan">
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
                            <label class="col-lg-4 col-form-label fw-bold fs-6">Masa Berlaku Harga</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container" id="mbh_eqiv">
                                <input class="form-control form-control-solid" readonly name="ed_price_eqiv" placeholder="Masa Berlaku Harga" id="kt_daterangepicker_4" readonly/>
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
                                <!-- <input class="form-control" name="notes_eqiv" placeholder="Keterangan" id=""/> -->
                                <textarea class="form-control" name="notes_eqiv" placeholder="Keterangan" rows="5"></textarea>
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
                                <input class="form-control" name="created_by_eqiv" placeholder="Dibuat Oleh" id="" />
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">File Brosur</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container" id="input_file_eqiv">
                                <!-- <span class="form-text text-muted">File yang diperbolehkan JPG, JPEG, PNG, & PDF.</span> -->
                                <span class="form-text text-muted">File yang diperbolehkan .PDF</span>
                                <div class="mb-3">
                                    <input class="form-control eqiv_file" type="file" name="eqiv_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control eqiv_file" type="file" name="eqiv_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control eqiv_file" type="file" name="eqiv_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control eqiv_file" type="file" name="eqiv_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control eqiv_file" type="file" name="eqiv_file[]">
                                </div>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
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
                    <button type="reset" id="kt_modal_det_rfq_goods_ekuivalen_cancel" class="btn btn-light me-3">Tutup</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_det_rfq_goods_ekuivalen_submit" class="btn btn-primary">
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

            <form id="kt_modal_additional_price_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" action="<?php echo site_url('rfq/save_other'); ?>">
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
                                <select class="form-select form-select-solid" name="add_price_type[]" id="add_price_type_1" data-control="select2" data-dropdown-parent="#kt_modal_additional_price" data-placeholder="Pilih Biaya Lainnya">
                                    <option value="ZFR1_Freight Cost - Taxable">Freight Cost - Taxable</option>
                                    <option value="ZFR2_Freight Cost - Non Taxable">Freight Cost - Non Taxable</option>
                                    <option value="ZFIN_Freight & Insurance">Freight & Insurance</option>
                                    <option value="ZINS_Insurance">Insurance</option>
                                </select>
                                <!-- <div class="fv-plugins-message-container invalid-feedback"></div> -->
                            </div>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row fv-plugins-icon-container">
                                <input type="text" name="add_price[]" id="add_price_1" class="form-control add_price_val" placeholder="">
                                <!-- <div class="fv-plugins-message-container invalid-feedback"></div> -->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                <select class="form-select form-select-solid" name="add_currency[]" id="add_currency_1" data-control="select2" data-dropdown-parent="#kt_modal_additional_price" data-placeholder="Pilih Mata Uang">
                                    <?php
                                    foreach ($currencies as $currency) {
                                    ?>
                                        <option value="<?php echo $currency->kode_uang; ?>" <?php echo ($currency->kode_uang == 'IDR') ? 'selected' : ''; ?>><?php echo $currency->kode_uang; ?> (<?php echo $currency->deskripsi; ?>)</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- <div class="fv-plugins-message-container invalid-feedback"></div> -->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-2 fv-row fv-plugins-icon-container">
                                <button type="button" id="btn_add_1" class="btn btn-sm btn-bg-success btn-icon me-2 mb-2" onclick="return Elements.add_row();">
                                    <i class="las la-plus fs-1 text-white"></i>
                                </button>
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
        const target = document.querySelector("#kt_modal_det_rfq_goods_ekuivalen .modal-content");
        const blockUI = new KTBlockUI(target);
        const loading = new KTBlockUI(document.querySelector("#kt_content"), {
            overlayClass: "bg-dark bg-opacity-10",
        });
        return {
            init: function() {
                e = $("#kt_datatable_detail_rfq_goods").DataTable({
                        processing: !0,
                        serverSide: !0,
                        destroy: !0,
                        // responsive: !0,
                        scrollX: !0,
                        dom: "<'row'<'col-sm-6 col-md-6 col-lg-6 d-flex align-items-center'B><'col-sm-6 col-md-6 col-lg-6'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-1'l><'col-sm-12 col-md-3'i><'col-sm-12 col-md-8'p>>",
                        buttons: [
                            {
                                text: 'Biaya Lainnya',
                                className: 'btn btn-sm btn-success',
                                action: function ( e, dt, node, config ) {
                                    // loading.release();
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo site_url('rfq/get_other_data') ?>",
                                        data: { id: $('input[name=id_rfq_other]').val() },
                                        beforeSend: function() {
                                            loading.block();
                                        },
                                        success: function(response) {
                                            var obj = jQuery.parseJSON(response);
                                            if(obj.data.length > 0) {
                                                if(obj.data.length > 1) {
                                                    // console.log($("div[id^=el_add_]").length);
                                                    for(var i = 0; i < obj.data.length - 1; i++) {
                                                        Elements.add_row();
                                                    }
                                                }

                                                $("div[id^=el_add_]").each( function(key, value) {
                                                    $("#add_price_type_"+(key+1)).val(obj.data[key].kode_biaya+'_'+obj.data[key].deskripsi_biaya).trigger('change');
                                                    $("#add_price_"+(key+1)).maskMoney('mask', parseInt(obj.data[key].jumlah_biaya));
                                                    $("#add_currency_"+(key+1)).val($.trim(obj.data[key].mata_uang)).trigger('change');
                                                }),
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
                            url: "<?php echo site_url('rfq/det_rfq_goods/' . $this->uri->segment(3)); ?>"
                        },
                        columns: [{
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
                            // {
                            //     data: 'berkas',
                            //     className: 'text-center'
                            // },
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
                    $('#kt_datatable_detail_rfq_goods tbody').on('click', 'button.rfq_form', function() {
                        blockUI.release();
                        $("#input_file div").remove();
                        var data = e.row($(this).parents('tr')).data();
                        var material_desc_val = '';
                        var txt_desc_mat = '';
                        var txt_dipakai = '';
                        var last_char = '';
                        $("#kt_modal_det_rfq_goods h4 span#txt_rfq_no").text(data.nomor_rfq);
                        $("#kt_modal_det_rfq_goods h4 span#txt_material_code").text(data.kode_barang);
                        $("input[name=id_rfq]").val('<?php echo $this->uri->segment(3); ?>');
                        $("input[name=unit_price]").maskMoney('mask', data.harga_satuan);
                        $('#unit_measure').val(data.satuan).trigger('change');
                        $("#currency").val('IDR').trigger('change');
                        $("input[name=material_code]").val(data.kode_barang);
                        $("input[name=material_name]").val(data.deskripsi_barang);
                        txt_desc_mat = (data.deskripsi_material == '' || data.deskripsi_material == null) ? '' : data.deskripsi_material;
                        txt_dipakai = (data.dipakai_untuk == '' || data.dipakai_untuk == null) ? ' - ' : $.trim(data.dipakai_untuk);
                        last_char = txt_dipakai.slice(-1);
                        txt_dipakai = (last_char == '&') ? txt_dipakai.slice(0, -2) : txt_dipakai;
                        material_desc_val = txt_desc_mat + '\n' + 'Dipakai untuk : ' + txt_dipakai;
                        $("textarea[name=material_desc]").val(material_desc_val);
                        $("input[name=request_total]").val(data.jumlah_permintaan);
                        $("input[name=measurement]").val(data.satuan + ' (' + data.deskripsi_satuan + ')');
                        $("input[name=r_measurement]").val($.trim(data.satuan));
                        $("input[name=desc_measure]").val($.trim(data.deskripsi_satuan));
                        $('input[name="convert"][value="0"]').prop('checked', true);
                        if ($('input[name="convert"]:checked').val() == 0) {
                            $('#unit_measure').attr('disabled', 'disabled');
                            $("#form_convertion").hide();
                        } else {
                            $('#unit_measure').removeAttr('disabled');
                            $("#form_convertion").show();
                        }
                        $('input[name="available"][value="0"]').prop('checked', true);
                        $("input[name=ed_price]").val(Elements.get_date());
                        $("input[name=available_total]").val(0);
                        $("input[name=indent_total]").val(0);
                        $("input[name=indent_day]").val(0);

                        // Status Ketersediaan Barang
                        if ($('input[name="available"]:checked').val() == 0) { // Checked Tersedia
                            $("#form_status_ketersediaan_barang").hide();
                        } else {    // Checked Indent
                            $("#form_status_ketersediaan_barang").show();
                        }

                        var i_file = '';
                        for (var i = 0; i < 5; i++) {
                            i_file += '<div class="row mb-3">';
                            i_file += '<div class="col-lg-8"><input class="form-control rfq_file" type="file" accept="application/pdf" name="rfq_file[]"></div>';
                            i_file += '</div>';
                        }
                        $("#input_file span").after(i_file);

                        if (data.modified_date != null && data.modified_by != null) {
                            $("#currency").val(data.mata_uang).trigger('change');
                            $("#unit_measure").val(data.per_harga_satuan).trigger('change');
                            $('input[name="convert"][value="' + data.konversi + '"]').prop('checked', true);
                            if ($('input[name="convert"]:checked').val() == 0) {
                                $('#unit_measure').attr('disabled', 'disabled');
                                $("#form_convertion").hide();
                            } else {
                                $('#unit_measure').removeAttr('disabled');
                                $("#form_convertion").show();
                                $("input[name=convertion_qty]").val(parseInt(data.jumlah_konversi));
                                $("input[name=convertion_measure]").val($("#unit_measure").select2('data')[0].text);
                                $("select[name=convertion_measurement]").val(data.satuan_konversi).trigger('change');
                            }
                            $('input[name="available"][value="' + data.ketersediaan_barang + '"]').prop('checked', true);
                            if ($('input[name="available"]:checked').val() == 0) { // Status Ketersediaan Barang = Tersedia
                                    $("#form_status_ketersediaan_barang").hide();
                                    $('#available_total').val(0);
                                    $('#indent_total').val(0);
                                    $('#indent_day').val(0);
                            } else { // Status Ketersediaan Barang = Tersedia
                                $("#form_status_ketersediaan_barang").show();
                                $('#available_total').val(parseFloat(data.jumlah_tersedia));
                                $('#indent_total').val(parseFloat(data.jumlah_inden));
                                $('#indent_day').val(parseFloat(data.lama_inden));
                            }

                            $("input[name=ed_price]").val(data.masa_berlaku_harga);
                            $("textarea[name=notes]").val(data.keterangan);
                            $("input[name=created_by]").val(data.dibuat_oleh);

                            $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('rfq/get_files'); ?>",
                                data: {
                                    val_1: '<?php echo $this->uri->segment(3); ?>',
                                    val_2: 0,
                                    val_3: data.kode_barang
                                },
                                beforeSend: function() {
                                    blockUI.block();
                                },
                                success: function(response) {
                                    blockUI.release();
                                    var obj = jQuery.parseJSON(response);
                                    if (obj.code == 0) {
                                        var uploaded_files = obj.data.length;
                                        if (uploaded_files > 0) {
                                            $("#input_file div").remove();
                                            var i_file = '';
                                            $.each(obj.data, function(index, value) {
                                                i_file += '<div class="row mb-3">';
                                                i_file += '<div class="col-lg-8" id="row_' + index + '"><input class="form-control form-control-solid" type="text" readonly value="' + value.nama_berkas_asli + '"></div>';
                                                i_file += '<div class="col-lg-2">';
                                                i_file += '<div class="form-check form-switch form-check-custom form-check-solid me-10">';
                                                i_file += '<input class="form-check-input h-40px w-60px" type="checkbox" onchange="Elements.switch(event,' + index + ',\'' + value.nama_berkas_asli + '\',\'' + value.nama_berkas + '\')" value="1" id="flexSwitch40x60"/>';
                                                i_file += '<label class="form-check-label" for="flexSwitch40x60">Ganti Berkas</label>';
                                                i_file += '</div>';
                                                i_file += '</div>';
                                                i_file += '<div class="col-lg-2" id="link_' + index + '">';
                                                i_file += '<a href="<?php echo site_url('rfq/download/'); ?>' + value.nama_berkas + '" class="btn btn-icon btn-sm btn-success me-2"><i class = "fas fa-download"></i></a>';
                                                i_file += '</div>';
                                                i_file += '</div>';
                                            });

                                            for (var i = 0; i < (5 - uploaded_files); i++) {
                                                i_file += '<div class="row mb-3">';
                                                i_file += '<div class="col-lg-8"><input class="form-control rfq_file" type="file" accept="application/pdf" name="rfq_file[]"></div>';
                                                i_file += '</div>';
                                            }

                                            $("#input_file span").after(i_file);
                                        } else {
                                            var i_file = '';
                                            for (var i = 0; i < 5; i++) {
                                                i_file += '<div class="row mb-3">';
                                                i_file += '<div class="col-lg-8"><input class="form-control rfq_file" type="file"  accept="application/pdf"name="rfq_file[]"></div>';
                                                i_file += '</div>';
                                            }
                                            $("#input_file span").after(i_file);
                                        }
                                    } else {
                                        $("#input_file div").remove();
                                        var i_file = '';
                                        for (var i = 0; i < 5; i++) {
                                            i_file += '<div class="row mb-3">';
                                            i_file += '<div class="col-lg-8"><input class="form-control rfq_file" type="file" accept="application/pdf" name="rfq_file[]"></div>';
                                            i_file += '</div>';
                                        }
                                        $("#input_file span").after(i_file);
                                    }
                                },
                                error: function() {
                                    blockUI.release();
                                }
                            });
                        }
                    }),
                    $('#kt_datatable_detail_rfq_goods tbody').on('click', 'button.eqiv_form_1, button.eqiv_form_2, button.eqiv_form_3, button.eqiv_form_4', function() {
                        blockUI.release();
                        $("#input_file_eqiv div").remove();
                        var data = e.row($(this).parents('tr')).data();
                        var id = $(this).attr('id');
                        var eqiv_id = id.replace('btn_eqiv_', '');
                        var material_code = data.kode_barang;
                        var material_desc_eqiv_val = '';
                        var txt_desc_eqiv = '';
                        var txt_dipakai_eqiv = '';
                        var last_char_eqiv = '';
                        $("#kt_modal_det_rfq_goods_ekuivalen h4 span#txt_rfq_no_eqiv").text(data.nomor_rfq);
                        $("#kt_modal_det_rfq_goods_ekuivalen h4 span#txt_material_code_eqiv").text(data.kode_barang);
                        $("#kt_modal_det_rfq_goods_ekuivalen h4 span#txt_seq_eqiv").text(eqiv_id);
                        $("input[name=id_rfq_eqiv]").val('<?php echo $this->uri->segment(3); ?>');
                        $("input[name=id_eqiv]").val(eqiv_id);
                        // $("input[name=seq_eqiv]").val(data.urutan_rfq);
                        $("input[name=material_code_eqiv]").val(data.kode_barang);
                        $("input[name=material_name_eqiv]").val(data.deskripsi_barang);
                        txt_desc_eqiv = (data.deskripsi_material == '' || data.deskripsi_material == null) ? '' : data.deskripsi_material;
                        txt_dipakai_eqiv = (data.dipakai_untuk == '' || data.dipakai_untuk == null) ? ' - ' : $.trim(data.dipakai_untuk);
                        last_char_eqiv = txt_dipakai_eqiv.slice(-1);
                        txt_dipakai_eqiv = (last_char_eqiv == '&') ? txt_dipakai_eqiv.slice(0, -2) : txt_dipakai_eqiv;

                        material_desc_eqiv_val = txt_desc_eqiv + '\n' + 'Dipakai untuk : ' + txt_dipakai_eqiv;
                        $("textarea[name=material_desc_eqiv]").val(material_desc_eqiv_val);
                        $("input[name=request_total_eqiv]").val(data.jumlah_permintaan);
                        $("input[name=measurement_eqiv]").val(data.satuan + ' (' + data.deskripsi_satuan + ')');
                        $("input[name=r_measurement_eqiv]").val($.trim(data.satuan));
                        $("input[name=desc_measure_eqiv]").val($.trim(data.deskripsi_satuan));
                        $("#unit_measure_eqiv").val(data.satuan).trigger('change');
                        $("#currency_eqiv").val('IDR').trigger('change');
                        $("input[name=unit_price_eqiv]").maskMoney('mask', 0);
                        $("input[name=temp_unit_measure_eqiv]").val(data.per_harga_satuan);
                        $('input[name="convert_eqiv"][value="0"]').prop('checked', true);
                        $('input[name="available_eqiv"][value="0"]').prop('checked', true);
                        $("input[name=ed_price_eqiv]").val(Elements.get_date());
                        $("textarea[name=notes_eqiv]").val('');
                        $("input[name=created_by_eqiv]").val('');

                        $("textarea[name=specification_eqiv]").val('');
                        $("input[name=merk_eqiv]").val('');
                        $("input[name=type_eqiv]").val('');
                        $("input[name=made_eqiv]").val('');
                        $("input[name=available_total_eqiv]").val(0);
                        $("input[name=indent_total_eqiv]").val(0);
                        $("input[name=indent_day_eqiv]").val(0);

                        // Status Ketersediaan Barang Equivalent
                        if ($('input[name="available_eqiv"]:checked').val() == 0) { // Checked Tersedia
                            $("#form_status_ketersediaan_barang_eqiv").hide();
                        } else {    // Checked Indent
                            $("#form_status_ketersediaan_barang_eqiv").show();
                        }

                        if ($('input[name="convert_eqiv"]:checked').val() == 0) {
                            $('#unit_measure_eqiv').attr('disabled', 'disabled');
                            $("#form_convertion_eqiv").hide();
                        } else {
                            $('#unit_measure_eqiv').removeAttr('disabled');
                            $("#form_convertion_eqiv").show();
                            $("input[name=convertion_qty_eqiv]").val('');
                            $("input[name=convertion_measure_eqiv]").val('');
                        }

                        var i_file = '';
                        for (var i = 0; i < 5; i++) {
                            i_file += '<div class="row mb-3">';
                            i_file += '<div class="col-lg-8"><input class="form-control eqiv_file" type="file" accept="application/pdf" name="eqiv_file[]"></div>';
                            i_file += '</div>';
                        }
                        $("#input_file_eqiv span").after(i_file);

                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('rfq/get_det_rfq_eqiv'); ?>",
                            data: {
                                val_1: '<?php echo $this->uri->segment(3); ?>',
                                val_2: eqiv_id,
                                val_3: material_code
                            },
                            beforeSend: function() {
                                blockUI.block();
                            },
                            success: function(response) {
                                blockUI.release();
                                var obj = jQuery.parseJSON(response);
                                if (obj.code == 0) {
                                    // $("input[name=currency_eqiv]").val(obj.data.mata_uang);
                                    $("#currency_eqiv").val(obj.data.mata_uang).trigger('change');
                                    $("input[name=unit_price_eqiv]").maskMoney('mask', parseInt(obj.data.harga_satuan));
                                    $("#unit_measure_eqiv").val(obj.data.per_harga_satuan).trigger('change');
                                    $("input[name=temp_unit_measure_eqiv]").val(obj.data.per_harga_satuan);
                                    $('input[name="convert_eqiv"][value="' + obj.data.konversi + '"]').prop('checked', true);
                                    if ($('input[name="convert_eqiv"]:checked').val() == 0) {
                                        $('#unit_measure_eqiv').attr('disabled', 'disabled');
                                        $("#form_convertion_eqiv").hide();
                                    } else {
                                        $('#unit_measure_eqiv').removeAttr('disabled');
                                        $("#form_convertion_eqiv").show();

                                        $("#convert_measurement_eqiv").val(obj.data.satuan_konversi).trigger('change');
                                        $("#unit_measure_eqiv").on('select2:select', function(e) {
                                            var data = e.params.data;
                                            $("input[name=convertion_measure_eqiv]").val(data.text);

                                            if($("input[name=r_measurement_eqiv]").val() == data.id) {
                                                $("#convert_measurement_eqiv").removeAttr('disabled');
                                            } else {
                                                $("#convert_measurement_eqiv").attr('disabled', 'disabled');
                                                $("#convert_measurement_eqiv").val($("input[name=r_measurement_eqiv]").val()).trigger('change');
                                            }
                                        })

                                        $("input[name=convertion_qty_eqiv]").val(parseInt(obj.data.jumlah_konversi));
                                        $("input[name=convertion_measure_eqiv]").val($("#unit_measure_eqiv").select2('data')[0].text);
                                    }
                                    $('input[name="available_eqiv"][value="' + obj.data.ketersediaan_barang + '"]').prop('checked', true);
                                    if ($('input[name="available_eqiv"]:checked').val() == 0) { // Status Ketersediaan Barang = Tersedia
                                            // $('#available_total_eqiv').attr('disabled', 'disabled');
                                            // $('#available_total_eqiv').val(parseFloat(obj.data.jumlah_tersedia));
                                            // $("input[name=indent_total_eqiv]").prop('readonly', false).removeClass('form-control-solid').val(parseInt(obj.data.jumlah_inden));

                                            $("#form_status_ketersediaan_barang_eqiv").hide();
                                            $('#available_total_eqiv').val(0);
                                            $('#indent_total_eqiv').val(0);
                                            $('#indent_day_eqiv').val(0);

                                    } else { // Status Ketersediaan Barang = Tersedia
                                        // $('#available_total_eqiv').removeAttr('disabled');
                                        // $("input[name=indent_total_eqiv]").prop('readonly', true).addClass('form-control-solid').val(0);

                                        $("#form_status_ketersediaan_barang_eqiv").show();
                                        $('#available_total_eqiv').val(parseFloat(obj.data.jumlah_tersedia));
                                        $('#indent_total_eqiv').val(parseFloat(obj.data.jumlah_inden));
                                        $('#indent_day_eqiv').val(parseFloat(obj.data.lama_inden));
                                    }
                                    $("input[name=ed_price_eqiv]").val(obj.data.masa_berlaku_harga);
                                    $("textarea[name=notes_eqiv]").val(obj.data.keterangan);
                                    $("input[name=created_by_eqiv]").val(obj.data.dibuat_oleh);

                                    $("textarea[name=specification_eqiv]").val(obj.data.spesifikasi);
                                    $("input[name=merk_eqiv]").val(obj.data.merek);
                                    $("input[name=type_eqiv]").val(obj.data.tipe);
                                    $("input[name=made_eqiv]").val(obj.data.buatan);
                                    // $("input[name=available_total_eqiv]").val(parseInt(obj.data.jumlah_tersedia));
                                    // $("input[name=indent_total_eqiv]").val(parseInt(obj.data.jumlah_inden));
                                    $("input[name=indent_day_eqiv]").val(obj.data.lama_inden);

                                    $("#input_file_eqiv div").remove();
                                    if (obj.files.length > 0) {
                                        $("#input_file_eqiv div").remove();
                                        var i_file = '';
                                        $.each(obj.files, function(index, value) {
                                            i_file += '<div class="row mb-3">';
                                            i_file += '<div class="col-lg-8" id="row_eqiv_' + index + '"><input class="form-control form-control-solid" type="text" readonly value="' + value.nama_berkas_asli + '"></div>';
                                            i_file += '<div class="col-lg-2">';
                                            i_file += '<div class="form-check form-switch form-check-custom form-check-solid me-10">';
                                            i_file += '<input class="form-check-input h-40px w-60px" type="checkbox" onchange="Elements.switch_eqiv(event,' + index + ',\'' + value.nama_berkas_asli + '\',\'' + value.nama_berkas + '\')" value="1" id="flexSwitch40x60"/>';
                                            i_file += '<label class="form-check-label" for="flexSwitch40x60">Ganti Berkas</label>';
                                            i_file += '</div>';
                                            i_file += '</div>';
                                            i_file += '<div class="col-lg-2" id="link_eqiv_' + index + '">';
                                            i_file += '<a href="<?php echo site_url('rfq/download/'); ?>' + value.nama_berkas + '" class="btn btn-icon btn-sm btn-success me-2"><i class = "fas fa-download"></i></a>';
                                            i_file += '</div>';
                                            i_file += '</div>';
                                        });

                                        for (var i = 0; i < (5 - obj.files.length); i++) {
                                            i_file += '<div class="row mb-3">';
                                            i_file += '<div class="col-lg-8"><input class="form-control eqiv_file" type="file" accept="application/pdf" name="eqiv_file[]"></div>';
                                            i_file += '</div>';
                                        }

                                        $("#input_file_eqiv span").after(i_file);
                                    } else {
                                        var i_file = '';
                                        for (var i = 0; i < 5; i++) {
                                            i_file += '<div class="row mb-3">';
                                            i_file += '<div class="col-lg-8"><input class="form-control eqiv_file" type="file" accept="application/pdf" name="eqiv_file[]"></div>';
                                            i_file += '</div>';
                                        }
                                        $("#input_file_eqiv span").after(i_file);
                                    }
                                } else {
                                    $("#input_file_eqiv div").remove();
                                    var i_file = '';
                                    for (var i = 0; i < 5; i++) {
                                        i_file += '<div class="row mb-3">';
                                        i_file += '<div class="col-lg-8"><input class="form-control eqiv_file" type="file" accept="application/pdf" name="eqiv_file[]"></div>';
                                        i_file += '</div>';
                                    }
                                    $("#input_file_eqiv span").after(i_file);
                                }
                            },
                            error: function() {
                                blockUI.release();
                            }
                        });
                    });
            }
        };
    })();

    var KTModalForm = (function() {
        var a, b, c, d, e, f, g, t, u, v, w, x, y, z;
        var btn_submit, btn_cancel, btn_close, form_additional;
        return {
            rfq_form: function() {
                (a = document.querySelector("#kt_modal_det_rfq_goods")) &&
                ((b = new bootstrap.Modal(a)),
                    (c = document.querySelector("#kt_modal_det_rfq_goods_form")),
                    (d = document.getElementById("kt_modal_det_rfq_goods_submit")),
                    (e = document.getElementById("kt_modal_det_rfq_goods_cancel")),
                    (f = document.querySelector('[data-kt-det-rfq-goods-modal-action="close"]')),
                    (g = FormValidation.formValidation(c, {
                        fields: {
                            material_code: {
                                validators: {
                                    notEmpty: {
                                        message: "Kode Material tidak boleh kosong"
                                    }
                                }
                            },
                            material_name: {
                                validators: {
                                    notEmpty: {
                                        message: "Nama Material tidak boleh kosong"
                                    }
                                }
                            },
                            request_total: {
                                validators: {
                                    notEmpty: {
                                        message: "Jumlah Permintaan tidak boleh kosong"
                                    }
                                }
                            },
                            measurement: {
                                validators: {
                                    notEmpty: {
                                        message: "Satuan tidak boleh kosong"
                                    }
                                }
                            },
                            currency: {
                                validators: {
                                    notEmpty: {
                                        message: "Mata Uang tidak boleh kosong"
                                    }
                                }
                            },
                            // unit_price: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Harga Satuan tidak boleh kosong"
                            //         }
                            //     }
                            // },
                            unit_measure: {
                                validators: {
                                    notEmpty: {
                                        message: "Satuan tidak boleh kosong"
                                    }
                                }
                            },
                            convert: {
                                validators: {
                                    notEmpty: {
                                        message: "Wajib pilih salah satu"
                                    }
                                }
                            },
                            convertion_qty: {
                                validators: {
                                    numeric: {
                                        message: 'Konversi Jumlah harus angka',
                                        // The default separators
                                        thousandsSeparator: '',
                                        decimalSeparator: '.',
                                    },
                                    callback: {
                                        message: 'Konversi Jumlah tidak boleh kosong',
                                        callback: function(input) {
                                            const selectedCheckbox = c.querySelector('[name="convert"]:checked');
                                            const convertion = selectedCheckbox ? selectedCheckbox.value : '';

                                            return (convertion !== '1')
                                                // The field is valid if user picks
                                                // a given convertion from the list
                                                ?
                                                true
                                                // Otherwise, the field value is required
                                                :
                                                (input.value !== '');
                                        }
                                    }
                                }
                            },
                            available: {
                                validators: {
                                    notEmpty: {
                                        message: "Wajib pilih salah satu"
                                    }
                                }
                            },
                            // available_total: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Jumlah tersedia tidak boleh kosong"
                            //         },
                            //         callback: {
                            //             message: 'Jumlah tersedia tidak boleh 0 (Nol)',
                            //             callback: function(input) {
                            //                 const selectedCheckbox = c.querySelector('[name="available"]:checked');
                            //                 const convertion = selectedCheckbox ? selectedCheckbox.value : '';
                            //                 const r_total = c.querySelector('[name="request_total"]');

                            //                 if(convertion !== '1') {
                            //                     return true;
                            //                 } else {

                            //                     if(parseInt(input.value) == 0) {
                            //                         return {
                            //                             valid: false,
                            //                             message: 'Jumlah tersedia tidak boleh 0 (Nol)'
                            //                         }
                            //                     } else {
                            //                         if(parseInt(input.value) > 0 && parseInt(input.value) <= r_total.value) {
                            //                             return true;
                            //                         } else {
                            //                             return {
                            //                                 valid: false,
                            //                                 message: 'Jumlah tersedia tidak boleh lebih dari jumlah permintaan'
                            //                             }
                            //                         }
                            //                     }
                                    
                            //                 }
                            //             }
                            //         }
                            //     }
                            // },
                            // indent_total: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Jumlah indent tidak boleh kosong"
                            //         },
                            //         callback: {
                            //             message: 'Jumlah tersedia tidak boleh 0 (Nol)',
                            //             callback: function(input) {
                            //                 const selectedCheckbox = c.querySelector('[name="available"]:checked');
                            //                 const convertion = selectedCheckbox ? selectedCheckbox.value : '';

                            //                 if(convertion !== '1') {
                            //                     return true;
                            //                 } else {

                            //                     return (parseInt(input.value) > 0);
                                    
                            //                 }
                            //             }
                            //         }
                            //     }
                            // },
                            // indent_day: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Lama indent tidak boleh kosong"
                            //         },
                            //         callback: {
                            //             message: 'Lama indent tidak boleh 0 (Nol)',
                            //             callback: function(input) {
                            //                 const selectedCheckbox = c.querySelector('[name="available"]:checked');
                            //                 const convertion = selectedCheckbox ? selectedCheckbox.value : '';
                            //                 const a_total = c.querySelector('[name="available_total"]');
                            //                 const r_total = c.querySelector('[name="request_total"]');

                            //                 if(convertion !== '1') {
                            //                     return true;
                            //                 } else {
                            //                     if(a_total.value == r_total.value) {
                            //                         return true;
                            //                     } else if(a_total.value > r_total.value) {
                            //                         return true;
                            //                     } else {
                            //                         return (parseInt(input.value) > 0);
                            //                     }
                            //                 }
                            //             }
                            //         }
                            //     }
                            // },
                            // ed_price: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Masa Berlaku Harga tidak boleh kosong"
                            //         }
                            //     }
                            // },
                            created_by: {
                                validators: {
                                    notEmpty: {
                                        message: "Dibuat Oleh tidak boleh kosong"
                                    },
                                    stringLength: {
                                        message: 'Input Max 30 karakter',
                                        max: 30
                                    }
                                }
                            },
                            rfq_file: {
                                // The children's full name are inputs with class .childFullName
                                selector: '.rfq_file',
                                // The field is placed inside .col-xs-6 div instead of .form-group
                                row: '.col-lg-8',
                                validators: {
                                    file: {
                                        extension: 'pdf', //'jpeg,jpg,png,pdf',
                                        type: 'application/pdf',//'image/jpeg,image/png,application/pdf',
                                        message: 'Please choose a PDF file',//'Please choose a JPEG, JPG, PNG, & PDF file',
                                    },
                                },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: ""
                            })
                        },
                    })),
                    d.addEventListener("click", function(e) {
                        e.preventDefault(),
                            g &&
                            g.validate().then(function(e) {
                                var frmData = new FormData(c);
                                "Valid" == e
                                    ?
                                    (
                                        Swal.fire({
                                            text: "Pastikan data yang Anda isi sudah benar dan dapat dipertanggung jawabkan",
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
                                                        url: c.getAttribute('action'),
                                                        data: frmData,
                                                        processData: false,
                                                        contentType: false,
                                                        beforeSend: function() {
                                                            d.setAttribute("data-kt-indicator", "on"),
                                                                (d.disabled = !0);
                                                        },
                                                        success: function(response) {
                                                            var obj = jQuery.parseJSON(response);
                                                            d.removeAttribute("data-kt-indicator"),
                                                                (d.disabled = !1);
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
                                                                    t.isConfirmed && (obj.code == 0) ? (KTDataTables.init(), g.resetForm(true), $('textarea[name="notes"]').val(''), b.hide()) : r.dismiss;
                                                                }
                                                            );
                                                        },
                                                        error: function() {
                                                            d.removeAttribute("data-kt-indicator"),
                                                                (d.disabled = !1);
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
                                                ) :
                                                "cancel" === r.dismiss;
                                        })
                                    ) :
                                    Swal.fire({
                                        text: "Silahkan lengkapi data dan pastikan data input sudah benar.",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Tutup",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        },
                                    });
                            });
                    }),
                    e.addEventListener("click", function(t) {
                        g.resetForm(true), b.hide();
                    })),
                f.addEventListener("click", function(t) {
                    g.resetForm(true), b.hide();
                });
            },
            eqiv_form: function() {
                (t = document.querySelector("#kt_modal_det_rfq_goods_ekuivalen")) &&
                ((u = new bootstrap.Modal(t)),
                    (v = document.querySelector("#kt_modal_det_rfq_goods_ekuivalen_form")),
                    (w = document.getElementById("kt_modal_det_rfq_goods_ekuivalen_submit")),
                    (x = document.getElementById("kt_modal_det_rfq_goods_ekuivalen_cancel")),
                    (y = document.querySelector('[data-kt-det-rfq-goods-ekuivalen-modal-action="close"]')),
                    (z = FormValidation.formValidation(v, {
                        fields: {
                            material_code_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Kode Material tidak boleh kosong"
                                    }
                                }
                            },
                            material_name_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Nama Material tidak boleh kosong"
                                    }
                                }
                            },
                            request_total_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Jumlah Permintaan tidak boleh kosong"
                                    }
                                }
                            },
                            measurement_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Satuan tidak boleh kosong"
                                    }
                                }
                            },
                            currency_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Mata Uang tidak boleh kosong"
                                    }
                                }
                            },
                            // unit_price_eqiv: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Harga Satuan tidak boleh kosong"
                            //         }
                            //     }
                            // },
                            unit_measure_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Satuan tidak boleh kosong"
                                    }
                                }
                            },
                            convert_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Wajib pilih salah satu"
                                    }
                                }
                            },
                            convertion_qty_eqiv: {
                                validators: {
                                    numeric: {
                                        message: 'Konversi Jumlah harus angka',
                                        // The default separators
                                        thousandsSeparator: '',
                                        decimalSeparator: '.',
                                    },
                                    callback: {
                                        message: 'Konversi Jumlah tidak boleh kosong',
                                        callback: function(input) {
                                            const selectedCheckbox = c.querySelector('[name="convert_eqiv"]:checked');
                                            const convertion = selectedCheckbox ? selectedCheckbox.value : '';

                                            return (convertion !== '1')
                                                // The field is valid if user picks
                                                // a given convertion from the list
                                                ?
                                                true
                                                // Otherwise, the field value is required
                                                :
                                                (input.value !== '');
                                        }
                                    }
                                }
                            },
                            specification_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Spesifikasi tidak boleh kosong"
                                    }
                                }
                            },
                            merk_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Merek tidak boleh kosong"
                                    },
                                    stringLength: {
                                        message: 'Input Max 30 karakter',
                                        max: 30
                                    }
                                }
                            },
                            type_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Tipe tidak boleh kosong"
                                    },
                                    stringLength: {
                                        message: 'Input Max 30 karakter',
                                        max: 30
                                    }
                                }
                            },
                            made_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Buatan tidak boleh kosong"
                                    },
                                    stringLength: {
                                        message: 'Input Max 30 karakter',
                                        max: 30
                                    }
                                }
                            },
                            // available_total_eqiv: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Jumlah tersedia tidak boleh kosong"
                            //         }
                            //     }
                            // },
                            // indent_total_eqiv: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Jumlah inden tidak boleh kosong"
                            //         }
                            //     }
                            // },
                            // indent_day_eqiv: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Lama Indent tidak boleh kosong"
                            //         }
                            //     }
                            // },
                            available_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Wajib pilih salah satu"
                                    }
                                }
                            },
                            // available_total_eqiv: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Jumlah tersedia tidak boleh kosong"
                            //         },
                            //         callback: {
                            //             message: 'Jumlah tersedia tidak boleh 0 (Nol)',
                            //             callback: function(input) {
                            //                 const selectedCheckbox = v.querySelector('[name="available_eqiv"]:checked');
                            //                 const convertion = selectedCheckbox ? selectedCheckbox.value : '';
                            //                 const r_total = v.querySelector('[name="request_total_eqiv"]');

                            //                 if(convertion !== '1') {
                            //                     return true;
                            //                 } else {

                            //                     if(parseInt(input.value) == 0) {
                            //                         return {
                            //                             valid: false,
                            //                             message: 'Jumlah tersedia tidak boleh 0 (Nol)'
                            //                         }
                            //                     } else {
                            //                         if(parseInt(input.value) > 0 && parseInt(input.value) <= r_total.value) {
                            //                             return true;
                            //                         } else {
                            //                             return {
                            //                                 valid: false,
                            //                                 message: 'Jumlah tersedia tidak boleh lebih dari jumlah permintaan'
                            //                             }
                            //                         }
                            //                     }
                                    
                            //                 }
                            //             }
                            //         }
                            //     }
                            // },
                            // indent_total_eqiv: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Jumlah indent tidak boleh kosong"
                            //         },
                            //         callback: {
                            //             message: 'Jumlah tersedia tidak boleh 0 (Nol)',
                            //             callback: function(input) {
                            //                 const selectedCheckbox = v.querySelector('[name="available_eqiv"]:checked');
                            //                 const convertion = selectedCheckbox ? selectedCheckbox.value : '';

                            //                 if(convertion !== '1') {
                            //                     return true;
                            //                 } else {

                            //                     return (parseInt(input.value) > 0);
                                    
                            //                 }
                            //             }
                            //         }
                            //     }
                            // },
                            // indent_day_eqiv: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Lama indent tidak boleh kosong"
                            //         },
                            //         callback: {
                            //             message: 'Lama indent tidak boleh 0 (Nol)',
                            //             callback: function(input) {
                            //                 const selectedCheckbox = v.querySelector('[name="available_eqiv"]:checked');
                            //                 const convertion = selectedCheckbox ? selectedCheckbox.value : '';
                            //                 const a_total = v.querySelector('[name="available_total_eqiv"]');
                            //                 const r_total = v.querySelector('[name="request_total_eqiv"]');

                            //                 if(convertion !== '1') {
                            //                     return true;
                            //                 } else {
                            //                     if(a_total.value == r_total.value) {
                            //                         return true;
                            //                     } else if(a_total.value > r_total.value) {
                            //                         return true;
                            //                     } else {
                            //                         return (parseInt(input.value) > 0);
                            //                     }
                            //                 }
                            //             }
                            //         }
                            //     }
                            // },
                            // ed_price_eqiv: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Masa Berlaku Harga tidak boleh kosong"
                            //         }
                            //     }
                            // },
                            created_by_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Dibuat Oleh tidak boleh kosong"
                                    },
                                    stringLength: {
                                        message: 'Input Max 30 karakter',
                                        max: 30
                                    }
                                }
                            },
                            eqiv_file: {
                                // The children's full name are inputs with class .childFullName
                                selector: '.eqiv_file',
                                // The field is placed inside .col-xs-6 div instead of .form-group
                                row: '.col-lg-6',
                                validators: {
                                    file: {
                                        extension: 'pdf', //'jpeg,jpg,png,pdf',
                                        type: 'application/pdf',//'image/jpeg,image/png,application/pdf',
                                        message: 'Please choose a PDF file',//'Please choose a JPEG, JPG, PNG, & PDF file',
                                    },
                                },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: ""
                            })
                        },
                    })),
                    w.addEventListener("click", function(e) {
                        e.preventDefault(),
                            z &&
                            z.validate().then(function(e) {
                                var frmData_eqiv = new FormData(v);
                                "Valid" == e
                                    ?
                                    (
                                        Swal.fire({
                                            text: "Pastikan data yang Anda isi sudah benar dan dapat dipertanggung jawabkan",
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
                                                        url: v.getAttribute('action'),
                                                        data: frmData_eqiv,
                                                        processData: false,
                                                        contentType: false,
                                                        beforeSend: function() {
                                                            w.setAttribute("data-kt-indicator", "on"),
                                                                (w.disabled = !0);
                                                        },
                                                        success: function(response) {
                                                            var obj = jQuery.parseJSON(response);
                                                            w.removeAttribute("data-kt-indicator"),
                                                                (w.disabled = !1);
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
                                                                    t.isConfirmed && (obj.code == 0) ? (KTDataTables.init(), z.resetForm(true), u.hide()) : r.dismiss;
                                                                }
                                                            );
                                                        },
                                                        error: function() {
                                                            w.removeAttribute("data-kt-indicator"),
                                                                (w.disabled = !1);
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
                                                ) :
                                                "cancel" === r.dismiss;
                                        })
                                    ) :
                                    Swal.fire({
                                        text: "Silahkan lengkapi data dan pastikan data input sudah benar.",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Tutup",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        },
                                    });
                            });
                    }),
                    x.addEventListener("click", function(t) {
                        z.resetForm(true), u.hide()
                    })),
                y.addEventListener("click", function(t) {
                    z.resetForm(true), u.hide()
                });
            },
            additional_form: function() {
                (form_additional = document.querySelector("#kt_modal_additional_price_form")),
                (btn_submit = document.getElementById("kt_modal_additional_price_submit")),
                (btn_cancel = document.getElementById("kt_modal_additional_price_cancel")),
                (btn_close = document.querySelector('[data-kt-additional-price-modal-action="close"]')),
                btn_submit.addEventListener("click", function(e) {
                    e.preventDefault();
                    var count_invalid = 0;
                    $('input[name="add_price[]"]').each(function(key, value) {
                        if($(this).val() == '') {
                            count_invalid = count_invalid + 1;
                        }
                    });
                    if(count_invalid > 0) {
                        Swal.fire({
                            text: "Silahkan lengkapi data dan pastikan data input sudah benar.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Tutup",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            },
                        });
                    } else {
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

    var Elements = (function() {
        return {
            switch: function(e, index, name, file) {
                var checked = e.target.checked;
                if (checked) {
                    $("#row_" + index + " > input, #link_" + index + " > a").remove();
                    $("#row_" + index).append('<input class="form-control rfq_file" type="file" accept="application/pdf" name="rfq_file[' + index + ']"><input type="hidden" name="old_name[' + index + ']" value="' + name + '">');
                } else {
                    $("#row_" + index + " > input").remove();
                    $("#row_" + index).append('<input class="form-control form-control-solid" type="text" readonly value="' + name + '">');
                    $("#link_" + index).append('<a href="<?php echo site_url('rfq/download/'); ?>' + file + '" class="btn btn-icon btn-sm btn-success me-2"><i class = "fas fa-download"></i></a>');
                }
            },
            switch_eqiv: function(e, index, name, file) {
                var checked = e.target.checked;
                if (checked) {
                    $("#row_eqiv_" + index + " > input, #link_eqiv_" + index + " > a").remove();
                    $("#row_eqiv_" + index).append('<input class="form-control eqiv_file" type="file" accept="application/pdf" name="eqiv_file[' + index + ']"><input type="hidden" name="old_name_eqiv[' + index + ']" value="' + name + '">');
                } else {
                    $("#row_eqiv_" + index + " > input").remove();
                    $("#row_eqiv_" + index).append('<input class="form-control form-control-solid" type="text" readonly value="' + name + '">');
                    $("#link_eqiv_" + index).append('<a href="<?php echo site_url('rfq/download/'); ?>' + file + '" class="btn btn-icon btn-sm btn-success me-2"><i class = "fas fa-download"></i></a>');
                }
            },
            add_row: function() {
                // get the last DIV which ID starts with ^= "klon"
                var $div = $('div[id^="el_add_"]:last');
                var num = parseInt( $div.prop("id").match(/\d+/g), 10 );
                if($('div[id^="el_add_"]').length == 1) {
                    var $btn_add = $div.closest('div').find('button[id^="btn_add_"]');
                    var $btn_rm = $btn_add.clone().prop('id', 'btn_rm_'+num).attr('onclick', 'return Elements.remove_row(this)');
                    $btn_rm.removeClass('btn-bg-success').addClass('btn-light');
                    $btn_rm.find('i').removeClass('la-plus text-white').addClass('la-minus text-dark');
                    $btn_add.after($btn_rm);
                }

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
                    $klon.closest('div').find('button[id^="btn_add_"]').prop('id', 'btn_add_'+next);
                    $klon.closest('div').find('button[id^="btn_rm_"]').prop('id', 'btn_rm_'+next);

                    // Finally insert $klon wherever you want
                    $div.after( $klon );

                    $('div[id^="el_add_"]').each(function(key, value) {
                        $("#"+value.id).find('select[id^="add_price_type_').select2();
                        $("#"+value.id).find('select[id^="add_currency_').select2();
                    });
                }

                Elements.inputMask();
            },
            remove_row: function(e) {
                var $this = $("#"+e.id).parent().parent().attr('id');
                if($('div[id^="el_add_"]').length > 1) {
                    $("#"+$this).remove();
                }
                
                if($('div[id^="el_add_"]').length == 1) {
                    var $btn_rm = $('div[id^="el_add_"]').closest('div').find('button[id^="btn_rm_"]');
                    $btn_rm.remove();
                }
            },
            clear_additional_modal: function() {
                // var $div = $('div[id^="el_add_"]');
                // if($div.length > 1) {
                //     console.log($div);
                // }
            },
            inputMask: function() {
                $("input[id^=add_price_]").maskMoney({
                    thousands: '.',
                    decimal: ',',
                    affixesStay: false,
                    precision: 0
                });
            },
            on_close_modal: function() {
                modal_additional_container.addEventListener('hidden.bs.modal', function () {
                    $('div[id^="el_add_"]').not(':first').remove();
                    if($('div[id^="el_add_"]').length == 1) {
                        var $btn_rm = $('div[id^="el_add_"]').closest('div').find('button[id^="btn_rm_"]');
                        $btn_rm.remove();
                    }
                });
            },
            get_date: function() {
                // var date = new Date();
                // var year = date.getFullYear();
                // var month = date.getMonth();
                // var day = date.getDate();
                // var today = year + '-' + month + '-' + day;
                var today = moment().format('YYYY-MM-DD');
                // console.log(today);
                return today;
            }
        }
    })();

    KTUtil.onDOMContentLoaded((function() {
        KTDataTables.init();
        KTModalForm.rfq_form();
        KTModalForm.eqiv_form();
        Elements.inputMask();
        $("input[name=unit_price]").maskMoney({
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 0,
            allowZero: !0
        });
        $("input[name=unit_price_eqiv]").maskMoney({
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 0,
            allowZero: !0
        });
        $("#kt_daterangepicker_3").daterangepicker({
            autoApply: true,
            singleDatePicker: true,
            showDropdowns: true,
            minYear: new Date().getFullYear() - 5,
            //maxYear: parseInt(moment().format("YYYY"), 10),
            drops: 'down',
            parentEl: '#mbh_rfq',
            maxYear: new Date().getFullYear() + 5,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
        $("#kt_daterangepicker_4").daterangepicker({
            autoApply: true,
            singleDatePicker: true,
            showDropdowns: true,
            minYear: new Date().getFullYear() - 5,
            //maxYear: parseInt(moment().format("YYYY"), 10),
            drops: 'down',
            parentEl: '#mbh_eqiv',
            maxYear: new Date().getFullYear() + 5,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
        $("input[name=convert]").on("change", function() {
            if ($(this).is(':checked')) {
                if ($(this).val() == 0) {
                    $("#form_convertion").hide();
                    $('#unit_measure').val($("input[name=r_measurement]").val()).trigger('change');
                    $('#unit_measure').attr('disabled', 'disabled');
                } else {
                    $('#unit_measure').removeAttr('disabled');
                    $("#form_convertion").show();

                    // $("select[name=convertion_measurement]").val($("input[name=r_measurement]").val()).trigger('change');

                    if ($("#unit_measure").val() !== '') {
                        $("input[name=convertion_measure]").val($("#unit_measure").select2('data')[0].text);
                        // add validation of convertion
                        if($("input[name=measurement]").val() !== $("input[name=convertion_measure]").val() ) {
                            $("select[name=convertion_measurement]").attr('disabled', 'disabled').addClass('form-select form-select-solid');
                            $("select[name=convertion_measurement]").val($("input[name=r_measurement]").val());
                        }else {
                            $("select[name=convertion_measurement]").removeAttr('disabled').removeClass('form-select form-select-solid');
                            $("select[name=convertion_measurement]").addClass('form-select');
                            
                            // $("select[name=convertion_measurement]").val($("input[name=r_measurement]").val());
                            $("select[name=convertion_measurement]").val($("input[name=r_measurement]").val()).trigger('change');
                        }
                    }
                    
                    $("#unit_measure").on('select2:select', function(e) {
                        var data = e.params.data;
                        $("input[name=convertion_measure]").val(data.text);
                        // add validation of convertion
                        if($("input[name=measurement]").val() !== data.text) {
                            $("select[name=convertion_measurement]").attr('disabled', 'disabled').addClass('form-select form-select-solid');
                            $("select[name=convertion_measurement]").val($("input[name=r_measurement]").val());
                        }else {
                            $("select[name=convertion_measurement]").removeAttr('disabled').removeClass('form-select form-select-solid');
                            $("select[name=convertion_measurement]").addClass('form-select');
                            $("select[name=convertion_measurement]").val($("input[name=r_measurement]").val());
                        }
                        
                    });
                }
            }
        });
        $("input[name=convert_eqiv]").on("change", function() {
            if ($(this).is(':checked')) {
                if ($(this).val() == 0) {
                    $("#form_convertion_eqiv").hide();
                    if($("input[name=temp_unit_measure_eqiv]").val() !== '') {
                        $('#unit_measure_eqiv').val($("input[name=temp_unit_measure_eqiv]").val()).trigger('change');
                    } else {
                        $('#unit_measure_eqiv').val($("input[name=r_measurement_eqiv]").val()).trigger('change');
                    }
                    $('#unit_measure_eqiv').attr('disabled', 'disabled');
                } else {
                    $('#unit_measure_eqiv').removeAttr('disabled');
                    $("#form_convertion_eqiv").show();
                    
                    $("#convert_measurement_eqiv").val($("input[name=r_measurement_eqiv]").val()).trigger('change');
                    $("#convert_measurement_eqiv").removeAttr('disabled');

                    if ($("#unit_measure_eqiv").val() !== '') {
                        $("input[name=convertion_measure_eqiv]").val($("#unit_measure_eqiv").select2('data')[0].text);
                    }

                    $("#unit_measure_eqiv").on('select2:select', function(e) {
                        var data = e.params.data;
                        $("input[name=convertion_measure_eqiv]").val(data.text);

                        if($("input[name=r_measurement_eqiv]").val() == data.id) {
                            $("#convert_measurement_eqiv").removeAttr('disabled');
                        } else {
                            $("#convert_measurement_eqiv").attr('disabled', 'disabled');
                            $("#convert_measurement_eqiv").val($("input[name=r_measurement_eqiv]").val()).trigger('change');
                        }
                    })
                }
            }
        });
        
        // OnChange Status Ketersedian Barang (Tersedia/ Indent)
        $("input[name=available_total]").on('keyup change', function() {
            var request_total = $("input[name=request_total]").val();
            var indent_total = parseInt(request_total) - parseInt(this.value);
            if (indent_total < 0) {
                indent_total = 0;
            } else {
                indent_total = indent_total;
            }

            if (indent_total == 0) {
                $("input[name=indent_day]").attr('readonly', true).addClass('form-control-solid').val(0);
            } else {
                $("input[name=indent_day]").attr('readonly', false).removeClass('form-control-solid');
            }
            $("input[name=indent_total]").val(indent_total);
        });
        $("input[name=available]").on('change', function() {
            if ($(this).is(':checked')) {
                if ($(this).val() == 0) {   // Checked Tersedia
                    // Hide object Jumlah Tersedia, Jumlah Indent, Lama Indent
                    $('#form_status_ketersediaan_barang').hide();
                    $('#available_total').val(0);
                    $('#indent_total').val(0);
                    $('#indent_day').val(0);
                    
                } else {    // Checked Indent
                    // Show object Jumlah Tersedia, Jumlah Indent, Lama Indent
                    $('#form_status_ketersediaan_barang').show();
                    $('#available_total').val(0);
                    $('#indent_total').val(0);
                    $('#indent_day').val(0);
                }
            }
        });
        // OnChange Status Ketersedian Barang Equivalent (Tersedia/ Indent)
        $("input[name=available_total_eqiv]").on('keyup change', function() {
            var request_total_eqiv = $("input[name=request_total_eqiv]").val();
            var indent_total_eqiv = parseInt(request_total_eqiv) - parseInt(this.value);
            if (indent_total_eqiv < 0) {
                indent_total_eqiv = 0;
            } else {
                indent_total_eqiv = indent_total_eqiv;
            }

            if (indent_total_eqiv == 0) {
                $("input[name=indent_day_eqiv]").attr('readonly', true).addClass('form-control-solid').val(0);
            } else {
                $("input[name=indent_day_eqiv]").attr('readonly', false).removeClass('form-control-solid');
            }
            $("input[name=indent_total_eqiv]").val(indent_total_eqiv);
        });
        $("input[name=available_eqiv]").on('change', function() {
            if ($(this).is(':checked')) {
                if ($(this).val() == 0) {   // Status Ketersediaan barang eqiv = Checked Tersedia
                    // $('#available_total_eqiv').attr('disabled', 'disabled');
                    // $('#available_total_eqiv').val(0);
                    // $("input[name=indent_total_eqiv]").prop('readonly', false).removeClass('form-control-solid').val($("input[name=request_total_eqiv]").val());

                    // Hide object Jumlah Tersedia, Jumlah Indent, Lama Indent
                    $('#form_status_ketersediaan_barang_eqiv').hide();
                    $('#available_total_eqiv').val(0);
                    $('#indent_total_eqiv').val(0);
                    $('#indent_day_eqiv').val(0);
                    
                } else {    // Status Ketersediaan barang eqiv = Checked Indent
                    // $('#available_total_eqiv').removeAttr('disabled');
                    // $("input[name=indent_total_eqiv]").prop('readonly', true).addClass('form-control-solid').val(0);

                    // Show object Jumlah Tersedia, Jumlah Indent, Lama Indent
                    $('#form_status_ketersediaan_barang_eqiv').show();
                    $('#available_total_eqiv').val(0);
                    $('#indent_total_eqiv').val(0);
                    $('#indent_day_eqiv').val(0);
                }
            }
        });
        KTModalForm.additional_form();
    }));
</script>