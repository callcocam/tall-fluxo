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

class FluxoEtapa extends AbstractModel
{
    use HasFactory, BelongsToTenants, UsesTenantConnection;

    protected $guarded = ['id'];
    // protected $with = ['fluxo_etapa_items','fluxo'];
    protected $with = ['fluxo_etapa_items','fluxo_etapa_items_all'];
    // protected $appends = ['etapa_items'];

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

    
    public function fluxo()
    {
        return $this->belongsTo(Fluxo::class);
    }
    
    public function fluxo_etapa_items_all()
    {
        return $this->hasMany(FluxoEtapaItem::class)->orderBy('ordering')->distinct();
    }
    
    public function fluxo_etapa_items()
    {
        return $this->hasMany(FluxoEtapaItem::class)->orderBy('ordering');
    }
    
    public function produtos()
    {
        return $this->hasMany(FluxoEtapaProduto::class)->orderBy('ordering');
    }
    
    public function getEtapaItemsAttribute()
    {
        return $this->fluxo->fluxo_etapas()->pluck('id','id');
    }
    
    public function getTotalAttribute()
    {
        return $this->produtos->count();
    }
}
