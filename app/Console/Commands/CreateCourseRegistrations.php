<?php

namespace App\Console\Commands;

use App\AnonymousIdNumber;
use App\Course;
use App\CourseRegistration;
use App\CourseSection;
use App\Person;
use App\User;
use Illuminate\Console\Command;

class CreateCourseRegistrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:course-registrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Student Course Registrations users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $students = Person::where('user_type', '=', 'student')
            ->get();

        $sections = CourseSection::where('term', '=', 'Fall 2019')
            ->get();

        echo "total sections" . $sections->count() . PHP_EOL;

        foreach($students as $student) {


            if($student->registrations->count() == 0) {

                echo "existing registrations: " . $student->registrations->count() . PHP_EOL;

                $totalRegistrations = rand(2, 5);

                $sectionIndex = [];
                for($i=0; $i<$totalRegistrations; $i++) {

                    $index =  rand(0, ($sections->count() - 1));

                    if(!in_array($index, $sectionIndex)) {

                        $sectionIndex[] = $index;

                    }

                }

                foreach($sectionIndex as $sectionNumber) {

                    $registration = new CourseRegistration();
                    $registration->term = 'Fall 2019';
                    $registration->course_section_id = $sections[$sectionNumber]->id;
                    $registration->registrant_university_id = $student->university_id_number;
                    $registration->save();

                }

                echo "Student: " . $student->first_name . " registered for " . $totalRegistrations . PHP_EOL;

            }

        }

    }

}
