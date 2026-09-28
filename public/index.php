<?php
date_default_timezone_set('Europe/Paris');

$requestPath = rtrim((string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/') ?: '/';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $blockedRequests = [
        '/register' => 'Inscription temporairement désactivée.',
        '/password/reset' => 'Réinitialisation du mot de passe temporairement désactivée.',
        '/contact/new' => 'Envoi du formulaire de contact temporairement désactivé.',
    ];

    if (isset($blockedRequests[$requestPath])) {
        die($blockedRequests[$requestPath]);
    }
}

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
