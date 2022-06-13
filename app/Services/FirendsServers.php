<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Models\FirendRequestRecord;
use Illuminate\Support\Facades\Auth;

class FirendsServers extends BaseServers
{

    public function add($input)
    {
        $user = Auth::user();
        if ($user->id == $input['firend_id']) {
            throw new BusinessException('不可以添加自己为好友!');
        }
        FirendRequestRecord::add($user->id, $input['firend_id'], $input['apply']);
    }

    public function agree($record_id)
    {
        $record = FirendRequestRecord::findOrFail($record_id);
        dd($record);
    }

}
