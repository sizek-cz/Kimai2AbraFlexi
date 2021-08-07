<?php

/**
 * KimaiToAbraFlexi - AppInit.
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2021 Vitex Software
 */

namespace Kimai2AbraFlexi;

require_once '../vendor/autoload.php';

if (file_exists(dirname(__DIR__) . '/.env')) {
    \Ease\Shared::instanced()->loadConfig(dirname(__DIR__) . '/.env', true);
}

new \Ease\Locale('cs_CZ', '../i18n', 'kimai-to-abraflexi');

define('EASE_LOOGER', 'console|syslog');

$engine = new Importer();
$engine->import();

if (\Ease\Functions::cfg('INVOICE_DOWNLOAD')) {
    $engine->addStatusMessage(sprintf(_('Invoice saved as %s'), $engine->downloadInFormat('pdf', \Ease\Functions::cfg('REPORTS_DIR'))));
    $engine->addStatusMessage(sprintf(_('Invoice saved as %s'), $engine->downloadInFormat('isdocx', \Ease\Functions::cfg('REPORTS_DIR'))));
}
