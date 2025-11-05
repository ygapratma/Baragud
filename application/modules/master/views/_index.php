<!-- <style>
    table.dataTable>thead .sorting {
        vertical-align: inherit !important;
    }

    table.dataTable>thead .sorting:after {
        top: 60% !important;
    }
</style> -->
<div class="card shadow-sm">
    <div class="card-header bg-success">
        <h3 class="card-title text-white"><?php echo $title; ?></h3>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-icon btn-bg-white me-2 mb-2">
            <i class="las la-sync fs-1 text-success"></i>
            </button>
        </div>
    </div>
    <div class="card-body py-1">
        <table id="kt_datatable_example_1" class="align-middle table table-row-bordered gy-5">
            <thead>
                <tr class="fw-bold fs-6 text-muted">
                    <th class="min-w-30px text-center">No.</th>
                    <th class="min-w-100px text-center">Kode Vendor</th>
                    <th class="min-w-150px text-center">Nama Perusahaan</th>
                    <th class="min-w-150px text-center">Tanggal Registrasi</th>
                    <th class="min-w-250px text-center">Surel</th>
                    <th class="min-w-250px text-center">Alamat</th>
                    <th class="min-w-80px text-center">No. Kantor</th>
                    <!-- <th class="min-w-30px text-center">Aksi</th> -->
                </tr>
            </thead>
            <!-- <tbody class="text-gray-600 fw-bold">
                <tr>
                    <td class="text-center">10029</td>
                    <td>MARCON ELEKTRIK</td>
                    <td class="text-center">12 dEC 21</td>
                    <td>esamahkota@yahoo.com</td>
                    <td>Jl. Ir. H. Juanda No. 23A</td>
                    <td class="text-center">0811613995</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-icon btn-sm btn-success me-2 mb-2">
                            <i class="fas fa-envelope-open-text"></i>
                        </a>
                    </td>
                </tr>
            </tbody> -->
        </table>
    </div>
</div>
<script type="text/javascript">
"use strict";

var KTDataTables = (function() {
    var e;
    return {
        init: function() {
            e = $("#kt_datatable_example_1").DataTable({
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
                    url: "<?php echo site_url('master/vendor');?>"
                },
                columns: [
                    { data: 'number', className: 'text-center', sortable: false, searchable: false, orderable: false },
                    { data: 'kode_vendor', className: 'text-center' },
                    { data: 'nama_perusahaan'},
                    { data: 'tanggal_registrasi', className: 'text-center' },
                    { data: 'email_perusahaan' },
                    { data: 'alamat_perusahaan' },
                    { data: 'no_telepon', className: 'text-center' }
                    // { data: 'actions', className: 'text-center', sortable: false, searchable: false, orderable: false }
                ],
                lengthMenu: [
                        [10, 15, 25, -1],
                        [10, 15, 25, "All"]
                    ],
                pageLength: 10,
                // columnDefs: [
                //     {
                //         targets: [0, 2, 3, 4, 5, -1],
                //         sortable: false,
                //         searchable: false,
                //         orderable: false,
                //         className: 'dt-center'
                //     },
                //     {
                //         targets: [-1, -2, -3],
                //         className: 'dt-center'
                //     },
                // ],
                order: [1, 'ASC']
            });
        }
    };
})();

KTUtil.onDOMContentLoaded((function() {
    KTDataTables.init();
}));
</script>