<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    public $name,$department_id,$price,$product,$filter_by_department;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'name'=>'required',
            'price'=>'required',
            'department_id'=>'required',
        ];
    }

    public function edit(Product $product){
        $this->name=$product->name;
        $this->price=$product->price;
        $this->department_id=$product->department_id;
        $this->product=$product;
    }

    public function save(){
        $data=$this->validate();
        if($this->product){
            $this->product->update($data);
        }else{
            Product::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }

    public function delete(Product $product){
        $product->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function mount(){
    }
    public function render()
    {
        $products=Product::with('department')->where(function($q){
            if($this->filter_by_department){
                $q->where('department_id',$this->filter_by_department);
            }
        })->latest()->paginate(10);
        $departments=Department::all();

        return view('livewire.products',compact('products','departments'));
    }
}
