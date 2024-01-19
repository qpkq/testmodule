<?php

namespace AdminDatabaseProvider\Http\Controllers\Admin;

use AdminDatabaseProvider\Services\DatabaseService;
use Illuminate\Routing\Controller;

class DatabaseController extends Controller
{
    /**
     * DatabaseController constructor.
     */
    public function __construct(
        private readonly DatabaseService $service
    ) {
    }

    public function getTables()
    {
        return $this->service->getTables();
    }
}