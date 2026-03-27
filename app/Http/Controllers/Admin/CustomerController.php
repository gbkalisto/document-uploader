<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\CustomerService;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ZipDownloadService;
use Exception;



class CustomerController extends Controller
{
    private $customerService;
    protected $zipService;
    public function __construct(CustomerService $customerService, ZipDownloadService $zipService)
    {
        $this->customerService = $customerService;
        $this->zipService = $zipService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('query');
        $users = $this->customerService->getUsers($searchTerm);
        return view('admin.customers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {
        $fields = $request->validated();
        $this->customerService->createUser($fields);
        return redirect()->route('admin.customers.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user =  $this->customerService->editUser($id);
        return view('admin.customers.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request, string $id)
    {
        $fields = $request->validated();
        $this->customerService->updateUser($id, $fields);
        return redirect()->route('admin.customers.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->customerService->deleteUser($id);
        return redirect()->route('admin.customers.index')->with('success', 'User deleted successfully');
    }

    public function documents($id)
    {
        $user = $this->customerService->getDocuments($id);
        return view('admin.customers.documents', compact('user'));
    }

    public function export()
    {
        try {
            $fileName = 'customers_export_' . date('Y-m-d_His') . '.xlsx';
            return Excel::download(new UsersExport, $fileName);
        } catch (Exception $e) {
            return back()->with('error', 'Export failed: ' . $e->getMessage());
        }
    }

    public function exportDocuments(Request $request)
    {
        return $this->zipService->downloadAllDocuments();
    }
}
