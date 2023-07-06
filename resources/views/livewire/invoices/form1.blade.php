<section class="container-fluid">
    <div class="res-table">
        <div dir="ltr" class="main-head">
            <img width="300" src="{{ display_file(setting()->logo) }}">
            <div class="head">
                <h1 class="ar">{{ setting()->site_name }}</h1>
                {{--  <h1><span>test</span></h1> --}}
            </div>
        </div>
        <table>
            <tr>
                <td colspan="6">
                    <div>
                        <span class="rig"><strong>أسم المريض</strong>:
                            {{ $invoice->patient->name }}</span>
                        <span dir="ltr" class="lef"><strong>Patinet Nam</strong>:-</span>
                    </div>
                </td>
                <td colspan="2">
                    -</td>
                <td colspan="1">
                    <span class="rig"><strong>رقم الملف</strong></span>
                    <span class="cen">{{ $invoice->patient->id }}</span>
                    <span dir="ltr" class="lef"><strong>File.No</strong></span>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <span class="rig"><strong>أسم الطبيب</strong></span>
                    <span>{{ $invoice->dr?->name }}</span>
                    <span dir="ltr" class="lef"><strong>Dr.Name</strong></span>
                </td>
                <td colspan="4">
                    <span class="rig"><strong>{{ __('Clinic') }}</strong></span>
                    <span>{{ $invoice->department->name }}</span>
                    <span dir="ltr" class="lef"><strong>Clinic</strong></span>
                </td>
                <td colspan="3">
                    <span class="rig"><strong>رقم الفاتورة</strong></span>
                    <span class="cen">{{ $invoice->id }}</span>
                    <span dir="ltr" class="lef"><strong>Invoice. No.</strong></span>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <span class="rig"><strong>شركة التأمين</strong></span>
                    <span class="cen">{{ $invoice->patient->insurance->name ?? null }}</span>
                    <span dir="ltr" class="lef"><strong>co.Name</strong></span>
                </td>
                <td colspan="4">
                    <span class="rig"><strong>الرقم الضريبي</strong></span>
                    <span class="cen">{{ setting()->tax_no }}</span>
                    <span class="lef" dir="ltr"><strong>Tax No.</strong></span>
                </td>
            </tr>

            <tr>
                <th colspan="3">{{ __('Service Name') }}<br />Service Name</th>
                <th>السعر<br />price</th>
                <th>العدد<br />Count</th>
                <th>الإجمالي<br />Total</th>
                <th>#الخصم<br />#Discount</th>
                <th>تحمل التأمين<br />Insuranee</th>
                <th colspan="1">%الضريبة<br />%VAT</th>
            </tr>
            @foreach ($invoice->products as $item)
                <tr>
                    <td colspan="3" dir="ltr">
                        {{ $item->product_name }}
                    </td>
                    <td>{{ $item->price }}</td>
                    <td>1</td>
                    <td>{{ $item->sub_total }}</td>
                    <td>{{ $item->discount }}</td>
                    <td>0.00</td>
                    <td colspan="1">{{ $item->tax }}</td>
                </tr>
            @endforeach

            <tr height="60px">
                <td class="hidd-1" colspan="2"></td>
                <td class="hidd-2" colspan="3"></td>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="rig pir-r"><strong>المبلغ قبل الضريبة</strong></span>
                    <span class="cen">{{ $invoice->amount }}</span>
                    <span dir="ltr pir-l" class="lef"><strong>ِAmount</strong></span>
                </td>
                <td colspan="4">
                    <span class="rig"><strong>{{ __('Date') }}</strong></span>
                    <span dir="ltr">{{ $invoice->date ? $invoice->date : $invoice->created_at->format('Y-m-d')  }}</span>
                    <span dir="ltr" class="lef"><strong>ِData</strong></span>
                </td>
                <td rowspan="2" colspan="2">
                    <span class="rig"><strong>ملاحظة</strong></span>
                    <span dir="ltr" class="lef"><strong>{{ $invoice->notes }}</strong></span>
                </td>
                <td rowspan="5">{!! $qrCode !!}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="rig pir-r"><strong>أجمالي الخصم</strong></span>
                    <span class="cen">{{ $invoice->discount + $invoice->offers_discount }}</span>
                    <span dir="ltr pir-l" class="lef"><strong>Discount</strong></span>
                </td>
                <td rowspan="2">
                    <strong>المدفوع-Paid</strong><br />{{ $invoice->installment_company?$invoice->total:$invoice->cash + $invoice->card }}
                </td>
                @if($invoice->installment_company)
                <td rowspan="2" colspan="4"><strong>تمارا-Tmara</strong><br />{{ $invoice->total }}</td>
                @else
                <td rowspan="2" colspan="2">
                    <strong>نقدي-Cash</strong><br />{{ $invoice->cash }}
                </td>
                <td rowspan="2"><strong>صراف-Atm</strong><br />{{ $invoice->card }}</td>
                @endif
                
            </tr>
            <tr>
                <td colspan="2">
                    <span class="rig pir-r"><strong>الصافي قبل الضريبة</strong></span>
                    <span class="cen pir-l">{{ $invoice->amount - $invoice->discount }}</span>
                    <span dir="ltr" class="lef"><strong>Total</strong></span>
                </td>
                <td colspan="2">
                    <span class="rig"><strong>التوقيع</strong></span>
                    <span dir="ltr" class="lef"><strong>Sing.</strong></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="rig pir-r"><strong>قيمة الضريبة المضافة</strong></span>
                    <span class="cen pir-l">{{ $invoice->tax }}</span>
                    <span dir="ltr" class="lef"><strong>VAT</strong></span>
                </td>
                <td rowspan="2" colspan="2">
                    <strong>تحمل التأمين .Ins</strong><br />0.00
                </td>
                <td rowspan="2" colspan="2">
                    <strong>المتبقي-Remain</strong><br />{{ $invoice->rest }}
                </td>
                <td colspan="2">
                    <span class="rig"><strong>هويةالمريض</strong></span>
                    <span>{{ $invoice->patient->civil }}</span>
                    <span dir="ltr" class="lef"><strong>Id</strong></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="rig pir-r"><strong>المبلغ بعد الضريبة</strong></span>
                    <span class="cen">{{ $invoice->total }}</span>
                    <span dir="ltr pir-l" class="lef"><strong>NET</strong></span>
                </td>
                <td colspan="2">
                    <div>
                        <span class="rig"><strong>{{ __('employee') }}</strong></span>
                        <span dir="ltr" class="lef"><strong>User</strong>
                            {{ $invoice->employee->name }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    العنوان:{{ setting()->address }}
                    رقم المبني:{{ setting()->build_num }}
                    رقم وحدة:{{ setting()->unit_num }}
                    الرمز البريدي:{{ setting()->postal_code }}
                    الرقم الاضافي:{{ setting()->extra_number }}
                </td>
            </tr>
        </table>
        <div dir="ltr" class="text">
            <span>-</span>
            <span>1/1</span>
            <span>-</span>
            <span>-</span>
            <span>-</span>
        </div>

    </div>
</section>
