<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Expense;
use Livewire\Component;
use Livewire\WithPagination;

class Expenses extends Component
{
    public $name,$main_cat,$category_id,$amount,$notes,$expense;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'name'=>'required',
            'main_cat'=>'required',
            'category_id'=>'required',
            'amount'=>'required',
            'notes'=>'nullable',
        ];
    }
    public function edit(Expense $expense){
        $this->name=$expense->name;
        $this->amount=$expense->amount;
        $this->notes=$expense->notes;
        $this->main_cat=$expense->category->main->id;
        $this->category_id=$expense->category_id;
        $this->expense=$expense;
    }
    public function save(){
        $data=$this->validate();
        unset($data['main_cat']);
        if($this->expense){
            $this->expense->update($data);
        }else{
            Expense::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }
    public function delete(Expense $expense){
        $expense->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $expenses=Expense::with('category')->latest()->paginate(10);
        $main_cats=Category::whereNull('parent')->get();
        $sub_cats=Category::whereParent($this->main_cat)->get();
        return view('livewire.expenses',compact('expenses','main_cats','sub_cats'));
    }
}
