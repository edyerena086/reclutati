<?php

namespace ReclutaTI\Rules\Front\Candidate;

use Auth;
use ReclutaTI\CandidateEducationHistory;
use Illuminate\Contracts\Validation\Rule;

class CurrentEducation implements Rule
{
    private $id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id = 0)
    {
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //Checks if is true
        if ($value == 2) {
            $count = CandidateEducationHistory::where('candidate_id', Auth::user()->candidate->id)->where('current', true)->get()->count();

            return ($count > 0)  ? false : true;
            //return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya tienes otro historial educativo como actualmente estudiando.';
    }
}
