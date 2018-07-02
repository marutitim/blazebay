<?php

// Stripe singleton
require(APPPATH.'libraries/stripe/stripe-php/lib/Stripe.php');

// Utilities
require(APPPATH.'libraries/stripe/stripe-php/lib/Util/AutoPagingIterator.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Util/LoggerInterface.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Util/DefaultLogger.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Util/RequestOptions.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Util/Set.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Util/Util.php');

// HttpClient
require(APPPATH.'libraries/stripe/stripe-php/lib/HttpClient/ClientInterface.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/HttpClient/CurlClient.php');

// Errors
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/Base.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/Api.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/ApiConnection.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/Authentication.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/Card.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/InvalidRequest.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/Permission.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/RateLimit.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/SignatureVerification.php');

// OAuth errors
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/OAuth/OAuthBase.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/OAuth/InvalidClient.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/OAuth/InvalidGrant.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/OAuth/InvalidRequest.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/OAuth/InvalidScope.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/OAuth/UnsupportedGrantType.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Error/OAuth/UnsupportedResponseType.php');

// Plumbing
require(APPPATH.'libraries/stripe/stripe-php/lib/ApiResponse.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/JsonSerializable.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/StripeObject.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/ApiRequestor.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/ApiResource.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/SingletonApiResource.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/AttachedObject.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/ExternalAccount.php');

// Stripe API Resources
require(APPPATH.'libraries/stripe/stripe-php/lib/Account.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/AlipayAccount.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/ApplePayDomain.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/ApplicationFee.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/ApplicationFeeRefund.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Balance.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/BalanceTransaction.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/BankAccount.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/BitcoinReceiver.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/BitcoinTransaction.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Card.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Charge.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Collection.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/CountrySpec.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Coupon.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Customer.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Dispute.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/EphemeralKey.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Event.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/FileUpload.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Invoice.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/InvoiceItem.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/LoginLink.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Order.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/OrderReturn.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Payout.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Plan.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Product.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Recipient.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/RecipientTransfer.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Refund.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/SKU.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Source.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Subscription.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/SubscriptionItem.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/ThreeDSecure.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Token.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/Transfer.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/TransferReversal.php');

// OAuth
require(APPPATH.'libraries/stripe/stripe-php/lib/OAuth.php');

// Webhooks
require(APPPATH.'libraries/stripe/stripe-php/lib/Webhook.php');
require(APPPATH.'libraries/stripe/stripe-php/lib/WebhookSignature.php');