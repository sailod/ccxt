<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class bitflyer extends \ccxt\async\Exchange {
    public function public_get_getmarkets_usa($params = array()) {
        return $this->request('getmarkets/usa', 'public', 'GET', $params);
    }
    public function public_get_getmarkets_eu($params = array()) {
        return $this->request('getmarkets/eu', 'public', 'GET', $params);
    }
    public function public_get_getmarkets($params = array()) {
        return $this->request('getmarkets', 'public', 'GET', $params);
    }
    public function public_get_getboard($params = array()) {
        return $this->request('getboard', 'public', 'GET', $params);
    }
    public function public_get_getticker($params = array()) {
        return $this->request('getticker', 'public', 'GET', $params);
    }
    public function public_get_getexecutions($params = array()) {
        return $this->request('getexecutions', 'public', 'GET', $params);
    }
    public function public_get_gethealth($params = array()) {
        return $this->request('gethealth', 'public', 'GET', $params);
    }
    public function public_get_getboardstate($params = array()) {
        return $this->request('getboardstate', 'public', 'GET', $params);
    }
    public function public_get_getchats($params = array()) {
        return $this->request('getchats', 'public', 'GET', $params);
    }
    public function private_get_getpermissions($params = array()) {
        return $this->request('getpermissions', 'private', 'GET', $params);
    }
    public function private_get_getbalance($params = array()) {
        return $this->request('getbalance', 'private', 'GET', $params);
    }
    public function private_get_getbalancehistory($params = array()) {
        return $this->request('getbalancehistory', 'private', 'GET', $params);
    }
    public function private_get_getcollateral($params = array()) {
        return $this->request('getcollateral', 'private', 'GET', $params);
    }
    public function private_get_getcollateralhistory($params = array()) {
        return $this->request('getcollateralhistory', 'private', 'GET', $params);
    }
    public function private_get_getcollateralaccounts($params = array()) {
        return $this->request('getcollateralaccounts', 'private', 'GET', $params);
    }
    public function private_get_getaddresses($params = array()) {
        return $this->request('getaddresses', 'private', 'GET', $params);
    }
    public function private_get_getcoinins($params = array()) {
        return $this->request('getcoinins', 'private', 'GET', $params);
    }
    public function private_get_getcoinouts($params = array()) {
        return $this->request('getcoinouts', 'private', 'GET', $params);
    }
    public function private_get_getbankaccounts($params = array()) {
        return $this->request('getbankaccounts', 'private', 'GET', $params);
    }
    public function private_get_getdeposits($params = array()) {
        return $this->request('getdeposits', 'private', 'GET', $params);
    }
    public function private_get_getwithdrawals($params = array()) {
        return $this->request('getwithdrawals', 'private', 'GET', $params);
    }
    public function private_get_getchildorders($params = array()) {
        return $this->request('getchildorders', 'private', 'GET', $params);
    }
    public function private_get_getparentorders($params = array()) {
        return $this->request('getparentorders', 'private', 'GET', $params);
    }
    public function private_get_getparentorder($params = array()) {
        return $this->request('getparentorder', 'private', 'GET', $params);
    }
    public function private_get_getexecutions($params = array()) {
        return $this->request('getexecutions', 'private', 'GET', $params);
    }
    public function private_get_getpositions($params = array()) {
        return $this->request('getpositions', 'private', 'GET', $params);
    }
    public function private_get_gettradingcommission($params = array()) {
        return $this->request('gettradingcommission', 'private', 'GET', $params);
    }
    public function private_post_sendcoin($params = array()) {
        return $this->request('sendcoin', 'private', 'POST', $params);
    }
    public function private_post_withdraw($params = array()) {
        return $this->request('withdraw', 'private', 'POST', $params);
    }
    public function private_post_sendchildorder($params = array()) {
        return $this->request('sendchildorder', 'private', 'POST', $params);
    }
    public function private_post_cancelchildorder($params = array()) {
        return $this->request('cancelchildorder', 'private', 'POST', $params);
    }
    public function private_post_sendparentorder($params = array()) {
        return $this->request('sendparentorder', 'private', 'POST', $params);
    }
    public function private_post_cancelparentorder($params = array()) {
        return $this->request('cancelparentorder', 'private', 'POST', $params);
    }
    public function private_post_cancelallchildorders($params = array()) {
        return $this->request('cancelallchildorders', 'private', 'POST', $params);
    }
}