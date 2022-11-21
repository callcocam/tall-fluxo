<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Fluxo\Core\Fields;

class Field 
{

    protected $form_db_options;
    protected $fluxo_field;
    protected $form_attributes = [];
    protected $form_options = [];

    public function __construct(
        public $id,
        public $name,
        public $slug,
        public $type,
        public $description,
        public $width,
        public $visible,
        public $evento = 'defer',
        public $status
    )
    {
        # code...
    }


    public static function make($id,
   $name,
   $slug,
   $type,
   $description,
   $width,
   $visible,
   $evento,
   $status)
    {
      return new static($id,
      $name,
      $slug,
      $type,
      $description,
      $width,
      $visible,
      $evento,
      $status);
    }


    public function form_options($form_options)
    {
        $this->form_options = $form_options;

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


    public function form_db_options($form_db_options)
    {
        $this->form_db_options = $form_db_options;

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
