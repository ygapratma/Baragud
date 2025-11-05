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
                    <th class="min-w-125px text-center">No. RFQ</th>
                    <th class="min-w-125px text-center">Berkas</th>
                    <th class="min-w-125px text-center">Tgl. RFQ</th>
                    <th class="min-w-125px text-center">Tgl. Jatuh Tempo</th>
                    <th class="min-w-125px text-center">Sisa Hari Pengisian</th>
                    <th class="min-w-50px text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-bold">
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">7200272804</td>
                    <td class="text-center">-</td>
                    <td class="text-center">11.01.2022</td>
                    <td class="text-center">24.01.2022</td>
                    <td class="text-center">8 Hari</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-icon btn-sm btn-success me-2 mb-2">
                            <i class="fas fa-envelope-open-text"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td class="text-center">7500272804</td>
                    <td class="text-center">-</td>
                    <td class="text-center">13.01.2022</td>
                    <td class="text-center">24.01.2022</td>
                    <td class="text-center">6 Hari</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-icon btn-sm btn-success me-2 mb-2">
                            <i class="fas fa-envelope-open-text"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td class="text-center">7900272804</td>
                    <td class="text-center">-</td>
                    <td class="text-center">02.02.2022</td>
                    <td class="text-center">28.02.2022</td>
                    <td class="text-center">7 Hari</td>
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