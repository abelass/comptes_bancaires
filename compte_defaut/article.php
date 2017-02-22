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
function compte_defaut_article_dist($id_objet, $objet_parent='', $id_objet_parent='') {
	$objet = 'article';
	if (!$compte_defaut = sql_fetsel(
			'*',
			'spip_bancaire_comptes LEFT JOIN spip_bancaire_comptes_liens
				ON spip_bancaire_comptes.id_bancaire_compte=spip_bancaire_comptes_liens.id_bancaire_compte',
			'objet=' . sql_quote($objet) . ' and id_objet=' . $id_objet)) {
			$id_rubrique = sql_getfetsel('id_rubrique', 'spip_articles', 'id_article=' . $id_objet);

			// On cherche maintenant s'il existe une personnalisation pour les taxes : prix_<objet>() dans prix/<objet>.php

			$compte_defaut = compte_bancaire_defaut('rubrique', $id_rubrique);
	}

	return $compte_defaut;
}