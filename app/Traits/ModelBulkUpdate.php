<?php


namespace App\Traits;

use Carbon\Carbon;

/**
 * Trait ModelBulkUpdate
 * @package App\Traits
 * @method static|\Illuminate\Database\Eloquent\Model getModel()
 */
trait ModelBulkUpdate
{
    /**
     * Creating bulk update for model
     * @note copied from stack overflow
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $values
     * @param string $column
     * @param string|null $table
     * @return int
     */
    public function scopeBulkUpdate($query, array $values, string $column, string $table = null)
    {
        $table = $table ?? self::getModel()->getTable();

        $cases  = [];
        $ids    = [];
        $params = [];

        foreach ($values as $id => $value) {
            $id       = (int) $id;
            $cases[]  = "WHEN {$id} then ?";
            $params[] = $value;
            $ids[]    = $id;
        }

        $ids      = implode(',', $ids);
        $cases    = implode(' ', $cases);
        $params[] = now()->toDateTimeString();

        return \DB::update("UPDATE `{$table}` SET `{$column}` = CASE `id` {$cases} END, `updated_at` = ? WHERE `id` in ({$ids})", $params);
    }
}
