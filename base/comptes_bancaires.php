<?php
/**
 * Déclarations relatives à la base de données
 *
 * @plugin     Comptes bancaires
 * @copyright  2017
 * @author     Rainer
 * @licence    GNU/GPL
 * @package    SPIP\Comptes_bancaires\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Déclaration des alias de tables et filtres automatiques de champs
 *
 * @pipeline declarer_tables_interfaces
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
 */
function comptes_bancaires_declarer_tables_interfaces($interfaces) {

	$interfaces['table_des_tables']['bancaire_comptes'] = 'bancaire_comptes';

	return $interfaces;
}


/**
 * Déclaration des objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function comptes_bancaires_declarer_tables_objets_sql($tables) {

	$tables['spip_bancaire_comptes'] = array(
		'type' => 'bancaire_compte',
		'principale' => "oui", 
		'table_objet_surnoms' => array('bancairecompte'), // table_objet('bancaire_compte') => 'bancaire_comptes' 
		'field'=> array(
			"id_bancaire_compte" => "bigint(21) NOT NULL",
			"nom"                => "varchar(255) NOT NULL DEFAULT ''",
			"nom_banque"         => "varchar(255) NOT NULL DEFAULT ''",
			"adresse_banque"     => "varchar(255) NOT NULL DEFAULT ''",
			"iban"               => "varchar(255) NOT NULL DEFAULT ''",
			"bic"                => "varchar(255) NOT NULL DEFAULT ''",
			"remarques"          => "text NOT NULL DEFAULT ''",
			"statut"             => "varchar(20)  DEFAULT '0' NOT NULL", 
			"maj"                => "TIMESTAMP"
		),
		'key' => array(
			"PRIMARY KEY"        => "id_bancaire_compte",
			"KEY statut"         => "statut", 
		),
		'titre' => "nom AS titre, '' AS lang",
		 #'date' => "",
		'champs_editables'  => array('nom', 'nom_banque', 'adresse_banque', 'iban', 'bic', 'remarques'),
		'champs_versionnes' => array('nom', 'nom_banque', 'adresse_banque', 'iban', 'bic', 'remarques'),
		'rechercher_champs' => array("nom" => 10, "nom_banque" => 8, "adresse_banque" => 5, "iban" => 5, "bic" => 4, "remarques" => 4),
		'tables_jointures'  => array('spip_bancaire_comptes_liens'),
		'statut_textes_instituer' => array(
			'prepa'    => 'texte_statut_en_cours_redaction',
			'prop'     => 'texte_statut_propose_evaluation',
			'publie'   => 'texte_statut_publie',
			'refuse'   => 'texte_statut_refuse',
			'poubelle' => 'texte_statut_poubelle',
		),
		'statut'=> array(
			array(
				'champ'     => 'statut',
				'publie'    => 'publie',
				'previsu'   => 'publie,prop,prepa',
				'post_date' => 'date', 
				'exception' => array('statut','tout')
			)
		),
		'texte_changer_statut' => 'bancaire_compte:texte_changer_statut_bancaire_compte', 
		

	);

	return $tables;
}


/**
 * Déclaration des tables secondaires (liaisons)
 *
 * @pipeline declarer_tables_auxiliaires
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function comptes_bancaires_declarer_tables_auxiliaires($tables) {

	$tables['spip_bancaire_comptes_liens'] = array(
		'field' => array(
			"id_bancaire_compte" => "bigint(21) DEFAULT '0' NOT NULL",
			"id_objet"           => "bigint(21) DEFAULT '0' NOT NULL",
			"objet"              => "VARCHAR(25) DEFAULT '' NOT NULL",
			"vu"                 => "VARCHAR(6) DEFAULT 'non' NOT NULL"
		),
		'key' => array(
			"PRIMARY KEY"        => "id_bancaire_compte,id_objet,objet",
			"KEY id_bancaire_compte" => "id_bancaire_compte"
		)
	);

	return $tables;
}


?>