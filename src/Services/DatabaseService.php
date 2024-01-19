<?php

namespace AdminDatabaseProvider\Services;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseService
{
    /**
     * Get all database tables.
     *
     * @return array
     */
    public function getTables(): array
    {
        return Arr::map(array_values(array_filter(Schema::getAllTables(), function ($table) {
            return in_array(reset($table), config('admin_panel.allowed_tables'));
        })), function ($table) {
            return [
                'title' => reset($table),
            ];
        });
    }

    /**
     * Get database table columns by title.
     *
     * @param string $title
     * @return array
     */
    public function getTable(string $title): array
    {
        if (in_array($title, AllowedTables::TABLES) && Schema::hasTable($title)) {
            return DB::table($title)
                ->select(AllowedTables::COLUMNS[$title])
                ->get()
                ->toArray();
        }

        return [];
    }

    /**
     * Getting all columns of a table.
     *
     * @param array $data
     * @return array
     */
    public function getTableColumns(array $data): array
    {
        $table = $data['table'];

        if (Schema::hasTable($table)) {
            $columnInfo = DB::select("DESCRIBE $table");

            foreach ($columnInfo as $column) {
                $columnName = $column->Field;
                $columnType = $column->Type;
                $isRequired = $column->Null === 'NO';

                $columnDetails[$columnName] = [
                    'type'      => $columnType,
                    'required'  => $isRequired,
                ];
            }

            return [
                'columns' => $columnDetails,
            ];
        }

        return [];
    }

    /**
     * Sort table by specified field.
     *
     * @param array $data
     * @return array|Collection
     */
    public function sortTable(array $data): array|Collection
    {
        if (Schema::hasTable($data['table']) && Schema::hasColumn($data['table'], $data['column'])) {
            return DB::table($data['table'])
                ->orderBy($data['column'], $data['sort_order'])
                ->select(AllowedTables::COLUMNS[$data['table']])
                ->get();
        }

        return [];
    }

    /**
     * Search through multiple columns in the database.
     *
     * @param array $data
     * @return array|Collection
     */
    public function search(array $data): array|Collection
    {
        if (!in_array($data['table'], AllowedTables::TABLES)) {
            return [];
        }

        try {
            $query = DB::table($data['table']);

            return $query->where(function ($query) use ($data) {
                foreach ($data['columns'] as $index => $column) {
                    $value = $data['values'][$index];
                    $query->orWhere($column, '=', $value);
                }
            })
                ->select(AllowedTables::COLUMNS[$data['table']])
                ->get();
        } catch (Exception) {
            return [];
        }
    }

    /**
     * Create a record in the specified table.
     *
     * @param array $data
     * @return array|Builder|mixed
     */
    public function createRecord(array $data): mixed
    {
        if (Schema::hasTable($data['table'])) {
            try {
                DB::beginTransaction();

                if (isset($data['properties']['password'])) {
                    $data['properties']['password'] = Hash::make($data['properties']['password']);
                }

                $createdObject = DB::table($data['table'])->find(
                    DB::table($data['table'])->insertGetId($data['properties'])
                );

                DB::commit();

                return $createdObject;
            } catch (Exception) {
                DB::rollBack();
            }
        }

        return [];
    }

    /**
     * Update a record in the specified table.
     *
     * @param array $data
     * @return mixed
     */
    public function updateRecord(array $data): mixed
    {
        if (Schema::hasTable($data['table']) && DB::table($data['table'])->find($data['record_id'])) {
            try {
                DB::beginTransaction();

                if (isset($data['properties']['password'])) {
                    $data['properties']['password'] = Hash::make($data['properties']['password']);
                }

                DB::table($data['table'])
                    ->where('id', $data['record_id'])
                    ->update($data['properties']);

                DB::commit();

                return DB::table($data['table'])->find($data['record_id']);
            } catch (Exception) {
                DB::rollBack();
            }
        }

        return [];
    }

    /**
     * Delete a record in the specified table.
     *
     * @param array $data
     * @return bool|array
     */
    public function deleteRecord(array $data): bool|array
    {
        if (Schema::hasTable($data['table']))
            return [
                'status' => (boolean)DB::table($data['table'])
                    ->where('id', $data['record_id'])
                    ->delete()
            ];
        return [];
    }
}