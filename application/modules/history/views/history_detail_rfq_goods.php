<script src="<?php echo base_url(); ?>assets/plugins/custom/jquery-maskMoney/jquery.maskMoney.js"></script>
<div class="card shadow-sm">
    <div class="card-header bg-success">
        <div class="card-toolbar">
            <a href="<?php echo site_url('history/rfq_goods'); ?>" class="btn btn-sm btn-bg-white btn-icon me-2 mb-2">
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
                    <th class="min-w-100px text-center">Kode Material</th>
                    <th class="min-w-125px text-center">Nama Material</th>
                    <th class="min-w-50px text-center">Jumlah Permintaan</th>
                    <th class="min-w-50px text-center">Satuan Permintaan</th>
                    <th class="min-w-50px text-center">Status</th>
                    <th class="min-w-50px text-center">Harga Sesuai Permintaan</th>
                    <!-- <th class="min-w-50px text-center">Status Harga Ekuivalen</th> -->
                    <th class="min-w-150px text-center">Harga Permintaan Ekuivalen</th>
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
                                <input type="text" name="measurement" class="form-control form-control-solid" disabled placeholder="Satuan">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input Group-->
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Mata Uang</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="currency" class="form-control form-control-solid" placeholder="Mata Uang" disabled>
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
                                <input type="text" name="unit_price" class="form-control form-control-solid" placeholder="Harga Satuan" disabled>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Label-->
                            <label class="col-lg-1 col-form-label required fw-bold fs-6">Per</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row fv-plugins-icon-container">
                                <input type="text" name="unit_measure" class="form-control" placeholder="Satuan" disabled>
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
                                        <input class="form-check-input" name="convert" type="radio" value="1" disabled>
                                        <span class="fw-bold ps-2 fs-6">Ya</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <input class="form-check-input" name="convert" type="radio" value="0" disabled>
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
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Masukkan Satuan X</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
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
                                                <input type="text" name="convertion_measure" class="form-control form-control-solid" disabled>
                                            </td>
                                            <td class="text-center">=</td>
                                            <td class="text-center">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control" name="convertion_qty" disabled placeholder="Konversi Jumlah">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </td>
                                            <td class="text-center"><input type="text" name="measurement" class="form-control form-control-solid" disabled></td>
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
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Status Ketersediaan Barang</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <div class="align-items-center mt-3">
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid me-5">
                                        <input class="form-check-input" name="available" type="radio" value="0" disabled>
                                        <span class="fw-bold ps-2 fs-6">Tersedia</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <input class="form-check-input" name="available" type="radio" value="1" disabled>
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
                                    <input type="number" name="available_total" id="available_total" class="form-control" placeholder="Jumlah Tersedia" min="0" disabled>
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
                                    <input type="number" name="indent_total" id="indent_total" class="form-control form-control-solid" placeholder="Jumlah Indent" min="0" disabled>
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
                                    <input type="number" name="indent_day" id="indent_day" class="form-control" placeholder="Lama Indent (Hari)" min="0" disabled>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input Group-->
                        </div>
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Masa Berlaku Harga</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input class="form-control form-control-solid" name="ed_price" placeholder="Pick date rage" id="kt_daterangepicker_3" disabled />
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
                                <!-- <input class="form-control  form-control-solid" name="notes" placeholder="Keterangan" disabled/> -->
                                <textarea class="form-control" name="notes" placeholder="Keterangan" rows="5" disabled></textarea>
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
                                <input class="form-control  form-control-solid" name="created_by" placeholder="Dibuat oleh" disabled />
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
                                <!-- <div class="mb-3">
                                    <input class="form-control" type="file" name="rfq_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="rfq_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="rfq_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="rfq_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="rfq_file[]">
                                </div> -->
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
                    <!-- <button type="submit" id="kt_modal_det_rfq_goods_submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button> -->
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
                        <input type="hidden" name="seq_eqiv">
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
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Mata Uang</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input class="form-control form-control-solid" name="currency_eqiv" placeholder="Mata Uang" id="" disabled />
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
                                <input type="text" name="unit_price_eqiv" class="form-control form-control-solid" placeholder="Harga Satuan" disabled>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Label-->
                            <label class="col-lg-1 col-form-label required fw-bold fs-6">Per</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row fv-plugins-icon-container">
                                <input type="text" name="unit_measure_eqiv" class="form-control form-control-solid" placeholder="Satuan" disabled>
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
                                        <input class="form-check-input" name="convert_eqiv" type="radio" value="1" disabled>
                                        <span class="fw-bold ps-2 fs-6">Ya</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <input class="form-check-input" name="convert_eqiv" type="radio" value="0" disabled>
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
                                                <input type="text" name="convertion_measure_eqiv" class="form-control form-control-solid" disabled>
                                            </td>
                                            <td class="text-center">=</td>
                                            <td class="text-center">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control form-control-solid" name="convertion_qty_eqiv" disabled placeholder="Konversi Jumlah">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </td>
                                            <td class="text-center"><input type="text" name="measurement_eqiv" class="form-control form-control-solid" disabled></td>
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
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Status Ketersediaan Barang</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <div class="align-items-center mt-3">
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid me-5">
                                        <input class="form-check-input" name="available_eqiv" type="radio" value="0" disabled>
                                        <span class="fw-bold ps-2 fs-6">Tersedia</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <input class="form-check-input" name="available_eqiv" type="radio" value="1" disabled>
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
                                    <input type="number" name="available_total_eqiv" id="available_total_eqiv" class="form-control" placeholder="Jumlah Tersedia" min="0" disabled>
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
                                    <input type="number" name="indent_total_eqiv" id="indent_total_eqiv" class="form-control form-control-solid" placeholder="Jumlah Indent" min="0" disabled>
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
                                    <input type="number" name="indent_day_eqiv" id="indent_day_eqiv" class="form-control" placeholder="Lama Indent (Hari)" min="0" disabled>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input Group-->
                        </div>
                        <!--Begin::Input Group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Masa Berlaku Harga</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input class="form-control form-control-solid" name="ed_price_eqiv" placeholder="Masa Berlaku Harga" id="kt_daterangepicker_4" disabled />
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
                                <!-- <input class="form-control form-control-solid" name="notes_eqiv" placeholder="Keterangan" id="" disabled/> -->
                                <textarea class="form-control" name="notes_eqiv" placeholder="Keterangan" rows="5" disabled></textarea>
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
                                <input class="form-control  form-control-solid" name="created_by_eqiv" placeholder="Dibuat Oleh" id="" disabled />
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
                                <!-- <div class="mb-3">
                                    <input class="form-control" type="file" name="eqiv_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="eqiv_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="eqiv_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="eqiv_file[]">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="eqiv_file[]">
                                </div> -->
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
                    <!-- <button type="submit" id="kt_modal_det_rfq_goods_ekuivalen_submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button> -->
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

    var KTDataTables = (function() {
        var e;
        var target = document.querySelector("#kt_modal_det_rfq_goods_ekuivalen .modal-content");
        var blockUI = new KTBlockUI(target);
        return {
            init: function() {
                e = $("#kt_datatable_detail_rfq_goods").DataTable({
                        processing: !0,
                        serverSide: !0,
                        destroy: !0,
                        // responsive: !0,
                        // scrollY: "500px",
                        scrollX: !0,
                        // scrollCollapse: !0,
                        dom: "<'row'<'col-sm-12 col-md-12 col-lg-12'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-1'l><'col-sm-12 col-md-3'i><'col-sm-12 col-md-8'p>>",
                        // fixedHeader:    true,
                        // fixedColumns:   {
                        //     heightMatch: 'none',
                        //     leftColumns: 1,
                        //     rightColumns: 0
                        // },
                        paging: !0,
                        ordering: !0,
                        searching: !0,
                        ajax: {
                            type: "POST",
                            url: "<?php echo site_url('history/det_rfq_goods/' . $this->uri->segment(3)); ?>"
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
                        var data = e.row($(this).parents('tr')).data();
                        $("#kt_modal_det_rfq_goods h4 span#txt_rfq_no").text(data.nomor_rfq);
                        $("#kt_modal_det_rfq_goods h4 span#txt_material_code").text(data.kode_barang);
                        $("input[name=id_rfq]").val('<?php echo $this->uri->segment(3); ?>');
                        $("input[name=unit_price]").maskMoney('mask', data.harga_satuan);
                        $("input[name=material_code]").val(data.kode_barang);
                        $("input[name=material_name]").val(data.deskripsi_barang);
                        $("input[name=request_total]").val(data.jumlah_permintaan);
                        $("input[name=measurement]").val(data.satuan + ' (' + data.deskripsi_satuan + ')');
                        // if($('input[name="convert"]:checked').val() == 0) {
                        //     $("#form_convertion").hide();
                        // } else {
                        //     $("#form_convertion").show();
                        // }

                        // if(data.modified_date != null && data.modified_by != null) {
                        //     $("input[name=currency]").val(data.mata_uang);
                        //     $("input[name=unit_measure]").val(data.per_harga_satuan);
                        //     $('input[name="convert"][value="' + data.konversi + '"]').prop('checked', true);
                        //     if($('input[name="convert"]:checked').val() == 0) {
                        //         $("#form_convertion").hide();
                        //     } else {
                        //         $("#form_convertion").show();
                        //     }
                        //     $('input[name="available"][value="' + data.ketersediaan_barang + '"]').prop('checked', true);
                        //     $("input[name=ed_price]").val(data.masa_berlaku_harga);
                        //     $("input[name=notes]").val(data.keterangan);
                        //     $("input[name=created_by]").val(data.dibuat_oleh);
                        // }

                        // Last Modify (2022-07-04)
                        $("input[name=currency]").val(data.mata_uang);
                        $("input[name=unit_measure]").val(data.per_harga_satuan);
                        $('input[name="convert"][value="' + data.konversi + '"]').prop('checked', true);
                        if ($('input[name="convert"]:checked').val() == 0) {
                            $("#form_convertion").hide();
                        } else {
                            $("#form_convertion").show();
                            $("input[name=convertion_qty]").val(parseInt(data.jumlah_konversi));
                            $("input[name=convertion_measure]").val(data.per_harga_satuan);
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

                        if (data.modified_date != null && data.modified_by != null) {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('history/get_files'); ?>",
                                data: {
                                    val_1: '<?php echo $this->uri->segment(3); ?>',
                                    val_2: 0,
                                    val_3: $("input[name=material_code]").val()
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
                                                i_file += '<a href="<?php echo site_url('history/download/'); ?>' + value.nama_berkas + '" class="btn btn-icon btn-sm btn-success me-2"><i class = "fas fa-download"></i></a>';
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
                        }
                    }),
                    $('#kt_datatable_detail_rfq_goods tbody').on('click', 'button.eqiv_form_1, button.eqiv_form_2, button.eqiv_form_3, button.eqiv_form_4', function() {
                        blockUI.release();

                        var data = e.row($(this).parents('tr')).data();
                        var id = $(this).attr('id');
                        var eqiv_id = id.replace('btn_eqiv_', '');

                        $("#kt_modal_det_rfq_goods_ekuivalen h4 span#txt_rfq_no_eqiv").text(data.nomor_rfq);
                        $("#kt_modal_det_rfq_goods_ekuivalen h4 span#txt_material_code_eqiv").text(data.kode_barang);
                        $("#kt_modal_det_rfq_goods_ekuivalen h4 span#txt_seq_eqiv").text(eqiv_id);
                        $("input[name=id_rfq_eqiv]").val('<?php echo $this->uri->segment(3); ?>');
                        $("input[name=id_eqiv]").val(eqiv_id);
                        $("input[name=seq_eqiv]").val(data.urutan_rfq);
                        $("input[name=material_code_eqiv]").val(data.kode_barang);
                        $("input[name=material_name_eqiv]").val(data.deskripsi_barang);
                        $("input[name=request_total_eqiv]").val(data.jumlah_permintaan);
                        $("input[name=measurement_eqiv]").val(data.satuan + ' (' + data.deskripsi_satuan + ')');
                        $("input[name=r_measurement_eqiv]").val(data.satuan);
                        $("input[name=desc_measure_eqiv]").val(data.deskripsi_satuan);

                        // Status Ketersediaan Barang Equivalent
                        if ($('input[name="available_eqiv"]:checked').val() == 0) { // Checked Tersedia
                            $("#form_status_ketersediaan_barang_eqiv").hide();
                        } else {    // Checked Indent
                            $("#form_status_ketersediaan_barang_eqiv").show();
                        }

                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('history/get_det_rfq_eqiv'); ?>",
                            data: {
                                val_1: '<?php echo $this->uri->segment(3); ?>',
                                val_2: eqiv_id,
                                val_3: $("input[name=material_code_eqiv]").val()
                            },
                            beforeSend: function() {
                                blockUI.block();
                            },
                            success: function(response) {
                                blockUI.release();
                                var obj = jQuery.parseJSON(response);
                                if (obj.code == 0) {
                                    $("input[name=currency_eqiv]").val(obj.data.mata_uang);
                                    $("input[name=unit_price_eqiv]").maskMoney('mask', parseInt(obj.data.harga_satuan));
                                    $("input[name=unit_measure_eqiv]").val(obj.data.per_harga_satuan);
                                    $('input[name="convert_eqiv"][value="' + obj.data.konversi + '"]').prop('checked', true);
                                    if ($('input[name="convert_eqiv"]:checked').val() == 0) {
                                        $("#form_convertion_eqiv").hide();
                                    } else {
                                        $("#form_convertion_eqiv").show();
                                        $("input[name=convertion_qty_eqiv]").val(parseInt(obj.data.jumlah_konversi));
                                        $("input[name=convertion_measure_eqiv]").val(obj.data.satuan_konversi);
                                    }
                                    $('input[name="available_eqiv"][value="' + obj.data.ketersediaan_barang + '"]').prop('checked', true);
                                    if ($('input[name="available_eqiv"]:checked').val() == 0) { // Status Ketersediaan Barang = Tersedia
                                            $("#form_status_ketersediaan_barang_eqiv").hide();
                                            $('#available_total_eqiv').val(0);
                                            $('#indent_total_eqiv').val(0);
                                            $('#indent_day_eqiv').val(0);
                                    } else { // Status Ketersediaan Barang = Tersedia
                                        $("#form_status_ketersediaan_barang_eqiv").show();
                                        $('#available_total_eqiv').val(parseFloat(obj.data.jumlah_tersedia));
                                        $('#indent_total_eqiv').val(parseFloat(obj.data.jumlah_inden));
                                        $('#indent_day_eqiv').val(parseFloat(obj.data.lama_inden));
                                    }
                                    $("input[name=ed_price_eqiv]").val(obj.data.masa_berlaku_harga);
                                    $("textarea[name=notes_eqiv]").val(obj.data.keterangan);
                                    $("input[name=created_by_eqiv]").val(obj.data.dibuat_oleh);
                                    var i_file = '';
                                    if (obj.files.length > 0) {
                                        $.each(obj.files, function(index, value) {
                                            i_file += '<div class="row mb-3">';
                                            i_file += '<div class="col-lg-8" id="row_eqiv_' + index + '"><input class="form-control form-control-solid" type="text" disabled value="' + value.nama_berkas_asli + '"></div>';
                                            i_file += '<div class="col-lg-2" id="link_eqiv_' + index + '">';
                                            i_file += '<a href="<?php echo site_url('history/download/'); ?>' + value.nama_berkas + '" class="btn btn-icon btn-sm btn-success me-2"><i class = "fas fa-download"></i></a>';
                                            i_file += '</div>';
                                            i_file += '</div>';
                                        });
                                    } else {
                                        i_file += '<div class="row mb-3">';
                                        i_file += '<div class="col-lg-8" id="row_eqiv"><input class="form-control form-control-solid" type="text" disabled value="Tidak ada berkas yang diupload"></div>';
                                        i_file += '</div>';
                                    }
                                    $("#input_file_eqiv").html(i_file);
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
                            unit_price: {
                                validators: {
                                    notEmpty: {
                                        message: "Harga Satuan tidak boleh kosong"
                                    }
                                }
                            },
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
                            available: {
                                validators: {
                                    notEmpty: {
                                        message: "Wajib pilih salah satu"
                                    }
                                }
                            },
                            ed_price: {
                                validators: {
                                    notEmpty: {
                                        message: "Masa Berlaku Harga tidak boleh kosong"
                                    }
                                }
                            },
                            created_by: {
                                validators: {
                                    notEmpty: {
                                        message: "Dibuat Oleh tidak boleh kosong"
                                    }
                                }
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
                    // d.addEventListener("click", function (e) {
                    //     e.preventDefault(),
                    //         g &&
                    //             g.validate().then(function (e) {
                    //                     var frmData = new FormData(c);
                    //                     "Valid" == e
                    //                         ? (
                    //                             Swal.fire({
                    //                                 text: "Pastikan data yang Anda isi sudah benar dan dapat dipertanggung jawabkan",
                    //                                 icon: "warning",
                    //                                 showCancelButton: !0,
                    //                                 buttonsStyling: !1,
                    //                                 confirmButtonText: "Ya, Simpan",
                    //                                 cancelButtonText: "Kembali",
                    //                                 customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light" },
                    //                             }).then(function (r) {
                    //                                 r.value
                    //                                     ? 
                    //                                     (
                    //                                         $.ajax({
                    //                                             type: 'POST',
                    //                                             url: c.getAttribute('action'),
                    //                                             data: frmData,
                    //                                             processData: false,
                    //                                             contentType: false,
                    //                                             beforeSend: function() {
                    //                                                 d.setAttribute("data-kt-indicator", "on"),
                    //                                                 (d.disabled = !0);
                    //                                             },
                    //                                             success: function(response) {
                    //                                                 var obj = jQuery.parseJSON(response);
                    //                                                 d.removeAttribute("data-kt-indicator"),
                    //                                                 (d.disabled = !1);
                    //                                                 Swal.fire({ 
                    //                                                     text: obj.msg, 
                    //                                                     icon: obj.status, 
                    //                                                     buttonsStyling: !1, 
                    //                                                     confirmButtonText: "Tutup", 
                    //                                                     customClass: { confirmButton: "btn btn-primary" } }).then(
                    //                                                     function (t) {
                    //                                                         t.isConfirmed && (obj.code == 0) ? (KTDataTables.init(),g.resetForm(true),b.hide()) : r.dismiss;
                    //                                                     }
                    //                                                 );
                    //                                             },
                    //                                             error: function() {
                    //                                                 d.removeAttribute("data-kt-indicator"),
                    //                                                 (d.disabled = !1);
                    //                                                 Swal.fire({ 
                    //                                                     text: "Terjadi masalah koneksi", 
                    //                                                     icon: "error", 
                    //                                                     buttonsStyling: !1, 
                    //                                                     confirmButtonText: "Tutup", 
                    //                                                     customClass: { confirmButton: "btn btn-primary" } }).then(
                    //                                                     function (t) {
                    //                                                         t.isConfirmed && r.dismiss;
                    //                                                     }
                    //                                                 );
                    //                                             }
                    //                                         })
                    //                                     )
                    //                                     : "cancel" === r.dismiss;
                    //                             })
                    //                           )
                    //                         : Swal.fire({
                    //                               text: "Maaf, masih ada field yang kosong, silahkan diisi.",
                    //                               icon: "error",
                    //                               buttonsStyling: !1,
                    //                               confirmButtonText: "Tutup",
                    //                               customClass: { confirmButton: "btn btn-primary" },
                    //                           });
                    //             });
                    // }),
                    e.addEventListener("click", function(t) {
                        $("#input_file div").remove(), g.resetForm(true), b.hide()
                    })),
                f.addEventListener("click", function(t) {
                    $("#input_file div").remove(), g.resetForm(true), b.hide()
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
                            unit_price_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Harga Satuan tidak boleh kosong"
                                    }
                                }
                            },
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
                            available_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Wajib pilih salah satu"
                                    }
                                }
                            },
                            ed_price_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Masa Berlaku Harga tidak boleh kosong"
                                    }
                                }
                            },
                            created_by_eqiv: {
                                validators: {
                                    notEmpty: {
                                        message: "Dibuat Oleh tidak boleh kosong"
                                    }
                                }
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
                    // w.addEventListener("click", function (e) {
                    //     e.preventDefault(),
                    //         z &&
                    //             z.validate().then(function (e) {
                    //                     var frmData_eqiv = new FormData(v);
                    //                     "Valid" == e
                    //                         ? (
                    //                             Swal.fire({
                    //                                 text: "Pastikan data yang Anda isi sudah benar dan dapat dipertanggung jawabkan",
                    //                                 icon: "warning",
                    //                                 showCancelButton: !0,
                    //                                 buttonsStyling: !1,
                    //                                 confirmButtonText: "Ya, Simpan",
                    //                                 cancelButtonText: "Kembali",
                    //                                 customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light" },
                    //                             }).then(function (r) {
                    //                                 r.value
                    //                                     ? 
                    //                                     (
                    //                                         $.ajax({
                    //                                             type: 'POST',
                    //                                             url: v.getAttribute('action'),
                    //                                             data: frmData_eqiv,
                    //                                             processData: false,
                    //                                             contentType: false,
                    //                                             beforeSend: function() {
                    //                                                 w.setAttribute("data-kt-indicator", "on"),
                    //                                                 (w.disabled = !0);
                    //                                             },
                    //                                             success: function(response) {
                    //                                                 var obj = jQuery.parseJSON(response);
                    //                                                 w.removeAttribute("data-kt-indicator"),
                    //                                                 (w.disabled = !1);
                    //                                                 Swal.fire({ 
                    //                                                     text: obj.msg, 
                    //                                                     icon: obj.status, 
                    //                                                     buttonsStyling: !1, 
                    //                                                     confirmButtonText: "Tutup", 
                    //                                                     customClass: { confirmButton: "btn btn-primary" } }).then(
                    //                                                     function (t) {
                    //                                                         t.isConfirmed && (obj.code == 0) ? (KTDataTables.init(),z.resetForm(true),u.hide()) : r.dismiss;
                    //                                                     }
                    //                                                 );
                    //                                             },
                    //                                             error: function() {
                    //                                                 w.removeAttribute("data-kt-indicator"),
                    //                                                 (w.disabled = !1);
                    //                                                 Swal.fire({ 
                    //                                                     text: "Terjadi masalah koneksi", 
                    //                                                     icon: "error", 
                    //                                                     buttonsStyling: !1, 
                    //                                                     confirmButtonText: "Tutup", 
                    //                                                     customClass: { confirmButton: "btn btn-primary" } }).then(
                    //                                                     function (t) {
                    //                                                         t.isConfirmed && r.dismiss;
                    //                                                     }
                    //                                                 );
                    //                                             }
                    //                                         })
                    //                                     )
                    //                                     : "cancel" === r.dismiss;
                    //                             })
                    //                           )
                    //                         : Swal.fire({
                    //                               text: "Maaf, masih ada field yang kosong, silahkan diisi.",
                    //                               icon: "error",
                    //                               buttonsStyling: !1,
                    //                               confirmButtonText: "Tutup",
                    //                               customClass: { confirmButton: "btn btn-primary" },
                    //                           });
                    //             });
                    // }),
                    x.addEventListener("click", function(t) {
                        $("#input_file_eqiv div").remove(), z.resetForm(true), u.hide()
                    })),
                y.addEventListener("click", function(t) {
                    $("#input_file_eqiv div").remove(), z.resetForm(true), u.hide()
                });
            }
        }
    })();

    KTUtil.onDOMContentLoaded((function() {
        KTDataTables.init();
        KTModalForm.rfq_form();
        KTModalForm.eqiv_form();
        $("input[name=unit_price]").maskMoney({
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 0
        });
        $("input[name=unit_price_eqiv]").maskMoney({
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 0
        });
        $("#kt_daterangepicker_3, #kt_daterangepicker_4").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format("YYYY"), 10),
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
        $("input[name=convert]").on("change", function() {
            if ($(this).is(':checked')) {
                if ($(this).val() == 0) {
                    $("#form_convertion").hide();
                } else {
                    $("#form_convertion").show();
                }
            }
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
        $("input[name=available_eqiv]").on('change', function() {
            if ($(this).is(':checked')) {
                if ($(this).val() == 0) {   // Checked Tersedia
                    // Hide object Jumlah Tersedia, Jumlah Indent, Lama Indent
                    $('#form_status_ketersediaan_barang_eqiv').hide();
                    $('#available_total_eqiv').val(0);
                    $('#indent_total_eqiv').val(0);
                    $('#indent_day_eqiv').val(0);
                    
                } else {    // Checked Indent
                    // Show object Jumlah Tersedia, Jumlah Indent, Lama Indent
                    $('#form_status_ketersediaan_barang_eqiv').show();
                    $('#available_total_eqiv').val(0);
                    $('#indent_total_eqiv').val(0);
                    $('#indent_day').val(0);
                }
            }
        });
    }));
</script>