<?php
/** @package    REFECONTROL::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Ficha.php");

/**
 * FichaController is the controller class for the Ficha object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package REFECONTROL::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class FichaController extends AppBaseController
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
	 * Displays a list view of Ficha objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Ficha records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new FichaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idficha,DataDasFichas,FichasMinimasDoDia,Cardapio'
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

				$fichas = $this->Phreezer->Query('Ficha',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $fichas->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $fichas->TotalResults;
				$output->totalPages = $fichas->TotalPages;
				$output->pageSize = $fichas->PageSize;
				$output->currentPage = $fichas->CurrentPage;
			}
			else
			{
				// return all results
				$fichas = $this->Phreezer->Query('Ficha',$criteria);
				$output->rows = $fichas->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Ficha record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idficha');
			$ficha = $this->Phreezer->Get('Ficha',$pk);
			$this->RenderJSON($ficha, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Ficha record and render response as JSON
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

			$ficha = new Ficha($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $ficha->Idficha = $this->SafeGetVal($json, 'idficha');

			$ficha->DataDasFichas = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataDasFichas')));
			$ficha->FichasMinimasDoDia = $this->SafeGetVal($json, 'fichasMinimasDoDia');
			$ficha->Cardapio = $this->SafeGetVal($json, 'cardapio');

			$ficha->Validate();
			$errors = $ficha->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$ficha->Save();
				$this->RenderJSON($ficha, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Ficha record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idficha');
			$ficha = $this->Phreezer->Get('Ficha',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $ficha->Idficha = $this->SafeGetVal($json, 'idficha', $ficha->Idficha);

			$ficha->DataDasFichas = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataDasFichas', $ficha->DataDasFichas)));
			$ficha->FichasMinimasDoDia = $this->SafeGetVal($json, 'fichasMinimasDoDia', $ficha->FichasMinimasDoDia);
			$ficha->Cardapio = $this->SafeGetVal($json, 'cardapio', $ficha->Cardapio);

			$ficha->Validate();
			$errors = $ficha->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$ficha->Save();
				$this->RenderJSON($ficha, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Ficha record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idficha');
			$ficha = $this->Phreezer->Get('Ficha',$pk);

			$ficha->Delete();

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
