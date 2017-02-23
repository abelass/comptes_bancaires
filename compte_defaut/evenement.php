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
 * Fonction qui détermine l'hierarchie au niveau de l'article
 *
 * @param  integer $id_objet l'id de l'objet.
 *
 * @return array   Les donées du compte par défaut.
 */
function compte_defaut_evenement_dist($id_objet) {
	$objet = 'evenement';

	// l'évenement en question
	if (!$compte_defaut = $compte_defaut = cb_compte_lie($objet, $id_objet)) {
			$evenement = sql_fetsel('id_article,id_evenement_source', 'spip_evenements', 'id_evenement=' .$id_objet);
			$id_article = $evenement['id_article'];
			$id_evenement_source = $evenement['id_evenement_source'];
			// l'évenement source.
			if (!$compte_defaut = cb_compte_lie($objet, $id_evenement_source)){
				//L'article aprent
				$compte_defaut = compte_bancaire_defaut('article', $id_article);
			}
	}

	return $compte_defaut;
}