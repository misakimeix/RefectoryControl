<?php
/** @package    Rfc::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * AlunoMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the AlunoDAO to the aluno datastore.
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
class AlunoMap implements IDaoMap, IDaoMap2
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
			self::$FM["Idaluno"] = new FieldMap("Idaluno","aluno","idaluno",true,FM_TYPE_INT,11,null,true);
			self::$FM["Matricula"] = new FieldMap("Matricula","aluno","matricula",false,FM_TYPE_VARCHAR,20,null,false);
			self::$FM["Nome"] = new FieldMap("Nome","aluno","nome",false,FM_TYPE_VARCHAR,500,null,false);
			self::$FM["Senha"] = new FieldMap("Senha","aluno","senha",false,FM_TYPE_VARCHAR,500,null,false);
			self::$FM["Turma"] = new FieldMap("Turma","aluno","turma",false,FM_TYPE_INT,11,null,false);
			self::$FM["Imagem"] = new FieldMap("Imagem","aluno","imagem",false,FM_TYPE_VARCHAR,5000,"null",false);
			self::$FM["Condicao"] = new FieldMap("Condicao","aluno","condicao",false,FM_TYPE_TINYINT,1,null,false);
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
			self::$KM["aluno_ibfk_1"] = new KeyMap("aluno_ibfk_1", "Turma", "Turma", "Idturma", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>