<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Services\DocumentService;
use  App\Http\Requests\DocumentStoreRequest;

class DocumentController extends Controller
{
    private $documentService;
    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function create()
    {
        return view('documents.index');
    }

    public function store(DocumentStoreRequest $request)
    {
        try {
            $this->documentService->uploadDocument(
                $request->validated(),
                $request->file('document')
            );

            return redirect()->route('dashboard')
                ->with('success', 'Document uploaded successfully and is pending verification.');
        } catch (\Exception $e) {
            return back()->withErrors(['document' => 'Upload failed: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $document = Document::findOrFail($id);
        $this->documentService->deleteDocument($document);
        return redirect()->route('dashboard')->with('success', 'Document deleted successfully');
    }
}
