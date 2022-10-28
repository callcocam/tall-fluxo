<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\AbstractDeleteComponent;
use Tall\Fluxo\Models\FluxoField;

class DeleteComponent extends AbstractDeleteComponent
{
    use AuthorizesRequests;

    public $title = "Excluir";

    public function mount(FluxoField $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model);
        $this->verifySecurity();
    }

    public function route(){
         Route::get('/fluxos/campos/{model}/excluir', static::class)->name('admin.fluxos.fields.delete');
    }

    public function redirectList()
    {
        $this->confirm--;

        if($this->confirm){

            return;
        }
        return $this->kill('admin.fluxos.fields');
    }

    public function getListProperty()
    {
        return 'admin.fluxos';
    }

    public function cancel()
    {
        return redirect()->route('admin.fluxos.fields');
    }

    public function view()
    {
        return 'tall::admin.fluxos.fields.delete';
    }
}
