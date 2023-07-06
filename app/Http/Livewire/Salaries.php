<?php

namespace App\Http\Livewire;

use App\Models\Discount;
use App\Models\Increase;
use App\Models\Overtime;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Salaries extends Component
{
    public $user_id, $reason, $date, $amount, $screen = 'salaries', $filter_by_user;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'user_id' => 'required',
            'reason' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ];
    }
    public function save_discount()
    {
        $data = $this->validate();
        Discount::create($data);
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }

    public function save_increase()
    {
        $data = $this->validate();
        Increase::create($data);
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }

    public function save_overtime()
    {
        $data = $this->validate();
        Overtime::create($data);
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }


    public function render()
    {
        $all_users = User::notAdmin()->get();
        $users = User::notAdmin()->where(function ($q) {
            if ($this->filter_by_user) {
                $q->where('id', $this->filter_by_user);
            }
        })->latest()->paginate(10);
        $sum_discounts = Discount::whereMonth('date', Carbon::now()->month)->where(function ($q) {
            if ($this->filter_by_user) {
                $q->where('user_id', $this->filter_by_user);
            }
        })->sum('amount');
        $discounts = [];

        $increases = [];

        $overtimes = [];

        if ($this->filter_by_user) {
            $discounts = Discount::where('user_id', $this->filter_by_user)->whereMonth('date', Carbon::now()->month)->latest()->paginate(10);
        }

        if ($this->filter_by_user) {
            $increases = Increase::where('user_id', $this->filter_by_user)->whereMonth('date', Carbon::now()->month)->latest()->paginate(10);
        }

        if ($this->filter_by_user) {
            $overtimes = Overtime::where('user_id', $this->filter_by_user)->whereMonth('date', Carbon::now()->month)->latest()->paginate(10);
        }


        $all_discounts = Discount::latest()->paginate(10);
        $all_increases = Increase::latest()->paginate(10);
        $all_overtimes = Overtime::latest()->paginate(10);

        return view('livewire.salaries', compact('sum_discounts', 'users', 'all_users', 'discounts', 'all_discounts', 'increases', 'all_increases', 'overtimes', 'all_overtimes'));
    }
}
