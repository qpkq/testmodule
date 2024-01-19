<?php

namespace AdminDatabaseProvider\Http\Controllers\Admin;

use AdminDatabaseProvider\Http\Requests\Admin\CreateRecordRequest;
use AdminDatabaseProvider\Http\Requests\Admin\DeleteRecordRequest;
use AdminDatabaseProvider\Http\Requests\Admin\GetTableColumnsRequest;
use AdminDatabaseProvider\Http\Requests\Admin\GetTableRequest;
use AdminDatabaseProvider\Http\Requests\Admin\SearchRequest;
use AdminDatabaseProvider\Http\Requests\Admin\SortTableRequest;
use AdminDatabaseProvider\Http\Requests\Admin\UpdateRecordRequest;
use AdminDatabaseProvider\Services\DatabaseService;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;

class DatabaseController extends Controller
{
    /**
     * DatabaseController constructor.
     */
    public function __construct(
        private readonly DatabaseService $service
    ) {
    }

    /**
     * Get all database tables.
     *
     * @return array
     */
    public function getTables()
    {
        return $this->service->getTables();
    }

    /**
     * Get database table columns by title.
     *
     * @return array
     */
    public function getTable(GetTableRequest $request)
    {
        return $this->service->getTable($request->validated()['table']);
    }

    /**
     * Getting all columns of a table.
     *
     * @param GetTableColumnsRequest $request
     * @return array
     */
    public function getTableColumns(GetTableColumnsRequest $request)
    {
        return $this->service->getTableColumns($request->validated()['table']);
    }

    /**
     * Sort table by specified field.
     *
     * @param SortTableRequest $request
     * @return array|Collection
     */
    public function sortTable(SortTableRequest $request)
    {
        return $this->service->sortTable($request->validated());
    }

    /**
     * Search through multiple columns in the database.
     *
     * @param SearchRequest $request
     * @return Collection
     */
    public function search(SearchRequest $request)
    {
        return $this->service->search($request->validated());
    }

    /**
     * Create a record in the specified table.
     *
     * @param CreateRecordRequest $request
     * @return array|Builder|mixed
     */
    public function createRecord(CreateRecordRequest $request)
    {
        return $this->service->createRecord($request->validated());
    }

    /**
     * Update a record in the specified table.
     *
     * @param UpdateRecordRequest $request
     * @return mixed
     */
    public function updateRecord(UpdateRecordRequest $request)
    {
        return $this->service->updateRecord($request->validated());
    }

    /**
     * Delete a record in the specified table.
     *
     * @param DeleteRecordRequest $request
     * @return array|bool
     */
    public function destroyRecord(DeleteRecordRequest $request)
    {
        return $this->service->deleteRecord($request->all());
    }
}