<?php

namespace Modules\Survey\Http\Livewire\Editor;

use Livewire\Component;
use Modules\Survey\Entities\Survey;

class Design extends Component
{
    public $surveyId, $slug, $name, $results_count;
    public $config = [];

    public $tools = [
        [
            'label' => 'Short Answear',
            'icon' => 'mdi mdi-text-short',
            'type' => 'input',
        ],
        [
            'label' => 'Paragraph',
            'icon' => 'mdi mdi-text',
            'type' => 'textarea',
        ],
        [
            'label' => 'Checboxes',
            'icon' => 'mdi mdi-checkbox-outline',
            'type' => 'checkbox',
        ],
        [
            'label' => 'Multiple Choice',
            'icon' => 'mdi mdi-radiobox-marked',
            'type' => 'radio',
        ],
        [
            'label' => 'Drop-down',
            'icon' => 'mdi mdi-form-select',
            'type' => 'select',
        ]
    ];

    public $pageIndexInEdit, $questionIndexInEdit;
    public $newQuestionType = 'input';

    protected $listeners = [
        'debug',
        'sortQuestion',
        'addQuestion',
        'toggleRequired',
        'addRadioOptions',
        'refreshComponent' => '$refresh',
    ];

    public function mount($slug)
    {
        $survey = Survey::where('slug', $this->slug)
            ->withCount('results')
            ->firstOrFail();
        $this->surveyId = $survey->id;
        $this->name = $survey->name;
        $this->config = $survey->json;
        $this->results_count = $survey->results_count;

        foreach($this->config as $pageIndex => $page){
            foreach($page['elements'] as $questionIndex => $question)
            {
                $this->config[$pageIndex]['elements'][$questionIndex] = $this->defaultConfig($question);
            }
        }
    }

    public function defaultConfig($question)
    {
        switch ($question['type']) {
            case 'input':
              if(isset($question['choices'])){
                unset($question['choices']);
              }
              if(isset($question['choicesByUrl'])){
                unset($question['choicesByUrl']);
              }
              break;
            case 'textarea':
              if(isset($question['choices'])){
                unset($question['choices']);
              }
              if(isset($question['choicesByUrl'])){
                unset($question['choicesByUrl']);
              }
              break;
            case 'checkbox':
                if(!isset($question['choices'])){
                    $question['choices'] = [
                        [
                            'value' => 'option1',
                            'text' => 'Option 1',
                        ],
                        [
                            'value' => 'option2',
                            'text' => 'Option 2',
                        ],
                    ];
                  }
                  if(!isset($question['choicesByUrl'])){
                    $question['choicesByUrl'] = [
                        'url' => null,
                        'path' => null,
                        'valueName' => null,
                        'titleName' => null,
                    ];
                  }
              break;
            case 'radio':
                if(!isset($question['choices'])){
                    $question['choices'] = [
                        [
                            'value' => 'option1',
                            'text' => 'Option 1',
                        ],
                        [
                            'value' => 'option2',
                            'text' => 'Option 2',
                        ],
                    ];
                  }
                  if(!isset($question['choicesByUrl'])){
                    $question['choicesByUrl'] = [
                        'url' => null,
                        'path' => null,
                        'valueName' => null,
                        'titleName' => null,
                    ];
                  }
              break;
            case 'select':
                if(!isset($question['choices'])){
                  $question['choices'] = [
                      [
                          'value' => 'option1',
                          'text' => 'Option 1',
                      ],
                      [
                          'value' => 'option2',
                          'text' => 'Option 2',
                      ],
                  ];
                }
                if(!isset($question['choicesByUrl'])){
                    $question['choicesByUrl'] = [
                        'url' => null,
                        'path' => null,
                        'valueName' => null,
                        'titleName' => null,
                    ];
                }
            break;
            default:
       }
       return $question;
    }

    public function clear()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function debug($aa)
    {
        // dd('debug', $aa);
    }

    public function getAttribute($pageIndex, $questionIndex)
    {
        $this->pageIndexInEdit = $pageIndex;
        $this->questionIndexInEdit = $questionIndex;
    }

    public function updatedConfig($val, $key)
    {
        $keys = explode('.', $key);
        // keys[0] = pageIndex
        // keys[2] = questionIndex
        if(count($keys) === 4 && $keys[3] === 'type') {
            $this->config[$keys[0]]['elements'][$keys[2]] = $this->defaultConfig($this->config[$keys[0]]['elements'][$keys[2]]);
            // dd($keys);
        }
        if(count($keys) === 4 && $keys[3] === 'title') {
            // page.elements.choices
            // dd($keys);
        }
        if(count($keys) === 6 && $keys[3] === 'choices') {
            // page.elements.title
            //dd($keys);
        }
    }

    public function addRadioOptions($pageIndex, $questionIndex)
    {
        $count = isset($this->config[$pageIndex]['elements'][$questionIndex]['choices']) ? count($this->config[$pageIndex]['elements'][$questionIndex]['choices']) + 1 : 1;
        $option = [
            'value' => 'option-'.$count ,
            'text' => 'Option '.$count,
        ];
        $this->config[$pageIndex]['elements'][$questionIndex]['choices'][] = $option;
    }

    public function removeRadioOption($pageIndex, $questionIndex, $optionIndex)
    {
        unset(
            $this->config[$pageIndex]['elements'][$questionIndex]['choices'][
                $optionIndex
            ]
        );
    }

    public function sortQuestion($page, $prevIndex, $nextIndex)
    {
        $element = $this->config[$page]['elements'][$prevIndex];
        unset($this->config[$page]['elements'][$prevIndex]);
        array_splice($this->config[$page]['elements'], $nextIndex, 0, [
            $element,
        ]);
        $this->emit('refreshComponent');
    }

    public function addQuestion($pageIndex, $type, $questionIndex)
    {
        $question['type'] = $type;
        $question['name'] = 'question';
        $question['title'] = 'Question';
        if ($type === 'radio' || $type === 'checkbox' || $type === 'select') {
            $question['choices'] = [
                [
                    'value' => 'option1',
                    'text' => 'Option 1',
                ],
                [
                    'value' => 'option2',
                    'text' => 'Option 2',
                ],
            ];
        }
        array_splice($this->config[$pageIndex]['elements'], $questionIndex, 0, [
            $question,
        ]);
    }

    public function removeQuestion($pageIndex, $questionIndex)
    {
        unset($this->config[$pageIndex]['elements'][$questionIndex]);
        if (!count($this->config[$pageIndex]['elements'])) {
            unset($this->config[$pageIndex]);
        }
        if (
            isset($this->config[$pageIndex]['elements'][$questionIndex]['name'])
        ) {
            unset($this->config[$pageIndex]['elements'][$questionIndex]);
        }
        $this->emit('refreshComponent');
    }

    public function addFirstQuestion()
    {
        $question = [
            'type' => $this->newQuestionType,
            'name' => 'question ',
            'title' => 'Question ',
            'choices' => [
                [
                    'value' => 'option1',
                    'text' => 'Option 1',
                ],
                [
                    'value' => 'option2',
                    'text' => 'Option 2',
                ],
            ],
        ];
        $this->config[] = [
            'name' => 'page-' . count($this->config) + 1,
            'text' => 'Page',
            'elements' => [$question],
        ];
        $this->emit('reInit');
    }

    public function toggleRequired($pageIndex, $questionIndex)
    {
        if (
            isset(
                $this->config[$pageIndex]['elements'][$questionIndex][
                    'isRequired'
                ]
            )
        ) {
            $this->config[$pageIndex]['elements'][$questionIndex][
                'isRequired'
            ] = !$this->config[$pageIndex]['elements'][$questionIndex][
                'isRequired'
            ];
        } else {
            $this->config[$pageIndex]['elements'][$questionIndex][
                'isRequired'
            ] = true;
        }
    }

    public function duplicateQuestion($pageIndex, $questionIndex)
    {
        $this->config[$pageIndex]['elements'][] =
            $this->config[$pageIndex]['elements'][$questionIndex];
    }

    public function update()
    {
        $survey = Survey::find($this->surveyId);
        $survey->json = $this->config;
        $survey->update();
        $this->emit('toast', ['success', 'Survey has been updated']);
        $this->emitTo('survey::editor.json', 'refreshComponent');
        $this->emitTo('survey::survey', 'refreshComponent');
    }

    public function render()
    {
        return view('survey::livewire.editor.design')->extends(
            'theme::backend.layouts.master'
        );
    }
}
