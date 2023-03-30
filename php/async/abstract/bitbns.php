<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class bitbns extends \ccxt\async\Exchange {
    public function www_get_order_fetchmarkets($params = array()) {
        return $this->request('order/fetchMarkets', 'www', 'GET', $params);
    }
    public function www_get_order_fetchtickers($params = array()) {
        return $this->request('order/fetchTickers', 'www', 'GET', $params);
    }
    public function www_get_order_fetchorderbook($params = array()) {
        return $this->request('order/fetchOrderbook', 'www', 'GET', $params);
    }
    public function www_get_order_gettickerwithvolume($params = array()) {
        return $this->request('order/getTickerWithVolume', 'www', 'GET', $params);
    }
    public function www_get_exchangedata_ohlc($params = array()) {
        return $this->request('exchangeData/ohlc', 'www', 'GET', $params);
    }
    public function www_get_exchangedata_orderbook($params = array()) {
        return $this->request('exchangeData/orderBook', 'www', 'GET', $params);
    }
    public function www_get_exchangedata_tradedetails($params = array()) {
        return $this->request('exchangeData/tradedetails', 'www', 'GET', $params);
    }
    public function v1_get_platform_status($params = array()) {
        return $this->request('platform/status', 'v1', 'GET', $params);
    }
    public function v1_get_tickers($params = array()) {
        return $this->request('tickers', 'v1', 'GET', $params);
    }
    public function v1_get_orderbook_sell_symbol($params = array()) {
        return $this->request('orderbook/sell/{symbol}', 'v1', 'GET', $params);
    }
    public function v1_get_orderbook_buy_symbol($params = array()) {
        return $this->request('orderbook/buy/{symbol}', 'v1', 'GET', $params);
    }
    public function v1_post_currentcoinbalance_everything($params = array()) {
        return $this->request('currentCoinBalance/EVERYTHING', 'v1', 'POST', $params);
    }
    public function v1_post_getapiusagestatus_usage($params = array()) {
        return $this->request('getApiUsageStatus/USAGE', 'v1', 'POST', $params);
    }
    public function v1_post_getordersockettoken_usage($params = array()) {
        return $this->request('getOrderSocketToken/USAGE', 'v1', 'POST', $params);
    }
    public function v1_post_currentcoinbalance_symbol($params = array()) {
        return $this->request('currentCoinBalance/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_orderstatus_symbol($params = array()) {
        return $this->request('orderStatus/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_deposithistory_symbol($params = array()) {
        return $this->request('depositHistory/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_withdrawhistory_symbol($params = array()) {
        return $this->request('withdrawHistory/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_withdrawhistoryall_symbol($params = array()) {
        return $this->request('withdrawHistoryAll/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_deposithistoryall_symbol($params = array()) {
        return $this->request('depositHistoryAll/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_listopenorders_symbol($params = array()) {
        return $this->request('listOpenOrders/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_listopenstoporders_symbol($params = array()) {
        return $this->request('listOpenStopOrders/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_getcoinaddress_symbol($params = array()) {
        return $this->request('getCoinAddress/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_placesellorder_symbol($params = array()) {
        return $this->request('placeSellOrder/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_placebuyorder_symbol($params = array()) {
        return $this->request('placeBuyOrder/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_buystoploss_symbol($params = array()) {
        return $this->request('buyStopLoss/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_sellstoploss_symbol($params = array()) {
        return $this->request('sellStopLoss/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_cancelorder_symbol($params = array()) {
        return $this->request('cancelOrder/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_cancelstoplossorder_symbol($params = array()) {
        return $this->request('cancelStopLossOrder/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_listexecutedorders_symbol($params = array()) {
        return $this->request('listExecutedOrders/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_placemarketorder_symbol($params = array()) {
        return $this->request('placeMarketOrder/{symbol}', 'v1', 'POST', $params);
    }
    public function v1_post_placemarketorderqnty_symbol($params = array()) {
        return $this->request('placeMarketOrderQnty/{symbol}', 'v1', 'POST', $params);
    }
    public function v2_post_orders($params = array()) {
        return $this->request('orders', 'v2', 'POST', $params);
    }
    public function v2_post_cancel($params = array()) {
        return $this->request('cancel', 'v2', 'POST', $params);
    }
    public function v2_post_getordersnew($params = array()) {
        return $this->request('getordersnew', 'v2', 'POST', $params);
    }
    public function v2_post_marginorders($params = array()) {
        return $this->request('marginOrders', 'v2', 'POST', $params);
    }
}