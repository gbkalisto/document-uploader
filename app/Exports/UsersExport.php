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
        // Fetch users with document count to match your UI
        return User::withCount('documents')->with('profile')->get();
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
            'Documents Count',
            'Account Status',
            'Joined Date',
        ];
    }

    /**
     * Map the data (Formatting rows)
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            // Use the null-safe operator to prevent crashes if profile is missing
            $user->profile?->phone ?? 'N/A',
            $user->documents_count,
            $user->is_active ? 'Active' : 'Inactive',
            $user->created_at->format('Y-m-d'),
        ];
    }
}
