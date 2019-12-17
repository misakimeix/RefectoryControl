<?php
/** @package    Rfc::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * SemanaMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the SemanaDAO to the semana datastore.
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
class SemanaMap implements IDaoMap, IDaoMap2
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
			self::$FM["Idsemana"] = new FieldMap("Idsemana","semana","idsemana",true,FM_TYPE_INT,11,null,true);
			self::$FM["Seg"] = new FieldMap("Seg","semana","seg",false,FM_TYPE_TINYINT,1,null,false);
			self::$FM["Ter"] = new FieldMap("Ter","semana","ter",false,FM_TYPE_TINYINT,1,null,false);
			self::$FM["Qua"] = new FieldMap("Qua","semana","qua",false,FM_TYPE_TINYINT,1,null,false);
			self::$FM["Qui"] = new FieldMap("Qui","semana","qui",false,FM_TYPE_TINYINT,1,null,false);
			self::$FM["Sex"] = new FieldMap("Sex","semana","sex",false,FM_TYPE_TINYINT,1,null,false);
			self::$FM["Sab"] = new FieldMap("Sab","semana","sab",false,FM_TYPE_TINYINT,1,null,false);
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
			self::$KM["turno_ibfk_1"] = new KeyMap("turno_ibfk_1", "Idsemana", "Turno", "Dias", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return self::$KM;
	}

}

?>