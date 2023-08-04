<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 8/23/2016
 * Time: 4:08 PM
 */

namespace Cuongpm\Modularization\Http\Facades;


class InputFun
{
    public function normalization($request)
    {
        return $this->loopNormalization($request->all());
    }

    public function loopNormalization($params)
    {
        foreach ($params as $k => $v) {
            if (is_string($v)) {
                $params[$k] = trim($v);
                if ($params[$k] === '') {
                    unset($params[$k]);
                }
            } elseif (is_array($v)) {
                $params[$k] = $this->loopNormalization($v);
            }
        }
        return $params;
    }

    public function runInput($params)
    {
        foreach ($params as $key => $val) {
            $this->{$key}($val);
        }
    }
}
