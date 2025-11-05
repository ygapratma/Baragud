<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title"><?php echo $title; ?></h3>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-primary btn-icon me-2 mb-2">
            <i class="las la-sync fs-1"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="kt_datatable_example_1" class="align-middle table table-row-bordered gy-5">
            <thead>
                <tr class="fw-bold fs-6 text-muted">
                    <th class="min-w-125px text-center">No.</th>
                    <th class="min-w-125px text-center">No. PO</th>
                    <th class="min-w-125px text-center">Berkas PO</th>
                    <th class="min-w-125px text-center">Tanggal Dokumen</th>
                    <th class="min-w-125px text-center">Tanggal Jatuh Tempo</th>
                    <th class="min-w-50px text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-bold">
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">5600097754</td>
                    <td class="text-center">-</td>
                    <td class="text-center">15.01.2022</td>
                    <td class="text-center">19.01.2022</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-icon btn-sm btn-success me-2 mb-2">
                            <i class="fas fa-envelope-open-text"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
"use strict";

var KTDataTables = (function() {
    var e;
    return {
        init: function() {
            e = $("#kt_datatable_example_1").DataTable();
        }
    };
})();

KTUtil.onDOMContentLoaded((function() {
    KTDataTables.init();
}));
</script>