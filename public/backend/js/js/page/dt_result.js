(function (namespace, $) {
    "use strict";

    var StudentResultDataTable = function () {
        var o = this;
        $(document).ready(function () {
            o.initialize();
        });
    };

    var p = StudentResultDataTable.prototype;

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
        var $dt_result = $("#dt_result");

        var table = $dt_result.DataTable({
            "dom": '<"clear">lfrtip',
            "order": [[3, "desc"]],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "type": "POST",
                "url": $dt_result.data("source")
            },
            "pageLength": "50",
            "columns": [
                {"data": "registration_id", "name": "registration_id", "class": "text-center"},
                {"data": "email", "name": "email", "class": "text-center"},
                {"data": "formatted_dob", "name": "formatted_dob", "class": "text-center"},
                {"data": "created_at", "name": "created_at", "bVisible": false },
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

    window.materialadmin.StudentResultDataTable = new StudentResultDataTable;
}(this.materialadmin, jQuery));