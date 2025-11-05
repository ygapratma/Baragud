<div class="card shadow-sm">
    <div class="card-header bg-success">
        <h3 class="card-title text-white"><?php echo $title; ?></h3>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-bg-white btn-icon me-2 mb-2">
            <i class="las la-sync fs-1"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="kt_datatable_example_1" class="align-middle table table-row-bordered gy-5">
            <thead>
                <tr class="fw-bold fs-6 text-muted">
                    <th class="min-w-50px text-center">No.</th>
                    <th class="min-w-80px text-center">No. PO/ Unduh</th>
                    <th class="min-w-50px text-center">Lampiran PO</th>
                    <th class="min-w-50px text-center">Download Template</th>
                    <th class="min-w-50px text-center">Unggah File Batch</th>
                    <th class="min-w-50px text-center">Tanggal Dokumen</th>
                    <th class="min-w-50px text-center">Tanggal Terima</th>
                    <th class="min-w-50px text-center">Tanggal Jatuh Tempo</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="kt_modal_upload_po_goods" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="min-width: 1280px;">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Upload</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-light ms-2" data-kt-upload-po-goods-modal-action="close" aria-label="Close">
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

            <!--begin::Modal body-->
            <div class="modal-body py-1 px-lg-4">
                <!--begin::Scroll-->
                <form id="kt_modal_upload_po_goods_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" enctype="multipart/form-data" action="<?php echo site_url('po_status/do_upload'); ?>">
                    <!--begin::Modal body-->
                    <div class="modal-body py-4 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_upload_po_goods_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_det_rfq_goods_header" data-kt-scroll-wrappers="#kt_modal_det_rfq_goods_scroll" data-kt-scroll-offset="300px" style="max-height: 144px;">
                            <input type="hidden" name="po_no" id="po_no">
                            <!--Begin::Input Group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Upload File Batch</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                    <div class="mb-3">
                                        <input class="form-control batch_file" type="file" name="batch_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    </div>
                                    <span class="form-text text-muted">File yang diperbolehkan EXCEL</span>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                                <div class="col-lg-2 fv-row fv-plugins-icon-container">
                                    <button type="submit" id="kt_modal_upload_po_goods_uploads" class="btn btn-success me-3">
                                        <span class="indicator-label">Upload</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </div>
                            <!--end::Input Group-->
                            <table id="kt_datatable_preview_batch" class="align-middle table table-row-bordered gy-5">
                                <thead>
                                    <tr class="fw-bold fs-6 text-muted">
                                        <th class="min-w-40px text-center">No.</th>
                                        <th class="min-w-80px text-center">Nomor PO</th>
                                        <th class="min-w-80px text-center">Item</th>
                                        <th class="min-w-80px text-center">Item Code</th>
                                        <th class="min-w-150px text-center">Description</th>
                                        <th class="min-w-40px text-center">Qty</th>
                                        <th class="min-w-40px text-center">UoM</th>
                                        <th class="min-w-80px text-center">Batch No</th>
                                        <th class="min-w-80px text-center">Expiry Date</th>
                                        <th class="min-w-80px text-center">Manufacture Date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_upload_po_goods_cancel" class="btn btn-light me-3">Tutup</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_modal_upload_po_goods_submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                    <div></div>
                </form>
                <!--end::Scroll-->
            </div>
            <!--end::Modal body-->
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="kt_modal_detail_po_goods" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="min-width: 1280px;">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Detail PO</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
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

            <!--begin::Modal body-->
            <div class="modal-body py-1 px-lg-4">
                <!--begin::Scroll-->
                <div class="scroll-y me-n7 pe-7" id="kt_modal_detail_po_goods_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_detail_po_goods_header" data-kt-scroll-wrappers="#kt_modal_detail_po_goods_scroll" data-kt-scroll-offset="300px" style="max-height: 144px;">
                    <table id="kt_datatable_example_2" class="align-middle table table-row-bordered gy-5">
                        <thead>
                            <tr class="fw-bold fs-6 text-muted">
                                <th class="min-w-40px text-center">No.</th>
                                <th class="min-w-125px text-center">MR. No</th>
                                <th class="min-w-80px text-center">Item Code</th>
                                <th class="min-w-250px text-center">Description</th>
                                <th class="min-w-40px text-center">Qty</th>
                                <th class="min-w-40px text-center">UoM</th>
                                <th class="min-w-80px text-center">Unit Price</th>
                                <th class="min-w-100px text-center">Amount</th>
                                <th class="min-w-70px text-center">Qty that has been sent</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold">
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">BB/TK/MR/128/X/21</td>
                                <td class="text-center">7015898</td>
                                <td class="text-center">BALL BEARING 6206 2Z/2C</td>
                                <td class="text-center">0</td>
                                <td class="text-center">BM</td>
                                <td class="text-center">75.000</td>
                                <td class="text-center">450.000</td>
                                <td class="text-center">6</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--end::Scroll-->
            </div>
            <!--end::Modal body-->
            <!--begin::Modal footer-->
            <div class="modal-footer flex-center">
                <!--begin::Button-->
                <button type="button" id="kt_modal_detail_po_goods_cancel" data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger me-3">Tutup</button>
                <!--end::Button-->
                <!--begin::Button-->
                <button type="submit" id="kt_modal_detail_po_goods_submit" class="btn btn-primary">
                    <span class="indicator-label">Simpan</span>
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <!--end::Button-->
            </div>
            <!--end::Modal footer-->
        </div>
    </div>
</div>
<script type="text/javascript">
"use strict";

var json_data;

var KTDataTables = (function() {
    var e, f;
    return {
        init: function() {
            e = $("#kt_datatable_example_1").DataTable({
                processing:!0, 
                serverSide:!0,
                destroy: !0,
                scrollX: !0,
                dom: "<'row'<'col-sm-12 col-md-12 col-lg-12'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-1'l><'col-sm-12 col-md-3'i><'col-sm-12 col-md-8'p>>",
                paging: !0,
                ordering: !0,
                searching: !0,
                ajax: {
                    type: "POST",
                    url: "<?php echo site_url('po_status/po_goods');?>"
                },
                columns: [
                    { data: 'number', className: 'text-center', sortable: false, searchable: false, orderable: false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: 'po_no', className: 'text-center' },
                    { data: 'attachment_po', className: 'text-center', sortable: false, searchable: false, orderable: false },
                    { data: 'template', className: 'text-center', sortable: false, searchable: false, orderable: false },
                    { data: 'upload', className: 'text-center', sortable: false, searchable: false, orderable: false },
                    { data: 'tanggal_document', className: 'text-center' },
                    { data: 'tanggal_dibuat', className: 'text-center' },
                    { data: 'jatuh_tempo', className: 'text-center' }
                ],
                lengthMenu: [
                        [5, 10, 15, 25, -1],
                        [5, 10, 15, 25, "All"]
                    ],
                pageLength: 10,
                order: [1, 'ASC']
            });
        },
        preview: function(json) {
            f = $("#kt_datatable_preview_batch").DataTable({
                    responsive:!1, 
                    processing:!0, 
                    serverSide:!1,
                    destroy: !0,
                    data: json,
                    columns: [
                        { data: 'id', className: 'text-center' },
                        { data: 'nomor_po', className: 'text-center' },
                        { data: 'item_po', className: 'text-center' },
                        { data: 'kode_material', className: 'text-center' },
                        { data: 'deskripsi_material' },
                        { data: 'quantity', className: 'text-right' },
                        { data: 'satuan', className: 'text-center' },
                        { data: 'batch' },
                        { data: 'kadarluarsa', className: 'text-center' },
                        { data: 'tanggal_produksi', className: 'text-center' }
                    ],
                    lengthMenu: [
                            [10, 15, 25, -1],
                            [10, 15, 25, "All"]
                        ],
                    pageLength: 10,
            });
        }
    };
})();

var KTModalForm = (function() {
    var a, b, c, d, e, f, g, h;
    return {
        upload_form: function() {
            (a = document.querySelector("#kt_modal_upload_po_goods")) &&
            ((b = new bootstrap.Modal(a)),
            (c = document.querySelector("#kt_modal_upload_po_goods_form")),
            (d = document.getElementById("kt_modal_upload_po_goods_submit")),
            (e = document.getElementById("kt_modal_upload_po_goods_cancel")),
            (h = document.getElementById("kt_modal_upload_po_goods_uploads")),
            (f = document.querySelector('[data-kt-upload-po-goods-modal-action="close"]')),
            (g = FormValidation.formValidation(c, {
                fields: {
                    batch_file: {
                        validators: {
                            notEmpty: {
                                message: "File batch tidak boleh kosong"
                            },
                            file: {
                                extension: 'xls,xlsx', //'jpeg,jpg,png,pdf',
                                type: 'application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',//'image/jpeg,image/png,application/pdf',
                                message: 'Please choose a Excel file',//'Please choose a JPEG, JPG, PNG, & PDF file',
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
            h.addEventListener("click", function(e) {
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
                                                dataType: 'text',  // what to expect back from the PHP script, if anything
                                                cache: false,
                                                data: frmData,
                                                processData: false,
                                                contentType: false,
                                                beforeSend: function() {
                                                    h.setAttribute("data-kt-indicator", "on"),
                                                        (h.disabled = !0);
                                                },
                                                success: function(response) {
                                                    var obj = jQuery.parseJSON(response);
                                                    h.removeAttribute("data-kt-indicator");
                                                    
                                                    if(obj.code == 0) {

                                                        $('input[name="batch_file"]').attr('disabled', 'disabled');
                                                        json_data = obj.data;
                                                        KTDataTables.preview(json_data);

                                                    } else {

                                                        (h.disabled = !1)
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
                                                                t.isConfirmed && r.dismiss;
                                                            }
                                                        );

                                                    }
                                                },
                                                error: function() {
                                                    h.removeAttribute("data-kt-indicator"),
                                                        (h.disabled = !1);
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
                                text: "Maaf, masih ada field yang kosong, silahkan diisi.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Tutup",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                },
                            });
                    });
            }),
            d.addEventListener("click", function(t) {
                t.preventDefault();
                
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
                            type: "POST",
                            url: "<?php echo site_url('po_status/save_batch'); ?>",
                            data: {
                                po_no: $('input[name="po_no"]').val(),
                                upload_data: JSON.stringify(json_data)
                            },
                            beforeSend: function() {
                                d.setAttribute("data-kt-indicator", "on"),
                                (d.disabled = !0);
                            },
                            success: function(response) {
                                d.removeAttribute("data-kt-indicator"),
                                (d.disabled = !1);
                                var obj = jQuery.parseJSON(response);
                                Swal.fire({
                                    text: obj.msg,
                                    icon: obj.status,
                                    buttonsStyling: !1,
                                    confirmButtonText: "Tutup",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(
                                    function(x) {
                                        x.isConfirmed && (obj.code == 0) ? (KTDataTables.init(), $('input[name="batch_file"]').removeAttr('disabled'), h.disabled = !1, json_data = [], KTDataTables.preview(json_data), g.resetForm(true), b.hide()) : r.dismiss;
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
                                    function(x) {
                                        x.isConfirmed && r.dismiss;
                                    }
                                );
                            }
                        })
                    ) :
                    "cancel" === r.dismiss;
                });
            }),
            e.addEventListener("click", function(t) {
                g.resetForm(true), 
                $('input[name="batch_file"]').removeAttr('disabled'), 
                h.disabled = !1,
                json_data = [],
                KTDataTables.preview(json_data),
                b.hide();
            })),
            f.addEventListener("click", function(t) {
                g.resetForm(true), 
                $('input[name="batch_file"]').removeAttr('disabled'), 
                h.disabled = !1, 
                json_data = [],
                KTDataTables.preview(json_data),
                b.hide();
            });
        },
    }
})();

var KTElement = (function() {
    return {
        modal_upload: function() {
            $('#kt_modal_upload_po_goods').on('show.bs.modal', function(e) {

                //get data-id attribute of the clicked element
                var poNo = $(e.relatedTarget).data('bs-id');

                //populate the textbox
                $(e.currentTarget).find('input[name="po_no"]').val(poNo);
                KTDataTables.preview(json_data);

            });
        }
    }
})();

KTUtil.onDOMContentLoaded((function() {
    KTDataTables.init();
    KTModalForm.upload_form();
    KTElement.modal_upload();
    json_data = [];
}));
</script>