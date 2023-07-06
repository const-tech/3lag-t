@extends('front.layouts.front')
@push('css')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    section {
        text-align: center;
        padding: 0 50px;
    }

    .main-head {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        margin-top: 30px;
        gap: 20px;
    }

    .main-head h1 {
        font-size: 27px;
        font-weight: normal;
    }

    .main-head h1.ar {
        font-size: 39px;
    }

    .main-head h1 span {
        font-weight: bold;
    }

    .main-head img {
        width: 64px;
    }

    table {
        margin: auto;
        width: 100%;
    }

    table tr td {
        padding: 5px 5px;
        position: relative;
    }

    table tr td .rig {
        float: right;
    }

    table tr td .lef {
        float: left;
        margin-right: 5px;
    }

    table tr td .cen {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    table tr td.hidd-1 {
        border-left-color: transparent;
    }

    table tr td.hidd-2 {
        border-left-color: transparent;
    }

    .text {
        display: flex;
        justify-content: space-evenly;
        margin-top: 10px;
    }

    .print {
        text-decoration: none;
        color: white;
        background-color: #2fc2df;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        margin: 20px auto 0;
        display: block;
        width: fit-content;
    }

    @media print {
        table {
            width: 100%;
        }

        table tr td div {
            display: flex;
            float: unset;
            justify-content: space-between;
        }

        section {
            padding: 0;
        }

        body {
            font-size: 6px;
        }

        table tr td .pir-r {
            margin-left: 25px;
        }

        table tr td .pir-l {
            margin-right: 25px;
        }

        .print {
            display: none;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    }
</style>
@endpush
@section('title')
{{ __('admin.Show invoice') }}
@endsection
@section('content')
@livewire('invoices.show-invoice',['invoice'=>$invoice])
@endsection
