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

class FluxoField extends AbstractModel
{
    use HasFactory, BelongsToTenants, UsesTenantConnection;

    protected $guarded = ['id'];
    protected $with = ['fluxo_field_attributes', 'fluxo_field_options','fluxo_field_db','fluxo_field_validations'];
    protected $appends = ['fluxo_field_etapa','fluxo_field_validation'];

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

    public function fluxo_field_etapa_items()
    {
        return $this->hasMany(FluxoEtapaItem::class)->orderBy('ordering');
    }

    //protected $table = "table";

    public function getFluxoFieldEtapaItemsAttribute()
    {
        return $this->hasMany(FluxoEtapaItem::class)->orderBy('ordering')->pluck('id','id');
    }

    public function getFluxoFieldEtapaAttribute()
    {
        return $this->belongsTo(FluxoEtapa::class)->orderBy('ordering')->pluck('id','id');
    }

    public function getFluxoFieldValidationAttribute()
    {
        return $this->fluxo_field_validations()->pluck('description','name')->toArray();
    }
    

    public function fluxo_field_validations()
    {
        return $this->hasMany(FluxoFieldValidation::class);
    }
    
    

    public function fluxo_field_attributes()
    {
        return $this->hasMany(FluxoFieldAttribute::class)->orderBy('ordering');
    }
    
    public function fluxo_field_options()
    {
        return $this->hasMany(FluxoFieldOption::class)->orderBy('ordering');
    }
    
    public function fluxo_field_db()
    {
        return $this->hasOne(FluxoFieldDb::class);
    }
}
