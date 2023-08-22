<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class lbank2 extends \ccxt\Exchange {
    public function spot_public_get_currencypairs($params = array()) {
        return $this->request('currencyPairs', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_accuracy($params = array()) {
        return $this->request('accuracy', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_usdtocny($params = array()) {
        return $this->request('usdToCny', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_withdrawconfigs($params = array()) {
        return $this->request('withdrawConfigs', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_timestamp($params = array()) {
        return $this->request('timestamp', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_ticker_24hr($params = array()) {
        return $this->request('ticker/24hr', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_ticker($params = array()) {
        return $this->request('ticker', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_depth($params = array()) {
        return $this->request('depth', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_incrdepth($params = array()) {
        return $this->request('incrDepth', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_trades($params = array()) {
        return $this->request('trades', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_kline($params = array()) {
        return $this->request('kline', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_supplement_system_ping($params = array()) {
        return $this->request('supplement/system_ping', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_supplement_incrdepth($params = array()) {
        return $this->request('supplement/incrDepth', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_supplement_trades($params = array()) {
        return $this->request('supplement/trades', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_supplement_ticker_price($params = array()) {
        return $this->request('supplement/ticker/price', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_get_supplement_ticker_bookticker($params = array()) {
        return $this->request('supplement/ticker/bookTicker', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spot_public_post_supplement_system_status($params = array()) {
        return $this->request('supplement/system_status', array('spot', 'public'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_user_info($params = array()) {
        return $this->request('user_info', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_subscribe_get_key($params = array()) {
        return $this->request('subscribe/get_key', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_subscribe_refresh_key($params = array()) {
        return $this->request('subscribe/refresh_key', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_subscribe_destroy_key($params = array()) {
        return $this->request('subscribe/destroy_key', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_get_deposit_address($params = array()) {
        return $this->request('get_deposit_address', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_deposit_history($params = array()) {
        return $this->request('deposit_history', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_create_order($params = array()) {
        return $this->request('create_order', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spot_private_post_batch_create_order($params = array()) {
        return $this->request('batch_create_order', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spot_private_post_cancel_order($params = array()) {
        return $this->request('cancel_order', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spot_private_post_cancel_clientorders($params = array()) {
        return $this->request('cancel_clientOrders', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spot_private_post_orders_info($params = array()) {
        return $this->request('orders_info', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_orders_info_history($params = array()) {
        return $this->request('orders_info_history', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_order_transaction_detail($params = array()) {
        return $this->request('order_transaction_detail', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_transaction_history($params = array()) {
        return $this->request('transaction_history', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_orders_info_no_deal($params = array()) {
        return $this->request('orders_info_no_deal', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_withdraw($params = array()) {
        return $this->request('withdraw', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_withdrawcancel($params = array()) {
        return $this->request('withdrawCancel', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_withdraws($params = array()) {
        return $this->request('withdraws', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_user_info($params = array()) {
        return $this->request('supplement/user_info', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_withdraw($params = array()) {
        return $this->request('supplement/withdraw', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_deposit_history($params = array()) {
        return $this->request('supplement/deposit_history', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_withdraws($params = array()) {
        return $this->request('supplement/withdraws', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_get_deposit_address($params = array()) {
        return $this->request('supplement/get_deposit_address', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_asset_detail($params = array()) {
        return $this->request('supplement/asset_detail', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_customer_trade_fee($params = array()) {
        return $this->request('supplement/customer_trade_fee', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_api_restrictions($params = array()) {
        return $this->request('supplement/api_Restrictions', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_system_ping($params = array()) {
        return $this->request('supplement/system_ping', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_create_order_test($params = array()) {
        return $this->request('supplement/create_order_test', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spot_private_post_supplement_create_order($params = array()) {
        return $this->request('supplement/create_order', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spot_private_post_supplement_cancel_order($params = array()) {
        return $this->request('supplement/cancel_order', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spot_private_post_supplement_cancel_order_by_symbol($params = array()) {
        return $this->request('supplement/cancel_order_by_symbol', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spot_private_post_supplement_orders_info($params = array()) {
        return $this->request('supplement/orders_info', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_orders_info_no_deal($params = array()) {
        return $this->request('supplement/orders_info_no_deal', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_orders_info_history($params = array()) {
        return $this->request('supplement/orders_info_history', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_user_info_account($params = array()) {
        return $this->request('supplement/user_info_account', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spot_private_post_supplement_transaction_history($params = array()) {
        return $this->request('supplement/transaction_history', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function contract_public_get_cfd_openapi_v1_pub_gettime($params = array()) {
        return $this->request('cfd/openApi/v1/pub/getTime', array('contract', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function contract_public_get_cfd_openapi_v1_pub_instrument($params = array()) {
        return $this->request('cfd/openApi/v1/pub/instrument', array('contract', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function contract_public_get_cfd_openapi_v1_pub_marketdata($params = array()) {
        return $this->request('cfd/openApi/v1/pub/marketData', array('contract', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function contract_public_get_cfd_openapi_v1_pub_marketorder($params = array()) {
        return $this->request('cfd/openApi/v1/pub/marketOrder', array('contract', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetCurrencyPairs($params = array()) {
        return $this->request('currencyPairs', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetAccuracy($params = array()) {
        return $this->request('accuracy', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetUsdToCny($params = array()) {
        return $this->request('usdToCny', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetWithdrawConfigs($params = array()) {
        return $this->request('withdrawConfigs', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetTimestamp($params = array()) {
        return $this->request('timestamp', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetTicker24hr($params = array()) {
        return $this->request('ticker/24hr', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetTicker($params = array()) {
        return $this->request('ticker', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetDepth($params = array()) {
        return $this->request('depth', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetIncrDepth($params = array()) {
        return $this->request('incrDepth', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetTrades($params = array()) {
        return $this->request('trades', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetKline($params = array()) {
        return $this->request('kline', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetSupplementSystemPing($params = array()) {
        return $this->request('supplement/system_ping', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetSupplementIncrDepth($params = array()) {
        return $this->request('supplement/incrDepth', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetSupplementTrades($params = array()) {
        return $this->request('supplement/trades', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetSupplementTickerPrice($params = array()) {
        return $this->request('supplement/ticker/price', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicGetSupplementTickerBookTicker($params = array()) {
        return $this->request('supplement/ticker/bookTicker', array('spot', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function spotPublicPostSupplementSystemStatus($params = array()) {
        return $this->request('supplement/system_status', array('spot', 'public'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostUserInfo($params = array()) {
        return $this->request('user_info', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSubscribeGetKey($params = array()) {
        return $this->request('subscribe/get_key', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSubscribeRefreshKey($params = array()) {
        return $this->request('subscribe/refresh_key', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSubscribeDestroyKey($params = array()) {
        return $this->request('subscribe/destroy_key', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostGetDepositAddress($params = array()) {
        return $this->request('get_deposit_address', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostDepositHistory($params = array()) {
        return $this->request('deposit_history', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostCreateOrder($params = array()) {
        return $this->request('create_order', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spotPrivatePostBatchCreateOrder($params = array()) {
        return $this->request('batch_create_order', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spotPrivatePostCancelOrder($params = array()) {
        return $this->request('cancel_order', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spotPrivatePostCancelClientOrders($params = array()) {
        return $this->request('cancel_clientOrders', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spotPrivatePostOrdersInfo($params = array()) {
        return $this->request('orders_info', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostOrdersInfoHistory($params = array()) {
        return $this->request('orders_info_history', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostOrderTransactionDetail($params = array()) {
        return $this->request('order_transaction_detail', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostTransactionHistory($params = array()) {
        return $this->request('transaction_history', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostOrdersInfoNoDeal($params = array()) {
        return $this->request('orders_info_no_deal', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostWithdraw($params = array()) {
        return $this->request('withdraw', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostWithdrawCancel($params = array()) {
        return $this->request('withdrawCancel', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostWithdraws($params = array()) {
        return $this->request('withdraws', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementUserInfo($params = array()) {
        return $this->request('supplement/user_info', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementWithdraw($params = array()) {
        return $this->request('supplement/withdraw', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementDepositHistory($params = array()) {
        return $this->request('supplement/deposit_history', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementWithdraws($params = array()) {
        return $this->request('supplement/withdraws', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementGetDepositAddress($params = array()) {
        return $this->request('supplement/get_deposit_address', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementAssetDetail($params = array()) {
        return $this->request('supplement/asset_detail', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementCustomerTradeFee($params = array()) {
        return $this->request('supplement/customer_trade_fee', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementApiRestrictions($params = array()) {
        return $this->request('supplement/api_Restrictions', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementSystemPing($params = array()) {
        return $this->request('supplement/system_ping', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementCreateOrderTest($params = array()) {
        return $this->request('supplement/create_order_test', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spotPrivatePostSupplementCreateOrder($params = array()) {
        return $this->request('supplement/create_order', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spotPrivatePostSupplementCancelOrder($params = array()) {
        return $this->request('supplement/cancel_order', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spotPrivatePostSupplementCancelOrderBySymbol($params = array()) {
        return $this->request('supplement/cancel_order_by_symbol', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 1));
    }
    public function spotPrivatePostSupplementOrdersInfo($params = array()) {
        return $this->request('supplement/orders_info', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementOrdersInfoNoDeal($params = array()) {
        return $this->request('supplement/orders_info_no_deal', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementOrdersInfoHistory($params = array()) {
        return $this->request('supplement/orders_info_history', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementUserInfoAccount($params = array()) {
        return $this->request('supplement/user_info_account', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function spotPrivatePostSupplementTransactionHistory($params = array()) {
        return $this->request('supplement/transaction_history', array('spot', 'private'), 'POST', $params, null, null, array("cost" => 2.5));
    }
    public function contractPublicGetCfdOpenApiV1PubGetTime($params = array()) {
        return $this->request('cfd/openApi/v1/pub/getTime', array('contract', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function contractPublicGetCfdOpenApiV1PubInstrument($params = array()) {
        return $this->request('cfd/openApi/v1/pub/instrument', array('contract', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function contractPublicGetCfdOpenApiV1PubMarketData($params = array()) {
        return $this->request('cfd/openApi/v1/pub/marketData', array('contract', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
    public function contractPublicGetCfdOpenApiV1PubMarketOrder($params = array()) {
        return $this->request('cfd/openApi/v1/pub/marketOrder', array('contract', 'public'), 'GET', $params, null, null, array("cost" => 2.5));
    }
}
