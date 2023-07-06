<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class Departments extends Component
{
    use WithPagination;
    public $name,$parent,$department,$is_lab,$is_scan;
    public $transferstatus=false;
    public $appointmentstatus=false;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'name'=>'required',
            'parent'=>'nullable',
            'transferstatus'=>'boolean',
            'appointmentstatus'=>'boolean',
            'is_lab'=>'nullable',
            'is_scan'=>'nullable',
        ];
    }

    public function edit(Department $department){
        $this->name              = $department->name;
        $this->transferstatus    = $department->transferstatus;
        $this->appointmentstatus = $department->appointmentstatus;
        $this->parent            = $department->parent;
        $this->is_lab            = $department->is_lab;
        $this->is_scan            = $department->is_scan;
        $this->department        = $department;
    }

    public function save(){
        $data=$this->validate();
        if($this->department){
            $this->department->update($data);
        }else{
            // dd($this->appointmentstatus);
            Department::create($data);
            // Department::create([
            //     'name' => $this->name,
            //     'transferstatus' => $this->transferstatus,
            //     'appointmentstatus' => $this->appointmentstatus ,
            //     'parent' => $this->parent,
            // ]);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }

    public function delete(Department $department){
        $department->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function mount(){
    }
    public function render()
    {
        $departments=Department::latest()->paginate(10);
        return view('livewire.departments',compact('departments'));
    }
}
