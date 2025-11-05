<div class="card shadow-sm">
    <div class="card-header bg-success">
        <h3 class="card-title text-white"><?php echo $title; ?></h3>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-bg-white btn-icon me-2 mb-2" onclick="return KTDataTables.init();">
                <i class="las la-sync fs-1 text-success"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="kt_datatable_rfq_head" class="align-middle table table-row-bordered gy-5">
            <thead>
                <tr class="fw-bold fs-6 text-muted">
                    <th class="min-w-50px text-center">No.</th>
                    <th class="min-w-125px text-center">No. RFQ</th>
                    <th class="min-w-125px text-center">Berkas</th>
                    <th class="min-w-80px text-center">Tgl. RFQ</th>
                    <th class="min-w-80px text-center">Tgl. Jatuh Tempo</th>
                    <th class="min-w-80px text-center">Sisa Hari Pengisian</th>
                    <th class="min-w-50px text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
"use strict";

var KTDataTables = (function() {
    var e;
    return {
        init: function() {
            e = $("#kt_datatable_rfq_head").DataTable({
                processing:!0, 
                serverSide:!0,
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
                    url: "<?php echo site_url('history/rfq_goods');?>"
                },
                columns: [
                    { data: 'number', className: 'text-center', sortable: false, searchable: false, orderable: false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: 'nomor_rfq', className: 'text-center' },
                    // { data: 'berkas',
                    //     render: function (data, type, row, meta) {
                    //         return '';
                    //     }    
                    // },
                    { data: 'berkas', className: 'text-center', sortable: false, searchable: false, orderable: false },
                    { data: 'tanggal_rfq', className: 'text-center' },
                    { data: 'tanggal_jatuh_tempo', className: 'text-center' },
                    { data: 'sisa_hari', className: 'text-center' },
                    { data: 'actions', className: 'text-center', sortable: false, searchable: false, orderable: false }
                ],
                lengthMenu: [
                        [5, 10, 15, 25, -1],
                        [5, 10, 15, 25, "All"]
                    ],
                pageLength: 10,
                order: [1, 'ASC']
            });
        }
    };
})();

KTUtil.onDOMContentLoaded((function() {
    KTDataTables.init();
}));
</script>