<?php 
class Usuario extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
?>