<?php
/**
 * Détermine le compte par défaut d'un objet
*
* @plugin     Comptes bancaires
* @copyright  2017
* @author     Rainer
* @licence    GNU/GPL
* @package    SPIP\Comptes_bancaires\Compte defaut
*/

if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Fonction générique
 *
 * @param  integer $objet Objet dont on checrche le compte.
 * @param  integer $id_objet l'id de l'objet.
 * @param  integer $objet_parent L'objet parent
 * @param  integer $id_objet_parent L'id de l'objet parent
 *
 * @return array   Les donées du compte par défaut.
 */
function compte_defaut_evenement_dist($id_objet, $objet_parent='', $id_objet_parent='') {
	$objet = 'evenement';
	if (!$compte_defaut = sql_fetsel(
			'*',
			'spip_bancaire_comptes, spip_bancaire_comptes_liens',
			'objet=' . sql_quote($objet) . ' and id_objet=' . $id_objet)) {

			$evenement = sql_fetsel('id_article,id_evenement_source', 'spip_evenements', 'id_evenement=' .$id_objet);
			$id_article = $evenement['id_article'];
			$id_evenement_source = $evenement['id_evenement_source'];

			if (!$compte_defaut = sql_fetsel(
			'*',
			'spip_bancaire_comptes, spip_bancaire_comptes_liens',
			'objet=' . sql_quote($objet) . ' and id_objet=' . $id_evenement_source)){

			$compte_defaut = compte_bancaire_defaut('article', $id_article);
			}
	}

	return $compte_defaut;
}