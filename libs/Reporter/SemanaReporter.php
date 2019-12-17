<?php
/** @package    Rfc::Reporter */

/** import supporting libraries */
require_once("verysimple/Phreeze/Reporter.php");

/**
 * This is an example Reporter based on the Semana object.  The reporter object
 * allows you to run arbitrary queries that return data which may or may not fith within
 * the data access API.  This can include aggregate data or subsets of data.
 *
 * Note that Reporters are read-only and cannot be used for saving data.
 *
 * @package Rfc::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class SemanaReporter extends Reporter
{

	// the properties in this class must match the columns returned by GetCustomQuery().
	// 'CustomFieldExample' is an example that is not part of the `semana` table
	public $CustomFieldExample;

	public $Idsemana;
	public $Seg;
	public $Ter;
	public $Qua;
	public $Qui;
	public $Sex;
	public $Sab;

	/*
	* GetCustomQuery returns a fully formed SQL statement.  The result columns
	* must match with the properties of this reporter object.
	*
	* @see Reporter::GetCustomQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomQuery($criteria)
	{
		$sql = "select
			'custom value here...' as CustomFieldExample
			,`semana`.`idsemana` as Idsemana
			,`semana`.`seg` as Seg
			,`semana`.`ter` as Ter
			,`semana`.`qua` as Qua
			,`semana`.`qui` as Qui
			,`semana`.`sex` as Sex
			,`semana`.`sab` as Sab
		from `semana`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();
		$sql .= $criteria->GetOrder();

		return $sql;
	}
	
	/*
	* GetCustomCountQuery returns a fully formed SQL statement that will count
	* the results.  This query must return the correct number of results that
	* GetCustomQuery would, given the same criteria
	*
	* @see Reporter::GetCustomCountQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomCountQuery($criteria)
	{
		$sql = "select count(1) as counter from `semana`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();

		return $sql;
	}
}

?>