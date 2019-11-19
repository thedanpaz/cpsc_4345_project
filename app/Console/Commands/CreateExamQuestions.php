<?php

namespace App\Console\Commands;

use App\CourseSection;
use App\Exam;
use App\Question;
use App\QuestionOption;
use Illuminate\Console\Command;

class CreateExamQuestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:exam-questions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Exams questions for sections';

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

        $questions = [
            [
                'question' => 'The United States of America has how many states?',
                'answers' => [
                    [
                        'text' => '13',
                        'isCorrect' => 0
                    ],
                    [
                        'text' => '48',
                        'isCorrect' => 0
                    ],
                    [
                        'text' => '50',
                        'isCorrect' => 1
                    ],
                    [
                        'text' => '29',
                        'isCorrect' => 0
                    ]
                ]
            ],
            [
                'question' => 'The primary colors in the visible light spectrum are red, _____, and blue.',
                'answers' => [
                    [
                        'text' => 'purple',
                        'isCorrect' => 0
                    ],
                    [
                        'text' => 'green',
                        'isCorrect' => 0
                    ],
                    [
                        'text' => 'yellow',
                        'isCorrect' => 1
                    ],
                    [
                        'text' => 'white',
                        'isCorrect' => 0
                    ]
                ]
            ],
            [
                'question' => 'Governors State University is located in _____ Park, Illinois.',
                'answers' => [
                    [
                        'text' => 'Forest',
                        'isCorrect' => 0
                    ],
                    [
                        'text' => 'Oak',
                        'isCorrect' => 0
                    ],
                    [
                        'text' => 'University',
                        'isCorrect' => 1
                    ],
                    [
                        'text' => 'Highland',
                        'isCorrect' => 0
                    ]
                ]
            ],
            [
                'question' => 'The course subject CPSC stands for _____.',
                'answers' => [
                    [
                        'text' => 'Computer Programming and Statistics',
                        'isCorrect' => 0
                    ],
                    [
                        'text' => 'Charitable People Solving Crime',
                        'isCorrect' => 0
                    ],
                    [
                        'text' => 'Computer Science',
                        'isCorrect' => 1
                    ],
                    [
                        'text' => 'Computer Programming',
                        'isCorrect' => 0
                    ]
                ]
            ],
            [
                'question' => 'The sum of 2 and 2 is _____.',
                'answers' => [
                    [
                        'text' => '3.14',
                        'isCorrect' => 0
                    ],
                    [
                        'text' => '1',
                        'isCorrect' => 0
                    ],
                    [
                        'text' => '4',
                        'isCorrect' => 1
                    ],
                    [
                        'text' => '2',
                        'isCorrect' => 0
                    ]
                ]
            ],
            [
                'question' => 'Database are cool.',
                'answers' => [
                    [
                        'text' => 'True',
                        'isCorrect' => 1
                    ],
                    [
                        'text' => 'False',
                        'isCorrect' => 0
                    ]
                ]
            ],
            [
                'question' => 'Washington D.C. is a US state.',
                'answers' => [
                    [
                        'text' => 'True',
                        'isCorrect' => 0
                    ],
                    [
                        'text' => 'False',
                        'isCorrect' => 1
                    ]
                ]
            ],
            [
                'question' => 'The answer is: Yes.',
                'answers' => [
                    [
                        'text' => 'No',
                        'isCorrect' => 0
                    ],
                    [
                        'text' => 'Yes',
                        'isCorrect' => 1
                    ]
                ]
            ]

        ];




        $exams = Exam::get();

        foreach($exams as $exam) {

            $questionsIndexToUse = [];

            echo $exam->id . " - Exam Id" . PHP_EOL;
            print_r($exam->questions);

            if($exam->questions->count() == 0) {

                while(count($questionsIndexToUse) < 4) {

                    $randomQuestion = rand(0, (count($questions) - 1));

                    if(in_array($randomQuestion, $questionsIndexToUse)) {

                        continue;

                    }

                    $questionsIndexToUse[] = $randomQuestion;

                }

                echo "Designating the following questions to exam" . PHP_EOL;
                print_r($questionsIndexToUse);

                // Save the questions to the DB
                foreach($questionsIndexToUse as $index) {

                    $questionForExam = new Question();
                    $questionForExam->question_copy = $questions[$index]['question'];
                    $questionForExam->exam_id = $exam->id;
                    $questionForExam->save();

                    // Iterate over answers and store those
                    foreach($questions[$index]['answers'] as $option) {

                        print_r($option);

                        $optionRow = new QuestionOption();
                        $optionRow->question_copy =  (string) $option['text'];
                        $optionRow->correct_answer = ($option['isCorrect'] === 1 ? 1 : 0);
                        $optionRow->question_id = $questionForExam->id;
                        $optionRow->save();

                    }

                }

            }

        }

    }
}
