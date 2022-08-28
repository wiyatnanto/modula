<?php

namespace Modules\Survey\Http\Livewire;

use Livewire\Component;
use Modules\Survey\Entities\Survey as SurveyModel;
use Modules\Survey\Entities\SurveyResult;


class Survey extends Component
{
    public $surveyId, $name, $bg_header, $slug, $questionClass;
    public $config = [];
    public $answers = [];
    public $pageIndex = 0;

    protected $queryString = [];

    protected $listeners = [
        'debug',
        'refreshComponent' => '$refresh',
    ];

    public function rules()
    {
        $rules = [];
        foreach($this->config as $pageIndex => $page){
            foreach($page['elements'] as $questionIndex => $question){
                if(isset($question['isRequired']) && $question['isRequired']){
                    $rules['answers.'.$pageIndex.'.'.$questionIndex.'.'.$question['name']] = 'required';
                }
            }
        }
        return $rules;
    }

    public function messages()
    {
        $rulesMessages = [];
        foreach($this->config as $pageIndex => $page){
            foreach($page['elements'] as $questionIndex => $question){
                if(isset($question['isRequired']) && $question['isRequired']){
                    $rulesMessages['answers.'.$pageIndex.'.'.$questionIndex.'.'.$question['name'].'.required'] = 'Response is required';
                }
            }
        }
        return $rulesMessages;
    }

    // public function mount($slug)
    // {
        
    //     $this->config = $survey->json;
    //     $this->answers = collect($this->config)->map(function($page, $key) {
    //         return collect($page['elements'])->map(function ($question, $key) {
    //              return [ $question['name'] => null ];
    //         });
    //     });
    // }

    public function updatingPageIndex()
    {
        $this->validate();
    }

    public function updatingAnswers($key, $val)
    {

    }   

    public function store()
    {
        $this->validate();
        $survey = new SurveyResult;
        $survey->survey_id = $this->surveyId;
        $survey->user_id = 0;
        $survey->ip_address = '';
        $survey->json = $this->answers;
        $survey->save();
        $this->emit('toast', ['success', 'Survey has been updated']);
    }

    public function render()
    {
        $survey = SurveyModel::where('slug', $this->slug)->firstOrFail();
        $this->config = $survey->json;
        return view('survey::livewire.survey',[
            'survey' => $survey
        ]);
    }
}
