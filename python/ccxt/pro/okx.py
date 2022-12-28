# -*- coding: utf-8 -*-

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

from ccxt.pro.base.exchange import Exchange
import ccxt.async_support
from ccxt.pro.base.cache import ArrayCache, ArrayCacheBySymbolById, ArrayCacheByTimestamp
import hashlib
from ccxt.base.errors import AuthenticationError
from ccxt.base.errors import InvalidNonce


class okx(Exchange, ccxt.async_support.okx):

    def describe(self):
        return self.deep_extend(super(okx, self).describe(), {
            'has': {
                'ws': True,
                'watchTicker': True,
                # 'watchTickers': False,  # for now
                'watchOrderBook': True,
                'watchTrades': True,
                'watchBalance': True,
                'watchOHLCV': True,
                'watchOrders': True,
            },
            'urls': {
                'api': {
                    'ws': {
                        'public': 'wss://ws.okx.com:8443/ws/v5/public',  # wss://wsaws.okx.com:8443/ws/v5/public
                        'private': 'wss://ws.okx.com:8443/ws/v5/private',  # wss://wsaws.okx.com:8443/ws/v5/private
                    },
                },
                'test': {
                    'ws': {
                        'public': 'wss://wspap.okx.com:8443/ws/v5/public?brokerId=9999',
                        'private': 'wss://wspap.okx.com:8443/ws/v5/private?brokerId=9999',
                    },
                },
            },
            'options': {
                'watchOrderBook': {
                    #
                    # bbo-tbt
                    # 1. Newly added channel that sends tick-by-tick Level 1 data
                    # 2. All API users can subscribe
                    # 3. Public depth channel, verification not required
                    #
                    # books-l2-tbt
                    # 1. Only users who're VIP5 and above can subscribe
                    # 2. Identity verification required before subscription
                    #
                    # books50-l2-tbt
                    # 1. Only users who're VIP4 and above can subscribe
                    # 2. Identity verification required before subscription
                    #
                    # books
                    # 1. All API users can subscribe
                    # 2. Public depth channel, verification not required
                    #
                    # books5
                    # 1. All API users can subscribe
                    # 2. Public depth channel, verification not required
                    # 3. Data feeds will be delivered every 100ms(vs. every 200ms now)
                    #
                    'depth': 'books',
                },
                'watchBalance': 'spot',  # margin, futures, swap
                'ws': {
                    # 'inflate': True,
                },
                'checksum': True,
            },
            'streaming': {
                # okex does not support built-in ws protocol-level ping-pong
                # instead it requires a custom text-based ping-pong
                'ping': self.ping,
                'keepAlive': 20000,
            },
        })

    async def subscribe(self, access, channel, symbol, params={}):
        await self.load_markets()
        url = self.urls['api']['ws'][access]
        messageHash = channel
        firstArgument = {
            'channel': channel,
        }
        if symbol is not None:
            market = self.market(symbol)
            messageHash += ':' + market['id']
            firstArgument['instId'] = market['id']
        request = {
            'op': 'subscribe',
            'args': [
                self.deep_extend(firstArgument, params),
            ],
        }
        return await self.watch(url, messageHash, request, messageHash)

    async def watch_trades(self, symbol, since=None, limit=None, params={}):
        """
        get the list of most recent trades for a particular symbol
        :param str symbol: unified symbol of the market to fetch trades for
        :param int|None since: timestamp in ms of the earliest trade to fetch
        :param int|None limit: the maximum amount of trades to fetch
        :param dict params: extra parameters specific to the okx api endpoint
        :returns [dict]: a list of `trade structures <https://docs.ccxt.com/en/latest/manual.html?#public-trades>`
        """
        await self.load_markets()
        symbol = self.symbol(symbol)
        trades = await self.subscribe('public', 'trades', symbol, params)
        if self.newUpdates:
            limit = trades.getLimit(symbol, limit)
        return self.filter_by_since_limit(trades, since, limit, 'timestamp', True)

    def handle_trades(self, client, message):
        #
        #     {
        #         arg: {channel: 'trades', instId: 'BTC-USDT'},
        #         data: [
        #             {
        #                 instId: 'BTC-USDT',
        #                 tradeId: '216970876',
        #                 px: '31684.5',
        #                 sz: '0.00001186',
        #                 side: 'buy',
        #                 ts: '1626531038288'
        #             }
        #         ]
        #     }
        #
        arg = self.safe_value(message, 'arg', {})
        channel = self.safe_string(arg, 'channel')
        data = self.safe_value(message, 'data', [])
        tradesLimit = self.safe_integer(self.options, 'tradesLimit', 1000)
        for i in range(0, len(data)):
            trade = self.parse_trade(data[i])
            symbol = trade['symbol']
            marketId = self.safe_string(trade['info'], 'instId')
            messageHash = channel + ':' + marketId
            stored = self.safe_value(self.trades, symbol)
            if stored is None:
                stored = ArrayCache(tradesLimit)
                self.trades[symbol] = stored
            stored.append(trade)
            client.resolve(stored, messageHash)
        return message

    async def watch_ticker(self, symbol, params={}):
        """
        watches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
        :param str symbol: unified symbol of the market to fetch the ticker for
        :param dict params: extra parameters specific to the okx api endpoint
        :returns dict: a `ticker structure <https://docs.ccxt.com/en/latest/manual.html#ticker-structure>`
        """
        return await self.subscribe('public', 'tickers', symbol, params)

    def handle_ticker(self, client, message):
        #
        #     {
        #         arg: {channel: 'tickers', instId: 'BTC-USDT'},
        #         data: [
        #             {
        #                 instType: 'SPOT',
        #                 instId: 'BTC-USDT',
        #                 last: '31500.1',
        #                 lastSz: '0.00001754',
        #                 askPx: '31500.1',
        #                 askSz: '0.00998144',
        #                 bidPx: '31500',
        #                 bidSz: '3.05652439',
        #                 open24h: '31697',
        #                 high24h: '32248',
        #                 low24h: '31165.6',
        #                 sodUtc0: '31385.5',
        #                 sodUtc8: '32134.9',
        #                 volCcy24h: '503403597.38138519',
        #                 vol24h: '15937.10781721',
        #                 ts: '1626526618762'
        #             }
        #         ]
        #     }
        #
        arg = self.safe_value(message, 'arg', {})
        channel = self.safe_string(arg, 'channel')
        data = self.safe_value(message, 'data', [])
        for i in range(0, len(data)):
            ticker = self.parse_ticker(data[i])
            symbol = ticker['symbol']
            marketId = self.safe_string(ticker['info'], 'instId')
            messageHash = channel + ':' + marketId
            self.tickers[symbol] = ticker
            client.resolve(ticker, messageHash)
        return message

    async def watch_ohlcv(self, symbol, timeframe='1m', since=None, limit=None, params={}):
        """
        watches historical candlestick data containing the open, high, low, and close price, and the volume of a market
        :param str symbol: unified symbol of the market to fetch OHLCV data for
        :param str timeframe: the length of time each candle represents
        :param int|None since: timestamp in ms of the earliest candle to fetch
        :param int|None limit: the maximum amount of candles to fetch
        :param dict params: extra parameters specific to the okx api endpoint
        :returns [[int]]: A list of candles ordered as timestamp, open, high, low, close, volume
        """
        await self.load_markets()
        symbol = self.symbol(symbol)
        interval = self.timeframes[timeframe]
        name = 'candle' + interval
        ohlcv = await self.subscribe('public', name, symbol, params)
        if self.newUpdates:
            limit = ohlcv.getLimit(symbol, limit)
        return self.filter_by_since_limit(ohlcv, since, limit, 0, True)

    def handle_ohlcv(self, client, message):
        #
        #     {
        #         arg: {channel: 'candle1m', instId: 'BTC-USDT'},
        #         data: [
        #             [
        #                 '1626690720000',
        #                 '31334',
        #                 '31334',
        #                 '31334',
        #                 '31334',
        #                 '0.0077',
        #                 '241.2718'
        #             ]
        #         ]
        #     }
        #
        arg = self.safe_value(message, 'arg', {})
        channel = self.safe_string(arg, 'channel')
        data = self.safe_value(message, 'data', [])
        marketId = self.safe_string(arg, 'instId')
        market = self.safe_market(marketId)
        symbol = market['id']
        interval = channel.replace('candle', '')
        # use a reverse lookup in a static map instead
        timeframe = self.find_timeframe(interval)
        for i in range(0, len(data)):
            parsed = self.parse_ohlcv(data[i], market)
            self.ohlcvs[symbol] = self.safe_value(self.ohlcvs, symbol, {})
            stored = self.safe_value(self.ohlcvs[symbol], timeframe)
            if stored is None:
                limit = self.safe_integer(self.options, 'OHLCVLimit', 1000)
                stored = ArrayCacheByTimestamp(limit)
                self.ohlcvs[symbol][timeframe] = stored
            stored.append(parsed)
            messageHash = channel + ':' + marketId
            client.resolve(stored, messageHash)

    async def watch_order_book(self, symbol, limit=None, params={}):
        """
        watches information on open orders with bid(buy) and ask(sell) prices, volumes and other data
        :param str symbol: unified symbol of the market to fetch the order book for
        :param int|None limit: the maximum amount of order book entries to return
        :param dict params: extra parameters specific to the okx api endpoint
        :returns dict: A dictionary of `order book structures <https://docs.ccxt.com/en/latest/manual.html#order-book-structure>` indexed by market symbols
        """
        options = self.safe_value(self.options, 'watchOrderBook', {})
        #
        # bbo-tbt
        # 1. Newly added channel that sends tick-by-tick Level 1 data
        # 2. All API users can subscribe
        # 3. Public depth channel, verification not required
        #
        # books-l2-tbt
        # 1. Only users who're VIP5 and above can subscribe
        # 2. Identity verification required before subscription
        #
        # books50-l2-tbt
        # 1. Only users who're VIP4 and above can subscribe
        # 2. Identity verification required before subscription
        #
        # books
        # 1. All API users can subscribe
        # 2. Public depth channel, verification not required
        #
        # books5
        # 1. All API users can subscribe
        # 2. Public depth channel, verification not required
        # 3. Data feeds will be delivered every 100ms(vs. every 200ms now)
        #
        depth = self.safe_string(options, 'depth', 'books')
        orderbook = await self.subscribe('public', depth, symbol, params)
        return orderbook.limit()

    def handle_delta(self, bookside, delta):
        #
        #     [
        #         '31685',  # price
        #         '0.78069158',  # amount
        #         '0',  # liquidated orders
        #         '17'  # orders
        #     ]
        #
        price = self.safe_float(delta, 0)
        amount = self.safe_float(delta, 1)
        bookside.store(price, amount)

    def handle_deltas(self, bookside, deltas):
        for i in range(0, len(deltas)):
            self.handle_delta(bookside, deltas[i])

    def handle_order_book_message(self, client, message, orderbook, messageHash):
        #
        #     {
        #         asks: [
        #             ['31738.3', '0.05973179', '0', '3'],
        #             ['31738.5', '0.11035404', '0', '2'],
        #             ['31739.6', '0.01', '0', '1'],
        #         ],
        #         bids: [
        #             ['31738.2', '0.67557666', '0', '9'],
        #             ['31738', '0.02466947', '0', '2'],
        #             ['31736.3', '0.01705046', '0', '2'],
        #         ],
        #         instId: 'BTC-USDT',
        #         ts: '1626537446491'
        #     }
        #
        asks = self.safe_value(message, 'asks', [])
        bids = self.safe_value(message, 'bids', [])
        storedAsks = orderbook['asks']
        storedBids = orderbook['bids']
        self.handle_deltas(storedAsks, asks)
        self.handle_deltas(storedBids, bids)
        checksum = self.safe_value(self.options, 'checksum', True)
        if checksum:
            asksLength = len(storedAsks)
            bidsLength = len(storedBids)
            payloadArray = []
            for i in range(0, 25):
                if i < bidsLength:
                    payloadArray.append(self.number_to_string(storedBids[i][0]))
                    payloadArray.append(self.number_to_string(storedBids[i][1]))
                if i < asksLength:
                    payloadArray.append(self.number_to_string(storedAsks[i][0]))
                    payloadArray.append(self.number_to_string(storedAsks[i][1]))
            payload = ':'.join(payloadArray)
            responseChecksum = self.safe_integer(message, 'checksum')
            localChecksum = self.crc32(payload, True)
            if responseChecksum != localChecksum:
                error = InvalidNonce(self.id + ' invalid checksum')
                client.reject(error, messageHash)
        timestamp = self.safe_integer(message, 'ts')
        orderbook['timestamp'] = timestamp
        orderbook['datetime'] = self.iso8601(timestamp)
        return orderbook

    def handle_order_book(self, client, message):
        #
        # snapshot
        #
        #     {
        #         arg: {channel: 'books-l2-tbt', instId: 'BTC-USDT'},
        #         action: 'snapshot',
        #         data: [
        #             {
        #                 asks: [
        #                     ['31685', '0.78069158', '0', '17'],
        #                     ['31685.1', '0.0001', '0', '1'],
        #                     ['31685.6', '0.04543165', '0', '1'],
        #                 ],
        #                 bids: [
        #                     ['31684.9', '0.01', '0', '1'],
        #                     ['31682.9', '0.0001', '0', '1'],
        #                     ['31680.7', '0.01', '0', '1'],
        #                 ],
        #                 ts: '1626532416403',
        #                 checksum: -1023440116
        #             }
        #         ]
        #     }
        #
        # update
        #
        #     {
        #         arg: {channel: 'books-l2-tbt', instId: 'BTC-USDT'},
        #         action: 'update',
        #         data: [
        #             {
        #                 asks: [
        #                     ['31657.7', '0', '0', '0'],
        #                     ['31659.7', '0.01', '0', '1'],
        #                     ['31987.3', '0.01', '0', '1']
        #                 ],
        #                 bids: [
        #                     ['31642.9', '0.50296385', '0', '4'],
        #                     ['31639.9', '0', '0', '0'],
        #                     ['31638.7', '0.01', '0', '1'],
        #                 ],
        #                 ts: '1626535709008',
        #                 checksum: 830931827
        #             }
        #         ]
        #     }
        #
        # books5
        #
        #     {
        #         arg: {channel: 'books5', instId: 'BTC-USDT'},
        #         data: [
        #             {
        #                 asks: [
        #                     ['31738.3', '0.05973179', '0', '3'],
        #                     ['31738.5', '0.11035404', '0', '2'],
        #                     ['31739.6', '0.01', '0', '1'],
        #                 ],
        #                 bids: [
        #                     ['31738.2', '0.67557666', '0', '9'],
        #                     ['31738', '0.02466947', '0', '2'],
        #                     ['31736.3', '0.01705046', '0', '2'],
        #                 ],
        #                 instId: 'BTC-USDT',
        #                 ts: '1626537446491'
        #             }
        #         ]
        #     }
        #
        # bbo-tbt
        #
        #     {
        #         "arg":{
        #             "channel":"bbo-tbt",
        #             "instId":"BTC-USDT"
        #         },
        #         "data":[
        #             {
        #                 "asks":[["36232.2","1.8826134","0","17"]],
        #                 "bids":[["36232.1","0.00572212","0","2"]],
        #                 "ts":"1651826598363"
        #             }
        #         ]
        #     }
        #
        arg = self.safe_value(message, 'arg', {})
        channel = self.safe_string(arg, 'channel')
        action = self.safe_string(message, 'action')
        data = self.safe_value(message, 'data', [])
        marketId = self.safe_string(arg, 'instId')
        market = self.safe_market(marketId)
        symbol = market['symbol']
        depths = {
            'bbo-tbt': 1,
            'books': 400,
            'books5': 5,
            'books-l2-tbt': 400,
            'books50-l2-tbt': 50,
        }
        limit = self.safe_integer(depths, channel)
        messageHash = channel + ':' + marketId
        if action == 'snapshot':
            for i in range(0, len(data)):
                update = data[i]
                orderbook = self.order_book({}, limit)
                self.orderbooks[symbol] = orderbook
                orderbook['symbol'] = symbol
                self.handle_order_book_message(client, update, orderbook, messageHash)
                client.resolve(orderbook, messageHash)
        elif action == 'update':
            if symbol in self.orderbooks:
                orderbook = self.orderbooks[symbol]
                for i in range(0, len(data)):
                    update = data[i]
                    self.handle_order_book_message(client, update, orderbook, messageHash)
                    client.resolve(orderbook, messageHash)
        elif (channel == 'books5') or (channel == 'bbo-tbt'):
            orderbook = self.safe_value(self.orderbooks, symbol)
            if orderbook is None:
                orderbook = self.order_book({}, limit)
            self.orderbooks[symbol] = orderbook
            for i in range(0, len(data)):
                update = data[i]
                timestamp = self.safe_integer(update, 'ts')
                snapshot = self.parse_order_book(update, symbol, timestamp, 'bids', 'asks', 0, 1)
                orderbook.reset(snapshot)
                client.resolve(orderbook, messageHash)
        return message

    async def authenticate(self, params={}):
        self.check_required_credentials()
        url = self.urls['api']['ws']['private']
        messageHash = 'login'
        client = self.client(url)
        future = self.safe_value(client.subscriptions, messageHash)
        if future is None:
            future = client.future('authenticated')
            timestamp = str(self.seconds())
            method = 'GET'
            path = '/users/self/verify'
            auth = timestamp + method + path
            signature = self.hmac(self.encode(auth), self.encode(self.secret), hashlib.sha256, 'base64')
            request = {
                'op': messageHash,
                'args': [
                    {
                        'apiKey': self.apiKey,
                        'passphrase': self.password,
                        'timestamp': timestamp,
                        'sign': signature,
                    },
                ],
            }
            self.spawn(self.watch, url, messageHash, request, messageHash, future)
        return await future

    async def watch_balance(self, params={}):
        """
        query for balance and get the amount of funds available for trading or funds locked in orders
        :param dict params: extra parameters specific to the okx api endpoint
        :returns dict: a `balance structure <https://docs.ccxt.com/en/latest/manual.html?#balance-structure>`
        """
        await self.load_markets()
        await self.authenticate()
        return await self.subscribe('private', 'account', None, params)

    def handle_balance(self, client, message):
        #
        #     {
        #         arg: {channel: 'account'},
        #         data: [
        #             {
        #                 adjEq: '',
        #                 details: [
        #                     {
        #                         availBal: '',
        #                         availEq: '8.21009913',
        #                         cashBal: '8.21009913',
        #                         ccy: 'USDT',
        #                         coinUsdPrice: '0.99994',
        #                         crossLiab: '',
        #                         disEq: '8.2096065240522',
        #                         eq: '8.21009913',
        #                         eqUsd: '8.2096065240522',
        #                         frozenBal: '0',
        #                         interest: '',
        #                         isoEq: '0',
        #                         isoLiab: '',
        #                         liab: '',
        #                         maxLoan: '',
        #                         mgnRatio: '',
        #                         notionalLever: '0',
        #                         ordFrozen: '0',
        #                         twap: '0',
        #                         uTime: '1621927314996',
        #                         upl: '0'
        #                     },
        #                 ],
        #                 imr: '',
        #                 isoEq: '0',
        #                 mgnRatio: '',
        #                 mmr: '',
        #                 notionalUsd: '',
        #                 ordFroz: '',
        #                 totalEq: '22.1930992296832',
        #                 uTime: '1626692120916'
        #             }
        #         ]
        #     }
        #
        arg = self.safe_value(message, 'arg', {})
        channel = self.safe_string(arg, 'channel')
        type = 'spot'
        balance = self.parseTradingBalance(message)
        oldBalance = self.safe_value(self.balance, type, {})
        newBalance = self.deep_extend(oldBalance, balance)
        self.balance[type] = self.safe_balance(newBalance)
        client.resolve(self.balance[type], channel)

    async def watch_orders(self, symbol=None, since=None, limit=None, params={}):
        """
        watches information on multiple orders made by the user
        :param str|None symbol: unified market symbol of the market orders were made in
        :param int|None since: the earliest time in ms to fetch orders for
        :param int|None limit: the maximum number of  orde structures to retrieve
        :param dict params: extra parameters specific to the okx api endpoint
        :param bool params['stop']: True if fetching trigger or conditional orders
        :returns [dict]: a list of `order structures <https://docs.ccxt.com/en/latest/manual.html#order-structure>`
        """
        await self.load_markets()
        await self.authenticate()
        #
        #     {
        #         "op": "subscribe",
        #         "args": [
        #             {
        #                 "channel": "orders",
        #                 "instType": "FUTURES",
        #                 "uly": "BTC-USD",
        #                 "instId": "BTC-USD-200329"
        #             }
        #         ]
        #     }
        #
        options = self.safe_value(self.options, 'watchOrders', {})
        # By default, receive order updates from any instrument type
        type = self.safe_string(options, 'type', 'ANY')
        type = self.safe_string(params, 'type', type)
        isStop = self.safe_value(params, 'stop', False)
        params = self.omit(params, ['type', 'stop'])
        market = None
        if symbol is not None:
            market = self.market(symbol)
            symbol = market['symbol']
            type = market['type']
        if type == 'future':
            type = 'futures'
        uppercaseType = type.upper()
        request = {
            'instType': uppercaseType,
        }
        channel = 'orders-algo' if isStop else 'orders'
        orders = await self.subscribe('private', channel, symbol, self.extend(request, params))
        if self.newUpdates:
            limit = orders.getLimit(symbol, limit)
        return self.filter_by_symbol_since_limit(orders, symbol, since, limit, True)

    def handle_orders(self, client, message, subscription=None):
        #
        #     {
        #         "arg":{
        #             "channel":"orders",
        #             "instType":"SPOT"
        #         },
        #         "data":[
        #             {
        #                 "accFillSz":"0",
        #                 "amendResult":"",
        #                 "avgPx":"",
        #                 "cTime":"1634548275191",
        #                 "category":"normal",
        #                 "ccy":"",
        #                 "clOrdId":"e847386590ce4dBC330547db94a08ba0",
        #                 "code":"0",
        #                 "execType":"",
        #                 "fee":"0",
        #                 "feeCcy":"USDT",
        #                 "fillFee":"0",
        #                 "fillFeeCcy":"",
        #                 "fillNotionalUsd":"",
        #                 "fillPx":"",
        #                 "fillSz":"0",
        #                 "fillTime":"",
        #                 "instId":"ETH-USDT",
        #                 "instType":"SPOT",
        #                 "lever":"",
        #                 "msg":"",
        #                 "notionalUsd":"451.4516256",
        #                 "ordId":"370257534141235201",
        #                 "ordType":"limit",
        #                 "pnl":"0",
        #                 "posSide":"",
        #                 "px":"60000",
        #                 "rebate":"0",
        #                 "rebateCcy":"ETH",
        #                 "reqId":"",
        #                 "side":"sell",
        #                 "slOrdPx":"",
        #                 "slTriggerPx":"",
        #                 "state":"live",
        #                 "sz":"0.007526",
        #                 "tag":"",
        #                 "tdMode":"cash",
        #                 "tgtCcy":"",
        #                 "tpOrdPx":"",
        #                 "tpTriggerPx":"",
        #                 "tradeId":"",
        #                 "uTime":"1634548275191"
        #             }
        #         ]
        #     }
        #
        arg = self.safe_value(message, 'arg', {})
        channel = self.safe_string(arg, 'channel')
        orders = self.safe_value(message, 'data', [])
        ordersLength = len(orders)
        if ordersLength > 0:
            limit = self.safe_integer(self.options, 'ordersLimit', 1000)
            if self.orders is None:
                self.orders = ArrayCacheBySymbolById(limit)
            stored = self.orders
            marketIds = []
            parsed = self.parse_orders(orders)
            for i in range(0, len(parsed)):
                order = parsed[i]
                stored.append(order)
                symbol = order['symbol']
                market = self.market(symbol)
                marketIds.append(market['id'])
            client.resolve(self.orders, channel)
            for i in range(0, len(marketIds)):
                messageHash = channel + ':' + marketIds[i]
                client.resolve(self.orders, messageHash)

    def handle_subscription_status(self, client, message):
        #
        #     {event: 'subscribe', arg: {channel: 'tickers', instId: 'BTC-USDT'}}
        #
        # channel = self.safe_string(message, 'channel')
        # client.subscriptions[channel] = message
        return message

    def handle_authenticate(self, client, message):
        #
        #     {event: 'login', success: True}
        #
        client.resolve(message, 'authenticated')
        return message

    def ping(self, client):
        # okex does not support built-in ws protocol-level ping-pong
        # instead it requires custom text-based ping-pong
        return 'ping'

    def handle_pong(self, client, message):
        client.lastPong = self.milliseconds()
        return message

    def handle_error_message(self, client, message):
        #
        #     {event: 'error', msg: 'Illegal request: {"op":"subscribe","args":["spot/ticker:BTC-USDT"]}', code: '60012'}
        #     {event: 'error', msg: "channel:ticker,instId:BTC-USDT doesn't exist", code: '60018'}
        #
        errorCode = self.safe_string(message, 'errorCode')
        try:
            if errorCode is not None:
                feedback = self.id + ' ' + self.json(message)
                self.throw_exactly_matched_exception(self.exceptions['exact'], errorCode, feedback)
                messageString = self.safe_value(message, 'message')
                if messageString is not None:
                    self.throw_broadly_matched_exception(self.exceptions['broad'], messageString, feedback)
        except Exception as e:
            if isinstance(e, AuthenticationError):
                client.reject(e, 'authenticated')
                method = 'login'
                if method in client.subscriptions:
                    del client.subscriptions[method]
                return False
        return message

    def handle_message(self, client, message):
        if not self.handle_error_message(client, message):
            return
        #
        #     {event: 'subscribe', arg: {channel: 'tickers', instId: 'BTC-USDT'}}
        #     {event: 'login', msg: '', code: '0'}
        #
        #     {
        #         arg: {channel: 'tickers', instId: 'BTC-USDT'},
        #         data: [
        #             {
        #                 instType: 'SPOT',
        #                 instId: 'BTC-USDT',
        #                 last: '31500.1',
        #                 lastSz: '0.00001754',
        #                 askPx: '31500.1',
        #                 askSz: '0.00998144',
        #                 bidPx: '31500',
        #                 bidSz: '3.05652439',
        #                 open24h: '31697',
        #                 high24h: '32248',
        #                 low24h: '31165.6',
        #                 sodUtc0: '31385.5',
        #                 sodUtc8: '32134.9',
        #                 volCcy24h: '503403597.38138519',
        #                 vol24h: '15937.10781721',
        #                 ts: '1626526618762'
        #             }
        #         ]
        #     }
        #
        #     {event: 'error', msg: 'Illegal request: {"op":"subscribe","args":["spot/ticker:BTC-USDT"]}', code: '60012'}
        #     {event: 'error', msg: "channel:ticker,instId:BTC-USDT doesn't exist", code: '60018'}
        #     {event: 'error', msg: 'Invalid OK_ACCESS_KEY', code: '60005'}
        #     {
        #         event: 'error',
        #         msg: 'Illegal request: {"op":"login","args":["de89b035-b233-44b2-9a13-0ccdd00bda0e","7KUcc8YzQhnxBE3K","1626691289","H57N99mBt5NvW8U19FITrPdOxycAERFMaapQWRqLaSE="]}',
        #         code: '60012'
        #     }
        #
        #
        #
        if message == 'pong':
            return self.handle_pong(client, message)
        # table = self.safe_string(message, 'table')
        # if table is None:
        event = self.safe_string(message, 'event')
        if event is not None:
            methods = {
                # 'info': self.handleSystemStatus,
                # 'book': 'handleOrderBook',
                'login': self.handle_authenticate,
                'subscribe': self.handle_subscription_status,
            }
            method = self.safe_value(methods, event)
            if method is None:
                return message
            else:
                return method(client, message)
        else:
            arg = self.safe_value(message, 'arg', {})
            channel = self.safe_string(arg, 'channel')
            methods = {
                'bbo-tbt': self.handle_order_book,  # newly added channel that sends tick-by-tick Level 1 data, all API users can subscribe, public depth channel, verification not required
                'books': self.handle_order_book,  # all API users can subscribe, public depth channel, verification not required
                'books5': self.handle_order_book,  # all API users can subscribe, public depth channel, verification not required, data feeds will be delivered every 100ms(vs. every 200ms now)
                'books50-l2-tbt': self.handle_order_book,  # only users who're VIP4 and above can subscribe, identity verification required before subscription
                'books-l2-tbt': self.handle_order_book,  # only users who're VIP5 and above can subscribe, identity verification required before subscription
                'tickers': self.handle_ticker,
                'trades': self.handle_trades,
                'account': self.handle_balance,
                # 'margin_account': self.handle_balance,
                'orders': self.handle_orders,
                'orders-algo': self.handle_orders,
            }
            method = self.safe_value(methods, channel)
            if method is None:
                if channel.find('candle') == 0:
                    self.handle_ohlcv(client, message)
                else:
                    return message
            else:
                return method(client, message)
