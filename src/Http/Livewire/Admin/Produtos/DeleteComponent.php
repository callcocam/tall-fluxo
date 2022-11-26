<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Produtos;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\AbstractDeleteComponent;
use Tall\Fluxo\Models\Fluxo;
use Tall\Fluxo\Models\FluxoEtapaProduto;

class DeleteComponent extends AbstractDeleteComponent
{
    use AuthorizesRequests;

    public $title = "Excluir";

    public function mount(FluxoEtapaProduto $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);
        $this->verifySecurity();
    }

    public function route(){
         Route::get('/produtos/{model}/excluir', static::class)->name('admin.fluxo.produtos.delete');
    }

    public function redirectList()
    {
        $this->confirm--;

        if($this->confirm){

            return;
        }
        return $this->kill('admin.fluxo.produtos');
    }

    public function getListProperty()
    {
        return 'admin.fluxo.produtos';
    }

    public function cancel()
    {
        return redirect()->route('admin.fluxo.produtos');
    }

    public function view()
    {
        return 'tall::admin.produtos.delete';
    }
}
