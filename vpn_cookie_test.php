<?php

class CookieTest {
    public function __construct(){
        $this->cookie_names = [
            "ae427921_google9531127aRtF",
            "resid_login_token_id-886z454321atBrEqWE9", 
            "languageSettings8r5299166127",
            "gdpr_consent_spec32ARikJhfz",
            "shopping_cart_local331rFdSwccVbzs","userTheme88743251zcvFGhrdzaswrtf",
            "settingsStorage881734FvczsDF883"];
        $this->new_val = null;
        $this->checkCookie();
    }
    public function checkCookie(){
        $found = false;
        foreach ($this->cookie_names as $current_name){
            if (isset($_COOKIE[$current_name])){
                $this->logCookieValue("Returning", 
                    $_COOKIE[$current_name]);  
                    $found = true;
                    break; //Terminate loop if existing cookie found
            }
        }
        if ($found === false){ //If not found after loop completion
            $this->setNewCookie();
        }
    }
    private function setNewCookie(){
        $this->new_val = str_shuffle("azTrfsxFdeRtfg871s!JbvzKoP1987#@!&&");
        setcookie(
            $this->cookie_names[rand(0, count($this->cookie_names))],
            $this->new_val, 
            time() + 31536000, //Expiry of 1 year
            "/");
        $this->logCookieValue("First visit", $this->new_val);
    }
    private function logCookieValue($type, $value){
        $entry = "Visitor IP: " . $_SERVER["REMOTE_ADDR"] . "\n" .
                    "Visit type: " . $type . "\n" .
                    "Cookie value: " . $value . "\n" . 
                    "IP info: " . "http://www.scamalytics.com/ip/" . 
                                    $_SERVER["REMOTE_ADDR"] . "\n" .
                    "Time: " . $this->getTimestamp() . "\n\n";
        $log_file = "log.txt";
        if (!file_exists($log_file)){
            file_put_contents("log.txt", $entry);
        } elseif (file_exists($log_file)){
            $existing = file_get_contents($log_file);
            file_put_contents($log_file, $entry);
            $file = fopen("log.txt", "a+");
            fwrite($file, $existing);
            fclose($file);
        }
    }
    private function getTimestamp(){
        $timezone = "Australia/Sydney"; //Time zone string from PHP docs
        $time_obj = new DateTime("now", new DateTimeZone($timezone));
        $time = $time_obj->format("h:i:s A");
        $date = $time_obj->format("D d M Y");
        return $date . " " . $time;
    }
}

$cookie_test = new CookieTest();

//If you see all kinds of IPs but the cookie is the same, then the IP addresses are all coming from the same computer.