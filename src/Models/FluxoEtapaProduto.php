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

class FluxoEtapaProduto extends AbstractModel
{
    use HasFactory, BelongsToTenants, UsesTenantConnection;

    protected $guarded = ['id'];

    // protected $appends = ['produtos'];
    // protected $with = ['fluxo_etapa_produto_items','fluxo'];

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

    public function fluxo_etapa_produto_items()
    {
        return $this->hasMany(FluxoEtapaProdutoItem::class);
    }

    public function getProdutosAttribute()
    {
        return $this->hasMany(FluxoEtapaProdutoItem::class)->pluck('name','fluxo_field_id');
    }

    /**
    * @return string
    */
    protected function slugTo()
    {
        return false;
    }
}
