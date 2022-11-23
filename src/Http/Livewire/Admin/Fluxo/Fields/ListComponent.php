<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\TableComponent;
use Tall\Fluxo\Models\FluxoField;

class ListComponent extends TableComponent
{
    use AuthorizesRequests;

    public function mount()
    {
        $this->authorize(Route::currentRouteName());
    }

    public function route(){
        Route::get('/fluxos/campos', static::class)->name('admin.fluxos.fields');
    }

    public function query()
    {
          $builder = FluxoField::query();
        // if($role = data_get($this->filters, 'role')){
        //     $builder->whereHas('roles', function ($builder) use ($role) {
        //         $builder->where('id', $role);
        //     });
        // }
        return $builder;
    }

    public function getListProperty()
    {
        return 'admin.fluxos.fields';
    }

    public function getCreateProperty()
    {
        return 'admin.fluxos.fields.create';
    }

    public function getShowProperty()
    {
//       return 'admin.fluxos.fields.view';
    }
    public function getEditProperty()
    {
       return 'admin.fluxos.fields.edit';
    }
    
    public function getDeleteProperty()
    {
       return 'admin.fluxos.fields.delete';
    }

    public function getOrderProperty()
    {
       return 'admin.fluxos.fields.order';
    }
    public function view()
    {
        return 'tall::admin.fluxos.fields.list';
    }

}
