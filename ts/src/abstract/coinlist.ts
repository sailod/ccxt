// -------------------------------------------------------------------------------

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

// -------------------------------------------------------------------------------

import { implicitReturnType } from '../base/types.js';
import { Exchange as _Exchange } from '../base/Exchange.js';

interface Exchange {
    publicGetV1Time (params?: {}): Promise<implicitReturnType>;
    publicGetV1Symbols (params?: {}): Promise<implicitReturnType>;
    publicGetV1SymbolsSummary (params?: {}): Promise<implicitReturnType>;
    publicGetV1SymbolsSymbolSummary (params?: {}): Promise<implicitReturnType>;
    publicGetV1SymbolsSymbolBook (params?: {}): Promise<implicitReturnType>;
    publicGetV1SymbolsSymbolCandles (params?: {}): Promise<implicitReturnType>;
    publicGetV1SymbolsSymbolAuctions (params?: {}): Promise<implicitReturnType>;
    publicGetV1SymbolsSymbol (params?: {}): Promise<implicitReturnType>;
    publicGetV1SymbolsSymbolQuote (params?: {}): Promise<implicitReturnType>;
    publicGetV1SymbolsSymbolAuctionsAuctionCode (params?: {}): Promise<implicitReturnType>;
    privateGetV1Fees (params?: {}): Promise<implicitReturnType>;
    privateGetV1Accounts (params?: {}): Promise<implicitReturnType>;
    privateGetV1Balances (params?: {}): Promise<implicitReturnType>;
    privateGetV1Fills (params?: {}): Promise<implicitReturnType>;
    privateGetV1Orders (params?: {}): Promise<implicitReturnType>;
    privateGetV1OrdersOrderId (params?: {}): Promise<implicitReturnType>;
    privatePostV1Orders (params?: {}): Promise<implicitReturnType>;
    privatePatchV1OrdersOrderId (params?: {}): Promise<implicitReturnType>;
    privateDeleteV1Orders (params?: {}): Promise<implicitReturnType>;
    privateDeleteV1OrdersOrderId (params?: {}): Promise<implicitReturnType>;
    privateDeleteV1OrdersBulk (params?: {}): Promise<implicitReturnType>;
}
abstract class Exchange extends _Exchange {}

export default Exchange
