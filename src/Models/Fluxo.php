<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Fluxo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tall\Models\AbstractModel;
use Tall\Tenant\Models\Concerns\UsesTenantConnection;

class Fluxo extends AbstractModel
{
    use HasFactory,UsesTenantConnection;
 
    protected $guarded = ['id'];

    // protected $with = ['fluxo_etapas', 'fluxo_etapa_produtos','fluxo_fields'];
    protected $with = ['fluxo_etapas'];
    protected $appends = ['fields'];

     /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'stepAccess' => 'array',
        'stepMenus' => 'array',
    ];

    protected $table = "fluxos";

    public function getFieldsAttribute()
    {
        return $this->belongsToMany(FluxoField::class)->pluck('id','id')->toArray();
    }

    public function fluxo_fields()
    {
        return $this->belongsToMany(FluxoField::class);
    }

    public function fluxo_etapas()
    {
        return $this->hasMany(FluxoEtapa::class)->orderBy('ordering');
    }

    
    public function fluxo_etapa_produtos()
    {
        return $this->belongsTo(FluxoEtapaProduto::class);
    }
}
