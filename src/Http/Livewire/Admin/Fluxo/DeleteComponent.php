<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\AbstractDeleteComponent;
use Tall\Fluxo\Models\Fluxo;

class DeleteComponent extends AbstractDeleteComponent
{
    use AuthorizesRequests;

    public $title = "Excluir";

    public function mount(Fluxo $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);
        $this->verifySecurity();
    }

    public function route(){
         Route::get('/fluxos/{model}/excluir', static::class)->name('admin.fluxos.delete');
    }

    public function redirectList()
    {
        $this->confirm--;

        if($this->confirm){

            return;
        }
        return $this->kill('admin.fluxos');
    }

    public function getListProperty()
    {
        return 'admin.fluxos';
    }

    public function cancel()
    {
        return redirect()->route('admin.fluxos');
    }

    public function view()
    {
        return 'tall::admin.fluxos.delete';
    }
}
