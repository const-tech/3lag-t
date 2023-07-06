<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>فاتورة كاشير</title>
        <!-- Normalize -->
        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}" />
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
        <!-- Main File Css  -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
        <!-- Font Google -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500;600;700;800&display=swap" rel="stylesheet" />
    </head>
    <body>
        <section class="casher-invoice py-5">
            <div class="container">
                <div class="row">
                    <div class="col-11 m-auto">
                        <div class="invoice-content bg-white p-3 rounded-3 shadow-sm">
                            <h4 class="invoice-name text-center mb-3 p-2 rounded-3 fw-bold">
                                فاتورة ضريبة مبسطة - 14545
                            </h4>
                            <div class="the_date d-flex align-items-center justify-content-evenly mb-3">
                                <div class="date-holder">
                                    2022-08-16
                                </div>
                                <div class="date-holder">
                                    08:52 AM
                                </div>
                            </div>
                            <div class="logo-holder m-auto text-center rounded-3 mb-3">
                                <img class="the_image mx-auto rounded-3" src="{{ asset('img/helbal-heart-logo_1071-161.jpg')}}" alt="logo">
                            </div>
                            <div class="tax number text-center mb-3">
                                <small>الرقم الضرريبي : <span class="">2022083416</span></small>
                            </div>
                            <div class="the_address mb-3 fw-bold">
                                <div class="address-holder ">
                                الرياض - شارع لعلي
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table main-table text-center rounded-3 w-100">
                                <thead class="border-0">
                                    <tr>

                                    <th class="">
                                        <div>الوصف</div>
                                        <div class="">Description</div>
                                    </th>
                                    <td>مرهم</td>

                                    </tr>
                                    <tr>
                                        <th class="">
                                        <div class="">السعر</div>
                                        <div class="">Salary</div>
                                        </th>
                                        <td>100</td>

                                    </tr>
                                        <tr>
                                        <th>
                                            <div class="">الكمية</div>
                                            <div class="">Qty</div>
                                        </th>
                                        <td>2</td>

                                        </tr>
                                        <tr>
                                        <th>
                                            <div class="">الخصم</div>
                                            <div class="">Dicsc</div>
                                        </th>
                                        <td>2</td>

                                        </tr>
                                        <tr>
                                        <th>
                                            <div class="">الضريبه</div>
                                            <div class="">Vat</div>
                                        </th>
                                        <td>2</td>

                                        </tr>
                                        <tr>
                                        <th>
                                            <div class="">الاجمالي</div>
                                            <div class="">Total</div>
                                        </th>
                                        <td>2</td>

                                        </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                </table>
                            </div>
                            <div class="d-flex flex-column bototm-table gap-2 mb-3">
                                <div class="d-flex align-items-end gap-1">
                                <div class="">
                                    <b> الأجمالي:<br> Total: </b>
                                </div>
                                <div>0</div>
                                </div>
                                <div class="d-flex align-items-end gap-1">
                                <div class="">
                                    <b> الخصم:<br> Dicsc: </b>
                                </div>
                                <div>0</div>
                                </div>
                                <div class="d-flex align-items-end gap-1">
                                <div class="">
                                    <b> المجموع قبل الخصم والضريبة:<br> Total before deduction and tax: </b>
                                </div>
                                <div>0</div>
                                </div>
                                <div class="d-flex align-items-end gap-1">
                                <div class="">
                                    <b> ضريبة القيمة المضافة:<br> value added tax: </b>
                                </div>
                                <div>0</div>
                                </div>
                                <div class="d-flex align-items-end gap-1">
                                <div class="">
                                    <b> المحموع شامل الصريبة:<br> Total including tax: </b>
                                </div>
                                <div>0</div>
                                </div>
                            </div>
                            <div class="text_area_holder mb-3">
                                <div class="w-100">
                                    <textarea class="form-control area-con" placeholder="التعليمات هنا تكون" style="height: 80px"></textarea>
                                </div>
                            </div>
                            <div class="bar_code_holder text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="125" height="125" viewBox="0 0 125 125">
                                <rect x="0" y="0" width="125" height="125" fill="#ffffff"></rect>
                                <g transform="scale(3.378)">
                                    <g transform="translate(0,0)">
                                    <path fill-rule="evenodd" d="M8 0L8 4L10 4L10 3L11 3L11 4L12 4L12 2L11 2L11 0ZM12 0L12 1L13 1L13 0ZM17 0L17 1L16 1L16 2L15 2L15 3L14 3L14 2L13 2L13 3L14 3L14 4L13 4L13 5L11 5L11 6L10 6L10 7L9 7L9 5L8 5L8 7L9 7L9 8L10 8L10 7L11 7L11 6L12 6L12 8L11 8L11 9L9 9L9 10L11 10L11 11L9 11L9 13L10 13L10 12L12 12L12 13L13 13L13 14L15 14L15 15L14 15L14 16L13 16L13 15L12 15L12 16L11 16L11 14L10 14L10 17L9 17L9 18L10 18L10 17L12 17L12 18L11 18L11 19L10 19L10 21L11 21L11 20L12 20L12 21L13 21L13 22L15 22L15 23L14 23L14 24L13 24L13 23L12 23L12 24L11 24L11 25L12 25L12 26L11 26L11 27L9 27L9 29L8 29L8 30L11 30L11 28L12 28L12 29L13 29L13 30L15 30L15 31L14 31L14 32L13 32L13 31L12 31L12 32L11 32L11 33L10 33L10 34L9 34L9 35L8 35L8 37L9 37L9 36L10 36L10 37L11 37L11 36L12 36L12 37L14 37L14 35L15 35L15 36L16 36L16 35L17 35L17 36L19 36L19 37L20 37L20 36L22 36L22 37L23 37L23 36L24 36L24 37L26 37L26 36L27 36L27 37L28 37L28 36L31 36L31 37L34 37L34 36L35 36L35 37L37 37L37 36L36 36L36 35L34 35L34 36L32 36L32 35L31 35L31 33L33 33L33 34L34 34L34 33L35 33L35 34L37 34L37 32L36 32L36 31L35 31L35 29L34 29L34 33L33 33L33 28L30 28L30 27L31 27L31 26L30 26L30 25L31 25L31 23L30 23L30 25L28 25L28 26L27 26L27 25L26 25L26 24L25 24L25 23L24 23L24 22L23 22L23 20L24 20L24 21L25 21L25 22L26 22L26 23L27 23L27 24L29 24L29 23L28 23L28 21L31 21L31 20L28 20L28 18L29 18L29 19L30 19L30 18L31 18L31 17L32 17L32 18L33 18L33 19L34 19L34 20L33 20L33 21L32 21L32 22L33 22L33 23L32 23L32 24L33 24L33 25L32 25L32 27L33 27L33 26L34 26L34 24L35 24L35 23L36 23L36 21L37 21L37 20L36 20L36 21L34 21L34 20L35 20L35 16L36 16L36 18L37 18L37 15L35 15L35 13L37 13L37 12L36 12L36 11L34 11L34 14L33 14L33 13L32 13L32 12L33 12L33 11L32 11L32 10L34 10L34 9L36 9L36 10L37 10L37 8L33 8L33 9L32 9L32 8L31 8L31 9L32 9L32 10L30 10L30 11L29 11L29 5L28 5L28 3L29 3L29 2L28 2L28 3L25 3L25 4L27 4L27 5L26 5L26 7L27 7L27 8L28 8L28 10L27 10L27 9L25 9L25 6L24 6L24 7L23 7L23 5L24 5L24 4L22 4L22 7L21 7L21 6L20 6L20 5L21 5L21 3L22 3L22 2L21 2L21 1L22 1L22 0L21 0L21 1L20 1L20 0ZM26 0L26 1L27 1L27 0ZM28 0L28 1L29 1L29 0ZM17 1L17 2L19 2L19 1ZM24 1L24 2L25 2L25 1ZM9 2L9 3L10 3L10 2ZM19 3L19 5L18 5L18 4L17 4L17 5L16 5L16 4L15 4L15 5L16 5L16 6L15 6L15 8L16 8L16 9L13 9L13 8L14 8L14 6L13 6L13 8L12 8L12 9L11 9L11 10L12 10L12 9L13 9L13 10L16 10L16 12L17 12L17 10L18 10L18 9L19 9L19 8L21 8L21 9L20 9L20 10L19 10L19 11L18 11L18 13L16 13L16 15L17 15L17 14L18 14L18 15L21 15L21 14L22 14L22 15L23 15L23 13L24 13L24 14L25 14L25 15L24 15L24 16L26 16L26 17L20 17L20 16L15 16L15 17L13 17L13 16L12 16L12 17L13 17L13 18L16 18L16 17L17 17L17 19L16 19L16 20L15 20L15 19L14 19L14 21L15 21L15 22L16 22L16 23L17 23L17 22L18 22L18 23L20 23L20 24L21 24L21 25L19 25L19 24L15 24L15 25L13 25L13 24L12 24L12 25L13 25L13 26L16 26L16 25L19 25L19 28L18 28L18 32L15 32L15 33L13 33L13 32L12 32L12 33L11 33L11 34L12 34L12 33L13 33L13 34L16 34L16 33L20 33L20 34L19 34L19 36L20 36L20 34L21 34L21 33L20 33L20 30L22 30L22 31L23 31L23 30L25 30L25 29L26 29L26 30L27 30L27 29L28 29L28 28L29 28L29 27L28 27L28 28L26 28L26 27L27 27L27 26L25 26L25 25L24 25L24 23L23 23L23 22L22 22L22 21L21 21L21 20L20 20L20 21L19 21L19 19L22 19L22 20L23 20L23 18L24 18L24 19L25 19L25 20L26 20L26 21L28 21L28 20L26 20L26 17L27 17L27 18L28 18L28 17L29 17L29 18L30 18L30 17L29 17L29 15L26 15L26 14L28 14L28 12L29 12L29 11L28 11L28 12L27 12L27 13L26 13L26 11L27 11L27 10L26 10L26 11L25 11L25 12L24 12L24 11L23 11L23 10L25 10L25 9L22 9L22 8L21 8L21 7L20 7L20 6L19 6L19 5L20 5L20 3ZM27 5L27 7L28 7L28 5ZM16 6L16 7L17 7L17 9L18 9L18 7L19 7L19 6L18 6L18 7L17 7L17 6ZM0 8L0 9L2 9L2 10L0 10L0 11L1 11L1 12L2 12L2 15L1 15L1 14L0 14L0 15L1 15L1 16L0 16L0 18L1 18L1 19L0 19L0 21L2 21L2 23L1 23L1 24L0 24L0 26L1 26L1 25L2 25L2 26L3 26L3 28L4 28L4 26L3 26L3 23L4 23L4 25L5 25L5 28L6 28L6 29L7 29L7 28L8 28L8 27L7 27L7 26L6 26L6 25L7 25L7 24L5 24L5 23L7 23L7 22L9 22L9 23L8 23L8 26L9 26L9 24L10 24L10 23L11 23L11 22L9 22L9 19L8 19L8 20L6 20L6 19L7 19L7 18L5 18L5 17L8 17L8 16L5 16L5 15L4 15L4 14L3 14L3 12L4 12L4 9L7 9L7 10L5 10L5 14L6 14L6 15L7 15L7 14L6 14L6 13L7 13L7 12L6 12L6 11L7 11L7 10L8 10L8 9L7 9L7 8L4 8L4 9L2 9L2 8ZM21 9L21 11L20 11L20 12L19 12L19 13L18 13L18 14L20 14L20 13L21 13L21 12L22 12L22 13L23 13L23 12L22 12L22 9ZM2 11L2 12L3 12L3 11ZM12 11L12 12L13 12L13 11ZM14 11L14 13L15 13L15 11ZM30 11L30 12L31 12L31 11ZM25 13L25 14L26 14L26 13ZM29 13L29 14L31 14L31 16L32 16L32 17L34 17L34 15L32 15L32 13ZM3 15L3 16L1 16L1 17L3 17L3 18L4 18L4 19L5 19L5 18L4 18L4 17L5 17L5 16L4 16L4 15ZM27 16L27 17L28 17L28 16ZM18 17L18 18L20 18L20 17ZM1 19L1 20L2 20L2 21L4 21L4 20L2 20L2 19ZM12 19L12 20L13 20L13 19ZM17 19L17 20L16 20L16 22L17 22L17 20L18 20L18 19ZM5 21L5 22L7 22L7 21ZM18 21L18 22L19 22L19 21ZM20 21L20 23L21 23L21 24L22 24L22 25L21 25L21 27L20 27L20 28L19 28L19 30L20 30L20 29L21 29L21 28L22 28L22 29L23 29L23 28L24 28L24 29L25 29L25 27L24 27L24 26L23 26L23 28L22 28L22 25L23 25L23 23L22 23L22 22L21 22L21 21ZM33 21L33 22L34 22L34 23L33 23L33 24L34 24L34 23L35 23L35 22L34 22L34 21ZM36 24L36 25L35 25L35 26L37 26L37 24ZM6 27L6 28L7 28L7 27ZM12 27L12 28L13 28L13 27ZM14 27L14 29L15 29L15 30L16 30L16 31L17 31L17 30L16 30L16 29L17 29L17 27ZM34 27L34 28L35 28L35 27ZM0 28L0 29L2 29L2 28ZM36 28L36 30L37 30L37 28ZM29 29L29 32L32 32L32 29ZM30 30L30 31L31 31L31 30ZM8 31L8 33L9 33L9 32L10 32L10 31ZM25 31L25 32L26 32L26 33L22 33L22 35L23 35L23 34L24 34L24 35L25 35L25 36L26 36L26 33L28 33L28 34L27 34L27 35L30 35L30 34L29 34L29 33L28 33L28 31L27 31L27 32L26 32L26 31ZM10 35L10 36L11 36L11 35ZM12 35L12 36L13 36L13 35ZM0 0L7 0L7 7L0 7ZM1 1L1 6L6 6L6 1ZM2 2L5 2L5 5L2 5ZM30 0L37 0L37 7L30 7ZM31 1L31 6L36 6L36 1ZM32 2L35 2L35 5L32 5ZM0 30L7 30L7 37L0 37ZM1 31L1 36L6 36L6 31ZM2 32L5 32L5 35L2 35Z" fill="#000000"></path>
                                    </g>
                                </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
