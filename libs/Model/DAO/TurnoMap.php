<?php
/** @package    Rfc::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * TurnoMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the TurnoDAO to the turno datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Rfc::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class TurnoMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["Idturno"] = new FieldMap("Idturno","turno","idturno",true,FM_TYPE_INT,11,null,true);
			self::$FM["Horario"] = new FieldMap("Horario","turno","horario",false,FM_TYPE_INT,11,null,false);
			self::$FM["Dias"] = new FieldMap("Dias","turno","dias",false,FM_TYPE_INT,11,null,false);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
			self::$KM["turma_ibfk_1"] = new KeyMap("turma_ibfk_1", "Idturno", "Turma", "Turno", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["turno_ibfk_1"] = new KeyMap("turno_ibfk_1", "Dias", "Semana", "Idsemana", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>