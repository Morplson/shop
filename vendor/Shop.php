<?php
/**
 * Shop speichert alle Produkte und User (weil warum nicht)
 * Hier befinden sich auch die statischen methoden zum management.
 */
class Shop
{
    
    private static $produkte = [];
    private static $users = [];
    
    public static function addProduktToShop(Produkt $produkt){
        if (Produkt::checkSN($produkt)) {
            self::$produkte[]=$produkt;
        }
    }
    
    public static function findProdukt(string $serialID) {
        foreach (self::$produkte as $produkt) {
            if ($produkt->getName()==$serialID) {
                return $produkt;
            }
        }
    }
    
    public static function addUserToShop(User $user){
        self::$users[]=$user;
    }
    
    public static function findUser(string $name) {
        foreach (self::$users as $user) {
            if ($user->getName()==$name) {
                return $user;
            }
        }
    }
    
    public static function printall(){
        echo "\nUser:\n";
        foreach (self::$users as $user) {
            $user;
        }
        
        echo "\n\n\nProdukte:\n";
        foreach (self::$produkte as $produkt) {
            $produkt->print();
        }
    }
    
}





class Produkt
{
    
    private $serialID;
    protected $anzahl;
    protected $name;
    protected $bes;
    protected $preis;
    
    
    public function __construct(string $name,string $bes,float $preis,int $anzahl=1) {
        $this->serialID = uniqid(date(DATE_RFC3339_EXTENDED));
        $this->anzahl = $anzahl;
        $this->name = $name;
        $this->bes = $bes;
        $this->preis = $preis; 
    }
    
    public function kaufen(int $anzahl) {
        if ($this->anzahl-$anzahl>=0) {
            $this->anzahl-=$anzahl;
            
            echo "Kauf erfolgreich!\n";
        } else {
            echo "Kann nicht kaufen, da nurnoch $this->anzahl Produkte vorhanden sind.\n";
        }
    }
    
    public static function checkSN(Produkt $produkt) {
        if ($produkt instanceof Produkt){
            if (strlen($produkt->serialID)>13) {
                return true;
            }
        }
        return false;
        
    }
    
    public  function getSerialnumber() {
        return $this->serialID;
    }
    
    public  function getName() {
        return $this->name;
    }
    
    public  function getPreis() {
        return $this->preis;
    }
    
    public  function getBezeichnung() {
        return $this->bes;
    }
    
    public function gesammtPreis() {
        return $this->preis*$this->anzahl;
    }
    
    public function print() {
        echo "\nProdukt: $this->name ($this->bes) kostet $this->preis und $this->anzahl sind noch vorhanden.\n";
    }
    
}

class Buch extends Produkt {
    protected $isbn;
    
    function __construct(string $name,string $bes,float $preis,int $anzahl=1) {
        parent::__construct($name, $bes, $preis, $anzahl);
    }
    
    public function print() {
        echo "\nBuch: $this->name ($this->bes) kostet $this->preis und $this->anzahl sind noch vorhanden. ISBN: $this->isbn \n";
    }
    
    
}

class Mixtape extends Produkt {
    protected $tracks = [];
    
    function __construct(string $name,string $bes,float $preis,int $anzahl=1, $music) {
        parent::__construct($name, $bes, $preis, $anzahl);
        foreach ($music as $track) {
            $this->tracks[] = $track;
        }
    } 
    
    public function print() {
        echo "\nMixtape: $this->name ($this->bes) kostet $this->preis und $this->anzahl sind noch vorhanden.\n\nTracks:\n";
        foreach ($this->tracks as $mus) {
            $mus->print();
        }
    }
    
}

class Music extends Produkt {
    protected $interpret;
    protected $author;
    protected $album;
    
    function __construct(string $name,string $interpret,string $author,string $album, string $bes,float $preis,int $anzahl=1) {
        parent::__construct($name, $bes, $preis, $anzahl);
        $this->interpret = $interpret;
        $this->author = $author;
        $this->album = $album;
    }
    
    public function print() {
        echo "\nMusik: $this->name ($this->bes) von $this->interpret $this->author aus Album $this->album kostet $this->preis und $this->anzahl sind noch vorhanden.\n";
    }

}


class User
{
    private $wahrenkorb;
    private $name;
    private $email;
    private $psw;
    
    function __construct($name, $email) {
        $this->wahrenkorb = new Wahrenkorb();
        $this->name = $name;
        $this->email = $email;
        
        echo "user ERFOLGREICH erschaffen\n";
    }
    
    public function kaufen($serialID,$anzahl) {
        $this->wahrenkorb->kaufen($serialID, $anzahl);
    }
    
    public  function getName() {
        return $this->name;
    }
    
}


class Wahrenkorb {
    
    private $produkte;
    
    function __constructor() {
        $this->produkte = [];
    }
    
    public function gesammtPreis() {
        $preis = 0;
        foreach ($this->produkte as $produkt) {
            $preis+=$produkt->gesammtPreis();
        }
        
        return $preis;
    }
    
    public function loeschen() {
        $this->produkte = [];
    }
    
    public function kaufen($serialID,$anzahl) {
        $produkt = Shop::findProdukt($serialID);
        if(isset($produkt)){
            $produkt->kaufen($anzahl);
            
            $this->produkte[] = new Produkt($produkt->getName(), $produkt->getBezeichnung(), $produkt->getPreis(), $anzahl);
            
        }
    }
    
    
}












//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$shop = new Shop();

$shop::addProduktToShop(new Produkt("hand", "kann sachen aufheben", 33, 40));
$shop::addProduktToShop(new Produkt("bein", "kann stehen", 33, 50));
$shop::addProduktToShop(new Produkt("kopf", "kann denken", 33));

//string $name,string $interpret,string $author,string $album, string $bes,int $preis,int $anzahl=1
$tracks = [new Music("platte", "musiker", "musiker", "lieder", "gut gemacht", 12, 10000),new Music("platte2", "musiker", "musiker", "lieder", "gut gemacht", 1, 10000),new Music("platte3", "musiker", "musiker", "lieder", "nicht so gut", 12, 10000)];

$shop::addProduktToShop($tracks[0]);
$shop::addProduktToShop($tracks[1]);
$shop::addProduktToShop($tracks[2]);

$shop::addProduktToShop(new Mixtape("lieder", "lieder von musiker !!top hits!!", 99,99, $tracks));

$shop::addUserToShop(new User("k", "email"));

$shop::findUser("k")->kaufen("kopf",4);
$shop::findUser("k")->kaufen("bein",4);

$shop::printall();



