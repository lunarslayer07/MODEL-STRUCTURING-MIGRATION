<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class HrSchemaTest extends TestCase
{
    use RefreshDatabase;

    public function test_hr_schema_and_relationships_are_defined(): void
    {
        $expectedTables = [
            'regions',
            'countries',
            'locations',
            'jobs',
            'departments',
            'employees',
            'dependents',
            'job_history',
        ];

        foreach ($expectedTables as $table) {
            $this->assertTrue(Schema::hasTable($table), "Missing table: {$table}");
        }

        $this->assertTrue(method_exists(\App\Models\Region::class, 'countries'));
        $this->assertTrue(method_exists(\App\Models\Country::class, 'region'));
        $this->assertTrue(method_exists(\App\Models\Location::class, 'country'));
        $this->assertTrue(method_exists(\App\Models\Job::class, 'employees'));
        $this->assertTrue(method_exists(\App\Models\Department::class, 'employees'));
        $this->assertTrue(method_exists(\App\Models\Employee::class, 'department'));
        $this->assertTrue(method_exists(\App\Models\Employee::class, 'manager'));
        $this->assertTrue(method_exists(\App\Models\Dependent::class, 'employee'));
        $this->assertTrue(method_exists(\App\Models\JobHistory::class, 'employee'));
    }
}
