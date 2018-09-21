<?php

namespace ReclutaTI\Rules\Front\Candidate;

use Auth;
use ReclutaTI\CandidateJobHistory;
use Illuminate\Contracts\Validation\Rule;

class CurrentJobHistory implements Rule
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
        //Check if is current job
        if ($value == 2) {

            //Check if the given id is diffrent than zero
            if ($this->id == 0) {
                $records = CandidateJobHistory::where('candidate_id', Auth::user()->candidate->id)
                                            ->where('current', true)
                                            ->get();

                return ($records->count() > 0) ? false : true;
            } else {
                //Check if there is any record with current true
                $records = CandidateJobHistory::where('candidate_id', Auth::user()->candidate->id)
                                            ->where('current', true)
                                            ->first();

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
        return 'The validation error message.';
    }
}
