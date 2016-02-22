<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Smile Elastic Suite to newer
 * versions in the future.
 *
 * @category  Smile
 * @package   Smile_ElasticSuiteCatalog
 * @author    Aurelien FOUCRET <aurelien.foucret@smile.fr>
 * @copyright 2016 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Smile\ElasticSuiteCore\Search\Request;

use Magento\Framework\Search\Request\FilterInterface;

interface  SortOrderInterface
{
    /**
     * @return string;
     */
    public function getFieldName();

    /**
     * @return string
     */
    public function getDirection();

    /**
     * @return FilterInterface
     */
    public function getFilter();
}