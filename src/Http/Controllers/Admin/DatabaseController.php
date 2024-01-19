<?php

namespace AdminDatabaseProvider\Http\Controllers\Admin;

use AdminDatabaseProvider\Services\DatabaseService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

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