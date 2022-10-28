<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Processo;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoEtapa;
use Tall\Fluxo\Models\FluxoEtapaProduto;

class EditComponent extends FormComponent
{
    use AuthorizesRequests;

    public $title = "Editar";
    public $path;

    public function mount($path, FluxoEtapaProduto $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->path = $path;
        $this->setFormProperties($model, FluxoEtapa::query()->where('path', $path)->first());
    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    protected function fields(){
        return [
            'route'=> \Tall\View\Components\Form\Input::make('Rota de acesso', 'route')->order(2),
            'path'=> \Tall\View\Components\Form\Input::make('Url', 'path')->order(3),
            'component'=> \Tall\View\Components\Form\Input::make('Componente', 'component')->order(2),
        ];
    }
   
    
    public function getListProperty()
    {
        return sprintf('admin.%s.processo.%s', data_get($this->config, 'fluxo.route', 'fluxos'),$this->config->route);
    }

    public function view()
    {
        return sprintf('tall::admin.%s.processo.edit', data_get($this->config, 'fluxo.route', 'fluxos'));
    }
}
