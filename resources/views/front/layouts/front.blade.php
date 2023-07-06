@include('front.layouts.head')
<div class="up-btn position-fixed rounded-3 not-print  text-white">
    <i class="up-ar fa-solid fa-angles-up"></i>
    <i class="tooth-icon fa-solid fa-tooth"></i>
</div>
<div class='loader-container position-fixed w-100 vh-100'>
    <img src="{{ asset('img/rolling-loader.gif') }}" alt="loader-img" class="the_loader">
</div>
@include('front.layouts.navbar')
@include('front.layouts.navbar-bottom')

<x-message-admin />
@yield('content')
@push('js')
<script>
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
    if(document.getElementById("export-btn")) {
        document.getElementById("export-btn").addEventListener("click", function() {
            var html = document.getElementById("data-table").outerHTML;
            htmlToCSV(html, "report.csv");
        });
    }
</script>
@endpush
@include('front.layouts.footer')
