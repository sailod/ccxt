<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class bitforex extends \ccxt\Exchange {
    public function public_get_api_v1_market_symbols($params = array()) {
        return $this->request('api/v1/market/symbols', 'public', 'GET', $params);
    }
    public function public_get_api_v1_market_ticker($params = array()) {
        return $this->request('api/v1/market/ticker', 'public', 'GET', $params);
    }
    public function public_get_api_v1_market_ticker_all($params = array()) {
        return $this->request('api/v1/market/ticker-all', 'public', 'GET', $params);
    }
    public function public_get_api_v1_market_depth($params = array()) {
        return $this->request('api/v1/market/depth', 'public', 'GET', $params);
    }
    public function public_get_api_v1_market_depth_all($params = array()) {
        return $this->request('api/v1/market/depth-all', 'public', 'GET', $params);
    }
    public function public_get_api_v1_market_trades($params = array()) {
        return $this->request('api/v1/market/trades', 'public', 'GET', $params);
    }
    public function public_get_api_v1_market_kline($params = array()) {
        return $this->request('api/v1/market/kline', 'public', 'GET', $params);
    }
    public function private_post_api_v1_fund_mainaccount($params = array()) {
        return $this->request('api/v1/fund/mainAccount', 'private', 'POST', $params);
    }
    public function private_post_api_v1_fund_allaccount($params = array()) {
        return $this->request('api/v1/fund/allAccount', 'private', 'POST', $params);
    }
    public function private_post_api_v1_trade_placeorder($params = array()) {
        return $this->request('api/v1/trade/placeOrder', 'private', 'POST', $params);
    }
    public function private_post_api_v1_trade_placemultiorder($params = array()) {
        return $this->request('api/v1/trade/placeMultiOrder', 'private', 'POST', $params);
    }
    public function private_post_api_v1_trade_cancelorder($params = array()) {
        return $this->request('api/v1/trade/cancelOrder', 'private', 'POST', $params);
    }
    public function private_post_api_v1_trade_cancelmultiorder($params = array()) {
        return $this->request('api/v1/trade/cancelMultiOrder', 'private', 'POST', $params);
    }
    public function private_post_api_v1_trade_cancelallorder($params = array()) {
        return $this->request('api/v1/trade/cancelAllOrder', 'private', 'POST', $params);
    }
    public function private_post_api_v1_trade_orderinfo($params = array()) {
        return $this->request('api/v1/trade/orderInfo', 'private', 'POST', $params);
    }
    public function private_post_api_v1_trade_multiorderinfo($params = array()) {
        return $this->request('api/v1/trade/multiOrderInfo', 'private', 'POST', $params);
    }
    public function private_post_api_v1_trade_orderinfos($params = array()) {
        return $this->request('api/v1/trade/orderInfos', 'private', 'POST', $params);
    }
}