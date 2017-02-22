<?php
/**
 * Utilisations de pipelines par Comptes bancaires
 *
 * @plugin     Comptes bancaires
 * @copyright  2017
 * @author     Rainer
 * @licence    GNU/GPL
 * @package    SPIP\Comptes_bancaires\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/*
 * Un fichier de pipelines permet de regrouper
 * les fonctions de branchement de votre plugin
 * sur des pipelines existants.
 */



/**
 * Ajout de contenu sur certaines pages,
 * notamment des formulaires de liaisons entre objets
 *
 * @pipeline affiche_milieu
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function comptes_bancaires_affiche_milieu($flux) {
	include_spip('inc/config');
	$texte = "";
	$e = trouver_objet_exec($flux['args']['exec']);

	// cadeau_cheques sur les objets choisies
	if (! $e['edition'] and in_array($e['table_objet_sql'], array_filter(lire_config('comptes_bancaires/objets', array ())))) {
		$texte .= recuperer_fond('prive/objets/editer/liens', array (
			'table_source' => 'bancaire_comptes',
			'objet' => $e['type'],
			'id_objet' => $flux['args'][$e['id_table_objet']]
		));
	}



	if ($texte) {
		if ($p=strpos($flux['data'],"<!--affiche_milieu-->"))
			$flux['data'] = substr_replace($flux['data'],$texte,$p,0);
		else
			$flux['data'] .= $texte;
	}

	return $flux;
}



/**
 * Optimiser la base de données en supprimant les liens orphelins
 * de l'objet vers quelqu'un et de quelqu'un vers l'objet.
 *
 * @pipeline optimiser_base_disparus
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function comptes_bancaires_optimiser_base_disparus($flux){
	include_spip('action/editer_liens');
	$flux['data'] += objet_optimiser_liens(array('bancaire_compte'=>'*'),'*');
	return $flux;
}

?>