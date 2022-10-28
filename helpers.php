<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

if (!function_exists('get_tenant_id')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function get_tenant_id($tenant = 'id')
    {
        
        
        $tenantId =  data_get(get_tenant(), $tenant);
        return $tenantId;
    }
}

if (!function_exists('get_tenant')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function get_tenant()
    {
        $containerKey = config('tall.multitenancy.current_tenant_container_key', 'currentTenant');
        return app($containerKey);
    }
}


if (!function_exists('date_carbom_format')) {

    function date_carbom_format($date, $format = "d/m/Y H:i:s")
    {

      
        $date = explode(" ", str_replace(["-", "/", ":"], " ", $date));
 
        if (!isset($date[0])) {
            $date[0] = null;
        }
        if (!isset($date[1])) {
            $date[1] = null;
        }
        if (!isset($date[2])) {
            $date[2] = null;
        }
        if (!isset($date[3])) {
            $date[3] = null;
        }
        if (!isset($date[4])) {
            $date[4] = null;
        }
        if (!isset($date[5])) {
            $date[5] = null;
        }
        list($y, $m, $d, $h, $i, $s) = $date;

        //$carbon = \Carbon\Carbon::now();
        $carbon = \Illuminate\Support\Facades\Date::now();
        $carbon->locale('pt');
        if (strlen($date[0]) == 4) {
            return $carbon->create($y, $m, $d, $h, $i, $s);
        }
        if ($y && $m && $d) {
            return $carbon->create($d, $m, $y, $h, $i, $s);
        }
        return $carbon->create(null, null, null, null, null, null);
    }
}

if (!function_exists('load_icones')) {
    function load_icones($search="")
    {
        if(is_dir(resource_path('views/vendor/tall/components/icons')))
        {
            $path=resource_path('views/vendor/tall/components/icons');
        }
        else{
            $path= __DIR__ . '/resources/views/components/icons';
        }
        $files =collect([]);
        foreach ((new \Symfony\Component\Finder\Finder)->in($path)->files()->name(sprintf('%s*.blade.php', $search)) as $component) {   
            $file = \Illuminate\Support\Str::beforeLast( $component->getFilename(), ".blade");  
            $files[$file] = $file;
        }    
        return $files->sortKeys()->toarray();
    }
}


if (!function_exists('published')) {
    
    function published(){
        return ['status'=>'published'];
    }
}


if (!function_exists('form')) {
    
    function form($name, $fields){
        if(collect($fields)->count()){
            if($field = collect($fields)->firstWhere('name', $name)){
                $field->hiddenIf(false);
                return $field;
            }
        }
        return null;
    }
}