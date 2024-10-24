<?php

namespace App\Constants;

enum HttpStatusCodesEnum: int
{
    // 1xx Informational Responses
    case CONTINUE = 100;                    // Request received, continuing process
    case SWITCHING_PROTOCOLS = 101;          // Switching protocols
    case PROCESSING = 102;                   // Processing (WebDAV)
    case EARLY_HINTS = 103;                  // Early hints

    // 2xx Success
    case OK = 200;                           // Successful request
    case CREATED = 201;                      // Resource created
    case ACCEPTED = 202;                     // Request accepted for processing
    case NON_AUTHORITATIVE_INFORMATION = 203; // Non-authoritative information
    case NO_CONTENT = 204;                   // No content to send
    case RESET_CONTENT = 205;                // Reset content
    case PARTIAL_CONTENT = 206;              // Partial content
    case MULTI_STATUS = 207;                 // Multi-status (WebDAV)
    case ALREADY_REPORTED = 208;             // Already reported (WebDAV)
    case IM_USED = 226;                      // IM used

    // 3xx Redirection
    case MULTIPLE_CHOICES = 300;             // Multiple choices
    case MOVED_PERMANENTLY = 301;            // Moved permanently
    case FOUND = 302;                        // Found
    case SEE_OTHER = 303;                    // See other
    case NOT_MODIFIED = 304;                 // Not modified
    case USE_PROXY = 305;                    // Use proxy (Deprecated)
    case TEMPORARY_REDIRECT = 307;           // Temporary redirect
    case PERMANENT_REDIRECT = 308;           // Permanent redirect

    // 4xx Client Errors
    case BAD_REQUEST = 400;                  // Bad request
    case UNAUTHORIZED = 401;                 // Unauthorized
    case PAYMENT_REQUIRED = 402;             // Payment required (experimental)
    case FORBIDDEN = 403;                    // Forbidden
    case NOT_FOUND = 404;                    // Resource not found
    case METHOD_NOT_ALLOWED = 405;           // Method not allowed
    case NOT_ACCEPTABLE = 406;               // Not acceptable
    case PROXY_AUTHENTICATION_REQUIRED = 407; // Proxy authentication required
    case REQUEST_TIMEOUT = 408;              // Request timeout
    case CONFLICT = 409;                     // Conflict
    case GONE = 410;                         // Resource gone
    case LENGTH_REQUIRED = 411;              // Length required
    case PRECONDITION_FAILED = 412;          // Precondition failed
    case PAYLOAD_TOO_LARGE = 413;            // Payload too large
    case URI_TOO_LONG = 414;                 // URI too long
    case UNSUPPORTED_MEDIA_TYPE = 415;       // Unsupported media type
    case RANGE_NOT_SATISFIABLE = 416;        // Range not satisfiable
    case EXPECTATION_FAILED = 417;           // Expectation failed
    case IM_A_TEAPOT = 418;                  // I'm a teapot (Easter egg)
    case MISDIRECTED_REQUEST = 421;          // Misdirected request
    case UNPROCESSABLE_ENTITY = 422;         // Unprocessable entity (WebDAV)
    case LOCKED = 423;                       // Locked (WebDAV)
    case FAILED_DEPENDENCY = 424;            // Failed dependency (WebDAV)
    case TOO_EARLY = 425;                    // Too early
    case UPGRADE_REQUIRED = 426;             // Upgrade required
    case PRECONDITION_REQUIRED = 428;        // Precondition required
    case TOO_MANY_REQUESTS = 429;            // Too many requests
    case REQUEST_HEADER_FIELDS_TOO_LARGE = 431; // Request header fields too large
    case UNAVAILABLE_FOR_LEGAL_REASONS = 451; // Unavailable for legal reasons

    // 5xx Server Errors
    case INTERNAL_SERVER_ERROR = 500;        // Internal server error
    case NOT_IMPLEMENTED = 501;              // Not implemented
    case BAD_GATEWAY = 502;                  // Bad gateway
    case SERVICE_UNAVAILABLE = 503;          // Service unavailable
    case GATEWAY_TIMEOUT = 504;              // Gateway timeout
    case HTTP_VERSION_NOT_SUPPORTED = 505;   // HTTP version not supported
    case VARIANT_ALSO_NEGOTIATES = 506;      // Variant also negotiates
    case INSUFFICIENT_STORAGE = 507;         // Insufficient storage (WebDAV)
    case LOOP_DETECTED = 508;                // Loop detected (WebDAV)
    case NOT_EXTENDED = 510;                 // Not extended
    case NETWORK_AUTHENTICATION_REQUIRED = 511; // Network authentication required

    public function text(): string
    {
        return match ($this) {
            self::CONTINUE => 'Continue',
            self::SWITCHING_PROTOCOLS => 'Switching Protocols',
            self::PROCESSING => 'Processing',
            self::EARLY_HINTS => 'Early Hints',
            self::OK => 'OK',
            self::CREATED => 'Created',
            self::ACCEPTED => 'Accepted',
            self::NON_AUTHORITATIVE_INFORMATION => 'Non-Authoritative Information',
            self::NO_CONTENT => 'No Content',
            self::RESET_CONTENT => 'Reset Content',
            self::PARTIAL_CONTENT => 'Partial Content',
            self::MULTI_STATUS => 'Multi-Status',
            self::ALREADY_REPORTED => 'Already Reported',
            self::IM_USED => 'I\'m Used',
            self::MULTIPLE_CHOICES => 'Multiple Choices',
            self::MOVED_PERMANENTLY => 'Moved Permanently',
            self::FOUND => 'Found',
            self::SEE_OTHER => 'See Other',
            self::NOT_MODIFIED => 'Not Modified',
            self::USE_PROXY => 'Use Proxy',
            self::TEMPORARY_REDIRECT => 'Temporary Redirect',
            self::PERMANENT_REDIRECT => 'Permanent Redirect',
            self::BAD_REQUEST => 'Bad Request',
            self::UNAUTHORIZED => 'Unauthorized',
            self::PAYMENT_REQUIRED => 'Payment Required',
            self::FORBIDDEN => 'Forbidden',
            self::NOT_FOUND => 'Not Found',
            self::METHOD_NOT_ALLOWED => 'Method Not Allowed',
            self::NOT_ACCEPTABLE => 'Not Acceptable',
            self::PROXY_AUTHENTICATION_REQUIRED => 'Proxy Authentication Required',
            self::REQUEST_TIMEOUT => 'Request Timeout',
            self::CONFLICT => 'Conflict',
            self::GONE => 'Gone',
            self::LENGTH_REQUIRED => 'Length Required',
            self::PRECONDITION_FAILED => 'Precondition Failed',
            self::PAYLOAD_TOO_LARGE => 'Payload Too Large',
            self::URI_TOO_LONG => 'URI Too Long',
            self::UNSUPPORTED_MEDIA_TYPE => 'Unsupported Media Type',
            self::RANGE_NOT_SATISFIABLE => 'Range Not Satisfiable',
            self::EXPECTATION_FAILED => 'Expectation Failed',
            self::IM_A_TEAPOT => 'I\'m a teapot',
            self::MISDIRECTED_REQUEST => 'Misdirected Request',
            self::UNPROCESSABLE_ENTITY => 'Unprocessable Entity',
            self::LOCKED => 'Locked',
            self::FAILED_DEPENDENCY => 'Failed Dependency',
            self::TOO_EARLY => 'Too Early',
            self::UPGRADE_REQUIRED => 'Upgrade Required',
            self::PRECONDITION_REQUIRED => 'Precondition Required',
            self::TOO_MANY_REQUESTS => 'Too Many Requests',
            self::REQUEST_HEADER_FIELDS_TOO_LARGE => 'Request Header Fields Too Large',
            self::UNAVAILABLE_FOR_LEGAL_REASONS => 'Unavailable For Legal Reasons',
            self::INTERNAL_SERVER_ERROR => 'Internal Server Error',
            self::NOT_IMPLEMENTED => 'Not Implemented',
            self::BAD_GATEWAY => 'Bad Gateway',
            self::SERVICE_UNAVAILABLE => 'Service Unavailable',
            self::GATEWAY_TIMEOUT => 'Gateway Timeout',
            self::HTTP_VERSION_NOT_SUPPORTED => 'HTTP Version Not Supported',
            self::VARIANT_ALSO_NEGOTIATES => 'Variant Also Negotiates',
            self::INSUFFICIENT_STORAGE => 'Insufficient Storage',
            self::LOOP_DETECTED => 'Loop Detected',
            self::NOT_EXTENDED => 'Not Extended',
            self::NETWORK_AUTHENTICATION_REQUIRED => 'Network Authentication Required',
        };
    }

    public function translatedText(): string
    {
        return trans('http_status_codes.'.$this->text());
    }
}
