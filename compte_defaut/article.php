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
function compte_defaut_article_dist($id_objet) {
	$objet = 'article';

	if (!$compte_defaut = $compte_defaut = cb_compte_lie($objet, $id_objet)) {
		$id_rubrique = sql_getfetsel('id_rubrique', 'spip_articles', 'id_article=' . $id_objet);

		// On regarde si il y un compte au niverau de la rubrique
		$compte_defaut = compte_bancaire_defaut('rubrique', $id_rubrique);
	}

	return $compte_defaut;
}
