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

	// bancaire_comptes sur les objets choisies
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

/**
 * Permet de compléter ou modifier le résultat de la compilation d’un squelette donné.
 *
 * @pipeline recuperer_fond
 *
 * @param array $flux
 *        	Données du pipeline
 * @return array Données du pipeline
 */
function comptes_bancaires_recuperer_fond($flux) {
	$fond = $flux['args']['fond'];
	$contexte = $flux['data']['contexte'];

	// Modifie les infos bancaire en cas de viremen via le plugin bank.
	if ($fond == 'presta/virement/payer/attente') {
		$champs = array('id_commande', 'montant');

		if (test_plugin_actif('reservation_evenement')) {
			$champs[] = 'id_reservation';
		}

		if($transaction = sql_fetsel(
				$champs,
				'spip_transactions',
				'id_transaction=' . $contexte['id_transaction'] . ' AND transaction_hash =' . $contexte['transaction_hash'])) {
				$fonction_compte_defaut = charger_fonction('objet', 'compte_defaut');
				$contexte['montant'] = $transaction['montant'];
				foreach ($transaction as $champ => $valeur) {
					if ($champ == 'id_commande' AND $valeur != 0) {
						$commande = sql_fetsel('objet, id_objet', 'spip_commandes_details', 'id_commande=' .$valeur);
						$compte = $fonction_compte_defaut($commande['objet'], $commande['id_objet']);
					}
					elseif ($champ == 'id_reservation' AND $valeur != 0) {
						$id_evenement = sql_getfetsel('id_evenement', 'spip_reservations_details', 'id_reservation=' .$valeur);
						$compte = $fonction_compte_defaut('evenement', $id_evenement);
					}
				}
				$contexte = array_merge($contexte, $compte);
		}
		$flux['data']['texte'] = recuperer_fond('inclure/presta_payer_virement', $contexte);
	}

	return $flux;
}

/**
 * Ajouter les configurations dans celle de réservation événements.
 *
 * @pipeline reservation_evenement_objets_configuration
 *
 * @param array $flux
 *        	Données du pipeline
 * @return array Données du pipeline
 */
function comptes_bancaires_reservation_evenement_objets_configuration($flux) {

	$objets = array(
		'comptes_bancaires' => array(
			'label' => _T('comptes_bancaires:comptes_bancaires_titre'),
		),
	);

	$flux['data'] = array_merge($flux['data'], $objets);

	return $flux;
}