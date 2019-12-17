<?php
/** @package    REFECONTROL::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Semana.php");

/**
 * SemanaController is the controller class for the Semana object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package REFECONTROL::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class SemanaController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
		
		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}

	/**
	 * Displays a list view of Semana objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Semana records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new SemanaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idsemana,Seg,Ter,Qua,Qui,Sex,Sab'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$semanas = $this->Phreezer->Query('Semana',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $semanas->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $semanas->TotalResults;
				$output->totalPages = $semanas->TotalPages;
				$output->pageSize = $semanas->PageSize;
				$output->currentPage = $semanas->CurrentPage;
			}
			else
			{
				// return all results
				$semanas = $this->Phreezer->Query('Semana',$criteria);
				$output->rows = $semanas->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single Semana record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idsemana');
			$semana = $this->Phreezer->Get('Semana',$pk);
			$this->RenderJSON($semana, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Semana record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$semana = new Semana($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $semana->Idsemana = $this->SafeGetVal($json, 'idsemana');

			$semana->Seg = $this->SafeGetVal($json, 'seg');
			$semana->Ter = $this->SafeGetVal($json, 'ter');
			$semana->Qua = $this->SafeGetVal($json, 'qua');
			$semana->Qui = $this->SafeGetVal($json, 'qui');
			$semana->Sex = $this->SafeGetVal($json, 'sex');
			$semana->Sab = $this->SafeGetVal($json, 'sab');

			$semana->Validate();
			$errors = $semana->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$semana->Save();
				$this->RenderJSON($semana, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Semana record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('idsemana');
			$semana = $this->Phreezer->Get('Semana',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $semana->Idsemana = $this->SafeGetVal($json, 'idsemana', $semana->Idsemana);

			$semana->Seg = $this->SafeGetVal($json, 'seg', $semana->Seg);
			$semana->Ter = $this->SafeGetVal($json, 'ter', $semana->Ter);
			$semana->Qua = $this->SafeGetVal($json, 'qua', $semana->Qua);
			$semana->Qui = $this->SafeGetVal($json, 'qui', $semana->Qui);
			$semana->Sex = $this->SafeGetVal($json, 'sex', $semana->Sex);
			$semana->Sab = $this->SafeGetVal($json, 'sab', $semana->Sab);

			$semana->Validate();
			$errors = $semana->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$semana->Save();
				$this->RenderJSON($semana, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Semana record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idsemana');
			$semana = $this->Phreezer->Get('Semana',$pk);

			$semana->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
