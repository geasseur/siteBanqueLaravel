<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'http://baptiste-ventura.fr/sitePhp/siteBanqueLaravel/public/testConnexion',
        'http://baptiste-ventura.fr/siteBanqueLaravel/public/creationUser',
        'http://baptiste-ventura.fr/siteBanqueLaravel/public/indexComptes/creationCompte',
        'http://baptiste-ventura.fr/siteBanqueLaravel/public/',
        'http://baptiste-ventura.fr/siteBanqueLaravel/public/detailCompte',
        'http://baptiste-ventura.fr/siteBanqueLaravel/public/detailCompte/ajoutArgent',
        'http://baptiste-ventura.fr/siteBanqueLaravel/public/detailCompte/transfertSoi',
        'http://baptiste-ventura.fr/siteBanqueLaravel/public/detailCompte/linkAccount',
        'http://baptiste-ventura.fr/siteBanqueLaravel/public/detailCompte/TransfertAutre',
        'http://baptiste-ventura.fr/siteBanqueLaravel/public/indexComptes',
        'http://baptiste-ventura.fr/siteBanqueLaravel/public/detailCompte/effacerCompte'
    ];
}
