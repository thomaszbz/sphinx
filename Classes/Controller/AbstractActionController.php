<?php
namespace Causal\Sphinx\Controller;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this TYPO3 code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Abstract multi action controller.
 *
 * @category    Controller
 * @package     TYPO3
 * @subpackage  tx_sphinx
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   Causal Sàrl
 * @license     http://www.gnu.org/copyleft/gpl.html
 */
abstract class AbstractActionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * Needed in TYPO3 6.0.0-6.0.99
     *
     * @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher
     * @inject
     */
    protected $signalSlotDispatcher;

    /**
     * Injects settings.
     *
     * @return void
     */
    protected function injectSettings()
    {
        $configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$this->request->getControllerExtensionKey()]);
        if (!is_array($configuration)) {
            $configuration = array();
        }
        $this->settings = GeneralUtility::array_merge($configuration, $this->settings);
    }

    /**
     * Returns an AJAX response.
     *
     * @param array $response
     * @param bool $wrapForIframe see http://cmlenz.github.io/jquery-iframe-transport/#section-13
     * return void
     */
    protected function returnAjax(array $response, $wrapForIframe = false)
    {
        $payload = json_encode($response);
        if (!$wrapForIframe) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/html');
            $payload = '<textarea data-type="application/json">' . $payload . '</textarea>';
        }
        echo $payload;
        exit;
    }

    /**
     * Returns the localized label of a given key.
     *
     * @param string $key The key from the LOCAL_LANG array for which to return the value.
     * @param array $arguments the arguments of the extension, being passed over to vsprintf
     * @return string Localized label
     */
    protected function translate($key, $arguments = null)
    {
        return \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($key, $this->request->getControllerExtensionKey(), $arguments);
    }

    /**
     * Returns the Backend user.
     *
     * @return \TYPO3\CMS\Core\Authentication\BackendUserAuthentication
     */
    protected function getBackendUser()
    {
        return $GLOBALS['BE_USER'];
    }

    /**
     * Creates a toolbar button.
     *
     * @param string $link
     * @param string $title
     * @param string $iconClasses
     * @param string $onClick
     * @return string
     */
    protected function createToolbarButton($link, $title, $iconClasses, $onClick = '')
    {
        $button =
            '<a href="' . htmlspecialchars($link) . '"' .
            ($onClick ? ' onclick="' . $onClick . ';return false;"' : '') .
            ' title="' . htmlspecialchars($title) . '"' .
            ' target="tx-sphinx-documentation-content">' .
            '<span class="t3-icon ' . $iconClasses . '">&nbsp;</span>' .
            '</a>';
        // Replacement of single quotes to be compatible with the dynamic update of the toolbar
        return str_replace('\'', '\\\'', $button);
    }

}
