<?php

namespace App\Http\Livewire\Packages;

use App\Models\Department;
use App\Models\Package;
use Livewire\Component;

class Packages extends Component
{
    public $package, $package_id, $title, $type, $num_of_sessions, $session_period, $total_hours, $price, $tab = 'adult', $search, $department_id;

    protected function rules()
    {
        return [

            'exercises' => 'nullable',
            'exercises.*.item' => 'required',
            'exercises.*.time' => 'required',
            'advices' => 'nullable',
            'advices.*.item' => 'nullable',
        ];
    }

    public function render()
    {
        $adultPackages = Package::when($this->title, function ($q) {
            return $q->where('title', 'LIKE', "%$this->search%");
        })->where('type', 'adult')->latest()->paginate(10);

        $childPackages = Package::when($this->title, function ($q) {
            return $q->where('title', 'LIKE', "%$this->search%");
        })->where('type', 'child')->latest()->paginate(10);

        $departments = Department::whereNull('parent')->get();

        return view('livewire.packages.packages', compact('adultPackages', 'childPackages', 'departments'));
    }

    public function edit(Package $package)
    {
        $this->title = $package->title;
        $this->department_id = $package->department_id;
        $this->type = $package->type;
        $this->num_of_sessions = $package->num_of_sessions;
        $this->session_period = $package->session_period;
        $this->price = $package->price;
        $this->package = $package;
    }

    public function submit()
    {
        // dd($this->type);

        $data = $this->validate([
            'title' => 'required',
            'department_id' => 'required',
            'type' => 'required',
            'num_of_sessions' => 'required|integer',
            'session_period' => 'required|numeric',
            'price' => 'required',
        ]);
        if ($this->package) {
            $this->package->exercises()->delete();
            $this->package->advices()->delete();
            $this->package->update($data);
        } else {
            $new_package = Package::create($data);
        }

        $package = $this->package ? $this->package : $new_package;

        // $package->exercises()->createMany($this->exercises);
        // if (!empty($this->advices)) {
        //     $package->advices()->createMany($this->advices);
        // }

        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم حفظ الباكدج بنجاح']);
        $this->mount();
    }

    public function packageId($id)
    {
        $this->package_id = $id;

        $this->package = Package::findOrFail($this->package_id);
    }

    public function delete()
    {
        if ($this->package) {

            $this->package->delete();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم الحذف بنجاح']);
            $this->reset();
            $this->mount();
        }
    }

    public function clearPackage()
    {
        $this->reset();
    }
}
