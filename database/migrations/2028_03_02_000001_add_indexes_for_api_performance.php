<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'course_id')) {
                $table->index('course_id');
            }
            if (Schema::hasColumn('students', 'department_id')) {
                $table->index('department_id');
            }
            if (Schema::hasColumn('students', 'current_semester_id')) {
                $table->index('current_semester_id');
            }
        });

        Schema::table('teacher_subject_assignments', function (Blueprint $table) {
            if (Schema::hasColumn('teacher_subject_assignments', 'teacher_id')) {
                $table->index('teacher_id');
            }
            if (Schema::hasColumn('teacher_subject_assignments', 'semester_subject_id')) {
                $table->index('semester_subject_id');
            }
        });

        Schema::table('results', function (Blueprint $table) {
            if (Schema::hasColumn('results', 'student_id')) {
                $table->index('student_id');
            }
            if (Schema::hasColumn('results', 'course_id')) {
                $table->index('course_id');
            }
            if (Schema::hasColumn('results', 'semester_number')) {
                $table->index('semester_number');
            }
        });

        Schema::table('result_subjects', function (Blueprint $table) {
            if (Schema::hasColumn('result_subjects', 'result_id')) {
                $table->index('result_id');
            }
            if (Schema::hasColumn('result_subjects', 'subject_id')) {
                $table->index('subject_id');
            }
            if (Schema::hasColumn('result_subjects', 'student_id')) {
                $table->index('student_id');
            }
        });

        if (Schema::hasTable('attendances')) {
            Schema::table('attendances', function (Blueprint $table) {
                if (Schema::hasColumn('attendances', 'student_id')) {
                    $table->index('student_id');
                }
                if (Schema::hasColumn('attendances', 'attendance_session_id')) {
                    $table->index('attendance_session_id');
                }
            });
        }

        Schema::table('subjects', function (Blueprint $table) {
            if (Schema::hasColumn('subjects', 'course_id')) {
                $table->index('course_id');
            }
            // subjects table does not have 'semester_id'; it has 'semester_number' or 'semester_sequence'
            if (Schema::hasColumn('subjects', 'semester_number')) {
                $table->index('semester_number');
            } elseif (Schema::hasColumn('subjects', 'semester_id')) {
                $table->index('semester_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $this->dropIndexIfExists('students', 'students_course_id_index', $table);
            $this->dropIndexIfExists('students', 'students_department_id_index', $table);
            $this->dropIndexIfExists('students', 'students_current_semester_id_index', $table);
        });

        Schema::table('teacher_subject_assignments', function (Blueprint $table) {
            $this->dropIndexIfExists('teacher_subject_assignments', 'teacher_subject_assignments_teacher_id_index', $table);
            $this->dropIndexIfExists('teacher_subject_assignments', 'teacher_subject_assignments_semester_subject_id_index', $table);
        });

        Schema::table('results', function (Blueprint $table) {
            $this->dropIndexIfExists('results', 'results_student_id_index', $table);
            $this->dropIndexIfExists('results', 'results_course_id_index', $table);
            $this->dropIndexIfExists('results', 'results_semester_number_index', $table);
        });

        Schema::table('result_subjects', function (Blueprint $table) {
            $this->dropIndexIfExists('result_subjects', 'result_subjects_result_id_index', $table);
            $this->dropIndexIfExists('result_subjects', 'result_subjects_subject_id_index', $table);
            $this->dropIndexIfExists('result_subjects', 'result_subjects_student_id_index', $table);
        });

        if (Schema::hasTable('attendances')) {
            Schema::table('attendances', function (Blueprint $table) {
                $this->dropIndexIfExists('attendances', 'attendances_student_id_index', $table);
                $this->dropIndexIfExists('attendances', 'attendances_attendance_session_id_index', $table);
            });
        }

        Schema::table('subjects', function (Blueprint $table) {
            $this->dropIndexIfExists('subjects', 'subjects_course_id_index', $table);
            $this->dropIndexIfExists('subjects', 'subjects_semester_number_index', $table);
            $this->dropIndexIfExists('subjects', 'subjects_semester_id_index', $table);
        });
    }

    private function dropIndexIfExists(string $table, string $indexName, Blueprint $blueprint): void
    {
        if (Schema::hasIndex($table, $indexName)) {
            $blueprint->dropIndex($indexName);
        }
    }
};
