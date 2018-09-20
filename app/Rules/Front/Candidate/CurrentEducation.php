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
    public function __construct($id)
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

            if ($this->id == 0) {
                $count = CandidateEducationHistory::where('candidate_id', Auth::user()->candidate->id)->where('current', true)->get()->count();

                return ($count > 0)  ? false : true;
            } else {
                //Check if there is any record with current true
                $record = CandidateEducationHistory::where('candidate_id', Auth::user()->candidate->id)->where('current', true)->first();

                if ($record == null) {
                    return true;
                } else if ($record->id == $this->id) {
                    return true;
                } else {
                    return false;
                }
            }
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
