<?php
##Décription en php
use App\Controller\ClientController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes)
{
    $routes->add('client_prenom', '/client/prenom/{prenom}')
        // the controller value has the format [controller_class, method_name]
        ->controller([ClientController::class, 'prenom']);
}



?>
