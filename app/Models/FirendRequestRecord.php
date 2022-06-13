<?php

namespace App\Models;

class FirendRequestRecord extends DBModel
{
    protected $table = 'firend_request_record';


    public static function add($form_id, $to_id, $apply = '')
    {
        $firend          = new self();
        $firend->form_id = $form_id;
        $firend->to_id   = $to_id;
        $firend->apply   = $apply;
        $firend->save();
    }

}
