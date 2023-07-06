<?php

namespace App\Http\Livewire;

use App\Models\Offer;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Offers extends Component
{
    public $product_id, $start, $end, $rate, $show, $offer, $screen = 'index';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => '$refresh'];
    protected function rules()
    {
        return [
            'product_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'rate' => 'required',
            'show' => 'nullable',
        ];
    }

    public function edit(Offer $offer)
    {
        $this->product_id = $offer->product_id;
        $this->rate = $offer->rate;
        $this->end = $offer->end;
        $this->start = $offer->start;
        $this->show = $offer->show;
        $this->offer = $offer;
        $this->screen = 'edit';
    }

    public function save()
    {
        $data = $this->validate();
        if ($this->offer) {
            $this->offer->update($data);
        } else {
            Offer::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }
    public function delete(Offer $offer)
    {
        $offer->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }
    public function updatedScreen()
    {
        if ($this->screen == 'index') {
            $this->reset();
        }
    }
    public function render()
    {
        $offers = Offer::latest()->paginate(10);
        $products = Product::all();
        return view('livewire.offers', compact('offers', 'products'));
    }
}
