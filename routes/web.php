<?php

use App\Http\Controllers\AdministrationFermeController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\AUOPController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CampagneMeteoController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\CCController;
use App\Http\Controllers\CollecteController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EBController;
use App\Http\Controllers\EcoulementIntrantController;
use App\Http\Controllers\ExpressionBesoinController;
use App\Http\Controllers\FermeController;
use App\Http\Controllers\FIAController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\GerantController;
use App\Http\Controllers\GestionPackController;
use App\Http\Controllers\GroupementController;
use App\Http\Controllers\HistoriqueFermeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ICTController;
use App\Http\Controllers\IntrantDistributionController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\LocaliteController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\MoodleUserController;
use App\Http\Controllers\OffreBankController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackMonitoringController;
use App\Http\Controllers\ParametrageController;
use App\Http\Controllers\PluvioController;
use App\Http\Controllers\PrevisionController;
use App\Http\Controllers\PrixController;
use App\Http\Controllers\ProducteurController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProductionFermeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ReceptionIntrantController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\Services\AlertesController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopFermeController;
use App\Http\Controllers\SoilAnalysisController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\TacheFermeController;
use App\Http\Controllers\TerreController;
use App\Http\Controllers\TransversalController;
use App\Http\Controllers\UnionGroupementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\VenteOnlineController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//route vente en ligne


Route::post('/visiteur', [VenteOnlineController::class, 'getUserId']);

Route::get('/shop', [VenteOnlineController::class, 'index'])->name("shop.index");
Route::get('/nosboutiques', [VenteOnlineController::class, 'nosboutiques'])->name("nosboutiques.index");

Route::post('/louma/create_shop', [VenteOnlineController::class, 'create_shop']);


Route::get('/monPanier/produits', [VenteOnlineController::class, 'panier_by_user'])->name('monPanier.produit');
Route::post('/panier/update/', [VenteOnlineController::class, 'update']);
Route::get('/getCategorie', [VenteOnlineController::class, 'getCategorie']);
Route::get('/addProdPanier/{id}', [VenteOnlineController::class, 'monPanier']);
Route::get('/prod/paginate/{page}/{item_per_page}', [VenteOnlineController::class, 'pagination']);
Route::get('/paginate_shop_by_prod/{page}/{item_per_page}/{boutique}', [VenteOnlineController::class, 'pagination_shop']);
Route::get('/paginate_shop_by_cat/{page}/{item_per_page}/{categorie}', [VenteOnlineController::class, 'pagination_cat']);
Route::get('/shop/paginate/{page}/{item_per_page}', [ShopController::class, 'paginate']);
Route::get('/shop/prod/paginate/{page}/{item_per_page}/{shop}', [ShopController::class, 'paginate_prod_by_shop']);


Route::get('/shop/produit/{id}', [VenteOnlineController::class, 'listeProduit']);
Route::get('/prod_by_shop/{id}', [VenteOnlineController::class, 'forme']);
Route::get('/prod_by_categorie/{id}', [VenteOnlineController::class, 'prodByCat']);

Route::get('/', [HomeController::class, 'index'])->name('landing');
Route::post('/', [HomeController::class, 'contact_expert']);
Route::get('offres', [GestionPackController::class, 'offres']);
Route::get('offres/{acteur}', [GestionPackController::class, 'offresByActeur'])->name('packByActor');
Route::post('/packByProfil', [GestionPackController::class, 'offresByProfile'])->name('packByProfile');

Route::get('/opportunites/offres', [HomeController::class, 'appels_offres'])->name('opportunites.offres');
Route::get('/opportunites/offres/{id}/details', [HomeController::class, 'details_offres'])->name('details.offres');
Route::post('/opportunites/offres/postuler', [HomeController::class, 'postuler_offres'])->name('postuler.offres');


//Google oauth routes

Route::get('/auth/google/redirect', [GoogleController::class, 'handleGoogleRedirect']);

Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


//Facebook oauth routes

Route::get('/auth/facebook/redirect', [FacebookController::class, 'handleFacebookRedirect']);

Route::get('/auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);


Route::get('404', function () {
    return view('layouts.404');
});
Route::get('403', function () {
    return view('layouts.403');
});

Route::middleware(['all'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //commandes de l'utilisateur
    Route::get('/mesCommandes', [VenteOnlineController::class, 'commande']);
    //produit de la commande de l'utilisateur --historique
    Route::get('/produits_commandes/{id}', [VenteOnlineController::class, 'commande_produit']);


    // FIA
    Route::get('/entite/fia', [FIAController::class, 'index'])->name('utilisateurs.fia.index');
    Route::get('/entite/fia/create', [FIAController::class, 'create']);
    Route::post('/entite/fia/store', [FIAController::class, 'store']);
    Route::get('/entite/fia/communes/{id}', [FIAController::class, 'listeCommune'])->name('get.fia.communes');
    Route::get('/entite/fia/intrants/{id}', [FIAController::class, 'listeIntrants'])->name('get.fia.intrants');

    Route::get('/entite/fia/rattachement/create/{id}', [FIAController::class, 'createRattachement']);
    Route::get('/entite/fia/rattachement_intrant/create/{id}', [FIAController::class, 'createRattachementIntrants']);
    Route::get('/rattachements', [FIAController::class, 'rattachement']);
    Route::get('/intrants_rattachement', [FIAController::class, 'rattachementIntrant']);

    Route::post('/entite/fia/rattachement/store', [FIAController::class, 'storeRattachement']);
    Route::post('/entite/fia/rattachement_intrants/store', [FIAController::class, 'storeRattachementIntrants']);



    // CC
    Route::get('/entite/cc', [CCController::class, 'index'])->name('get.cc');
    Route::post('/entite/cc/store', [CCController::class, 'store']);
    Route::get('/entite/cc/membre/{id}', [CCController::class, 'getMember'])->name('get.membre.cc');
    Route::post('/entite/cc/membre/store', [CCController::class, 'storeMember']);
    Route::get('/cc/expression-de-besoin', [CCController::class, 'eb']);


    // MASAE
    Route::get('/se/expression-de-besoin', [EBController::class, 'indexSe']);


    // Route::get('/monPanier/{id}', [VenteOnlineController::class, 'monPanier']);
    Route::post('/valider_panier/payer', [VenteOnlineController::class, 'payer']);
    Route::get('/enregistrer_vente/{id}/{montant}/{telephone}', [VenteOnlineController::class, 'vente'])->name('panier.vente');
    Route::get('/supprimer_commande/{id}', [VenteOnlineController::class, 'cancel_command'])->name('panier.cancel');
    Route::get('panier/produit/payer/{id}', [VenteOnlineController::class, 'panier_by_id']);


    Route::get('admin/utilisateurs/profil', [UtilisateurController::class, 'profil'])->name('user.profil');
    Route::post('user/profil/avatar/change', [UtilisateurController::class, 'changeAvatar'])->name('user.change.avatar');
    Route::get('user/profil/avatar/reset/{id}', [UtilisateurController::class, 'resetAvatar'])->name('user.reset.avatar');

    /*/                   Route Utilisateurs                                /*/
    Route::get('admin/utilisateurs', [UtilisateurController::class, 'index']);
    Route::get('ong/utilisateurs', [UtilisateurController::class, 'index']);

    // Route::post('admin/utilisateurs/filter', [UtilisateurController::class, 'filter']);

    Route::get('admin/utilisateurs/create', [UtilisateurController::class, 'create']);

    Route::get('admin/utilisateurs/{id}', [UtilisateurController::class, 'show']);


    //historique ferme
    Route::get('ferme/historique', [HistoriqueFermeController::class, 'index'])->name('ferme.historique');

    //temoignage marketplace
    Route::post('/louma/temoignage', [VenteOnlineController::class, 'temoignage']);

    Route::get("/temoignage/connect", [VenteOnlineController::class, 'comment']);

    //creation ferme by admin

    Route::post('/listeferme/createferme', [FermeController::class, 'store_ferme'])->name('ferme.create');
    Route::post('/listeferme/createfermeByList', [FermeController::class, 'store_ferme_list'])->name('ferme.create.list');

    Route::post('/listeferme/update', [FermeController::class, 'update_ferme'])->name('ferme.update');

    Route::get('/listeferme/details/{id}', [FermeController::class, 'details_ferme'])->name('ferme.details');
    Route::get('/listeferme/edit/{id}', [FermeController::class, 'edit_ferme'])->name('ferme.edit');
    Route::get('/listeferme/delete/{id}', [FermeController::class, 'delete_ferme'])->name('ferme.delete');


    Route::get('listeferme/activite/edit/{id}', [ProductionFermeController::class, 'edit_activite_by_admin']);
    Route::post('/ferme/activite/update_by_admin', [ProductionFermeController::class, 'update_activite_by_admin']);
    Route::get('listeferme/produit/edit/{id}', [ProductionFermeController::class, 'edit_prod_by_admin']);
    Route::get('listeferme/stock/edit/{id}', [ProductionFermeController::class, 'edit_stock_by_admin']);
    Route::get('listeferme/finance/vente/view/{id}', [FinanceController::class, 'view_admin']);

    //  Ferme List User Route
    Route::get('user/ferme/profil', [FermeController::class, 'profil'])->name('user.ferme.profil');
    Route::get('ferme/utilisateurs/profil', [FermeController::class, 'profil'])->name('user.ferme.profile');
    Route::get('ferme/utilisateurs', [FermeController::class, 'index'])->name('ferme');
    //Route::get('ferme/role', [UtilisateurController::class, 'getEntity']);
    Route::get('ferme/utilisateurs/create', [FermeController::class, 'create']);
    // Route::get('ferme/role/create', [FermeController::class, 'add_role']);
    Route::post('/ferme/create_user', [FermeController::class, 'store']);
    Route::post('/ferme/create_user_by_admin', [FermeController::class, 'store_by_admin']);
    Route::post('/ferme/edit_user', [FermeController::class, 'edit']);
    //Route::post('/ferme/create_role', [FermeController::class, 'store_role']);
    Route::get('ferme/utilisateurs/profil/edit/{id}', [ProfilController::class, 'edit']);
    Route::get('ferme/utilisateur/{id}', [FermeController::class, 'show']);

    // Route Tache ferme
    Route::get('ferme/tache', [TacheFermeController::class, 'index'])->name('ferme.tache');
    Route::post('ferme/tache/create', [TacheFermeController::class, 'create']);
    Route::post('ferme/tache/update', [TacheFermeController::class, 'update']);
    Route::get('ferme/tache/edit/{id}', [TacheFermeController::class, 'edit']);

    // ferme administration
    Route::get('ferme/administration', [AdministrationFermeController::class, 'index'])->name('ferme.administration');
    Route::post('ferme/administration', [AdministrationFermeController::class, 'create'])->name('ferme.administration.create');
    Route::get('ferme/administration/demande/edit/{id}', [AdministrationFermeController::class, 'edit']);
    Route::post('ferme/demande/update', [AdministrationFermeController::class, 'update']);
    Route::post('ferme/administration/demande/comment', [AdministrationFermeController::class, 'comment']);


    // Route Ferme shop
    Route::get('ferme/shop', [ShopFermeController::class, 'index'])->name('ferme.shop');
    Route::get('/ferme/shop/listeProduits/{id}', [ShopFermeController::class, 'listeProduits']);
    Route::get('/ferme/shop/addProduit/{id}', [ShopFermeController::class, 'addProduitToShop']);
    Route::get('/ferme/shop/edit/{id}', [ShopFermeController::class, 'edit']);
    Route::post('/ferme/shop/update', [ShopFermeController::class, 'update']);

    Route::get('/ferme/shop/produit/edit/{id}', [ShopFermeController::class, 'editProduitToShop']);

    Route::post('/ferme/shop/create', [ShopFermeController::class, 'create']);
    Route::post('/produit_to_shop_ferme/add', [ShopFermeController::class, 'addProduit']);
    Route::post('/ferme/shop/produit/edit', [ShopFermeController::class, 'updateProduitToShop']);


    //ROUTE EXPRESSION DE BESOINS
    Route::get('ferme/eb/create', [ExpressionBesoinController::class, 'index']);

    Route::get('ferme/eb', [ExpressionBesoinController::class, 'validerPresi'])->name('ferme.eb');
    Route::post('/ferme/eb/create_eb', [ExpressionBesoinController::class, 'store'])->name('eb.create');
    Route::get('ferme/eb/edit/{id}', [ExpressionBesoinController::class, 'edit']);
    // Route::get('ferme/eb/edit/profil/{id}', [ExpressionBesoinController::class, 'editByProfil']);
    Route::post('/ferme/eb/update', [ExpressionBesoinController::class, 'update']);
    Route::get('ferme/eb/show/{id}', [ExpressionBesoinController::class, 'show'])->name('eb.show.id');
    Route::get('ferme/eb/commentP/{id}', [ExpressionBesoinController::class, 'editP']);
    Route::get('ferme/eb/commentM/{id}', [ExpressionBesoinController::class, 'editM']);
    Route::post('/ferme/eb/updateP', [ExpressionBesoinController::class, 'updateP']);
    Route::post('/ferme/eb/updateM', [ExpressionBesoinController::class, 'updateM']);
    Route::get('ferme/eb/commentP/edit/{id}', [ExpressionBesoinController::class, 'edit']);
    Route::get('ferme/eb/commentM/edit/{id}', [ExpressionBesoinController::class, 'edit']);


    // ROUTE FINANCE FERME
    Route::get('ferme/finance/decaissement', [FinanceController::class, 'index']);
    Route::post('/ferme/finance/create', [FinanceController::class, 'store'])->name('ferme.decaissement');
    Route::get('/ferme/finance/decaissement/create/{id}', [FinanceController::class, 'decaissement']);
    // ROUTE FINANCE/DECAISSEMENT FERME
    Route::get('ferme/finance/decaissement', [FinanceController::class, 'index'])->name('ferme.finance');
    Route::post('ferme/finance/decaissement/update', [FinanceController::class, 'update']);

    Route::post('ferme/finance/create', [FinanceController::class, 'store'])->name('ferme.decaissement');
    Route::get('/ferme/finance/decaissement/create/{id}', [FinanceController::class, 'decaissement']);
    Route::get('ferme/dec/edit/{id}', [FinanceController::class, 'edit']);

    //ROUTE FINANCE BANQUE FERME
    Route::get('ferme/finance/banque', [FinanceController::class, 'banque'])->name('ferme.banque');
    Route::post('/ferme/finance/banque/create', [FinanceController::class, 'store_banque'])->name('ferme.banque.create');


    //ROUTE FINANCE/VENTE FERME
    Route::get('ferme/finance/vente', [FinanceController::class, 'index_vente'])->name('ferme.vente');
    Route::post('/ferme/finance/vente/create', [FinanceController::class, 'store_vente'])->name('ferme.vente.create');

    Route::get('ferme/finance/vente/create/{id}', [FinanceController::class, 'vente']);

    Route::get('ferme/finance/vente/view/{id}', [FinanceController::class, 'view']);
    Route::get('ferme/finance/vente/create/{id}', [FinanceController::class, 'vente']);

    Route::get('ferme/finance/vente/view/{id}', [FinanceController::class, 'view']);
    //payement

    Route::get('/ferme/finance/vente/payement/{id}', [FinanceController::class, 'payement']);
    //payemnet par espece
    Route::post('/ferme/finance/vente/payement_espece', [FinanceController::class, 'payement_espece'])->name('ferme.vente.payement');
    Route::get('ferme/vente/validation/{id}/{montant}', [FinanceController::class, 'validation_vente'])->name('vente.validation');

    //ROUTE FINANCE/CAISSE


    //ROUTE FINANCE/CAISSE

    Route::get('ferme/finance/caisse', [FinanceController::class, 'index_caisse'])->name('ferme.caisse');
    Route::get('ferme/test', function () {
        return view('gestion.ferme.caisse.test');
    });
    Route::post('/ferme/finance/caisse/create', [FinanceController::class, 'store_caisse'])->name('ferme.caisse.create');
    Route::get('ferme/finance/caisse/view/{id}', [FinanceController::class, 'view_caisse']);

    //ROUTE PRODUCTION
    //ROUTE PRODUCTION __PRODUITS
    Route::get('ferme/production', [ProductionFermeController::class, 'index'])->name('ferme.produits');
    Route::post('/ferme/produits/create', [ProductionFermeController::class, 'create']);
    Route::get('ferme/production/edit/{id}', [ProductionFermeController::class, 'edit']);
    Route::post('/ferme/produits/update', [ProductionFermeController::class, 'update']);
    Route::get('ferme/produit/show/{id}', [ProductionFermeController::class, 'show']);
    Route::get('ferme/production/create', function () {
        return view('gestion.ferme.production.create');
    });

    //ROUTE PRODUCTION __ACTIVITE
    Route::get('ferme/activite', [ProductionFermeController::class, 'liste_activite']);
    Route::get('ferme/activite/show/{id}', [ProductionFermeController::class, 'show_activite']);
    Route::get('ferme/activite/edit/{id}', [ProductionFermeController::class, 'edit_activite']);

    Route::post('/ferme/activite/update', [ProductionFermeController::class, 'update_activite']);
    Route::post('/ferme/activite/create', [ProductionFermeController::class, 'create_activite']);

    //ROUTE PRODUCTION __STOCKS
    Route::get('ferme/stock', [ProductionFermeController::class, 'liste_stock'])->name('ferme.stock');
    Route::post('/ferme/stock/create', [ProductionFermeController::class, 'create_stock']);
    Route::get('/ferme/stock/create', function () {
        return view('gestion.ferme.stock.create');
    });
    Route::post('/ferme/stock/edit', [ProductionFermeController::class, 'update_stock']);

    Route::get('ferme/stock/edit/{id}', [ProductionFermeController::class, 'edit_stock']);
    /*/                   End                              /*/


    Route::get('admin/role/create', [UtilisateurController::class, 'getEntities'])->name('role.create');
    Route::get('admin/role', [UtilisateurController::class, 'getEntity'])->name('role');
    Route::get('admin/role/{id}', [UtilisateurController::class, 'getEntityDetails']);
    Route::get('admin/role/edit/{id}', [UtilisateurController::class, 'getEntityToEdit']);
    Route::get('admin/utilisateurs/edit/{id}', [ProfilController::class, 'edit']);
    Route::get('ong/utilisateurs/edit/{id}', [ProfilController::class, 'edit']);


    /*/                   Route Campagnes                                /*/

    Route::get('/campagnes', function () {
        return view('gestion.campagnes.liste');
    });


    // /*/                   Route Marche                                /*/
    // Route::get('prix-du-marche/marches', function () {
    //     return view('gestion.marches.index');
    // });


    /*/                   Route Produits                                /*/

    // Route::get('/louma-mbay/addProdFromApi', [ProductsController::class, 'AddProductFromApi']);
    Route::get('/louma-mbay/boutiqueProduit/{id}/{index}', [ProductsController::class, 'AddProd']);

    Route::get('/louma-mbay/produits', [ProductsController::class, 'index']);

    Route::get('/produit/paginate/{page}/{item_per_page}', [ProductsController::class, 'paginate']);


    // Route::get('/produits/{id}', [ProductsController::class, 'show']);


    /*/                   Route Commandes                                /*/

    Route::get('/louma-mbay/produits/commander/{id}', [OrderController::class, 'commanderProduit']);
    Route::post('/louma-mbay/enregistrerCommande', [OrderController::class, 'enregistrerCommande']);
    Route::get('/louma-mbay/commandes', [OrderController::class, 'index']);
    Route::get('/louma-mbay/commandes/listeProduits/{id}', [OrderController::class, 'listOrderProducts']);


    /*/                   Route Boutiques                                /*/

    Route::get('/louma-mbay/boutiques', [ShopController::class, 'index'])->name('shop.liste');
    Route::get('/louma-mbay/boutiques/listeProduits/{id}', [ShopController::class, 'listeProduits']);


    /*/                   Route Cours                               /*/

    Route::get('/louma-du-savoir/cours', [CoursController::class, 'index']);
    Route::get('/louma-du-savoir/cours/sujets/{id}', [CoursController::class, 'sujetsCours']);


    // Packs thanks
    Route::get('packs/show', [PackMonitoringController::class, 'index'])->name('packs');
    Route::get('packs', [PackMonitoringController::class, 'index'])->name('packs.index');
    Route::get('packs/show/create', [PackMonitoringController::class, 'create'])->name('packs.create');
    Route::get('packs/show/edit/{id}/{acteur}', [PackMonitoringController::class, 'edit'])->name('pack.edit');
    Route::post('packs/store', [PackMonitoringController::class, 'store'])->name('packs.store');
    Route::post('packs/update', [PackMonitoringController::class, 'update'])->name('packs.update');
    Route::delete('packs/delete/{id}', [PackMonitoringController::class, 'delete'])->name('packs.delete');
    Route::get('packs/validation/{id}/{acteur}', [PackMonitoringController::class, 'validation'])->name('packs.validation');

    Route::get('greenapi/validation/{id}/{acteur}', [PackMonitoringController::class, 'validation'])->name('greenapi.validation');

    Route::get('greenapi', [PackMonitoringController::class, 'greenapi_packs'])->name('greenapi.packs');
    Route::get('greenapi/renouveler/{id_pack}', [PackMonitoringController::class, 'renouveler'])->name('greenapi.renouveler');

    Route::get('greenapi/souscription/{id_pack}', [PackMonitoringController::class, 'suscribeService'])->name('greenapi.souscrire');
    Route::get('greenapi/confirm/{id}', [PackMonitoringController::class, 'confirm'])->name('greenapi.confirm');

    Route::get('packs/paiement/{id}', [PackMonitoringController::class, 'payer'])->name('packs.payer');
    Route::get('packs/souscription/{id}', [PackMonitoringController::class, 'souscription'])->name('packs.souscripte');
    Route::get('packs/renouvellement/{idAbonnement}', [PackMonitoringController::class, 'renouvellement'])->name('packs.renouvellement');
    Route::get('packs/list', [PackMonitoringController::class, 'list'])->name('packs.list');
    Route::get('packs/souscriptions', [PackMonitoringController::class, 'souscriptions'])->name('packs.souscriptions');
    Route::get('packs/souscriptions/details/{id}', [PackMonitoringController::class, 'detailsSouscriptions'])->name('packs.souscriptions.details');
    // Route::get('packs/souscriptions/journals', [PackMonitoringController::class, 'journalSouscriptions'])->name('packs.souscriptions.journals');
    Route::get('packs/activer/{id}', [PackMonitoringController::class, 'activerPack'])->name('pack.activer');
    Route::get('packs/activer2/{id}', [PackMonitoringController::class, 'activerPackDetails'])->name('pack.activer.details');
    Route::post('packs/prix/marche', [PackMonitoringController::class, 'prixMarche'])->name('packs.prix.marche');
    Route::post('packs/choix/cours', [PackMonitoringController::class, 'choixCours'])->name('packs.choix.cours');
    Route::post('packs/souscription/contrat', [PackMonitoringController::class, 'addContrat'])->name('packs.souscription.contrat');

    Route::get('/producteurs', [ProducteurController::class, 'index']);
    Route::get('/producteur/{id}', [ProducteurController::class, 'show']);
    Route::get('/producteurs/edit/{id}', [ProducteurController::class, 'edit']);
    Route::get('/producteurs/new', [ProducteurController::class, 'create'])->name('create.producteur');
    Route::post('/producteurs/create', [ProducteurController::class, 'store']);
    Route::post('/producteurs/create-list', [ProducteurController::class, 'store_list']);
    Route::post('/producteurs/create-list/prix', [ProducteurController::class, 'store_list_prix']);


    Route::get('/producteurs/edit/{id}', [ProducteurController::class, 'edit']);
    Route::put('/producteurs/update/{id}', [ProducteurController::class, 'update']);
    Route::delete('/producteurs/delete/{id}', [ProducteurController::class, 'destroy']);

    //liste ferme

    Route::get('/listeferme', [FermeController::class, 'liste_ferme']);

    //    Gestion Candidatures

    Route::get('opportunites', [CandidatureController::class, 'index'])->name('opportunites.index');
    Route::get('opportunites/create', [CandidatureController::class, 'create'])->name('opportunites.create');
    Route::post('opportunites/store', [CandidatureController::class, 'store'])->name('opportunites.store');
    Route::post('opportunites/update', [CandidatureController::class, 'update'])->name('opportunites.update');
    Route::get('opportunites/{id}/cloturer', [CandidatureController::class, 'cloture'])->name('opportunites.cloture');
    Route::get('opportunites/{id}/details', [CandidatureController::class, 'details_offres'])->name('opportunites.details.offres');
    Route::get('opportunites/candidats/rejet/{email}/{libelle}', [CandidatureController::class, 'rejetCandidature'])->name('opportunites.rejet.candidat');


    // // ___________________________SERVICES____________________________

    //-----------------------------------INFORMATIONS CLIMATIQUES------------------------------------------------//
    Route::get('/information-climatique/parametrage', [ParametrageController::class, 'index']);
    Route::post('/information-climatique/parametrage/reseau-create', [ParametrageController::class, 'store_reseau']);
    Route::get('/information-climatique/parametrage/reseau-edit/{id}', [ParametrageController::class, 'edit_reseau']);
    Route::put('/information-climatique/parametrage/reseau-update/{id}', [ParametrageController::class, 'update_reseau']);
    Route::delete('/information-climatique/parametrage/reseau-delete/{id}', [ParametrageController::class, 'destroy_reseau']);
    Route::delete('/information-climatique/parametrage/reseau-activate/{id}', [ParametrageController::class, 'destroy_reseau']);
    Route::delete('/information-climatique/parametrage/reseau-deactivate/{id}', [ParametrageController::class, 'destroy_reseau']);

    Route::get('/information-climatique/parametrage/gerant/create', [GerantController::class, 'create']);
    Route::post('/information-climatique/parametrage/gerant-create', [GerantController::class, 'store']);
    Route::get('/information-climatique/parametrage/gerant-list-model-download', [GerantController::class, 'dowload_model']);

    Route::post('/information-climatique/parametrage/gerant-list-create', [GerantController::class, 'store_list']);

    Route::get('/information-climatique/parametrage/gerant/edit/{id}', [GerantController::class, 'edit']);
    Route::put('/information-climatique/parametrage/gerant-update/{id}', [GerantController::class, 'update']);
    Route::delete('/information-climatique/parametrage/gerant/delete/{id}', [GerantController::class, 'destroy']);

    Route::post('/information-climatique/parametrage/pluvio/create', [PluvioController::class, 'store']);
    Route::get('/information-climatique/parametrage/pluvio/edit/{id}', [PluvioController::class, 'edit']);
    Route::put('/information-climatique/parametrage/pluvio/update/{id}', [PluvioController::class, 'update']);
    Route::delete('/information-climatique/parametrage/pluvio/delete/{id}', [PluvioController::class, 'destroy']);

    Route::post('/information-climatique/parametrage/transversal/create', [TransversalController::class, 'store']);
    Route::post('/information-climatique/parametrage/transversal-list-create', [TransversalController::class, 'store_list']);

    Route::get('/information-climatique/parametrage/transversal/edit/{id}', [TransversalController::class, 'edit']);
    Route::put('/information-climatique/parametrage/transversal/update/{id}', [TransversalController::class, 'update']);
    Route::delete('/information-climatique/parametrage/transversal/delete/{id}', [TransversalController::class, 'destroy']);

    Route::get('/information-climatique/parametrage', [ParametrageController::class, 'index']);

    Route::get('/information-climatique/collecte', [CollecteController::class, 'index']);
    Route::post('/information-climatique/collecte/create', [CollecteController::class, 'store']);
    Route::get('/information-climatique/collecte/edit/{id}', [CollecteController::class, 'edit']);
    Route::put('/information-climatique/collecte/update/{id}', [CollecteController::class, 'update']);
    Route::get('/information-climatique/collecte/{id}', [CollecteController::class, 'send_collecte_sms']);
    Route::post('/information-climatique/collecte/make-push', [CollecteController::class, 'send']);

    Route::delete('/information-climatique/collecte/delete/{id}', [CollecteController::class, 'destroy']);
    // Route::get("/stream", [CollecteController::class,"stream"]);

    Route::get('/information-climatique/prevision', [PrevisionController::class, 'index'])->name('info-clim.prevision');
    Route::get('/information-climatique/prevision/details/{date}/{message}', [PrevisionController::class, 'detailsPrevision'])->name('detailsPrevision');
    Route::get('/information-climatique/prevision/detailsvoice/{date}/{voice}', [PrevisionController::class, 'detailsPrevisionVoice'])->name('detailsPrevisionVoice');
    Route::get('/information-climatique/prevision/download/{date}/{message}', [PrevisionController::class, 'downloadPrevision'])->name('downloadPrevision');
    Route::get('/information-climatique/prevision/downloadVoice/{date}/{voice}', [PrevisionController::class, 'downloadPrevisionVoice'])->name('downloadPrevisionVoice');
    Route::post('/information-climatique/prevision/localite', [PrevisionController::class, "store"]);

    // Route::get('/information-climatique/statistiques', function () {
    //     return view('services.informations_climatiques.statistique.index');
    // });

    Route::get('/information-climatique/statistiques', [StatController::class, 'info_climatiques']);

    Route::get('/terre/list/{id}', [TerreController::class, "get_producteur_terre"]);
    Route::post('/terre/create', [TerreController::class, "new_producteur_terre"]);
    Route::get('/terre/edit/{id}', [TerreController::class, "get_terre_to_edit"]);
    Route::post('/terre/update/{id}', [TerreController::class, "update_terre"]);
    Route::delete('/terre/update/{id}', [TerreController::class, "delete_terre"]);


    Route::get('/information-climatique/campagne', [CampagneMeteoController::class, 'index']);
    Route::post('/information-climatique/campagne/create', [CampagneMeteoController::class, 'store']);
    Route::get('/information-climatique/campagne/edit/{id}', [CampagneMeteoController::class, 'edit'])->name('update-campagne');
    Route::put('/information-climatique/campagne/update/{id}', [CampagneMeteoController::class, 'update']);
    Route::delete('/information-climatique/campagne/delete/{id}', [CampagneMeteoController::class, 'destroy']);


    //-----------------------------------INFORMATIONS CLIMATIQUES END------------------------------------------------//

    //-----------------------------------SOIL ANALYSIS------------------------------------------------//

    Route::get('soil_analysis', [SoilAnalysisController::class, 'index'])->name("soil.analysis");
    Route::get('soil_analysis/farm/new', [SoilAnalysisController::class, 'createFarm'])->name("new.farm");
    Route::post('soil_analysis/farm/store', [SoilAnalysisController::class, 'storeFarm'])->name("store.farm");
    Route::post('soil_analysis/suscribe', [SoilAnalysisController::class, 'suscribeService'])->name("suscribe.service");
    Route::post('soil_analysis/validation/{forfait}', [SoilAnalysisController::class, 'validation'])->name("suscribe.validation");
    Route::get('soil_analysis/{id}/analyse', [SoilAnalysisController::class, 'analyseFarm'])->name("farm.analyse");
    Route::get('soil_analysis/{id}/analyse/recommendation', [SoilAnalysisController::class, 'analyseFarmWithRecommendation'])->name("farm.analyse.recommendation");
    Route::get('soil_analysis/log/farm/{idFarm}', [SoilAnalysisController::class, 'logAnalyseFarm'])->name("logFarm.analyse");

    //-----------------------------------SOIL ANALYSIS END------------------------------------------------//


    Route::get('ict', [ICTController::class, 'index']);
    Route::get('ict/farm/new', [ICTController::class, 'createFarm'])->name("ict.farm");


    //-----------------------------------CREDIT LOAN ------------------------------------------------//
    Route::get('credit', [\App\Http\Controllers\CreditLoanController::class, 'index'])->name("credit.loan");
    Route::get('credit/new', [\App\Http\Controllers\CreditLoanController::class, 'create'])->name("credit.create");
    Route::post('credit/store', [\App\Http\Controllers\CreditLoanController::class, 'store'])->name("credit.store");

    //-----------------------------------END CREDIT LOAN ------------------------------------------------//



    Route::get('/declaration-de-sinistre', function () {
        return view('services.declaration_de_sinistre.index');
    });

    // Route::get('/expression-de-besoin', function () {
    //     return view('services.expression_de_besoin.index');
    // });
    // Route::get('/offre-de-credit', function () {
    //     return view('services.offre_de_credit.index');
    // });
    // Route::get('/prix-du-marche/prix', function () {
    //     return view('services.prix_du_marche.index');
    // });


    //-----------------------------------Services Alertes ------------------------------------------------//


    Route::get('/alertes/new', [AlertesController::class, 'index'])->name('alertes');
    Route::get('/alertes/liste/new', [AlertesController::class, 'newList'])->name('new.liste.diffusion');
    Route::post('/alertes/sms/submit', [AlertesController::class, 'smsSubmit'])->name('alertes.sms.submit');
    Route::get('/alertes/liste/diffusion', [AlertesController::class, 'listeDiffusion'])->name('alertes.liste.diffusion');
    Route::post('/alertes/liste/diffusion/create', [AlertesController::class, 'createListDiffusion'])->name('alertes.diffusion.create');
    Route::get('/alertes/liste/diffusion/enroll/{id}', [AlertesController::class, 'enrollDiffusionForCamp'])->name('alertes.diffusion.addUserForList');
    Route::get('/alertes/liste/diffusion/enroll', [AlertesController::class, 'enrollDiffusion'])->name('alertes.diffusion.addUser');
    Route::get('/alertes/liste/diffusion/{id}', [AlertesController::class, 'listeDiffusionForCamp'])->name('alertes.diffusion.listeUser');
    Route::get('/alertes/diffusion/actif/{id}', [AlertesController::class, 'activerListe'])->name('diffusion.activer.liste');
    Route::get('/alertes/diffusion/inactif/{id}', [AlertesController::class, 'desactiverListe'])->name('diffusion.desactiver.liste');
    Route::post('/alertes/add/user/listByFile', [AlertesController::class, 'addByListUpload'])->name('alertes.list.addByFile');
    Route::get('/alertes/historiques', [AlertesController::class, 'stats'])->name('alertes.stats');
    Route::post('/alertes/historiques/liste', [AlertesController::class, 'export'])->name('alertes.stats.list');
    Route::post('/alertes/historiques/details', [AlertesController::class, 'details'])->name('alertes.stats.details');
    Route::post('/alertes/historiques/details/resend', [AlertesController::class, 'resendAlert'])->name('alertes.stats.details.resend');


    //-----------------------------------Services Alertes END------------------------------------------------//


    // // ___________________________DATA____________________________
    Route::get('/historique', function () {
        return view('data.statistique.index');
    });
    Route::get('/statistique', function () {
        return view('data.historique.index');
    });

    //});

    // Route::get('marches', function () {

    //     return view('gestion.marches.index');
    // });


    // -------------------------------LANGUES---------------------------------

    Route::get('langue', [LangueController::class, 'index']);


    // -------------------------------LOCALITES---------------------------------

    Route::get('localites', [LocaliteController::class, 'index']);


    // Route::get('campagnes', function () {

    //     return view('gestion.campagnes.index');
    // });
    // Route::get('information/climatique', function () {

    //     return view('gestion.infos_clima.index');
    // });
    // Route::get('prix/marche', function () {

    //     return view('gestion.marches.index');
    // });
    // Route::get('declaration/sinistre', function () {

    //     return view('gestion.marches.index');
    // });
    // Route::get('offre/credit', function () {

    //     return view('gestion.marches.index');
    // });
    // Route::get('expression/besoin', function () {

    //     return view('gestion.marches.index');
    // });
    // Route::get('statistique', function () {

    //     return view('gestion.marches.index');
    // });
    // Route::get('historique', function () {

    //     return view('gestion.marches.index');
    // });
    // Route::get('vocale', function () {

    //     return view('gestion.marches.index');
    // });


    // -------------------------Route PRODUCTIONS----------------------

    Route::get('productions/liste', [ProductionController::class, 'index']);
    Route::get('productions/create', [ProductionController::class, 'create']);
    Route::post('productions/store', [ProductionController::class, 'store']);
    Route::get('/productions/modifier/{id}', [ProductionController::class, 'modifier']);
    Route::post('/productions/edit', [ProductionController::class, 'edit']);
    Route::get('/productions/delete/{id}', [ProductionController::class, 'delete']);

    Route::get('productions/groupement/aggregation', [ProductionController::class, 'aggregation']);

    Route::get('productions/zone/aggregation', [ProductionController::class, 'zone_aggregation']);


    Route::post('/productions/filter', [ProductionController::class, 'filter']);


    // -------------------------Route Expressions Besoin----------------------

    Route::get('/expression-de-besoin', [EBController::class, 'index']);
    Route::get('/expression-de-besoin/type_eb', [EBController::class, 'type_eb']);
    Route::post('/expression-de-besoin/create', [EBController::class, 'create']);
    Route::post('/expression-de-besoin/store', [EBController::class, 'store']);
    Route::get('/expression-de-besoin/modifier/{id}', [EBController::class, 'modifier']);
    Route::post('/expression-de-besoin/edit', [EBController::class, 'edit']);
    Route::get('/expression-de-besoin/delete/{id}', [EBController::class, 'delete']);

    Route::post('/expression-de-besoin/filter', [EBController::class, 'filter']);

    Route::get('/expression-de-besoin/details/{id}', [EBController::class, 'show']);

    Route::post('/expression-de-besoin/offre/store', [EBController::class, 'offre']);

    Route::get('/expression-de-besoin/offre/liste/{id}', [EBController::class, 'liste_offre']);

    // ------------------------- Distributions d'Intrants----------------------

    Route::get('distributions', [IntrantDistributionController::class, 'index'])->name('distributions.index');
    Route::get('cc/reception/distribution', [IntrantDistributionController::class, 'index'])->name('distributions.index.1');
    Route::get('distributions/create', [IntrantDistributionController::class, 'create'])->name('distributions.create');
    Route::post('distributions/store', [IntrantDistributionController::class, 'store'])->name('distributions.store');
    Route::get('cc/reception/distribution/edit/{id}', [IntrantDistributionController::class, 'edit'])->name('distributions.valider.cc');
    Route::post('distributions/update', [IntrantDistributionController::class, 'update'])->name('distributions.update');

    // -------------------------Reception (Accuse Reception) Produit CC --> OP ----------------------


    Route::get("receptions/intrants", [ReceptionIntrantController::class, 'index'])->name('receptions.index');
    Route::get("distributions/cc/intrants", [ReceptionIntrantController::class, 'index'])->name('receptions.index.1');
    Route::get("receptions/intrants/new", [ReceptionIntrantController::class, 'create'])->name('receptions.create');
    Route::get("distributions/cc/intrants/new", [ReceptionIntrantController::class, 'create'])->name('receptions.create.1');
    Route::post('receptions/intrants/store', [ReceptionIntrantController::class, 'store'])->name('receptions.store');
    Route::post('receptions/intrants/store/validation', [ReceptionIntrantController::class, 'storeValidation'])->name('receptions.storeValidation');
    Route::get('receptions/intrants/validate/{id}', [ReceptionIntrantController::class, 'validationReception'])->name('receptions.validate');


    // -------------------------Ecoulement Produit OP --> Producteurs ----------------------

    Route::get("intrants/ecoulements", [EcoulementIntrantController::class, 'index'])->name('ecoulements.index');
    Route::get("intrants/ecoulements/new", [EcoulementIntrantController::class, 'create'])->name('ecoulements.create');
    Route::post('ecoulements/store', [EcoulementIntrantController::class, 'store'])->name('ecoulements.store');

    // -------------------------Route Offres Bancaires----------------------

    Route::get('/banques/offre-de-credit', [OffreBankController::class, 'index']);
    Route::get('/banques/offre-de-credit/create', [OffreBankController::class, 'create']);
    Route::post('/banques/offre-de-credit/store', [OffreBankController::class, 'store']);
    Route::get('/banques/offre-de-credit/modifier/{id}', [OffreBankController::class, 'modifier']);
    Route::post('/banques/offre-de-credit/edit', [OffreBankController::class, 'edit']);
    Route::get('/banques/offre-de-credit/delete/{id}', [OffreBankController::class, 'delete']);


    // -------------------------Route Banques----------------------

    Route::get('/banques/liste', [BankController::class, 'index']);
    Route::post('/banques/store', [BankController::class, 'store']);
    Route::get('/banques/modifier/{id}', [BankController::class, 'modifier']);
    Route::post('/banques/edit', [BankController::class, 'edit']);


    // -------------------------Route Agences Bancaires----------------------

    Route::get('/banques/liste/agences/{id_banque}/{nom_banque}', [AgenceController::class, 'index']);
    Route::post('/banques/liste/agences/store/{id_banque}/{nom_banque}', [AgenceController::class, 'store']);
    Route::get('/banques/liste/agences/modifier/{id_banque}/{nom_banque}/{id}', [AgenceController::class, 'modifier']);
    Route::post('/banques/liste/agences/edit/{id_banque}/{nom_banque}', [AgenceController::class, 'edit']);
    // Route::get('/banques/offre-de-credit/delete/{id}', [AgenceController::class, 'delete']);


    // ------------------------Route PRIX DU MARCHÉ--------------------------

    Route::get('/prix-du-marche/prix', [PrixController::class, 'index']);
    Route::get('/prix-du-marche/prix/create', [PrixController::class, 'create']);
    Route::get('/prix-du-marche/prix/push/{id}', [PrixController::class, 'make_push']);
    Route::post('/prix-du-marche/prix/sms', [PrixController::class, 'sms']);
    Route::get('/prix-du-marche/historique', [PrixController::class, 'push_history']);
    Route::get('/prix-du-marche/historiques/{message}/{date}', [PrixController::class, 'history_details']);


    Route::post('/prix-du-marche/prix/store', [PrixController::class, 'store']);
    Route::get('/prix-du-marche/prix/modifier/{id}', [PrixController::class, 'modifier']);
    Route::post('/prix-du-marche/prix/edit', [PrixController::class, 'edit']);
    Route::get('/prix-du-marche/prix/delete/{id}', [PrixController::class, 'delete']);


    Route::get('/cartographie/marches', [MarketController::class, 'map']);

    Route::get('/cartographie/pluvios', [PluvioController::class, 'map']);

    Route::get('/cartographie/stocks', [ProductsController::class, 'map']);


    Route::get('/prix-du-marche/marches', [MarketController::class, 'index']);

    Route::post('/prix-du-marche/marches/store', [MarketController::class, 'store']);

    Route::get('/prix-du-marche/marches/modifier/{id}', [MarketController::class, 'modifier']);

    Route::post('/prix-du-marche/marches/edit', [MarketController::class, 'edit']);

    Route::get('/prix-du-marche/marches/delete/{id}', [MarketController::class, 'delete']);

    // Route::resource('produits', 'App\Http\Controllers\ProduitController'); Chantier Abandonne


    // ------------------------Route GROUPEMENTS--------------------------

    Route::get('/groupements/membres/{libelle}/{id}', [GroupementController::class, 'membre']);
    Route::post('/groupements/membres/ajouter/{libelle}/{id}', [GroupementController::class, 'ajouter_membre']);

    Route::post('/groupements/liste_membres/ajouter/{libelle}/{id}', [GroupementController::class, 'membre_list']);


    Route::post('/groupements/liste_membres/migrer_phone/{libelle}/{id}', [GroupementController::class, 'updatebyphone']);

    Route::post('/groupements/liste_membres/migrer_mail/{libelle}/{id}', [GroupementController::class, 'updatebymail']);


    Route::get('/groupements/membres/delete/{libelle}/{id}/{producteur}', [GroupementController::class, 'retirer_membre']);
    Route::get('/groupements', [GroupementController::class, 'index'])->name('groupements');
    Route::post('/groupements/store', [GroupementController::class, 'store']);
    Route::get('/groupements/modifier/{id}', [GroupementController::class, 'modifier']);
    Route::post('/groupements/edit', [GroupementController::class, 'edit']);
    Route::get('/groupements/delete/{id}', [GroupementController::class, 'delete']);


    // Route::get('/phone_form', function () {

    //     return view('gestion.groupements.groupements.phone_form');
    // });

    // Route::get('/mail_form', function () {

    //     return view('gestion.groupements.groupements.mail_form');
    // });

    Route::get('/phone_form/{libelle}/{id}', [GroupementController::class, 'phone_form']);
    Route::get('/mail_form/{libelle}/{id}', [GroupementController::class, 'mail_form']);

    Route::post('/enroler/migrer_phone/{libelle}/{id}', [GroupementController::class, 'migrerPhone']);
    Route::post('/enroler/migrer_mail/{libelle}/{id}', [GroupementController::class, 'migrerMail']);


    // ------------------------Route UNIONS GROUPEMENTS--------------------------
    Route::post('/union_groupements/store', [UnionGroupementController::class, 'store']);
    Route::get('/union_groupements/modifier/{id}', [UnionGroupementController::class, 'modifier']);
    Route::post('/union_groupements/edit', [UnionGroupementController::class, 'edit']);
    Route::get('/union_groupements/delete/{id}', [UnionGroupementController::class, 'delete']);


    // ------------------------Route OP--------------------------

    Route::post('/auop/store', [AUOPController::class, 'store']);
    Route::get('/auop/modifier/{id}', [AUOPController::class, 'modifier']);
    Route::post('/auop/edit', [AUOPController::class, 'edit']);
    Route::get('/auop/delete/{id}', [AUOPController::class, 'delete']);


    /*/                   Route Produits                                /*/

    Route::get('/louma-mbay/produits/modifier/{id}', [ProductsController::class, 'edit']);
    Route::post('/louma-mbay/updateProduit', [ProductsController::class, 'updateProduit']);
    Route::get('/louma-mbay/produits/supprimer/{id}', [ProductsController::class, 'delete']);
    Route::get('/louma-mbay/produits/create', [ProductsController::class, 'create']);
    Route::post('/produit_to_shop/add', [ProductsController::class, 'addProduitToShop']);
    Route::post('/produit_to_shop/edit', [ProductsController::class, 'updateProduitToShop']);
    Route::get('/louma-mbay/boutiques/produit_to_shop/edit/{id}', [ProductsController::class, 'editProduitToShop']);

    /*/                   Route Commandes                                /*/

    Route::get('/louma-mbay/commandes/supprimer/{id}', [OrderController::class, 'supprimerCommande']);
    Route::get('/louma-mbay/commandes/modifier/{id}', [OrderController::class, 'modifierCommande']);
    Route::post('/louma-mbay/updateCommande', [OrderController::class, 'updateCommande']);


    /*/                   Route Boutiques                                /*/

    Route::get('/louma-mbay/boutiques/create', [ShopController::class, 'create']);
    Route::get('/boutique/edit/{id}', [ShopController::class, 'edit']);
    Route::post('/boutique/update', [ShopController::class, 'update']);
    Route::get('/louma-mbay/boutiques/addProduit/{id}', [ShopController::class, 'addProduitToShop']);


    Route::post('/shop/create', [ShopController::class, 'enregistrer']);
    Route::get('/louma-mbay/boutiques/supprimer/{id}', [ShopController::class, 'delete']);

    Route::post('/produit/create', [ProductsController::class, 'addProduct']);

    Route::post('/louma-mbay/boutiques/enregistrerProduit', [ShopController::class, 'enregistrerProduit']);

    Route::get('/louma-mbay/boutiques/produits/modifier/{id}', [ShopController::class, 'editProduct']);
    Route::post('/louma-mbay/boutiques/updateProduit', [ShopController::class, 'updateProduct']);
    Route::get('/louma-mbay/boutiques/produits/supprimer/{id}', [ShopController::class, 'deleteProduct']);


    /*/                   Route Utilisateurs Wordpress                                /*/

    Route::get('/louma-mbay/utilisateurs', [UserController::class, 'index']);
    Route::get('/louma-mbay/utilisateurs/create', [UserController::class, 'create']);
    Route::post('/louma-mbay/utilisateurs/enregistrer', [UserController::class, 'enregistrer']);
    Route::get('/louma-mbay/utilisateurs/modifier/{id}', [UserController::class, 'edit']);
    Route::post('/louma-mbay/utilisateurs/update', [UserController::class, 'update']);
    Route::get('/louma-mbay/utilisateurs/supprimer/{id}', [UserController::class, 'delete']);


    /*/                   Route Cours                               /*/

    Route::get('/louma-du-savoir/cours/listeEtudiants/{id}', [CoursController::class, 'getEnrolledStudents']);
    Route::get('/louma-du-savoir/cours/desinscrire/{userid}/{courseid}', [CoursController::class, 'desinscrireCours']);


    /*/                   Route Utilisateurs Moodle                                /*/

    Route::get('/louma-du-savoir/utilisateurs', [MoodleUserController::class, 'index']);


    // ------------------------Route LANGUES--------------------------

    Route::get('langue/create', [LangueController::class, 'create']);
    Route::post('langue/store', [LangueController::class, 'store']);
    Route::get('/langue/modifier/{id}', [LangueController::class, 'modifier']);
    Route::post('/langue/edit', [LangueController::class, 'edit']);
    Route::get('/langue/delete/{id}', [LangueController::class, 'delete']);


    // -------------------------------RÉGIONS---------------------------------

    Route::get('regions/create', [RegionController::class, 'create']);
    Route::post('regions/store', [RegionController::class, 'store']);
    Route::get('/regions/modifier/{id}', [RegionController::class, 'modifier']);
    Route::post('/regions/edit', [RegionController::class, 'edit']);
    Route::get('/regions/delete/{id}', [RegionController::class, 'delete']);


    // -------------------------------DÉPARTEMENTS---------------------------------

    Route::get('/departements/create', [DepartementController::class, 'create']);
    Route::post('departements/store', [DepartementController::class, 'store']);
    Route::get('/departements/modifier/{id}', [DepartementController::class, 'modifier']);
    Route::post('/departements/edit', [DepartementController::class, 'edit']);
    Route::get('/departements/delete/{id}', [DepartementController::class, 'delete']);


    // -------------------------------COMMUNES---------------------------------

    Route::get('/communes/create', [CommuneController::class, 'create']);
    Route::post('communes/store', [CommuneController::class, 'store']);
    Route::get('/communes/modifier/{id}', [CommuneController::class, 'modifier']);
    Route::post('/communes/edit', [CommuneController::class, 'edit']);
    Route::get('/communes/delete/{id}', [CommuneController::class, 'delete']);


    // -------------------------------LOCALITES---------------------------------

    Route::get('/localites/create', [LocaliteController::class, 'create']);
    Route::post('localites/store', [LocaliteController::class, 'store']);
    Route::get('/localites/modifier/{id}', [LocaliteController::class, 'modifier']);
    Route::post('/localites/edit', [LocaliteController::class, 'edit']);
    Route::get('/localites/delete/{id}', [LocaliteController::class, 'delete']);
});


Route::middleware(['as_admin'])->group(function () {});

Route::middleware(['as_ong'])->group(function () {


    /*/                   Route Utilisateurs                                /*/
    Route::get('ong/utilisateurs', [UtilisateurController::class, 'index']);
    Route::post('ong/utilisateurs/filter', [UtilisateurController::class, 'filter']);
    Route::get('ong/utilisateurs/create', [UtilisateurController::class, 'create']);
    Route::get('ong/utilisateurs/{id}', [UtilisateurController::class, 'show']);
    Route::get('/utilisateurs/nb', [UtilisateurController::class, 'show']);


    /*/                   End                              /*/


    Route::get('ong/role/create', [UtilisateurController::class, 'getEntities']);
    Route::get('ong/role', [UtilisateurController::class, 'getEntity']);
    Route::get('ong/role/{id}', [UtilisateurController::class, 'getEntityDetails']);
    Route::get('ong/role/edit/{id}', [UtilisateurController::class, 'getEntityToEdit']);


    Route::get('ong/profil/edit/{id}', [ProfilController::class, 'edit']);
});


// ___________________________data____________________________

// Route::get('/packs',function(){
//     return view('gestion.packs.index') ;
// });


// Route::get('/produits',function(){
//     return view('gestion.produits.index') ;
// });
// Route::get('/utilisateurs',function(){
//     return view('gestion.utilisateurs.index') ;
// });
Route::get('cgu', function () {
    return view("files.cgu");
})->name('cgu');

Route::get('cp', function () {
    return view("files.cp");
})->name('cp');

// Route qui permet de connaître la langue active
Route::get('locale', [LocalizationController::class, 'getLang'])->name('getlang');

// Route qui permet de modifier la langue
Route::get('locale/{lang}', [LocalizationController::class, 'setLang'])->name('setlang');

require __DIR__ . '/auth.php';
