<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Fluxo\Core\Fields;

use Illuminate\Support\Str;

class Field
{

    protected $form_db_options;
    protected $label;
    protected $view = 'text';
    protected $fluxo_field;
    protected $sortable = false;
    protected $listado = false;
    protected $form_attributes = [];
    protected $form_options = [];
    protected $fluxo_field_validation = [];

    public function __construct(
        public $id,
        public $name,
        public $slug,
        public $type,
        public $description,
        public $width,
        public $visible,
        public $evento = 'defer',
        public $fluxo_field_id = null,
        public $status='published'
    )
    {
       $this->label = Str::title($name);
       if(empty($id)) $this->id = $name;
       if(empty($fluxo_field_id)) $this->fluxo_field_id = $name;
    }


    public static function make($id,
   $name,
   $slug,
   $type,
   $description,
   $width,
   $visible,
   $evento = 'defer',
   $fluxo_field_id = null,
   $status='published')
    {
      return new static($id,
      $name,
      $slug,
      $type,
      $description,
      $width,
      $visible,
      $evento,
      $fluxo_field_id,
      $status);
    }


    public function form_options($form_options)
    {
        $this->form_options = $form_options;

        return $this;
    }

    public function fluxo_field_validation($fluxo_field_validation)
    {
        $this->fluxo_field_validation = array_filter($fluxo_field_validation);

        return $this;
    }

    public function form_attributes($form_attributes)
    {
        $this->form_attributes = $form_attributes;

        return $this;
    }


    public function fluxo_field($fluxo_field)
    {
        $this->fluxo_field = $fluxo_field;

        return $this;
    }
    public function label($label)
    {
        $this->label = $label;

        return $this;
    }

    public function form_db_options($form_db_options)
    {
        $this->form_db_options = $form_db_options;

        return $this;
    }

    public function sortable($sortable)
    {
        $this->sortable = $sortable;

        return $this;
    }
    
    public function listado($listado)
    {
        $this->listado = $listado;

        return $this;
    }

    public function view($view)
    {
        $this->view = $view;

        return $this;
    }


    public function __get($name)
    {
        return $this->{$name};
    }


    public function __set($name, $value)
    {
        $this->{$name} = $value;

        return $this;
    }
}
