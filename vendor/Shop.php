<?php


class Produkt
{
    
    private $serialID;
    protected $anzahl;
    protected $name;
    protected $bes;
    protected $preis;
    protected $einheit;
    protected $gewicht;
    private $userID;

    protected $score;
    protected $likes;
    protected $comments;
    
    
    public function __construct(string $name,string $bes,float $preis,$gewicht,$userID,int $anzahl=1,string $einheit='Stk.') {
        $this->serialID = uniqid(date(DATE_RFC3339_EXTENDED));
        $this->anzahl = $anzahl;
        $this->name = $name;
        $this->bes = $bes;
        $this->preis = $preis;
        $this->einheit = $einheit;
        $this->gewicht = $gewicht;

        $this->userID = $userID;

        $this->$score = 0;
        $this->$likes = 0;
        $this->$comments = 0;
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

    public  function getEinheit() {
        return $this->einheit;
    }
    
    public  function getGewicht() {
        return $this->gewicht;
    }
    
    public  function getUID() {
        return $this->userID;
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
    
    function __construct(string $name,string $bes,float $preis,int $gewicht,$userID,int $anzahl=1,string $einheit='Stk.') {
        parent::__construct($name, $bes, $preis, $gewicht, $userID, $anzahl, $einheit);
    }
    
    public function print() {
        echo "\nBuch: $this->name ($this->bes) kostet $this->preis und $this->anzahl sind noch vorhanden. ISBN: $this->isbn \n";
    }
    
    
}

class Mixtape extends Produkt {
    protected $tracks = [];
    
    function __construct(string $name,string $bes,float $preis,int $gewicht,$userID,int $anzahl=1,string $einheit='Stk.', $music) {
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
    
    function __construct(string $name,string $bes,float $preis,int $gewicht,string $interpret,string $author,string $album,$userID,int $anzahl=1,string $einheit='Stk.') {
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

