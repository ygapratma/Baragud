<div class="card shadow-sm">
    <div class="card-header bg-success">
        <h3 class="card-title text-white"><?php echo $title; ?></h3>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-bg-white btn-icon me-2 mb-2" onclick="return KTDataTables.init();">
            <i class="las la-sync fs-1"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="kt_datatable_example_1" class="align-middle table table-row-bordered gy-5">
            <thead>
                <tr class="fw-bold fs-6 text-muted">
                    <th class="min-w-50px text-center">No.</th>
                    <th class="min-w-150px text-center">PO Number - Item</th>
                    <th class="min-w-200px text-center">Order Date - Deadline</th>
                    <th class="min-w-100px text-center">Vendor Name</th>
                    <th class="min-w-400px text-center">Material Num - Desc</th>
                    <th class="min-w-30px text-center">UoM</th>
                    <th class="min-w-30px text-center">Unit Price</th>
                    <th class="min-w-30px text-center">Order Qty</th>
                    <th class="min-w-30px text-center">Outstanding Qty</th>
                    <th class="min-w-50px text-center">Outstanding Value</th>
                    <th class="min-w-50px text-center">Late Days</th>
                    <th class="min-w-30px text-center">Progress Supply</th>
                </tr>
            </thead>
        </table>
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
                processing:!1, 
                serverSide:!1,
                destroy: !0,
                scrollX: !0,
                dom: "<'row'<'col-sm-6 col-md-6 col-lg-6 d-flex align-items-center'B ><'col-sm-6 col-md-6 col-lg-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-1'l><'col-sm-12 col-md-3'i><'col-sm-12 col-md-8'p>>",
                    buttons: [
                    {
                        extend: 'excel', 
                        exportOptions: { 
                            modifier: { 
                                page: 'all', 
                                search: 'none' 
                            }
                        },
                        text: 'Export',
                        className: 'btn btn-sm btn-success'
                    }
                ],
                paging: !0,
                ordering: !0,
                searching: !0,
                ajax: {
                    type: "POST",
                    url: "<?php echo site_url('po_status/list_os_po');?>"
                },
                columns: [
                    { data: '', className: 'text-center', sortable: true, searchable: false, orderable: true, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: 'po_number_item', className: 'text-center' },
                    { data: 'order_date_deadline', className: 'text-center' },
                    { data: 'vendor_name', className: 'text-center' },
                    { data: 'material_num_desc', className: 'text-left' },
                    { data: 'uom', className: 'text-center' },
                    { data: 'unit_price', className: 'text-center' },
                    { data: 'order_qty', className: 'text-center' },
                    { data: 'outstanding_qty', className: 'text-center' },
                    { data: 'outstanding_value', className: 'text-center' },
                    { data: 'late_days', className: 'text-center' },
                    { data: 'progress_supply', className: 'text-center' },
                ],
                lengthMenu: [
                        [5, 10, 15, 25, -1],
                        [5, 10, 15, 25, "All"]
                    ],
                pageLength: 10,
            });
        }
    };
})();

KTUtil.onDOMContentLoaded((function() {
    KTDataTables.init();
}));
</script>