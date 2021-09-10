# VPN-Cookie-Test
This PHP script can be installed on a web page to determine if multiple IP addresses are all coming from the same device.

The script works like this. First, it will set a cookie on a user's computer, containing a unique sequence of letters and numbers. It will then write this value into a log.txt file, along with the IP address of the visitor. If the script can find a cookie on the user's device from a prior visit, however, it will simply log the existing value. This means that, even if the visitor is using multiple IP addresses, the cookie value will still be the same. You can use this cookie value to determine if multiple IP addresses visiting your web pages are in fact one person/computer. This is assuming the person has not cleared cookies after each visit – if this is the case, their visits will report as first-time visits each time.

The cookies the script sets are disguised as normal cookies, making references to Google, shopping carts, and GDPR. This means that, if a visitor is analyzing the cookies your website is setting manually, they will be unlikely to determine the cookies' true purpose easily.

The script also provides a handy link to find out more information about an IP address from Scamalytics, which can reveal more things about an IP address, such as its likelihood of being a VPN or proxy connection. The script will also log the exact time and date of the visit (don't forget to change the time zone in the getTimestamp() method to be local to your time or it won't work properly).
