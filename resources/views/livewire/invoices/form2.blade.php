<section class="casher-invoice py-5">
    <div class="container">
        <div class="invoice-content bg-white p-3 rounded-3 shadow-sm">
            <div class="logo-holder m-auto text-center rounded-3 mb-2">
                <img class="the_image mx-auto rounded-3" src="{{ display_file(setting()->logo) }}" alt="logo"
                    width="150">
            </div>
            <div class="tax number text-center mb-1">
                {{ setting()->site_name }}
            </div>
            <p class=" text-center mb-1">
                فاتورة ضريبة مبسطة - {{ $invoice->id }}
            </p>
            <hr class="w-75 mx-auto mt-2 mb-3">
            <div class="mb-2">
                <b>العنوان: </b> {{ setting()->address }}
            </div>
            <div class="mb-1">
                <b>رقم الجوال:</b> {{ setting()->phone }}
            </div>
            <div class=" text-center mb-1">
                <b>الرقم الضرريبي: </b> {{ setting()->tax_no }}
            </div>
            <div class="the_date d-flex align-items-center justify-content-evenly mb-1">
                
                <div class="date-holder mb-1">
                    {{ $invoice->date ? $invoice->date : $invoice->created_at->format('Y-m-d') }}
                </div>
            </div>
            <div class="mb-1"> <b>اسم العميل:</b> {{ $invoice->patient->name }}</div>
            <div class="mb-1"> <b>رقم الملف:</b> {{ $invoice->patient->id }}</div>
            <div class="mb-2"> <b>الطبيب المعالج:</b> {{ $invoice->dr?->name }}</div>

            <table class="table w-100 main-table text-center rounded-3 w-100">
                <thead class="border-0">
                    <tr>
                        <th class="">
                            <div>النوع</div>
                            <div>Type</div>
                        </th>
                        <th>
                            <div>عدد</div>
                            <div>Number</div>
                        </th>
                        <th>
                            <div>الخصم</div>
                            <div>Discount</div>
                        </th>
                        <th>
                            <div>الاجمالي</div>
                            <div>Total</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->products as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->discount }}</td>
                            <td>{{ $item->sub_total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex flex-column invoice-info gap-2 mb-2">
                <div class="d-flex align-items-end gap-1">
                    <div class="name">
                        <b> الأجمالي:<br> Total: </b>
                    </div>
                    <div class="value">{{ $invoice->total }}</div>
                </div>
                <div class="d-flex align-items-end gap-1">
                    <div class="name">
                        <b> الخصم:<br> Dicsc: </b>
                    </div>
                    <div class="value">{{ $invoice->discount + $invoice->offers_discount }}</div>
                </div>
                <div class="d-flex align-items-end gap-1">
                    <div class="name">
                        <b> المجموع قبل الخصم والضريبة:<br> Total before deduction and tax: </b>
                    </div>
                    <div class="value">{{ $invoice->amount - $invoice->discount }}</div>
                </div>
                <div class="d-flex align-items-end gap-1">
                    <div class="name">
                        <b> ضريبة القيمة المضافة:<br> value added tax: </b>
                    </div>
                    <div class="value">{{ $invoice->tax }}</div>
                </div>
                <div class="d-flex align-items-end gap-1">
                    <div class="name">
                        <b> المحموع شامل الصريبة:<br> Total including tax: </b>
                    </div>
                    <div class="value">{{ $invoice->total }}</div>
                </div>
            </div>
            <h5 class="wel text-end text-primary my-3">
                شكرا لزيارتكم
            </h5>
            <div class="d-flex flex-column align-items-start gap-2">
                <div class="d-flex parent-boxes-info  flex-column gap-2">
                    @if ($invoice->installment_company)
                        <div class="box-info-border">
                            <b>دفع تمارا</b>
                            {{ $invoice->total }}
                        </div>
                    @else
                        <div class="box-info-border">
                            <b>دفع نقدا</b>
                            {{ $invoice->cash }}
                        </div>
                        <div class="box-info-border">
                            <b>دفع شبكة</b>
                            {{ $invoice->card }}
                        </div>
                        <div class="box-info-border">
                            <b>دفع تحويل بنكي</b>
                            {{ $invoice->bank }}
                        </div>
                    @endif
                    <div class="box-info-border">
                        <b> المتبقي</b>
                        {{ $invoice->rest }}
                    </div>
                    <div class="box-info-border">
                        <b> البائع</b>
                        {{ $invoice->employee->name }}
                    </div>
                </div>
                <div class="bar_code_holder text-center">
                    {!! $qrCode !!}
                </div>
            </div>
        </div>
    </div>
</section>
