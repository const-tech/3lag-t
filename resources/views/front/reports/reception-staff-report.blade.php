@extends('front.layouts.front')
@section('title')
    {{ __('admin.Reception staff report') }}
@endsection
@section('content')
@livewire('reports.reception-staff-report')
@push('js')
<script>
    function printData() {
        let divToPrint = document.getElementById("data-table");
        newWin = window.open("");
        newWin.document.head.replaceWith(document.head.cloneNode(true));
        newWin.document.body.appendChild(divToPrint.cloneNode(true));
        setTimeout(() => {
            newWin.print();
            newWin.close();
        }, 600);
    }
    document.getElementById("print-btn").addEventListener("click", printData);

    function downloadCSVFile(csv, filename) {
        var csv_file, download_link;
        csv_file = new Blob(["\uFEFF" + csv], {
            type: "text/csv"
        });
        download_link = document.createElement("a");
        download_link.download = filename;
        download_link.href = window.URL.createObjectURL(csv_file);
        download_link.style.display = "none";
        document.body.appendChild(download_link);
        download_link.click();
    }

    function htmlToCSV(html, filename) {
        var data = [];
        var rows = document.querySelectorAll("table tr");
        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].querySelectorAll("td, th");
            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }
            data.push(row.join(","));
        }
        downloadCSVFile(data.join("\n"), filename);
    }
    document.getElementById("export-btn").addEventListener("click", function() {
        var html = document.getElementById("data-table").outerHTML;
        htmlToCSV(html, "report.csv");
    });
</script>
@endpush
@endsection
