<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Livewire\WithPagination;
use ReflectionClass;

trait livewireResource
{
    public $model, $obj, $screen = 'index', $keys, $data;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function __construct()
    {
        $this->setModelName();
        $this->keys = array_keys($this->rules());
    }
    protected function setModelName()
    {
        $reflector = new ReflectionClass($this);
        $model = $reflector->name;

        $array = explode('\\', $model);
        $model = str_replace('Controller', '', end($array));
        $model = Str::singular($model);

        if (!isset($this->model)) {
            if (class_exists('App\\Models\\' . $model)) {

                $this->model = 'App\\Models\\' . $model;
            } elseif (class_exists('App\\' . $model)) {
                $this->model = 'App\\' . $model;
            } elseif (class_exists('App\\Model\\' . $model)) {
                $this->model = 'App\\Model\\' . $model;
            }
        }
    }

    public function beforeSubmit()
    {
    }
    public function beforeCreate()
    {
    }

    public function submit()
    {
        $this->data = $this->validate();
        $this->beforeSubmit();
        if ($this->obj) {
            $this->beforeUpdate();
            $this->obj->update($this->data);
            $this->afterUpdate();
        } else {
            $this->beforeCreate();
            $this->model::create($this->data);
            $this->afterCreate();
        }
        $this->afterSubmit();
        $this->obj = null;
        $this->resetInputs();
        $this->screen = 'index';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم الحفظ بنجاح']);
    }

    public function afterSubmit()
    {
    }
    public function afterCreate()
    {
    }

    public function whileEditing()
    {
    }
    public function beforeUpdate()
    {
    }

    public function edit($id)
    {
        $edit = $this->model::findOrFail($id);
        $this->obj = $edit;
        $array = $this->keys;
        if (key_exists('password', $this->rules())) {
            array_splice($array, array_search('password', $array), 1);
        }
        foreach ($array as $key) {
            $this->$key = $edit->$key;
        }
        $this->whileEditing();

        $this->screen = 'edit';
    }

    public function afterUpdate()
    {
    }

    public function delete($id)
    {
        $delete = $this->model::findOrFail($id);
        $delete->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم الحذف بنجاح']);
    }

    public function updatedScreen()
    {
        if ($this->screen == 'index') {
            $this->resetInputs();
        }
    }

    public function resetInputs()
    {
        $this->reset($this->keys);
    }
}
