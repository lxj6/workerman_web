<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Models\FirendRequestRecord;
use App\Models\Firends;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::beginTransaction();
            $create = [
                'user_id' => $record->form_id,
                'firend_id' => $record->to_id,
            ];
            Firends::create($create);
            $reverse = [
                'user_id' => $record->to_id,
                'firend_id' => $record->form_id,
            ];
            Firends::create($reverse);
            $record->state = 1;
            $record->save();
            DB::commit();
        } catch (BusinessException $e) {
            DB::rollBack();
            throw new BusinessException('ServerError:'.$e->getMessage());
        }
    }

}
