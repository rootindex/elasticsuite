<?php
/**
 * DISCLAIMER
 * Do not edit or add to this file if you wish to upgrade Smile Elastic Suite to newer
 * versions in the future.
 *
 * @category  Smile
 * @package   Smile_ElasticSuiteCatalogAutocomplete
 * @author    Romain Ruaud <romain.ruaud@smile.fr>
 * @copyright 2016 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Smile\ElasticSuiteCatalogAutocomplete\Block\Search\Form;

use Magento\Framework\Locale\FormatInterface;

/**
 * Quick Form block for Autocomplete
 *
 * @category Smile
 * @package  Smile_ElasticSuiteCatalogAutocomplete
 * @author   Romain Ruaud <romain.ruaud@smile.fr>
 */
class Autocomplete extends \Magento\Framework\View\Element\Template
{
    /**
     * @var FormatInterface
     */
    private $localeFormat;

    /**
     * JSON Helper
     *
     * @var \Magento\Framework\Json\Helper\Data
     */
    private $jsonHelper;

    /**
     * @var array
     */
    private $rendererList;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * Autocomplete constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     * @param FormatInterface $localeFormat
     * @param array $data
     * @param array $rendererList
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        FormatInterface $localeFormat,
        array $data,
        array $rendererList = []
    ) {
        $this->jsonHelper = $jsonHelper;
        $this->localeFormat = $localeFormat;
        $this->rendererList = $rendererList;
        $this->storeManager = $context->getStoreManager();

        parent::__construct($context, $data);
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        if ($this->_storeManager->getStore()->isCurrentlySecure()) {
            $params['_secure'] = true;
        }
        return parent::getUrl($route, $params);
    }

    /**
     * Retrieve templates renderers for autocomplete results
     *
     * @return array
     */
    public function getSuggestRenderers()
    {
        foreach ($this->rendererList as &$renderer) {
            if (isset($renderer['title'])) {
                $renderer['title'] = __($renderer['title']);
            }
        }

        return $this->rendererList;
    }

    /**
     * Retrieve Renderers used to draw the suggest in JSON format
     *
     * @return string
     */
    public function getJsonSuggestRenderers()
    {
        $templates = $this->getSuggestRenderers();

        return $this->jsonHelper->jsonEncode($templates);
    }

    /**
     * Retrieve price format configuration in Json.
     *
     * @return array
     */
    public function getJsonPriceFormat()
    {
        return $this->jsonHelper->jsonEncode($this->getPriceFormat());
    }

    /**
     * Retrieve price format configuration.
     *
     * @return array
     */
    protected function getPriceFormat()
    {
        return $this->localeFormat->getPriceFormat();
    }
}
