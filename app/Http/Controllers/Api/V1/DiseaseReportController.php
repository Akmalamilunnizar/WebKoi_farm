<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\DiseaseReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiseaseReportController extends Controller
{
    public function index()
    {
        $reports = (new DiseaseReport)->getRecent();
        return view('admin.diseasereport', compact('reports'));
    }
}
