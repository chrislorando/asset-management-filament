<?php

namespace Database\Seeders;

use App\Models\EmployeeDocument;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            // Ahmad Pratama (Employee ID: 1)
            [
                'employee_id' => 1,
                'document_type' => 'contract',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2022-01-15',
                'expiry_date' => '2027-01-14',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'document_type' => 'driving_license',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2021-06-20',
                'expiry_date' => '2026-06-19',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Siti Nurhaliza (Employee ID: 2)
            [
                'employee_id' => 2,
                'document_type' => 'passport',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2021-03-20',
                'expiry_date' => '2026-03-19',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'document_type' => 'national_id',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2020-08-10',
                'expiry_date' => null, 
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'document_type' => 'medical_certificate',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2023-12-01',
                'expiry_date' => '2024-12-31',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'employee_id' => 3,
                'document_type' => 'passport',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2020-06-10',
                'expiry_date' => '2025-06-09',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3,
                'document_type' => 'driving_license',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2022-04-15',
                'expiry_date' => '2027-04-14',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3,
                'document_type' => 'work_permit',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2020-06-01',
                'expiry_date' => '2025-05-31',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dewi Lestari (Employee ID: 4)
            [
                'employee_id' => 4,
                'document_type' => 'passport',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2022-09-05',
                'expiry_date' => '2027-09-04',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 4,
                'document_type' => 'national_id',
                'file_path' => 'documents/employees/EMP004/national_id_004.pdf',
                'issue_date' => '2018-12-20',
                'expiry_date' => null,
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Rudi Hermawan (Employee ID: 5)
            [
                'employee_id' => 5,
                'document_type' => 'passport',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2023-02-01',
                'expiry_date' => '2028-01-31',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 5,
                'document_type' => 'driving_license',
                'file_path' => 'documents/employees/EMP005/driving_license_005.pdf',
                'issue_date' => '2021-11-10',
                'expiry_date' => '2026-11-09',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 5,
                'document_type' => 'medical_certificate',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2023-10-15',
                'expiry_date' => '2024-10-14',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Indah Permata (Employee ID: 6)
            [
                'employee_id' => 6,
                'document_type' => 'passport',
                'file_path' => 'documents/employees/EMP006/passport_006.pdf',
                'issue_date' => '2023-04-15',
                'expiry_date' => '2028-04-14',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 6,
                'document_type' => 'visa',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2023-11-01',
                'expiry_date' => '2024-10-31',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Eko Prasetyo (Employee ID: 7)
            [
                'employee_id' => 7,
                'document_type' => 'passport',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2022-11-20',
                'expiry_date' => '2027-11-19',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 7,
                'document_type' => 'driving_license',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2020-07-05',
                'expiry_date' => '2025-07-04',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'employee_id' => 8,
                'document_type' => 'passport',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2021-08-10',
                'expiry_date' => '2026-08-09',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 8,
                'document_type' => 'driving_license',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2019-03-25',
                'expiry_date' => '2024-03-24',
                'is_expired' => true, // Expired
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Fajar Nugroho (Employee ID: 9)
            [
                'employee_id' => 9,
                'document_type' => 'passport',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2023-06-01',
                'expiry_date' => '2028-05-31',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 9,
                'document_type' => 'national_id',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2019-09-12',
                'expiry_date' => null,
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Rina Wijaya (Employee ID: 10)
            [
                'employee_id' => 10,
                'document_type' => 'passport',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2023-07-15',
                'expiry_date' => '2028-07-14',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 10,
                'document_type' => 'medical_certificate',
                'file_path' => 'employee-documents/01KEGQM0KCXVE37Q1BN1BPQG8V.pdf',
                'issue_date' => '2023-11-20',
                'expiry_date' => '2024-11-19',
                'is_expired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        EmployeeDocument::insert($documents);
    }
}