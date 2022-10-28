<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/

namespace Tall\Fluxo\Http\Livewire\Admin\Fluxo\Fields\Db;

use Tall\Http\Livewire\FormComponent;
use Tall\Fluxo\Models\FluxoFieldDb;
use Illuminate\Support\Str;
use Tall\Schema\Schema;

class EditComponent extends FormComponent
{

    public $title = "Editar";
    public $columns = [];

    public function mount(FluxoFieldDb $model)
    {
        $this->setFormProperties($model);

        $this->getColumns(data_get($model, 'model'));
    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function updatedDataModel($value)
    {
       $this->getColumns($value);
    }

    protected function getColumns($value){
        if(class_exists($value)){
            $table = app($value)->getTable();
            $columns = $this->makeSchema()->getTable($table)->getColumns()->toArray();
            collect($columns)->map(function($collum){
                $this->columns[$collum->getName()] = $collum->getName();
            });
            $this->columns =  $this->generateForeignKeys($table, $this->columns);
       }
    }
 /**
     * Generates foreign key migrations.
     *
    * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function generateForeignKeys($table, $columns): array
    {
  
        $foreignKeys = $this->makeSchema()->getTableForeignKeys($table);     
        if ($foreignKeys->isNotEmpty()) {
            if ($foreignKeys) {
                foreach($foreignKeys as $foreignKey){
                    $name = $foreignKey->getForeignTableName();
                    $method = Str::singular($name);
                    $data = $this->makeSchema()->getTable($table)->getColumns()->toArray();
                    $foreignKeyColumns =  collect($data)->map(function($collum) {
                        return $collum->getName();
                    });
                   
                    $columns[$method] =  array_combine($foreignKeyColumns->toArray(),$foreignKeyColumns->toArray());
                }   
            }
        }
     
        return $columns;
    }

    public function getModelsProperty()
    {
        return  Schema::models();
    }
    /**
    * Get DB schema by the database connection name.
    *
   * @throws \Exception
    */
   protected function makeSchema()
   {
       return Schema::make();
   }


    public function view()
    {
        return 'tall::admin.fluxos.fields.db.edit';
    }
}
