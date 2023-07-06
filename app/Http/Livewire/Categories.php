<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    public $name,$parent,$category;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'name'=>'required',
            'parent'=>'nullable',
        ];
    }
    public function edit(Category $category){
        $this->name=$category->name;
        $this->parent=$category->parent;
        $this->category=$category;
    }
    public function save(){
        $data=$this->validate();
        if($this->category){
            $this->category->update($data);
        }else{
            Category::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }
    public function delete(Category $category){
        $category->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }
    public function render()
    {
        $main_cats=Category::whereNull('parent')->get();
        $categories=Category::with('main')->latest()->paginate(10);
        return view('livewire.categories',compact('main_cats','categories'));
    }
}
