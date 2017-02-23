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
	if ($objets_lies = lister_objets_lies('bancaire_compte', $objet, $id_objet, 'bancaire_compte')) {
		$compte_defaut = $objets_lies[0];
	}
	else{
		$id_rubrique = sql_getfetsel('id_rubrique', 'spip_articles', 'id_article=' .$id_objet);

		// On cherche maintenant s'il existe une personnalisation pour les taxes : prix_<objet>() dans prix/<objet>.php
		$fonction_compte_defaut = charger_fonction('objet', 'compte_defaut', true);
		$compte_defaut = $fonction_compte_defaut('rubrique', $id_rubrique);
	}

	return $compte_defaut;
}
