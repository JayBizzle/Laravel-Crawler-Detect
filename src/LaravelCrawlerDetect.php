<?php namespace Jaybizzle\LaravelCrawlerDetect;

class LaravelCrawlerDetect {
	
	protected static $crawlers = [
		"googlebot\\/",
		"Googlebot-Mobile",
		"Googlebot-Image",
		"Mediapartners-Google ",
		"bingbot ",
		"slurp ",
		"wget",
		"curl",
		"Commons-HttpClient",
		"Python-urllib",
		"libwww",
		"httpunit",
		"nutch",
		"phpcrawl ",
		"msnbot ",
		"Adidxbot ",
		"blekkobot ",
		"teoma",
		"ia_archiver",
		"GingerCrawler",
		"webmon ",
		"httrack",
		"webcrawler",
		"FAST-WebCrawler",
		"FAST Enterprise Crawler",
		"convera",
		"biglotron",
		"grub.org",
		"UsineNouvelleCrawler",
		"antibot",
		"netresearchserver",
		"speedy",
		"fluffy",
		"jyxobot",
		"bibnum.bnf",
		"findlink",
		"exabot",
		"gigabot",
		"msrbot",
		"seekbot",
		"ngbot",
		"panscient",
		"yacybot",
		"AISearchBot",
		"IOI",
		"ips-agent",
		"tagoobot",
		"MJ12bot",
		"dotbot",
		"woriobot",
		"yanga",
		"buzzbot",
		"mlbot",
		"yandex",
		"purebot ",
		"Linguee Bot ",
		//"Voyager ",
		"CyberPatrol",
		"voilabot",
		"baiduspider",
		"citeseerxbot",
		"spbot",
		"twengabot",
		"postrank",
		"turnitinbot",
		"scribdbot",
		"page2rss",
		"sitebot",
		"linkdex",
		"ezooms",
		"dotbot",
		"Mail\.",
		"discobot",
		"heritrix",
		"findthatfile",
		"europarchive.",
		"NerdByNature.",
		"sistrix crawler",
		"ahrefsbot",
		"Aboundex",
		"domaincrawler",
		"wbsearchbot",
		"summify",
		"ccbot",
		"edisterbot",
		"seznambot",
		"ec2linkfinder",
		"gslfbot",
		"aihitbot",
		"intelium_bot",
		"facebookexternalhit",
		"yeti",
		"RetrevoPageAnalyzer",
		"lb-",
		"sogou",
		"lssbot",
		"careerbot",
		"wotbox",
		"wocbot",
		"ichiro",
		"DuckDuckBot",
		"lssrocketcrawler",
		"drupact",
		"webcompanycrawler",
		"acoonbot",
		"openindexspider",
		"gnam gnam",
		"web-",
		"backlinkcrawler",
		"coccoc",
		"integromedb",
		"content crawler",
		"toplistbot",
		"seokicks-",
		"it2media-",
		"ip-web-crawler",
		"siteexplorer.",
		"elisabot",
		"proximic",
		"changedetection",
		"blexbot",
		"arabot",
		"WeSEE:",
		"niki-",
		"CrystalSemanticsBot",
		"rogerbot",
		"360Spider",
		"psbot",
		"InterfaxScanBot",
		"Lipperhey SEO",
		"CC Metadata",
		"g00g1e.",
		"GrapeshotCrawler",
		"urlappendbot",
		"brainobot",
		"binlar",
		"SimpleCrawler",
		"SimpleCrawler",
		"Livelapbot",
		"Twitterbot",
		"cXensebot",
		"smtbot",
		"bnf.",
		"A6-",
		"ADmantX",
		"Facebot",
		"Twitterbot",
		"OrangeBot",
		"memorybot",
		"AdvBot",
		"XoviBot",
		"QuerySeekerSpider",
		"iisbot",
		"JOC Web Spider",
		"archive-com",
		"Sosospider",
		"Xenu Link Sleuth",
		"Gluten Free Crawler",
		"dataprovider",
		"emailmarketingrobot",
		"Genieo",
		"Riddler",
		"SEOstats",
		"uMBot",
		"netEstate NE Crawler",
		"Pizilla",
		"crawler4j",
		"GermCrawler"
	];

	public $matches = [];

	/**
     * All possible HTTP headers that represent the
     * User-Agent string.
     *
     * @var array
     */
    protected static $uaHttpHeaders = array(
        // The default User-Agent string.
        'HTTP_USER_AGENT',
        // Header can occur on devices using Opera Mini.
        'HTTP_X_OPERAMINI_PHONE_UA',
        // Vodafone specific header: http://www.seoprinciple.com/mobile-web-community-still-angry-at-vodafone/24/
        'HTTP_X_DEVICE_USER_AGENT',
        'HTTP_X_ORIGINAL_USER_AGENT',
        'HTTP_X_SKYFIRE_PHONE',
        'HTTP_X_BOLT_PHONE_UA',
        'HTTP_DEVICE_STOCK_UA',
        'HTTP_X_UCBROWSER_DEVICE_UA'
    );

	/**
	 * Class constructor
	 */
	public function __construct(array $headers = null, $userAgent = null)
	{
		$this->setHttpHeaders($headers);
		$this->setUserAgent($userAgent);
	}

	public function setHttpHeaders($httpHeaders = null)
    {
        // use global _SERVER if $httpHeaders aren't defined
        if (!is_array($httpHeaders) || !count($httpHeaders)) {
            $httpHeaders = $_SERVER;
        }
        // clear existing headers
        $this->httpHeaders = array();
        // Only save HTTP headers. In PHP land, that means only _SERVER vars that
        // start with HTTP_.
        foreach ($httpHeaders as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                $this->httpHeaders[$key] = $value;
            }
        }
    }

    public function getUaHttpHeaders()
    {
        return self::$uaHttpHeaders;
    }

    public function setUserAgent($userAgent = null)
    {
        if (false === empty($userAgent)) {
            return $this->userAgent = $userAgent;
        } else {
            $this->userAgent = null;
            foreach ($this->getUaHttpHeaders() as $altHeader) {
                if (false === empty($this->httpHeaders[$altHeader])) { // @todo: should use getHttpHeader(), but it would be slow. (Serban)
                    $this->userAgent .= $this->httpHeaders[$altHeader] . " ";
                }
            }
            return $this->userAgent = (!empty($this->userAgent) ? trim($this->userAgent) : null);
        }
    }

    public function getRegex()
    {
    	return "(".implode('|',self::$crawlers).")";
    }

    public function isCrawler($userAgent = null)
    {
    	$agent = is_null($userAgent) ? $this->userAgent : $userAgent;

		$pass = preg_match("/".$this->getRegex()."/i", $agent, $matches);

		if($matches) {
			$this->matches = $matches;
		}

    	return (bool) $pass;
    }

    public function getMatches() {
    	return $this->matches;
    }
}
