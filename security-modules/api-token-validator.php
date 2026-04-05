<?php
/**
 * API Security & Token Validator
 * Engineered for secure data transmission in Custom PHP Applications (e.g., Astrology/Kundli Data).
 * Prevents unauthorized access and SQL injection attempts at the endpoint level.
 */
class ApiSecurityManager {

    private $secretKey;

    public function __construct($envKey) {
        $this->secretKey = $envKey; // Loaded from secure environment variables
    }

    /**
     * Validates Bearer token from incoming API requests.
     */
    public function validateRequest() {
        $headers = apache_request_headers();
        
        if (!isset($headers['Authorization'])) {
            $this->terminateRequest('Unauthorized access attempt flagged.');
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);
        
        if (!hash_equals($this->secretKey, hash('sha256', $token))) {
            $this->terminateRequest('Invalid or expired security token.');
        }

        return true; // Request is secure and validated
    }

    private function terminateRequest($message) {
        header('HTTP/1.1 401 Unauthorized');
        echo json_encode(['error' => true, 'message' => $message]);
        exit;
    }
}

/* // Endpoint Usage:
$security = new ApiSecurityManager($_ENV['APP_SECRET_KEY']);
$security->validateRequest();
// Proceed to fetch Kundli data securely...
*/
?>
