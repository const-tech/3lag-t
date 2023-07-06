<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\VacationRequest;

class VacationRequests extends Component
{
    use WithFileUploads, WithPagination;
    public $screen = 'index';
    public $attachment, $date, $duration, $reason, $duration_time, $from, $to, $username, $status_reason_input, $filter_user_id;
    public function render()
    {
        $vacations = VacationRequest::latest()->where(function ($query) {
            if ($this->from) {
                $query->where('date', '>=', $this->from);
            }
            if ($this->to) {
                $query->where('date', '<=', $this->to);
            }
            if ($this->filter_user_id) {
                $query->where('user_id', $this->filter_user_id);
            }
        })->when($this->username, function ($q) {
            if ($this->username) {
                $q->whereHas('user', function ($qq) {
                    $qq->where('name', 'LIKE', "%$this->username%");
                });
            }
        })->paginate(10);
        return view('livewire.admin.vacation-requests', compact('vacations'))->extends('admin.layouts.admin');
    }

    public function accept(VacationRequest $vacation)
    {
        $vacation->update(['status' => 'accepted']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Vacation Status Changed')]);

    }

    public function reject(VacationRequest $vacation)
    {
        $data = $this->validate(['status_reason_input' => 'nullable']);
        $vacation->update(['status' => 'rejected', 'status_reason' => $data['status_reason_input']]);
        $this->reset(['status_reason_input']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Vacation Status Changed')]);
    }

// public function submit()
// {
//     $data = $this->validate([
//         'user_id' => 'required',
//         'date' => 'required',
//         'duration' => 'required',
//         'duration_time' => 'required_if:duration,part',
//         'reason' => 'required',
//         'attachment' => 'nullable|file',
//     ]);
//     // dd($data);
//     if (isset($data['attachment'])) {
//         $data['attachment'] = store_file($data['attachment'], 'vacations');
//     } else {
//         unset($data['attachment']);
//     }
//     auth()->user()->vacationRequests()->create($data);
//     $this->reset([
//         'date',
//         'duration',
//         'reason',
//         'attachment',
//         'user_id'
//     ]);
//     $this->screen = 'index';
//     $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Vacation request added successfully')]);
// }

}
