<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Fluxo\Http\Livewire\Admin\Produtos;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Fluxo\Models\FluxoEtapaProduto;
use Tall\Http\Livewire\TableComponent;
class ListComponent extends TableComponent
{
    use AuthorizesRequests;

    public function mount()
    {
        $this->authorize(Route::currentRouteName());
    }

    public function route(){
        Route::get('/produtos', static::class)->name('admin.produtos');
    }

    public function query()
    {
          $builder = FluxoEtapaProduto::query();
        // if($role = data_get($this->filters, 'role')){
        //     $builder->whereHas('roles', function ($builder) use ($role) {
        //         $builder->where('id', $role);
        //     });
        // }
        return $builder;
    }

    public function getListProperty()
    {
        return 'admin.produtos';
    }

    public function getCreateProperty()
    {
        return null;//'admin.produtos.create';
    }

    public function getShowProperty()
    {
       return 'admin.produtos.view';
    }
    public function getEditProperty()
    {
       return 'admin.produtos.edit';
    }
    
    public function getDeleteProperty()
    {
       return 'admin.produtos.delete';
    }

    public function getOrderProperty()
    {
       return 'admin.produtos.order';
    }
    public function view()
    {
        return 'tall::admin.produtos.list';
    }

}
