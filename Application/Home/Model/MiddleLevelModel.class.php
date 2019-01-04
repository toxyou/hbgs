<?php
namespace Home\Model;
use Think\Model\RelationModel;

class MiddleLevelModel extends RelationModel{
    protected $_link = array(
        'high_level'  =>  array(
            'mapping_type' => self::BELONGS_TO,
            'foreign_key'  => 'high_id',
            'as_fields'    => 'high_name',
        ),
    );












}


