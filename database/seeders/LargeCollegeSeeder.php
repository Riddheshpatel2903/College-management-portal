<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LargeCollegeSeeder extends Seeder
{
    public function run(): void
    {
        $driver = DB::getDriverName();

        // Disable foreign key checks — syntax differs by driver
        if ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        $this->call([
            // Core users / roles / principal
            UserSeeder::class,
            PrincipalSeeder::class,

            // Academic structure
            AcademicSessionSeeder::class,
            DepartmentSeeder::class,
            HodSeeder::class,
            CourseSeeder::class,
            ClassroomSeeder::class,
            SubjectSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
            TeacherSubjectAssignmentSeeder::class,

            // Academic operations
            TimetableSeeder::class,
            AssignmentSeeder::class,
            SubmissionSeeder::class,
            AttendanceSeeder::class,
            InternalMarksSeeder::class,
            ResultSeeder::class,

            // Finance
            FeeStructureSeeder::class,
            StudentFeeSeeder::class,
            PaymentSeeder::class,

            // Communication & calendar
            NoticeSeeder::class,
            EventSeeder::class,
            HolidaySeeder::class,
            LeaveSeeder::class,

            // System usage / activity logs
            ActivityLogSeeder::class,
        ]);

        // Re-enable foreign key checks
        if ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}
