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

    public function form_attributes()
    {
        return [
            'class'=>'form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none'
        ];
    }
}
