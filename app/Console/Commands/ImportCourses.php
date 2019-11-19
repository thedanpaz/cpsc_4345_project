<?php

namespace App\Console\Commands;

use App\AnonymousIdNumber;
use App\Course;
use App\CourseSection;
use App\Person;
use App\User;
use Illuminate\Console\Command;

class ImportCourses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:course';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports courses from a CSV file';

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
        // Grab the default Faculty user
        $professorPerson = Person::where('user_type', '=', 'faculty')
        ->first();

        $faculty = [];

        if(empty($professorPerson)) {

            echo "Creating Faculty" . PHP_EOL;

            $facultyRow = 0;
            if (($handle = fopen(base_path() . "/faculty.csv", "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $facultyRow++;

                    if($facultyRow == 1) { // skip header

                        continue;

                    }

                    // Create the default professor
                    $professorUser = new User();
                    $professorUser->email = $data[2] . '@govst.edu';
                    $professorUser->name = $data[2];
                    $professorUser->password = bcrypt('testaccount');
                    $professorUser->save();

                    $professorPerson = new Person();
                    $professorPerson->user_id = $professorUser->id;
                    $professorPerson->first_name = $data[0];
                    $professorPerson->preferred_first_name = $data[0];
                    $professorPerson->last_name = $data[1];
                    $professorPerson->user_type = 'faculty';
                    $professorPerson->save();

                    $faculty[] = $professorPerson->user_id;

                }

                fclose($handle);

            }

        } else {

            $professors =Person::where('user_type', '=', 'faculty')
                ->get();

            foreach($professors as $professor) {

                $faculty[] = $professor->university_id_number;

            }


        }

        $row = 0;
        if (($handle = fopen(base_path() . "/courses.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;

                if($row == 1) { // skip header

                    continue;

                }

                $thisFacultyIndex = rand(0, (count($faculty) -1));

                $course = new Course();
                $course->subject_cd = $data[0];
                $course->number = $data[1];
                $course->title = $data[2];
                $course->save();

                // Course Section
                $section = new CourseSection();
                $section->course_id = $course->id;
                $section->term = 'Fall 2019';
                $section->credit_hours = rand(2,4);
                $section->faculty = (int) $faculty[$thisFacultyIndex];
                $section->save();

            }

            fclose($handle);

        }

        echo "Courses and Sections created" . PHP_EOL;

    }

}
