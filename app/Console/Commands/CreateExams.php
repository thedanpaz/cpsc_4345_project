<?php

namespace App\Console\Commands;

use App\CourseSection;
use App\Exam;
use Illuminate\Console\Command;

class CreateExams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:exam';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Exams course sections';

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

        $sections = CourseSection::where('term', '=', 'Fall 2019')
            ->get();

        foreach($sections as $section) {

            if(empty($section->midtermExam)) {

                $midtermExam = new Exam();
                $midtermExam->term = 'Fall 2019';
                $midtermExam->exam_type = 'midterm';
                $midtermExam->course_section_id = $section->id;
                $midtermExam->save();

            } else {

                echo "Midterm exam exists" . PHP_EOL;

            }

            if(empty($section->finalExam)) {

                $finalExam = new Exam();
                $finalExam->term = 'Fall 2019';
                $finalExam->exam_type = 'final';
                $finalExam->course_section_id = $section->id;
                $finalExam->save();

            } else {

                echo "Final exam exists" . PHP_EOL;

            }

        }

    }
}
