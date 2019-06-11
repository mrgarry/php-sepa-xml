<?php
/**
 * SEPA file generator.
 *
 * @copyright © Digitick <www.digitick.net> 2012-2013
 * @copyright © Blage <www.blage.net> 2013
 * @license GNU Lesser General Public License v3.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Lesser Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Digitick\Sepa\TransferInformation;

class CustomerCreditTransferInformation extends BaseTransferInformation
{
    /**
     * @param string $amount
     * @param string $iban
     * @param string $name
     * @param string $identification
     */
    public function __construct($amount, $iban, $name, $identification = null, $creditorType = BaseTransferInformation::CREDITOR_TYPE_COMPANY)
    {
        parent::__construct($amount, $iban, $name);

        if (null === $identification) {
            $dt = new \DateTime();
            $identification = $dt->format('YmdHisu');
        } else {
            //sets creditor id only if identification is specified
            $this->setCreditorId($identification);
            //checking type, defaulting to company
            if (!in_array($creditorType, [static::CREDITOR_TYPE_COMPANY, static::CREDITOR_TYPE_INDIVIDUAL])) {
                throw new InvalidArgumentException('Creditor type must be either company or individual (defaults to company if omited)');
            }
            $this->setCreditorType($creditorType);
        }
        
        $this->setEndToEndIdentification($identification);
    }

    /**
     * @return string
     */
    public function getCreditorName()
    {
        return $this->name;
    }
}
