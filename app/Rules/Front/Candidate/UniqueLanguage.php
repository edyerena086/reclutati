<?php

namespace ReclutaTI\Rules\Front\Candidate;

use Auth;
use ReclutaTI\CandidateLanguage;
use Illuminate\Contracts\Validation\Rule;

class UniqueLanguage implements Rule
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
        //Check if is unique language
        if ($this->id == 0) {
            $count = CandidateLanguage::where('candidate_id', Auth::user()->candidate->id)
                                        ->where('language_id', $value)->get()->count();

            if (!is_int($value) || $count > 0) {
                return false;
            } else {
                return true;
            }
        }  else {
            $query = CandidateLanguage::find($this->id);

            return ($query->language_id == $value) ? true : false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya haz selecionado previamente ese idioma.';
    }
}
