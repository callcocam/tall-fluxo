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

class OrderComponent extends TableComponent
{
    use AuthorizesRequests;

    public function mount()
    {
        $this->authorize(Route::currentRouteName());

    }

    public function route(){
        Route::get('/fluxos/campos/order/ordenar', static::class)->name('admin.fluxos.fields.order');
    }

    public function query()
    {
          $builder = FluxoField::query()->orderBy('ordering');
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
       return 'admin.fluxos.fields.view';
    }
    public function getEditProperty()
    {
       return 'admin.fluxos.fields.edit';
    }
    public function getDeleteProperty()
    {
       return 'admin.fluxos.fields.delete';
    }
    public function view()
    {
        return 'tall::admin.fluxos.fields.order';
    }
    public function setGroupUpdatedOrder($data)
    {
        $orders = parent::setGroupUpdatedOrder($data);
        $orders = array_filter($orders);
        if($orders){
            foreach($orders as $order => $id){
                if($model=FluxoField::find( $id)){
                    $model->ordering = $order;
                    $model->update();
                }
            }
        }
        return $orders;
    }
}
