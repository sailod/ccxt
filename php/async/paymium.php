<?php

namespace ccxt\async;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use \ccxt\ExchangeError;
use \ccxt\Precise;

class paymium extends Exchange {

    public function describe() {
        return $this->deep_extend(parent::describe (), array(
            'id' => 'paymium',
            'name' => 'Paymium',
            'countries' => array( 'FR', 'EU' ),
            'rateLimit' => 2000,
            'version' => 'v1',
            'has' => array(
                'CORS' => true,
                'spot' => true,
                'margin' => null,
                'swap' => false,
                'future' => false,
                'option' => false,
                'cancelOrder' => true,
                'createDepositAddress' => true,
                'createOrder' => true,
                'fetchBalance' => true,
                'fetchDepositAddress' => true,
                'fetchDepositAddresses' => true,
                'fetchFundingHistory' => false,
                'fetchFundingRate' => false,
                'fetchFundingRateHistory' => false,
                'fetchFundingRates' => false,
                'fetchIndexOHLCV' => false,
                'fetchMarkOHLCV' => false,
                'fetchOpenInterestHistory' => false,
                'fetchOrderBook' => true,
                'fetchPremiumIndexOHLCV' => false,
                'fetchTicker' => true,
                'fetchTrades' => true,
                'fetchTradingFee' => false,
                'fetchTradingFees' => false,
                'transfer' => true,
            ),
            'urls' => array(
                'logo' => 'https://user-images.githubusercontent.com/51840849/87153930-f0f02200-c2c0-11ea-9c0a-40337375ae89.jpg',
                'api' => 'https://paymium.com/api',
                'www' => 'https://www.paymium.com',
                'fees' => 'https://www.paymium.com/page/help/fees',
                'doc' => array(
                    'https://github.com/Paymium/api-documentation',
                    'https://www.paymium.com/page/developers',
                    'https://paymium.github.io/api-documentation/',
                ),
                'referral' => 'https://www.paymium.com/page/sign-up?referral=eDAzPoRQFMvaAB8sf-qj',
            ),
            'api' => array(
                'public' => array(
                    'get' => array(
                        'countries',
                        'data/{currency}/ticker',
                        'data/{currency}/trades',
                        'data/{currency}/depth',
                        'bitcoin_charts/{id}/trades',
                        'bitcoin_charts/{id}/depth',
                    ),
                ),
                'private' => array(
                    'get' => array(
                        'user',
                        'user/addresses',
                        'user/addresses/{address}',
                        'user/orders',
                        'user/orders/{uuid}',
                        'user/price_alerts',
                        'merchant/get_payment/{uuid}',
                    ),
                    'post' => array(
                        'user/addresses',
                        'user/orders',
                        'user/withdrawals',
                        'user/email_transfers',
                        'user/payment_requests',
                        'user/price_alerts',
                        'merchant/create_payment',
                    ),
                    'delete' => array(
                        'user/orders/{uuid}',
                        'user/orders/{uuid}/cancel',
                        'user/price_alerts/{id}',
                    ),
                ),
            ),
            'markets' => array(
                'BTC/EUR' => array( 'id' => 'eur', 'symbol' => 'BTC/EUR', 'base' => 'BTC', 'quote' => 'EUR', 'baseId' => 'btc', 'quoteId' => 'eur', 'type' => 'spot', 'spot' => true ),
            ),
            'fees' => array(
                'trading' => array(
                    'maker' => $this->parse_number('-0.001'),
                    'taker' => $this->parse_number('0.005'),
                ),
            ),
            'precisionMode' => TICK_SIZE,
        ));
    }

    public function parse_balance($response) {
        $result = array( 'info' => $response );
        $currencies = is_array($this->currencies) ? array_keys($this->currencies) : array();
        for ($i = 0; $i < count($currencies); $i++) {
            $code = $currencies[$i];
            $currency = $this->currency($code);
            $currencyId = $currency['id'];
            $free = 'balance_' . $currencyId;
            if (is_array($response) && array_key_exists($free, $response)) {
                $account = $this->account();
                $used = 'locked_' . $currencyId;
                $account['free'] = $this->safe_string($response, $free);
                $account['used'] = $this->safe_string($response, $used);
                $result[$code] = $account;
            }
        }
        return $this->safe_balance($result);
    }

    public function fetch_balance($params = array ()) {
        /**
         * query for balance and get the amount of funds available for trading or funds locked in orders
         * @param {dict} $params extra parameters specific to the paymium api endpoint
         * @return {dict} a ~@link https://docs.ccxt.com/en/latest/manual.html?#balance-structure balance structure~
         */
        yield $this->load_markets();
        $response = yield $this->privateGetUser ($params);
        return $this->parse_balance($response);
    }

    public function fetch_order_book($symbol, $limit = null, $params = array ()) {
        /**
         * fetches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
         * @param {str} $symbol unified $symbol of the $market to fetch the order book for
         * @param {int|null} $limit the maximum amount of order book entries to return
         * @param {dict} $params extra parameters specific to the paymium api endpoint
         * @return {dict} A dictionary of {@link https://docs.ccxt.com/en/latest/manual.html#order-book-structure order book structures} indexed by $market symbols
         */
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'currency' => $market['id'],
        );
        $response = yield $this->publicGetDataCurrencyDepth (array_merge($request, $params));
        return $this->parse_order_book($response, $market['symbol'], null, 'bids', 'asks', 'price', 'amount');
    }

    public function parse_ticker($ticker, $market = null) {
        //
        // {
        //     "high":"33740.82",
        //     "low":"32185.15",
        //     "volume":"4.7890433",
        //     "bid":"33313.53",
        //     "ask":"33497.97",
        //     "midpoint":"33405.75",
        //     "vwap":"32802.5263553",
        //     "at":1643381654,
        //     "price":"33143.91",
        //     "open":"33116.86",
        //     "variation":"0.0817",
        //     "currency":"EUR",
        //     "trade_id":"ce2f5152-3ac5-412d-9b24-9fa72338474c",
        //     "size":"0.00041087"
        // }
        //
        $symbol = $this->safe_symbol(null, $market);
        $timestamp = $this->safe_timestamp($ticker, 'at');
        $vwap = $this->safe_string($ticker, 'vwap');
        $baseVolume = $this->safe_string($ticker, 'volume');
        $quoteVolume = Precise::string_mul($baseVolume, $vwap);
        $last = $this->safe_string($ticker, 'price');
        return $this->safe_ticker(array(
            'symbol' => $symbol,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'high' => $this->safe_string($ticker, 'high'),
            'low' => $this->safe_string($ticker, 'low'),
            'bid' => $this->safe_string($ticker, 'bid'),
            'bidVolume' => null,
            'ask' => $this->safe_string($ticker, 'ask'),
            'askVolume' => null,
            'vwap' => $vwap,
            'open' => $this->safe_string($ticker, 'open'),
            'close' => $last,
            'last' => $last,
            'previousClose' => null,
            'change' => null,
            'percentage' => $this->safe_string($ticker, 'variation'),
            'average' => null,
            'baseVolume' => $baseVolume,
            'quoteVolume' => $quoteVolume,
            'info' => $ticker,
        ), $market);
    }

    public function fetch_ticker($symbol, $params = array ()) {
        /**
         * fetches a price $ticker, a statistical calculation with the information calculated over the past 24 hours for a specific $market
         * @param {str} $symbol unified $symbol of the $market to fetch the $ticker for
         * @param {dict} $params extra parameters specific to the paymium api endpoint
         * @return {dict} a {@link https://docs.ccxt.com/en/latest/manual.html#$ticker-structure $ticker structure}
         */
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'currency' => $market['id'],
        );
        $ticker = yield $this->publicGetDataCurrencyTicker (array_merge($request, $params));
        //
        // {
        //     "high":"33740.82",
        //     "low":"32185.15",
        //     "volume":"4.7890433",
        //     "bid":"33313.53",
        //     "ask":"33497.97",
        //     "midpoint":"33405.75",
        //     "vwap":"32802.5263553",
        //     "at":1643381654,
        //     "price":"33143.91",
        //     "open":"33116.86",
        //     "variation":"0.0817",
        //     "currency":"EUR",
        //     "trade_id":"ce2f5152-3ac5-412d-9b24-9fa72338474c",
        //     "size":"0.00041087"
        // }
        //
        return $this->parse_ticker($ticker, $market);
    }

    public function parse_trade($trade, $market) {
        $timestamp = $this->safe_timestamp($trade, 'created_at_int');
        $id = $this->safe_string($trade, 'uuid');
        $market = $this->safe_market(null, $market);
        $side = $this->safe_string($trade, 'side');
        $price = $this->safe_string($trade, 'price');
        $amountField = 'traded_' . strtolower($market['base']);
        $amount = $this->safe_string($trade, $amountField);
        return $this->safe_trade(array(
            'info' => $trade,
            'id' => $id,
            'order' => null,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'symbol' => $market['symbol'],
            'type' => null,
            'side' => $side,
            'takerOrMaker' => null,
            'price' => $price,
            'amount' => $amount,
            'cost' => null,
            'fee' => null,
        ), $market);
    }

    public function fetch_trades($symbol, $since = null, $limit = null, $params = array ()) {
        /**
         * get the list of most recent trades for a particular $symbol
         * @param {str} $symbol unified $symbol of the $market to fetch trades for
         * @param {int|null} $since timestamp in ms of the earliest trade to fetch
         * @param {int|null} $limit the maximum amount of trades to fetch
         * @param {dict} $params extra parameters specific to the paymium api endpoint
         * @return {[dict]} a list of ~@link https://docs.ccxt.com/en/latest/manual.html?#public-trades trade structures~
         */
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'currency' => $market['id'],
        );
        $response = yield $this->publicGetDataCurrencyTrades (array_merge($request, $params));
        return $this->parse_trades($response, $market, $since, $limit);
    }

    public function create_deposit_address($code, $params = array ()) {
        /**
         * create a currency deposit address
         * @param {str} $code unified currency $code of the currency for the deposit address
         * @param {dict} $params extra parameters specific to the paymium api endpoint
         * @return {dict} an {@link https://docs.ccxt.com/en/latest/manual.html#address-structure address structure}
         */
        yield $this->load_markets();
        $response = yield $this->privatePostUserAddresses ($params);
        //
        //     {
        //         "address" => "1HdjGr6WCTcnmW1tNNsHX7fh4Jr5C2PeKe",
        //         "valid_until" => 1620041926,
        //         "currency" => "BTC",
        //         "label" => "Savings"
        //     }
        //
        return $this->parse_deposit_address($response);
    }

    public function fetch_deposit_address($code, $params = array ()) {
        /**
         * fetch the deposit address for a currency associated with this account
         * @param {str} $code unified currency $code
         * @param {dict} $params extra parameters specific to the paymium api endpoint
         * @return {dict} an {@link https://docs.ccxt.com/en/latest/manual.html#address-structure address structure}
         */
        yield $this->load_markets();
        $request = array(
            'address' => $code,
        );
        $response = yield $this->privateGetUserAddressesAddress (array_merge($request, $params));
        //
        //     {
        //         "address" => "1HdjGr6WCTcnmW1tNNsHX7fh4Jr5C2PeKe",
        //         "valid_until" => 1620041926,
        //         "currency" => "BTC",
        //         "label" => "Savings"
        //     }
        //
        return $this->parse_deposit_address($response);
    }

    public function fetch_deposit_addresses($codes = null, $params = array ()) {
        /**
         * fetch deposit addresses for multiple currencies and chain types
         * @param {[str]|null} $codes list of unified currency $codes, default is null
         * @param {dict} $params extra parameters specific to the paymium api endpoint
         * @return {dict} a list of {@link https://docs.ccxt.com/en/latest/manual.html#address-structure address structures}
         */
        yield $this->load_markets();
        $response = yield $this->privateGetUserAddresses ($params);
        //
        //     array(
        //         {
        //             "address" => "1HdjGr6WCTcnmW1tNNsHX7fh4Jr5C2PeKe",
        //             "valid_until" => 1620041926,
        //             "currency" => "BTC",
        //             "label" => "Savings"
        //         }
        //     )
        //
        return $this->parse_deposit_addresses($response, $codes);
    }

    public function parse_deposit_address($depositAddress, $currency = null) {
        //
        //     {
        //         "address" => "1HdjGr6WCTcnmW1tNNsHX7fh4Jr5C2PeKe",
        //         "valid_until" => 1620041926,
        //         "currency" => "BTC",
        //         "label" => "Savings"
        //     }
        //
        $address = $this->safe_string($depositAddress, 'address');
        $currencyId = $this->safe_string($depositAddress, 'currency');
        return array(
            'info' => $depositAddress,
            'currency' => $this->safe_currency_code($currencyId, $currency),
            'address' => $address,
            'tag' => null,
            'network' => null,
        );
    }

    public function create_order($symbol, $type, $side, $amount, $price = null, $params = array ()) {
        /**
         * create a trade order
         * @param {str} $symbol unified $symbol of the $market to create an order in
         * @param {str} $type 'market' or 'limit'
         * @param {str} $side 'buy' or 'sell'
         * @param {float} $amount how much of currency you want to trade in units of base currency
         * @param {float|null} $price the $price at which the order is to be fullfilled, in units of the quote currency, ignored in $market orders
         * @param {dict} $params extra parameters specific to the paymium api endpoint
         * @return {dict} an {@link https://docs.ccxt.com/en/latest/manual.html#order-structure order structure}
         */
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'type' => $this->capitalize($type) . 'Order',
            'currency' => $market['id'],
            'direction' => $side,
            'amount' => $amount,
        );
        if ($type !== 'market') {
            $request['price'] = $price;
        }
        $response = yield $this->privatePostUserOrders (array_merge($request, $params));
        return array(
            'info' => $response,
            'id' => $response['uuid'],
        );
    }

    public function cancel_order($id, $symbol = null, $params = array ()) {
        /**
         * cancels an open order
         * @param {str} $id order $id
         * @param {str|null} $symbol not used by paymium cancelOrder ()
         * @param {dict} $params extra parameters specific to the paymium api endpoint
         * @return {dict} An {@link https://docs.ccxt.com/en/latest/manual.html#order-structure order structure}
         */
        $request = array(
            'uuid' => $id,
        );
        return yield $this->privateDeleteUserOrdersUuidCancel (array_merge($request, $params));
    }

    public function transfer($code, $amount, $fromAccount, $toAccount, $params = array ()) {
        /**
         * transfer $currency internally between wallets on the same account
         * @param {str} $code unified $currency $code
         * @param {float} $amount amount to transfer
         * @param {str} $fromAccount account to transfer from
         * @param {str} $toAccount account to transfer to
         * @param {dict} $params extra parameters specific to the paymium api endpoint
         * @return {dict} a {@link https://docs.ccxt.com/en/latest/manual.html#transfer-structure transfer structure}
         */
        yield $this->load_markets();
        $currency = $this->currency($code);
        if (mb_strpos($toAccount, '@') === false) {
            throw new ExchangeError($this->id . ' transfer() only allows transfers to an email address');
        }
        if ($code !== 'BTC' && $code !== 'EUR') {
            throw new ExchangeError($this->id . ' transfer() only allows BTC or EUR');
        }
        $request = array(
            'currency' => $currency['id'],
            'amount' => $this->currency_to_precision($code, $amount),
            'email' => $toAccount,
            // 'comment' => 'a small note explaining the transfer'
        );
        $response = yield $this->privatePostUserEmailTransfers (array_merge($request, $params));
        //
        //     {
        //         "uuid" => "968f4580-e26c-4ad8-8bcd-874d23d55296",
        //         "type" => "Transfer",
        //         "currency" => "BTC",
        //         "currency_amount" => "string",
        //         "created_at" => "2013-10-24T10:34:37.000Z",
        //         "updated_at" => "2013-10-24T10:34:37.000Z",
        //         "amount" => "1.0",
        //         "state" => "executed",
        //         "currency_fee" => "0.0",
        //         "btc_fee" => "0.0",
        //         "comment" => "string",
        //         "traded_btc" => "string",
        //         "traded_currency" => "string",
        //         "direction" => "buy",
        //         "price" => "string",
        //         "account_operations" => array(
        //             {
        //                 "uuid" => "968f4580-e26c-4ad8-8bcd-874d23d55296",
        //                 "amount" => "1.0",
        //                 "currency" => "BTC",
        //                 "created_at" => "2013-10-24T10:34:37.000Z",
        //                 "created_at_int" => 1389094259,
        //                 "name" => "account_operation",
        //                 "address" => "1FPDBXNqSkZMsw1kSkkajcj8berxDQkUoc",
        //                 "tx_hash" => "string",
        //                 "is_trading_account" => true
        //             }
        //         )
        //     }
        //
        return $this->parse_transfer($response, $currency);
    }

    public function parse_transfer($transfer, $currency = null) {
        //
        //     {
        //         "uuid" => "968f4580-e26c-4ad8-8bcd-874d23d55296",
        //         "type" => "Transfer",
        //         "currency" => "BTC",
        //         "currency_amount" => "string",
        //         "created_at" => "2013-10-24T10:34:37.000Z",
        //         "updated_at" => "2013-10-24T10:34:37.000Z",
        //         "amount" => "1.0",
        //         "state" => "executed",
        //         "currency_fee" => "0.0",
        //         "btc_fee" => "0.0",
        //         "comment" => "string",
        //         "traded_btc" => "string",
        //         "traded_currency" => "string",
        //         "direction" => "buy",
        //         "price" => "string",
        //         "account_operations" => array(
        //             {
        //                 "uuid" => "968f4580-e26c-4ad8-8bcd-874d23d55296",
        //                 "amount" => "1.0",
        //                 "currency" => "BTC",
        //                 "created_at" => "2013-10-24T10:34:37.000Z",
        //                 "created_at_int" => 1389094259,
        //                 "name" => "account_operation",
        //                 "address" => "1FPDBXNqSkZMsw1kSkkajcj8berxDQkUoc",
        //                 "tx_hash" => "string",
        //                 "is_trading_account" => true
        //             }
        //         )
        //     }
        //
        $currencyId = $this->safe_string($transfer, 'currency');
        $updatedAt = $this->safe_string($transfer, 'updated_at');
        $timetstamp = $this->parse_date($updatedAt);
        $accountOperations = $this->safe_value($transfer, 'account_operations');
        $firstOperation = $this->safe_value($accountOperations, 0, array());
        $status = $this->safe_string($transfer, 'state');
        return array(
            'info' => $transfer,
            'id' => $this->safe_string($transfer, 'uuid'),
            'timestamp' => $timetstamp,
            'datetime' => $this->iso8601($timetstamp),
            'currency' => $this->safe_currency_code($currencyId, $currency),
            'amount' => $this->safe_number($transfer, 'amount'),
            'fromAccount' => null,
            'toAccount' => $this->safe_string($firstOperation, 'address'),
            'status' => $this->parse_transfer_status($status),
        );
    }

    public function parse_transfer_status($status) {
        $statuses = array(
            'executed' => 'ok',
            // what are the other $statuses?
        );
        return $this->safe_string($statuses, $status, $status);
    }

    public function sign($path, $api = 'public', $method = 'GET', $params = array (), $headers = null, $body = null) {
        $url = $this->urls['api'] . '/' . $this->version . '/' . $this->implode_params($path, $params);
        $query = $this->omit($params, $this->extract_params($path));
        if ($api === 'public') {
            if ($query) {
                $url .= '?' . $this->urlencode($query);
            }
        } else {
            $this->check_required_credentials();
            $nonce = (string) $this->nonce();
            $auth = $nonce . $url;
            $headers = array(
                'Api-Key' => $this->apiKey,
                'Api-Nonce' => $nonce,
            );
            if ($method === 'POST') {
                if ($query) {
                    $body = $this->json($query);
                    $auth .= $body;
                    $headers['Content-Type'] = 'application/json';
                }
            } else {
                if ($query) {
                    $queryString = $this->urlencode($query);
                    $auth .= $queryString;
                    $url .= '?' . $queryString;
                }
            }
            $headers['Api-Signature'] = $this->hmac($this->encode($auth), $this->encode($this->secret));
        }
        return array( 'url' => $url, 'method' => $method, 'body' => $body, 'headers' => $headers );
    }

    public function handle_errors($httpCode, $reason, $url, $method, $headers, $body, $response, $requestHeaders, $requestBody) {
        if ($response === null) {
            return;
        }
        $errors = $this->safe_value($response, 'errors');
        if ($errors !== null) {
            throw new ExchangeError($this->id . ' ' . $this->json($response));
        }
    }
}
