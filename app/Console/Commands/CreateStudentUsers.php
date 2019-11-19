<?php

namespace App\Console\Commands;

use App\AnonymousIdNumber;
use App\Course;
use App\CourseSection;
use App\Person;
use App\User;
use Illuminate\Console\Command;

class CreateStudentUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Student users';

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

        echo $students->count() . PHP_EOL;


        $firstNames = [ "Adam", "Alex", "Aaron", "Ben", "Carl", "Dan", "David", "Edward", "Fred", "Frank", "George", "Hal", "Hank", "Ike", "John", "Jack", "Joe", "Larry", "Monte", "Matthew", "Mark", "Nathan", "Otto", "Paul", "Peter", "Roger", "Roger", "Steve", "Thomas", "Tim", "Ty", "Victor", "Walter"];
        $lastNames = ["Anderson", "Ashwoon", "Aikin", "Bateman", "Bongard", "Bowers", "Boyd", "Cannon", "Cast", "Deitz", "Dewalt", "Ebner", "Frick", "Hancock", "Haworth", "Hesch", "Hoffman", "Kassing", "Knutson", "Lawless", "Lawicki", "Mccord", "McCormack", "Miller", "Myers", "Nugent", "Ortiz", "Orwig", "Ory", "Paiser", "Pak", "Pettigrew", "Quinn", "Quizoz", "Ramachandran", "Resnick", "Sagar", "Schickowski", "Schiebel", "Sellon", "Severson", "Shaffer", "Solberg", "Soloman", "Sonderling", "Soukup", "Soulis", "Stahl", "Sweeney", "Tandy", "Trebil", "Trusela", "Trussel", "Turco", "Uddin", "Uflan", "Ulrich", "Upson", "Vader", "Vail", "Valente", "Van Zandt", "Vanderpoel", "Ventotla", "Vogal", "Wagle", "Wagner", "Wakefield", "Weinstein", "Weiss", "Woo", "Yang", "Yates", "Yocum", "Zeaser", "Zeller", "Ziegler", "Bauer", "Baxster", "Casal", "Cataldi", "Caswell", "Celedon", "Chambers", "Chapman", "Christensen", "Darnell", "Davidson", "Davis", "DeLorenzo", "Dinkins", "Doran", "Dugelman", "Dugan", "Duffman", "Eastman", "Ferro", "Ferry", "Fletcher", "Fietzer", "Hylan", "Hydinger", "Illingsworth", "Ingram", "Irwin", "Jagtap", "Jenson", "Johnson", "Johnsen", "Jones", "Jurgenson", "Kalleg", "Kaskel", "Keller", "Leisinger", "LePage", "Lewis", "Linde", "Lulloff", "Maki", "Martin", "McGinnis", "Mills", "Moody", "Moore", "Napier", "Nelson", "Norquist", "Nuttle", "Olson", "Ostrander", "Reamer", "Reardon", "Reyes", "Rice", "Ripka", "Roberts", "Rogers", "Root", "Sandstrom", "Sawyer", "Schlicht", "Schmitt", "Schwager", "Schutz", "Schuster", "Tapia", "Thompson", "Tiernan", "Tisler"];

        if(empty($students) OR $students->count() < 50) {

            // Create Student Users
            echo "Creating Students" . PHP_EOL;

            for($i=0; $i<50; $i++) {

                $first_name = $firstNames[rand(0, (count($firstNames) - 1))];
                $last_name = $lastNames[rand(0, (count($lastNames) - 1))];

                // Create the default professor
                $studentUser = new User();
                $studentUser->email = 'student' . $i . '@student.govst.edu';
                $studentUser->name = strtolower(substr($first_name, 0, 1) . $last_name) . $i;
                $studentUser->password = bcrypt('testaccount');
                $studentUser->save();

                $studentPerson = new Person();
                $studentPerson->user_id = $studentUser->id;
                $studentPerson->first_name = $first_name;
                $studentPerson->preferred_first_name =$first_name;
                $studentPerson->last_name = $last_name;
                $studentPerson->user_type = 'student';
                $studentPerson->save();

                $anonymousFinalExamId = new AnonymousIdNumber();
                $anonymousFinalExamId->uin = $studentPerson->id;
                $anonymousFinalExamId->exam_type = 'midterm';
                $anonymousFinalExamId->save();

                $anonymousFinalExamId = new AnonymousIdNumber();
                $anonymousFinalExamId->uin = $studentPerson->id;
                $anonymousFinalExamId->exam_type = 'final';
                $anonymousFinalExamId->save();

            }

        } else {

            echo "Already enough student users in system" . PHP_EOL;

        }

    }

}
