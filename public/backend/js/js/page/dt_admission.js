(function (namespace, $) {
    "use strict";

    var AdmissionDataTable = function () {
        var o = this;
        $(document).ready(function () {
            o.initialize();
        });
    };

    var p = AdmissionDataTable.prototype;

    p.initialize = function () {
        this._initDataTables();
    };

    p._initDataTables = function () {
        if (!$.isFunction($.fn.dataTable)) {
            return;
        }
        this.createDataTable();
    };

    p.createDataTable = function () {
        var $dt_admission = $("#dt_admission");

        var table = $dt_admission.DataTable({
            "dom": '<"clear">lfrtip',
            "order": [[1, "desc"]],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "type": "POST",
                "url": $dt_admission.data("source")
            },
            "pageLength": "50",
            "columns": [
                {"data": "name", "class": "text-left"},
                {"data": "created_at", "name": "created_at", "bVisible": false},
                {"data": "academic_year", "name": "academic_year", "class": "text-center"},
                {"data": "class", "name": "class", "class": "text-center"},
                {"data": "type", "name": "type", "class": "text-center"},
                {
                    "data": "is_activated",
                    "name": "is_activated",
                    "class": "text-center",
                    "render": function (data) {
                        return data == true ? 'Yes' : 'No';
                    }
                },
                {
                    "data": "action",
                    "class": "text-right",
                    "orderable": false,
                    "searchable": false,
                    "render": function (data) {
                        return data ? data : '-';
                    }
                }
            ],
            "drawCallback": function () {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    };

    window.materialadmin.AdmissionDataTable = new AdmissionDataTable;
}(this.materialadmin, jQuery));