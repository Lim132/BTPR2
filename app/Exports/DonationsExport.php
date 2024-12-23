<?php

namespace App\Exports;

use App\Models\Donation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DonationsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Donation::select(
            'created_at',
            'amount',
            'donor_name',
            'donor_email',
            'message',
            'status'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Amount (RM)',
            'Donor Name',
            'Email',
            'Message',
            'Status'
        ];
    }
}
