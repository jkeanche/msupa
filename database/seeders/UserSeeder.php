<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Creating admin user...\n";
        // Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@msupa.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        echo "Creating store managers...\n";
        // Store owner users
        $storeOwners = [
            [
                'name' => 'Naivas Manager',
                'email' => 'manager@naivas.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'vendor',
            ],
            [
                'name' => 'Carrefour Manager',
                'email' => 'manager@carrefour.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'vendor',
            ],
            [
                'name' => 'QuickMart Manager',
                'email' => 'manager@quickmart.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'vendor',
            ],
        ];

        foreach ($storeOwners as $owner) {
            User::create($owner);
        }

        echo "Creating customer users...\n";
        // Create some regular customer users directly, not using factory
        $customers = [
            [
                'name' => 'John Customer',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'customer',
            ],
            [
                'name' => 'Jane Customer',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'customer',
            ],
        ];
        
        foreach ($customers as $customer) {
            User::create($customer);
        }
        
        // Skip using the factory to avoid potential issues
        echo "Skipping factory-based user generation to avoid dependencies\n";
    }
}
