<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class bitfinex extends \ccxt\Exchange {
    public function v2_get_platform_status($params = array()) {
        return $this->request('platform/status', 'v2', 'GET', $params);
    }
    public function v2_get_tickers($params = array()) {
        return $this->request('tickers', 'v2', 'GET', $params);
    }
    public function v2_get_ticker_symbol($params = array()) {
        return $this->request('ticker/{symbol}', 'v2', 'GET', $params);
    }
    public function v2_get_tickers_hist($params = array()) {
        return $this->request('tickers/hist', 'v2', 'GET', $params);
    }
    public function v2_get_trades_symbol_hist($params = array()) {
        return $this->request('trades/{symbol}/hist', 'v2', 'GET', $params);
    }
    public function v2_get_book_symbol_precision($params = array()) {
        return $this->request('book/{symbol}/{precision}', 'v2', 'GET', $params);
    }
    public function v2_get_book_symbol_p0($params = array()) {
        return $this->request('book/{symbol}/P0', 'v2', 'GET', $params);
    }
    public function v2_get_book_symbol_p1($params = array()) {
        return $this->request('book/{symbol}/P1', 'v2', 'GET', $params);
    }
    public function v2_get_book_symbol_p2($params = array()) {
        return $this->request('book/{symbol}/P2', 'v2', 'GET', $params);
    }
    public function v2_get_book_symbol_p3($params = array()) {
        return $this->request('book/{symbol}/P3', 'v2', 'GET', $params);
    }
    public function v2_get_book_symbol_r0($params = array()) {
        return $this->request('book/{symbol}/R0', 'v2', 'GET', $params);
    }
    public function v2_get_stats1_key_size_symbol_side_section($params = array()) {
        return $this->request('stats1/{key}:{size}:{symbol}:{side}/{section}', 'v2', 'GET', $params);
    }
    public function v2_get_stats1_key_size_symbol_section($params = array()) {
        return $this->request('stats1/{key}:{size}:{symbol}/{section}', 'v2', 'GET', $params);
    }
    public function v2_get_stats1_key_size_symbol_long_last($params = array()) {
        return $this->request('stats1/{key}:{size}:{symbol}:long/last', 'v2', 'GET', $params);
    }
    public function v2_get_stats1_key_size_symbol_long_hist($params = array()) {
        return $this->request('stats1/{key}:{size}:{symbol}:long/hist', 'v2', 'GET', $params);
    }
    public function v2_get_stats1_key_size_symbol_short_last($params = array()) {
        return $this->request('stats1/{key}:{size}:{symbol}:short/last', 'v2', 'GET', $params);
    }
    public function v2_get_stats1_key_size_symbol_short_hist($params = array()) {
        return $this->request('stats1/{key}:{size}:{symbol}:short/hist', 'v2', 'GET', $params);
    }
    public function v2_get_candles_trade_timeframe_symbol_section($params = array()) {
        return $this->request('candles/trade:{timeframe}:{symbol}/{section}', 'v2', 'GET', $params);
    }
    public function v2_get_candles_trade_timeframe_symbol_last($params = array()) {
        return $this->request('candles/trade:{timeframe}:{symbol}/last', 'v2', 'GET', $params);
    }
    public function v2_get_candles_trade_timeframe_symbol_hist($params = array()) {
        return $this->request('candles/trade:{timeframe}:{symbol}/hist', 'v2', 'GET', $params);
    }
    public function public_get_book_symbol($params = array()) {
        return $this->request('book/{symbol}', 'public', 'GET', $params);
    }
    public function public_get_lendbook_currency($params = array()) {
        return $this->request('lendbook/{currency}', 'public', 'GET', $params);
    }
    public function public_get_lends_currency($params = array()) {
        return $this->request('lends/{currency}', 'public', 'GET', $params);
    }
    public function public_get_pubticker_symbol($params = array()) {
        return $this->request('pubticker/{symbol}', 'public', 'GET', $params);
    }
    public function public_get_stats_symbol($params = array()) {
        return $this->request('stats/{symbol}', 'public', 'GET', $params);
    }
    public function public_get_symbols($params = array()) {
        return $this->request('symbols', 'public', 'GET', $params);
    }
    public function public_get_symbols_details($params = array()) {
        return $this->request('symbols_details', 'public', 'GET', $params);
    }
    public function public_get_tickers($params = array()) {
        return $this->request('tickers', 'public', 'GET', $params);
    }
    public function public_get_trades_symbol($params = array()) {
        return $this->request('trades/{symbol}', 'public', 'GET', $params);
    }
    public function private_post_account_fees($params = array()) {
        return $this->request('account_fees', 'private', 'POST', $params);
    }
    public function private_post_account_infos($params = array()) {
        return $this->request('account_infos', 'private', 'POST', $params);
    }
    public function private_post_balances($params = array()) {
        return $this->request('balances', 'private', 'POST', $params);
    }
    public function private_post_basket_manage($params = array()) {
        return $this->request('basket_manage', 'private', 'POST', $params);
    }
    public function private_post_credits($params = array()) {
        return $this->request('credits', 'private', 'POST', $params);
    }
    public function private_post_deposit_new($params = array()) {
        return $this->request('deposit/new', 'private', 'POST', $params);
    }
    public function private_post_funding_close($params = array()) {
        return $this->request('funding/close', 'private', 'POST', $params);
    }
    public function private_post_history($params = array()) {
        return $this->request('history', 'private', 'POST', $params);
    }
    public function private_post_history_movements($params = array()) {
        return $this->request('history/movements', 'private', 'POST', $params);
    }
    public function private_post_key_info($params = array()) {
        return $this->request('key_info', 'private', 'POST', $params);
    }
    public function private_post_margin_infos($params = array()) {
        return $this->request('margin_infos', 'private', 'POST', $params);
    }
    public function private_post_mytrades($params = array()) {
        return $this->request('mytrades', 'private', 'POST', $params);
    }
    public function private_post_mytrades_funding($params = array()) {
        return $this->request('mytrades_funding', 'private', 'POST', $params);
    }
    public function private_post_offer_cancel($params = array()) {
        return $this->request('offer/cancel', 'private', 'POST', $params);
    }
    public function private_post_offer_new($params = array()) {
        return $this->request('offer/new', 'private', 'POST', $params);
    }
    public function private_post_offer_status($params = array()) {
        return $this->request('offer/status', 'private', 'POST', $params);
    }
    public function private_post_offers($params = array()) {
        return $this->request('offers', 'private', 'POST', $params);
    }
    public function private_post_offers_hist($params = array()) {
        return $this->request('offers/hist', 'private', 'POST', $params);
    }
    public function private_post_order_cancel($params = array()) {
        return $this->request('order/cancel', 'private', 'POST', $params);
    }
    public function private_post_order_cancel_all($params = array()) {
        return $this->request('order/cancel/all', 'private', 'POST', $params);
    }
    public function private_post_order_cancel_multi($params = array()) {
        return $this->request('order/cancel/multi', 'private', 'POST', $params);
    }
    public function private_post_order_cancel_replace($params = array()) {
        return $this->request('order/cancel/replace', 'private', 'POST', $params);
    }
    public function private_post_order_new($params = array()) {
        return $this->request('order/new', 'private', 'POST', $params);
    }
    public function private_post_order_new_multi($params = array()) {
        return $this->request('order/new/multi', 'private', 'POST', $params);
    }
    public function private_post_order_status($params = array()) {
        return $this->request('order/status', 'private', 'POST', $params);
    }
    public function private_post_orders($params = array()) {
        return $this->request('orders', 'private', 'POST', $params);
    }
    public function private_post_orders_hist($params = array()) {
        return $this->request('orders/hist', 'private', 'POST', $params);
    }
    public function private_post_position_claim($params = array()) {
        return $this->request('position/claim', 'private', 'POST', $params);
    }
    public function private_post_position_close($params = array()) {
        return $this->request('position/close', 'private', 'POST', $params);
    }
    public function private_post_positions($params = array()) {
        return $this->request('positions', 'private', 'POST', $params);
    }
    public function private_post_summary($params = array()) {
        return $this->request('summary', 'private', 'POST', $params);
    }
    public function private_post_taken_funds($params = array()) {
        return $this->request('taken_funds', 'private', 'POST', $params);
    }
    public function private_post_total_taken_funds($params = array()) {
        return $this->request('total_taken_funds', 'private', 'POST', $params);
    }
    public function private_post_transfer($params = array()) {
        return $this->request('transfer', 'private', 'POST', $params);
    }
    public function private_post_unused_taken_funds($params = array()) {
        return $this->request('unused_taken_funds', 'private', 'POST', $params);
    }
    public function private_post_withdraw($params = array()) {
        return $this->request('withdraw', 'private', 'POST', $params);
    }
}