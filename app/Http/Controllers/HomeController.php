<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Document;
use App\Services\DocumentService;

class HomeController extends Controller
{
    private $documentService;
    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }
    public function dashboard()
    {
        $data = $this->documentService->documentList();
        return view('dashboard', $data);
    }
}
