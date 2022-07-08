<?php 
class Prodotti {
    public $nome;
    public $tipo_prodotto;
    public $prezzo;
    public $sconto;
    public $acquirente;

    use Cibo;
    use Giochi;

    function __construct($_nome, $_tipo_prodotto, $_prezzo, $_destinatario, $_tipologia_cibo, $_sconto){
        $this->nome = $_nome;
        $this->tipo_prodotto = $_tipo_prodotto;
        $this->prezzo = $_prezzo;
        $this->destinatario = $_destinatario;
        $this->tipologia_cibo = $_tipologia_cibo;
        $this->sconto = $_sconto;
    }
    function set_tipologia($tipo_prodotto){
        if ($tipo_prodotto === 'gioco') {
            $this->tipologia_cibo = null; 
            $this->tipo_prodotto = 'gioco';
        } else { 
            $this->tipo_prodotto = 'cibo';
        }
    }
};

trait Giochi {
    public $destinatario;
}
trait Cibo {
    public $tipologia_cibo;
}
class User{
    public $tipologia_user;
    public $scadenza_carta_credito;
    public $sconto;
    public $cartavalida;

    function __construct($_tipologia_user, $_scadenza_carta_credito, $_sconto, $_cartavalida){
        $this->tipologia_user = $_tipologia_user;
        $this->scadenza_carta_credito = $_scadenza_carta_credito;
        $this->sconto = $_sconto;
        $this->cartavalida = $_cartavalida;
    }

    function sconticino($tipologia_user){
        if ($tipologia_user === true) {
            $this->sconto = '20%';
        } else  {
            $this->sconto = false;
            $this->cartavalida = false;
        }

    }

    function check($scadenza_carta_credito){
        if (strtotime(date("d-m-y"))  >= $scadenza_carta_credito ) {
            $this->cartavalida = false;
        } else {
            $this->cartavalida = true;
        }
    }
}

$iscritto_scaduto = new User(true, '06-07-2022', '', '');
$iscritto_scaduto->sconticino(true);
$iscritto_scaduto->check('06-07-2022');
var_dump($iscritto_scaduto);

$iscritto_normale = new User(true, '30-05-2022', '', '');
$iscritto_normale->sconticino(true);
$iscritto_normale->check('30-07-2022');
var_dump($iscritto_normale);

$non_registrato = new User(false, '', '', '');
$non_registrato->sconticino(false);
$non_registrato->check('');
var_dump($non_registrato);

$osso = new Prodotti('osso', '', '10$', 'cani', '', '');
$osso->set_tipologia('gioco');

$cibo_gatti = new Prodotti('cibo gatti', '', '5$', 'gatti', 'umido', '');
$cibo_gatti->set_tipologia('cibo');