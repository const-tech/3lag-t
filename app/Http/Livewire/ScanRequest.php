<?php

namespace App\Http\Livewire;

use App\Models\ScanRequest as ModelsScanRequest;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ScanRequest extends Component
{
    public $selected_request,$scan_content,$file,$screen='index';
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public function rules(){
        return [
            'file'=>'required',
            'scan_content'=>'required',
        ];
    }
    public function show(ModelsScanRequest $request){
        $this->selected_request=$request;
        $this->screen='show';
    }
    public function submit(){
        $data=$this->validate();
        $data['file']=store_file($this->file,'scans');
        $data['scanned_at']=now()->format('Y-m-d');
        $data['delivered_at']=now()->format('Y-m-d');
        $data['status']='done';
        $this->selected_request->update($data);
        $this->selected_request=null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
        $this->reset();
    }
    public function delete(ModelsScanRequest $request){
        $request->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }
    public function render()
    {
        $requests=ModelsScanRequest::with(['doctor','patient','clinic','product'])->latest()->paginate(10);
        return view('livewire.scan-request',compact('requests'));
    }
}
