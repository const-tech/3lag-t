<!-- Start Footer -->
<div class="footer-bottom py-3 not-print">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <p>{{__('All rights reserved © 2022')}}</p>
            <div class="about_data d-flex align-items-center justify-content-center">
                <p class="ms-2">{{__('C Program - Medical Clinic Management 0.0.1')}}</p>
                <img class="alt_image" src="{{ asset('img/footer/doc.png') }}" alt="image">
            </div>
            <a href="https://www.const-tech.org/">
                <img src="{{ asset('img/footer/copy.png') }}" alt="logo">
            </a>
        </div>
    </div>
</div>
<!-- ENd Footer -->
<!-- Js Files -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <!-- Sweer Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    window.addEventListener('alert', ({
        detail: {
            type,
            message
        }
    }) => {
        Toast.fire({
            icon: type,
            title: message
        })
    })
</script>

<!-- Chart Js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
if(document.querySelector("#myChartDate")) {
    let xValues = ["January","February","March ","April","may","June","July","August ","September","September","October","November","December"];
    new Chart("myChartDate", {
        type: "line",
        data: {
            labels: xValues,
            datasets:  [{
            data: [860,1140,1060,1060,1070,1070,1070,1070,1110,1330,2210,7830,2478],
            borderWidth: "1px",
            pointRadius: 0,
            borderColor: "#4B94BF",
                backgroundColor: "rgba(75, 148, 191, 0.7)",
            fill: true
        }, {
            data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,1900,1900,1900,7000],
            borderColor: "rgba(210 ,214, 223, 1)",
            borderWidth: "1px",
            backgroundColor: "rgba(210 ,214, 223, 0.7)",
            pointRadius: 0,
            fill: true
        }]
        },
        options: {
        legend: {display: false}
        }
    });
}
</script>

<!-- bootstrap Tooltip -->
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
</script>
@livewireScripts
@stack('js')
</body>

</html>
