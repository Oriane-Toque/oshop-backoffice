<?php

namespace App\Controllers;

// Classe gérant les erreurs (404, 403)
class ErrorController extends CoreController {
    /**
     * Méthode gérant l'affichage de la page 404
     *
     * @return void
     */
    public function err404() {
        

        header('HTTP/1.0 404 Not Found');

        $errorData['titrePage'] = 'Error 404';

        // Puis on gère l'affichage
        $this->show('error/err404', $errorData);
    }
    /**
     * Méthode gérant l'affichage de la page 403
     *
     * @return void
     */
    public function err403() {

        // On envoie le header 403
        header('HTTP/1.0 403 Not Found');

        $errorData['titrePage'] = 'Error 403';

        // Puis on gère l'affichage
        $this->show('error/err403', $errorData);
    }
}