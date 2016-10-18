<?php
/*
 * Copyright (C) 2015 Andy Pieters <andy@pay.nl>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Paynl\Api\Instore;

use Paynl\Error;

/**
 * Description of Status
 *
 * @author Andy Pieters <andy@pay.nl>
 */
class Status extends Instore
{
    protected $apiTokenRequired = false;
    protected $serviceIdRequired = false;

    /**
     * @var string The hash of the instore transaction
     */
    private $hash;

    /**
     * @return array the data
     * @throws Error\Required
     */
    protected function getData()
    {
        if (empty($this->hash)) {
            throw new Error\Required('Hash is niet geset');
        }
        $this->data['hash'] = $this->hash;
        return parent::getData();
    }

    /**
     * @param string $hash the hash of the instore transaction
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @param null $endpoint
     * @param null $version
     * @return array the result
     */
    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('instore/status');
    }
}