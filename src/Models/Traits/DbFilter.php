<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Fluxo\Models\Traits;

trait DbFilter
{


    public function scopeFilter($query, $filters=null, $term=null)
    {
        return $query->when($filters, function($builder, $filter){
            $builder->whereHas($filter, function ($queryBuilder) {
                $queryBuilder;
            });
        });
    }
    
}
