<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Fluxo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tall\Models\AbstractModel;
use Tall\Tenant\BelongsToTenants;
use Tall\Tenant\Models\Concerns\UsesTenantConnection;

class FluxoEtapaItem extends AbstractModel
{
    use HasFactory, BelongsToTenants, UsesTenantConnection;

    protected $guarded = ['id'];
    protected $with = ['fluxo_field'];

     /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    //protected $table = "table";
    
    public function fluxo_field()
    {
        return $this->belongsTo(FluxoField::class);
    }
    
    public function fluxo_etapa_produtos()
    {
        return $this->hasMany(FluxoEtapaProduto::class)->orderBy('ordering');
    }

    public function form_db()
    {
        if($fluxo_field = $this->fluxo_field){
            return  $fluxo_field->fluxo_field_db->toArray();
        }
        return [];
    }

    public function form_db_options()
    {
        if($fluxo_field = $this->fluxo_field){           
            if($db = $fluxo_field->fluxo_field_db){   
                if(class_exists($db->model)){
                    $data = app($db->model)->pluck($db->columns,$db->key_name);
                    if($data->count()){
                        return $data->toArray();
                    }
                }
            }
        }
        return null;
    }


    public function form_attributes()
    {
        if($fluxo_field = $this->fluxo_field){
            $attributes = $fluxo_field->fluxo_field_attributes()->pluck('description','name')->toArray();
            switch ($this->evento) {
                case 'defer':
                    $attributes['wire:model.defer'] = sprintf('data.%s', $fluxo_field->id);
                    break;
                case 'lazy':
                    $attributes['wire:model.lazy'] = sprintf('data.%s', $fluxo_field->id);
                    break;
                default:
                    $attributes['wire:model'] = sprintf('data.%s', $fluxo_field->id);
                    break;
            }
           
            return  $attributes;
        }
        return [
            'class'=>'form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none'
        ];
    }

    public function form_options()
    {
        if($fluxo_field = $this->fluxo_field){
            return  data_get($fluxo_field->toArray(), 'fluxo_field_options');
        }
        return null;
    }
}
