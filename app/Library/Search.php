<?php

namespace ReclutaTI\Library;

use ReclutaTI\State;
use ReclutaTI\SearchVacancy;

class Search
{
	public static function states($string)
	{
		$states = State::search($string)->get();

		$response = [
			'results' => $states->count(),
			'data' => $states
		];

		return $response;
	}

	/**
	 * [addVacancy description]
	 * @param [type] $vacancy [description]
	 */
	public static function addVacancy($vacancy)
	{
		$record = new SearchVacancy();

		$record->vacancy_id = $vacancy->id;
		$record->job_title = $vacancy->job_title;
		if ($vacancy->job_small_description != '') {
			$record->job_small_description = $vacancy->job_small_description;
		}
		$record->job_description = strip_tags($vacancy->job_description);
		if ($vacancy->job_type_id != '') {
			$record->job_type = $vacancy->jobType->name;
		}
		if ($vacancy->state_id != '') {
			$record->state = $vacancy->state->name;
		}
		$record->publish = $vacancy->publish;
		if ($vacancy->salary_min != '') {
			$record->salary_min = $vacancy->salary_min;
		}
		if ($vacancy->salary_max != '') {
			$record->salary_max = $vacancy->salary_max;
		}
		//Save company info
		$company = $vacancy->recruiter->companyContact->companies;
		$record->company_id = $company->id;
		$record->company_name = $company->name;
		$record->company_profile_picture = $company->profile_picture;

		if ($record->save()) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * [updateVacancy description]
	 * @param  [type] $vacancy [description]
	 * @return [type]          [description]
	 */
	public static function updateVacancy($vacancy)
	{
		$record = SearchVacancy::where('vacancy_id', $vacancy->id)->first();

		if ($record) {
			$record->job_title = $vacancy->job_title;
			if ($vacancy->job_small_description != '') {
				$record->job_small_description = $vacancy->job_small_description;
			}
			$record->job_description = strip_tags($vacancy->job_description);
			if ($vacancy->job_type_id != '') {
				$record->job_type = $vacancy->jobType->name;
			}
			if ($vacancy->state_id != '') {
				$record->state = $vacancy->state->name;
			}
			$record->publish = $vacancy->publish;
			if ($vacancy->salary_min != '') {
				$record->salary_min = $vacancy->salary_min;
			}
			if ($vacancy->salary_max != '') {
				$record->salary_max = $vacancy->salary_max;
			}

			//Save company info
			$company = $vacancy->recruiter->companyContact->companies;
			$record->company_id = $company->id;
			$record->company_name = $company->name;
			$record->company_profile_picture = $company->profile_picture;

			if ($record->save()) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}