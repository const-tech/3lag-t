<?php

namespace App\Http\Livewire\Invoices;

use Livewire\Component;
use Prgayman\Zatca\Facades\Zatca;
use Prgayman\Zatca\Utilis\QrCodeOptions; // Optional
class ShowInvoice extends Component
{
    public $invoice,$qrCode;
    public function mount(){
        $qrCodeOptions = new QrCodeOptions();
        $qrCodeOptions->format('svg');
        $qrCodeOptions->backgroundColor(255, 255, 255);
        $qrCodeOptions->color(0, 0, 0);
        $qrCodeOptions->size(125);
        $qrCodeOptions->margin(0);
        $qrCodeOptions->style('square', 0.5);
        $qrCodeOptions->eye('square');
        if(strlen(setting()->tax_no) == 15){
            $this->qrCode = Zatca::sellerName(setting()->site_name)
                ->vatRegistrationNumber(setting()->tax_no)
                ->timestamp($this->invoice->created_at)
                ->totalWithVat($this->invoice->total)
                ->vatTotal($this->invoice->tax)
                ->toQrCode($qrCodeOptions);
        }
    }
    public function render()
    {
        return view('livewire.invoices.show-invoice');
    }
}
