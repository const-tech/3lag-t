<?php

namespace App\Actions\Fortify;

use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        if($input['membership_type']=='driver'){
            $car_condition= "required";
          }else{
            $car_condition = "nullable";
          }
        if($input['type']=='company'){
            $company_condition= "required";
          }else{
            $company_condition = "nullable";
          }
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => $this->passwordRules(),
            'mobile' => [Rule::unique(User::class, 'mobile'), 'required'],
            'membership_type' => ['in:driver,customer', 'required'],
            'type' => ['in:individual,company', 'required'],
            'country_id' => ['exists:countries,id', 'required'],
            'tax_number' => [$company_condition, 'numeric'],
            'company_number' => [$company_condition, 'numeric'],
            'download_number' => [$company_condition, 'numeric'],
            'logistics_number' => [$company_condition, 'numeric'],
            'id_img' => ['nullable'],
            'car_name' => [$car_condition],
            'car_number' => [$car_condition],
            'color' => [$car_condition],
            'model' => [$car_condition],
            'agent_id' => ['nullable','exists:agents,id'],
            'license' => [$car_condition],
            'form' => [$car_condition],
            'card' => [$car_condition],
        ])->validate();

        if (isset($input['id_img'])) {
            $input['id_img'] = store_file($input['id_img'], 'users');
        } else {
            $input['id_img'] = null;
        }
        if (isset($input['form'])) {
            $input['form'] = store_file($input['form'], 'cars');
        } else {
            $input['form'] = null;
        }
        if (isset($input['license']) ) {
            $input['license'] = store_file($input['license'], 'users');
        } else {
            $input['license'] = null;
        }
        if (isset($input['card']) ) {
            $input['card'] = store_file($input['card'], 'cars');
        } else {
            $input['card'] = null;
        }
        if (!isset($input['company_number'])) {
            $input['tax_number'] = null;
            $input['company_number'] = null;
            $input['download_number'] = null;
            $input['logistics_number'] = null;
        }

        if ($input['membership_type'] == 'driver') {
            $input['account_status'] = app('settings')->active_drivers_directly ? 'active' : 'pending';
        }
        if ($input['membership_type'] == 'customer') {
            $input['account_status'] = app('settings')->active_customers_directly ? 'active' : 'pending';
        }
        $car=null;
        if ($input['membership_type'] == 'driver'){
            $car=Car::create([
                'name'=>$input['car_name'],
                'number'=>$input['car_number'],
                'color'=>$input['color'],
                'model'=>$input['model'],
                'agent_id'=>$input['agent_id'],
                'form'=>$input['form'],
                'card'=>$input['card'],
            ]);
        }
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'membership_type' => $input['membership_type'],
            'type' => $input['type'],
            'car_id' => $car?$car->id:$car,
            'country_id' => $input['country_id'],
            'tax_number' => $input['tax_number'],
            'company_number' => $input['company_number'],
            'download_number' => $input['download_number'],
            'logistics_number' => $input['logistics_number'],
            'id_img' => $input['id_img'],
            'license' => $input['license'],
            'password' => Hash::make($input['password']),
            'account_status' => $input['account_status'],
        ]);
    }
}
