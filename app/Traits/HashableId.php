<?php

namespace App\Traits;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

trait HashableId
{
    public function resolveRouteBinding($value, $field = null)
    {
        // On essaie de décoder le hash
        $decoded = Hashids::decode($value);

        if (empty($decoded)) {
            abort(404);
        }

        return $this->where('id', $decoded[0])->firstOrFail();
    }

    public function getHashIdAttribute()
    {
        return Hashids::encode($this->id);
    }

    public static function findByHashOrFail($hash)
    {
        $decoded = Hashids::decode($hash);

        if (empty($decoded)) {
            abort(404, 'Sondage introuvable.');
        }
        return self::findOrFail($decoded[0]);
    }
}