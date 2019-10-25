<?php

namespace App\Traits;

use App\Models\Group;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GroupCacheable
{
    const STORED_INTERVAL = 3600 * 24;


    public function getGroupIdByGroupName(string $groupName): ?int
    {
        $groupArray = Cache::remember('groupIdsByName', self::STORED_INTERVAL, function () {
            return $this->buildGroupArray();
        });

        Log::info(json_encode($groupArray));
        Log::info('name' . $groupName);
        Log::info(json_encode(array_key_exists($groupName, $groupArray)));
        return array_key_exists($groupName, $groupArray) ? $groupArray[$groupName] : null;
    }

    public function refreshGroupCache(): void
    {
        Cache::put('groupIdsByName', $this->buildGroupArray(), self::STORED_INTERVAL);
    }

    public function buildGroupArray(): array
    {
        return Group::all()->mapWithKeys(function ($item) {
            return [$item->name => $item->id];
        })->all();
    }
}