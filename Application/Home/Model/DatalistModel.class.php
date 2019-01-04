<?php
namespace Home\Model;
use Think\Model\RelationModel;

class DatalistlModel extends RelationModel{
    protected $_link = array(
        'high_level'  =>  array(
            'mapping_type' => self::BELONGS_TO,
            'foreign_key'  => 'high_id',
            'as_fields'    => 'high_name',
        ),
        'middle_level'  =>  array(
            'mapping_type' => self::BELONGS_TO,
            'foreign_key'  => 'middle_id',
            'as_fields'    => 'middle_name',
        ),
    );












}


