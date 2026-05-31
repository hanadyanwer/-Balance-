<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait QueryOptimization
{
    /**
     * Cache a query result
     *
     * @param string $cacheKey
     * @param callable $query
     * @param int $minutes
     * @return mixed
     */
    public function cacheQuery($cacheKey, callable $query, $minutes = 3600)
    {
        return Cache::remember($cacheKey, $minutes, $query);
    }

    /**
     * Invalidate cache
     */
    public function invalidateCache($pattern = null)
    {
        if ($pattern) {
            Cache::tags([$pattern])->flush();
        } else {
            // Clear all application cache
            Cache::flush();
        }
    }

    /**
     * Get with caching
     */
    public function getWithCache($cacheKey, $minutes = 3600, $limit = null)
    {
        return $this->cacheQuery($cacheKey, function () use ($limit) {
            $query = $this->query();
            if ($limit) {
                return $query->limit($limit)->get();
            }
            return $query->get();
        }, $minutes);
    }
}
