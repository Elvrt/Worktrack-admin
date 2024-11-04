import { DataTable } from "simple-datatables";

document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("data-table")) {
        const dataTable = new DataTable("#data-table", {
            header: true,
            searchable: true,
            sensitivity: "base", 
            searchQuerySeparator: "",
            sortable: true,
            paging: true,
            perPage: 5,
            perPageSelect: [5, 10, 20, 50],
            firstLast: true,
            nextPrev: true,
        });
    }
});