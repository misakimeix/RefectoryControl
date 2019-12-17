<?php
/** @package Rfc::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("CardapioMap.php");

/**
 * CardapioDAO provides object-oriented access to the cardapio table.  This
 * class is automatically generated by ClassBuilder.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the Model class which is extended from this DAO class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Rfc::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class CardapioDAO extends Phreezable
{
	/** @var int */
	public $Idcardapio;

	/** @var string */
	public $Principal;

	/** @var string */
	public $Acompanhamento;

	/** @var string */
	public $Sobremesa;

	/** @var string */
	public $Suco;



}
?>