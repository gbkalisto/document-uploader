<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Eager load documents and profile to keep the export fast
        return User::with(['profile', 'documents'])->withCount('documents')->get();
    }

    /**
     * Table Headings
     */
    public function headings(): array
    {
        return [
            'ID',
            'Full Name',
            'Email Address',
            'Phone Number',
            'Aadhar Number',
            'Documents Count',
            'Document URLs', // New Column
            'Account Status',
            'Joined Date',
        ];
    }

    /**
     * Map the data (Formatting rows)
     */
    public function map($user): array
    {
        // Generate comma-separated full URLs
        $documentUrls = $user->documents->map(function ($doc) {
            return asset('storage/' . $doc->file_path);
        })->implode(', ');

        return [
            $user->id,
            $user->name,
            $user->email,
            $user->profile?->phone ?? 'N/A',
            $user->aadhar_last_four_digit ? 'XXXXXXXXXX ' . $user->aadhar_last_four_digit  : 'N/A',
            $user->documents_count,
            $documentUrls ?: 'N/A', // If empty, show fallback text
            $user->is_active ? 'Active' : 'Inactive',
            $user->created_at->format('Y-m-d'),
        ];
    }
}
