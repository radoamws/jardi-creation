# Jardi Création — Site web

Site vitrine de **Jardi Création**, pépiniériste et paysagiste à Pins-Justaret (31860), près de Toulouse.

- En ligne : https://jardi-creation.fr
- En local : http://localhost/jardi-creation (administration : `/wp-login.php`)
- Détails techniques : [DOCUMENTATION-TECHNIQUE.md](DOCUMENTATION-TECHNIQUE.md)

## À quoi sert le site

Présenter l'entreprise, ses services, ses produits et ses pépinières, et permettre aux visiteurs de la contacter.

## Plan du site

| Rubrique | Contenu |
|---|---|
| **Accueil** | Diaporama, adresse et horaires du showroom, arrivages, nouveautés, présentation, vidéo YouTube, fil Instagram |
| **Nos Services** | Arrosage & éclairage · Avant / Après · Dessouchage, abattage, taille · Gazons & prairies fleuries · Grutage de végétaux · Création de massifs · Plantations bord de piscine |
| **Nos Produits** | Minéraux, ornements et granulats · Terre et terreaux · Aménagement bois et composite · Poteries et statues · Barbecue et accessoires |
| **Nos Pépinières** | Carrousels par famille : oliviers, palmiers, arbres, arbustes, fruitiers, plantes de haies… |
| **Nos réalisations** | Galerie photos de chantiers |
| **Contact** | Adresse, téléphone, horaires, formulaire de contact (protégé par reCAPTCHA) |
| **Mentions légales** | Informations légales |

Informations affichées : 7 impasse du Centaure (à côté de la gare), 31860 Pins-Justaret — ouvert du vendredi au dimanche, 9h–12h et 14h–18h — 06 09 02 41 94.

## Modifier le contenu

| Je veux… | Où |
|---|---|
| Modifier le texte/les images d'une page | *Pages* → page → **Utiliser le Divi Builder** |
| Modifier l'en-tête ou le pied de page (toutes les pages) | *Divi* → **Theme Builder** → en-tête / pied de page global |
| Ajouter une plante/un produit dans un carrousel | *Slide Anything* → carrousel concerné → ajouter une diapositive |
| Modifier la galerie des réalisations | *Image Gallery* → « realisation » |
| Modifier le formulaire de contact | *Contact* (Contact Form 7) → « Formulaire de contact – Jardi creation » |
| Modifier le menu | *Apparence* → *Menus* |
| Modifier le référencement (titre Google, description) | Bloc **Yoast SEO** sous chaque page |

Les textes alternatifs des images (alt) sont complétés automatiquement si vous les laissez vides.

## Fonctionnement en local (différences avec la prod)

En local, pour permettre de travailler sans risque :
- aucun e-mail n'est envoyé (le formulaire de contact se valide mais n'envoie rien) ;
- le reCAPTCHA du formulaire n'est pas vérifié ;
- les modules de sécurité, cache, sauvegarde, statistiques et HTTPS forcé sont désactivés.

La prod n'est pas concernée.

## Historique

### 26/11/2026
- Site rendu fonctionnel en local.
- **Images manquantes restaurées** : le site avait été restauré depuis une ancienne sauvegarde et environ 290 images n'existaient plus (fiches plantes, produits, galeries, icônes du contact). Elles ont été reconstituées à partir des copies réduites encore présentes. Certaines sont donc de résolution moindre.
- **Encore manquants** (à fournir) : la **vidéo de la page Grutage**, 2 fiches PDF (« Pierres-Roches-Poutres », « Sables-Graviers ») et 2 photos de statues en pierre.
