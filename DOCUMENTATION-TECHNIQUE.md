# Documentation technique — Jardi Création

> Site vitrine WordPress de la pépinière / paysagiste **Jardi Création** (Pins-Justaret, 31).
> Prod : `https://jardi-creation.fr` — Local : `http://localhost/jardi-creation`
> Ce document est mis à jour à chaque intervention (voir [Journal des modifications](#9-journal-des-modifications)).

---

## 1. Stack

| Élément | Valeur |
|---|---|
| WordPress | 6.7.12 (fr_FR) |
| Thème | **Divi 4.21.0** (Elegant Themes), thème parent **sans thème enfant** |
| PHP local | 8.3 (XAMPP `C:\xampp8`, Apache 2.4) |
| Base de données | MariaDB/MySQL, base `jardi-creation`, préfixe `wp_` |
| Permaliens | `/%postname%/` (`.htaccess` avec `RewriteBase /jardi-creation/`) |
| Hébergeur prod | Infomaniak (chemins `/home/clients/.../sites/jardi-creation.fr/`) |

## 2. Installation locale

1. Démarrer Apache + MySQL (XAMPP).
2. La base `jardi-creation` est déjà importée, URLs déjà remplacées par `http://localhost/jardi-creation`.
3. Créer/vérifier `wp-config-local.php` à la racine (ignoré par git) :
   ```php
   define( 'WP_ENVIRONMENT_TYPE', 'local' );
   define( 'WP_HOME', 'http://localhost/jardi-creation' );
   define( 'WP_SITEURL', 'http://localhost/jardi-creation' );
   define( 'FORCE_SSL_ADMIN', false );
   define( 'WP_CACHE', false );
   define( 'WP_DEBUG', true );
   define( 'WP_DEBUG_LOG', true );      // -> wp-content/debug.log
   define( 'WP_DEBUG_DISPLAY', false );
   ```
4. `wp-config.php` charge ce fichier s'il existe (sinon comportement prod inchangé).
5. Ouvrir `http://localhost/jardi-creation/` — admin : `/wp-login.php`.

### Mu-plugin `wp-content/mu-plugins/local-dev.php`
Actif **uniquement** si `WP_ENVIRONMENT_TYPE === 'local'` (aucun effet en prod). Il :
- retire à la volée (filtre `option_active_plugins`, **sans toucher la base**) les plugins prod-only :
  Really Simple SSL (boucle HTTPS sur localhost), 10Web Speed Optimizer (cache/réécriture), Wordfence, All-In-One Security, UpdraftPlus, Imagify, Site Kit, GA Google Analytics, Advanced Google reCAPTCHA, WP SMTP, Akismet ;
- bloque tout envoi d'e-mail (`pre_wp_mail`) ;
- retire la validation reCAPTCHA custom de Contact Form 7 (`valider_recaptcha_v2_cf7`), sinon le formulaire est inutilisable hors domaine prod.

> ⚠️ `wp-config.php` est **suivi par git** (malgré la ligne dans `.gitignore`, il a été commité dans le commit initial). Ne jamais y mettre de constantes locales : utiliser `wp-config-local.php`.

## 3. Architecture du thème (Divi)

Le rendu repose sur le **Divi Theme Builder** (contenu en base, pas en fichiers) :

| ID | Type | Rôle |
|---|---|---|
| 20 | `et_theme_builder` | Conteneur du Theme Builder |
| 21 | `et_template` | Modèle par défaut : header 8 + footer 98 |
| 1004 | `et_template` | Résultats de recherche : header 8 + body 998 + footer 98 |
| 2514 / 2515 | `et_template` | Anciens modèles, marqués *unused* |
| 8 | `et_header_layout` | En-tête global (menu, logo, téléphone, réseaux sociaux) |
| 98 | `et_footer_layout` | Pied de page global |
| 998 | `et_body_layout` | Corps de la page recherche |

Pages construites avec le Divi Builder (shortcodes `[et_pb_*]` dans `post_content`). Page d'accueil : ID **70** (`accueil`). La page `accueil-2` (2973) est un doublon publié.

### Personnalisations dans le code du thème parent (⚠️ écrasées à la mise à jour de Divi)
`wp-content/themes/Divi/functions.php` (≈ lignes 8831–8908, une copie avant modif existe : `functionsbak.php`) :
1. **reCAPTCHA v2 maison pour CF7** : désactive le reCAPTCHA v3 natif de CF7 (`wpcf7_recaptcha_*` → false) et valide `g-recaptcha-response` via `wpcf7_validate`. **La clé secrète est en dur dans le fichier.**
2. **ALT/TITLE automatiques** : buffer de sortie (`template_redirect` → `ob_start`) qui ajoute `alt`/`title` = `<nom-fichier> pépiniériste paysagiste Jardi-Creation Pins-Justaret` aux `<img>` sans alt/title (SEO).

`wp-content/themes/Divi/header.php` ligne 37 : chargement global de `https://www.google.com/recaptcha/api.js`.

### Autres sources de CSS/JS custom
| Source | Emplacement |
|---|---|
| CSS additionnel WP (Customizer) | post `custom_css` ID 12 (~20 Ko) |
| Plugin *Simple Custom CSS and JS* | `wp-content/uploads/custom-css-js/2944.css`, `2947.js` (JS = simple `console.log`) |
| Cache CSS Divi | `wp-content/et-cache/` (régénéré automatiquement, ignoré par git) |

Note : `2944.css` référence des polices en chemin absolu `/wp-content/plugins/slide-anything/...` → OK en prod (racine), 404 en local (sous-dossier). Sans impact visuel notable.

## 4. Plugins actifs (23)

| Plugin | Usage | Local |
|---|---|---|
| Contact Form 7 | Formulaire contact (ID 89) | ✅ |
| Slide Anything | 35 carrousels `sa_slider` (pépinières, produits) | ✅ |
| Flip Cards Module Divi | Cartes retournables | ✅ |
| New Image Gallery | Galerie « realisation » (ID 630) | ✅ |
| Popup Anything on Click | Popups grutage (2191, 2196) | ✅ |
| Yoast SEO | SEO + sitemaps | ✅ |
| Classic Editor, Duplicate Page, Custom CSS JS, Better Search Replace, All-in-One WP Migration, Maintenance (désactivé : state=0) | Outils | ✅ |
| Really Simple SSL, 10Web Speed Optimizer, Wordfence, AIOS, UpdraftPlus, Imagify, Site Kit, GA Google Analytics, Advanced Google reCAPTCHA, WP SMTP, Akismet | Prod | ❌ neutralisés |

Mu-plugins : `aios-firewall-loader.php` (inclut un bootstrap uniquement présent sur le serveur prod — sans effet en local), `local-dev.php`.

## 5. Contenu

- 20 pages publiées, 1 article (« Hello world! », à supprimer), 894 médias, 2 menus (`Menu` 30 entrées, `Menu Footer` 7).
- Arborescence : Accueil · Nos Services (arrosage-éclairage, avant-après, dessouchage, gazons, grutage, massifs, bord de piscine) · Nos Produits (minéraux, terre, bois/composite, poteries, barbecue) · Nos Pépinières · Nos réalisations · Contact · Mentions légales.

## 6. Médias — restauration des images manquantes

Contexte : la prod a été restaurée à partir d'une ancienne sauvegarde ; une partie des **fichiers originaux** de `uploads/2023/08/` manquait (en local **et** en prod), alors que leurs **miniatures** existaient.

Recherche effectuée :
1. `wp-content/uploads-old`, `ShortpixelBackups`, `ewww`, caches → rien.
2. Site en ligne `jardi-creation.fr` → mêmes fichiers en 404.
3. Wayback Machine (API CDX) → aucune archive des uploads postérieure à 2021.
4. **Solution retenue** : reconstitution depuis la plus grande variante locale disponible, via `wp_get_image_editor()` (même algorithme de recadrage que WordPress).

Bilan (détail fichier par fichier : [`docs/images-restaurees.csv`](docs/images-restaurees.csv)) :

| Action | Nb |
|---|---|
| Original reconstitué depuis la plus grande miniature | 256 |
| Miniature manquante régénérée | 30 |
| Icônes recréées (`phone.png`, `time.png`, page Contact) — Tabler Icons, licence MIT, même style que `location.png` | 2 |
| Doublon recopié (`agave-1-1.jpg` ← `agave-1.jpg`) | 1 |
| **Introuvables** | 6 |

Introuvables (à récupérer auprès du client / ancienne agence) :
- `2023/08/video_grutage.mp4` — **utilisée** sur la page *Grutage* (lecteur vidéo vide).
- `2023/08/Pierres-Roches-Poutres.pdf`, `2023/08/Sables-Graviers.pdf` — médias non liés dans les pages.
- `2023/08/favicon.png` — non utilisé (le favicon actif est `2023/09/fav.png`).
- `2023/08/statue-pierre-02-300x300-1.jpg`, `statue-pierre-04-300x300-1.jpg` — non affichées.

Limite : les originaux reconstitués ont la résolution de la plus grande miniature (78 ≥ 1000 px, 47 entre 500–999 px, 131 < 500 px). Suffisant pour l'affichage actuel (vignettes/carrousels) ; remplacer par les vrais originaux si on les retrouve.

Résultat : crawl de toutes les URLs du sitemap → **999 ressources locales vérifiées, 1 seule en 404 (la vidéo)**.

### Re-lancer l'audit
Script utilisé (hors dépôt) : lister les `_wp_attached_file` en base, tester l'existence sur disque, puis crawler les URLs de `page-sitemap.xml` et tester chaque ressource `wp-content/…` en HTTP.

## 7. Points d'attention / dette technique

| Priorité | Sujet | Recommandation |
|---|---|---|
| 🔴 | Clé secrète reCAPTCHA en dur dans `Divi/functions.php` (et dans git) | Déplacer dans une constante de `wp-config.php` prod, régénérer la clé |
| 🔴 | Code custom dans le thème parent Divi | Créer un **thème enfant** et y migrer le code (sinon perdu à la prochaine mise à jour) |
| 🟠 | Divi 4.21 sur PHP 8.3 : nombreux *Deprecated* | Mettre à jour Divi (4.27+) après création du thème enfant |
| 🟠 | `wp-config.php` (salts, identifiants) versionné | `git rm --cached wp-config.php` si le dépôt est partagé |
| 🟠 | Vidéo grutage manquante | Récupérer le fichier ou remplacer par une vidéo YouTube |
| 🟡 | Buffer ALT/TITLE sur tout le HTML (regex) | Préférer le filtre `wp_get_attachment_image_attributes` |
| 🟡 | Dossiers résiduels `*-old`, `*-old-old`, `plugins_vide`, `functionsbak.php`, `index.php-old` | Nettoyer après validation |
| 🟡 | Page `accueil-2` et article « Hello world! » publiés | Dépublier |
| 🟡 | 1350 révisions | Purger |

## 8. Déploiement

- Ne **pas** déployer : `wp-config-local.php`, `wp-content/debug.log`, `wp-content/et-cache/`.
- `local-dev.php` peut être déployé sans risque (inactif hors `local`), mais inutile en prod.
- Images restaurées : copier `wp-content/uploads/2023/08/` (fichiers listés dans le CSV) sur la prod pour corriger les mêmes 404 en ligne.

## 9. Journal des modifications

### 2026-11-26 — Mise en route locale + restauration des médias
**Fichiers ajoutés**
- `wp-config-local.php` (ignoré par git) — constantes locales.
- `wp-content/mu-plugins/local-dev.php` — neutralisation des plugins prod en local.
- 289 images dans `wp-content/uploads/2023/08/` (cf. CSV).
- `docs/images-restaurees.csv`, `DOCUMENTATION-TECHNIQUE.md`, `README.md`.

**Fichiers modifiés**
- `wp-config.php` : `define('WP_DEBUG', false)` remplacé par l'inclusion conditionnelle de `wp-config-local.php` + `WP_DEBUG` par défaut à `false` (comportement prod identique).
- `.gitignore` : ajout de `wp-content/debug.log`, `wp-config-local.php`, `wp-content/et-cache/`.

**Base de données** : aucune modification.
