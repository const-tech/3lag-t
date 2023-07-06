<div class="box-header-invoice ">
    <div class="row align-items-center">
        <div class="col-12">
            <h6 class="text-center "><b> {{ setting()->site_name }}</b></h6>

        </div>
        <div class="col-md-4 ">
            <small class="mb-1 d-block"><b>الرقم الضريبي: </b>{{ setting()->tax_no }}</small>
            <small class="mb-1 d-block">
                <b> العنوان: </b> {{ setting()->address }}
            </small>
            <small class="mb-1 d-block"><b> الهاتف: </b>{{ setting()->phone }}</small>
        </div>
        <div class="text-center col-md-4  d-flex align-items-center justify-content-center">
            <img class="img-fluid img-logo mx-auto" src="{{ display_file(setting()->logo) }}" alt="">
        </div>
    </div>
</div>
