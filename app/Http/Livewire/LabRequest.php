<?php

namespace App\Http\Livewire;

use App\Models\LabRequest as ModelsLabRequest;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class LabRequest extends Component
{
    public $selected_request,$lab_content,$file,$screen='index';
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public function rules(){
        return [
            'file'=>'required',
            'lab_content'=>'required',
        ];
    }
    public function show(ModelsLabRequest $request){
        $this->selected_request=$request;
        $this->screen='show';
    }
    public function submit(){
        $data=$this->validate();
        $data['file']=store_file($this->file,'scans');
        $data['delivered_at']=now()->format('Y-m-d');
        $data['status']='done';
        $this->selected_request->update($data);
        $this->selected_request=null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
        $this->reset();
    }
    public function delete(ModelsLabRequest $request){
        $request->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }
    public function render()
    {
        $requests=ModelsLabRequest::with(['doctor','patient','clinic','product'])->latest()->paginate(10);
        return view('livewire.lab-request',compact('requests'));
    }
}
