<?php
/** @package    Rfc::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * ReservaMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the ReservaDAO to the reserva datastore.
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
class ReservaMap implements IDaoMap, IDaoMap2
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
			self::$FM["Idreserva"] = new FieldMap("Idreserva","reserva","idreserva",true,FM_TYPE_INT,11,null,true);
			self::$FM["DataDaReserva"] = new FieldMap("DataDaReserva","reserva","data_da_reserva",false,FM_TYPE_DATE,null,null,false);
			self::$FM["Quantidade"] = new FieldMap("Quantidade","reserva","quantidade",false,FM_TYPE_INT,11,null,false);
			self::$FM["Turmaturno"] = new FieldMap("Turmaturno","reserva","turmaTurno",false,FM_TYPE_INT,11,null,false);
			self::$FM["Horario"] = new FieldMap("Horario","reserva","horario",false,FM_TYPE_CHAR,1,null,false);
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
		}
		return self::$KM;
	}

}

?>