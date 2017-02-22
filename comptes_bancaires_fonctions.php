<?php
/**
 * Fonctions utiles au plugin Comptes bancaires
 *
 * @plugin     Comptes bancaires
 * @copyright  2017
 * @author     Rainer
 * @licence    GNU/GPL
 * @package    SPIP\Comptes_bancaires\Fonctions
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Filtre pour déterminer un compte par défaut
 *
 * @param  integer $objet Objet dont on checrche le compte.
 * @param  integer $id_objet l'id de l'objet.
 * @param  integer $objet_parent L'objet parent
 * @param  integer $id_objet_parent L'id de l'objet parent
 *
 * @return array       Données du pipeline
 */
function compte_bancaire_defaut($objet, $id_objet, $objet_parent='', $id_objet_parent='') {
	// On cherche maintenant s'il existe une personnalisation pour les taxes : prix_<objet>() dans prix/<objet>.php
	if ($fonction_compte_defaut = charger_fonction('objet', 'compte_defaut', true)){
		return $compte_defaut = $fonction_compte_defaut($objet, $id_objet, $objet_parent, $id_objet_parent);
	}
}

?>