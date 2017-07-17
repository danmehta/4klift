<?php

/*
 * This file is part of CEF (a 4klift component).
 *
 * Copyright (c) 2017 Deasil Works Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace DeasilWorks\CEF\StatementComponent;

use DeasilWorks\CEF\CEFData;

/**
 * Class Obj
 *
 * Takes a CEFData and allows it to be stringified with fromJSON
 * for CQL statements
 *
 * @package DeasilWorks\CEF\StatementComponent
 */
class Obj
{
    /**
     * @var CEFData
     */
    protected $cef_data;

    function __toString()
    {
        if ($this->getCefData()) {
            // cassandra string support
            $json = str_replace("'", "''", $this->getCefData()->toJson());

            return 'fromJSON(\'' . $json . '\')';
        } else {
            return '';
        }
    }

    /**
     * Obj constructor.
     * @param CEFData $cef_data
     */
    public function __construct(CEFData $cef_data)
    {
        $this->setCefData($cef_data);
    }

    /**
     * @return CEFData
     */
    public function getCefData()
    {
        return $this->cef_data;
    }

    /**
     * @param CEFData $cef_data
     * @return Obj
     */
    public function setCefData($cef_data)
    {
        $this->cef_data = $cef_data;
        return $this;
    }

}