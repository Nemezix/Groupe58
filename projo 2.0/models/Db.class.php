<?php
class Db
{
    private static $instance = null;
    private $_db;

    private function __construct()
    {
        try {
            $this->_db = new PDO('mysql:host=localhost;dbname=projectbd;charset=utf8', 'root', '');
            $this->_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        } 
		catch (PDOException $e) {
		    die('Erreur de connexion à la base de données : '.$e->getMessage());
        }
    }

	# Pattern Singleton
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    #QUERY
    public function pswdCheck($login, $pw){

        #retrive hashcode
        $query = 'SELECT pswd FROM members WHERE mail=:login';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':login', $login);
        $ps->execute();

        if($ps->rowcount() == 0)
            return false;

        $hash = $ps->fetch()->pswd;

        return password_verify($pw, $hash);
    }

    public function select_member($login){

        $query = 'SELECT memberid, firstname, surname, numtel, adress, bankid, trainingid, rights, title, pswd FROM members WHERE mail=?';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(1, $login);
        $ps->execute();

        $ps = $ps->fetch(PDO::FETCH_BOTH);

        $member_id = $ps[0];
        $first_name = $ps[1];
        $sur_name = $ps[2];
        $num_tel = $ps[3];
        $user_mail = $login;
        $user_adress = $ps[4];
        $bank_id = $ps[5];
        $training_id = $ps[6];
        $user_rights = $ps[7];
        $user_title = $ps[8];
        $user_pswd = $ps[9];

        $user = new Member($member_id, $first_name, $sur_name, $num_tel, $user_mail, $user_adress, $bank_id, $training_id, $user_rights, $user_title, $user_pswd);

        return $user;
    }
    
    public function retrieve_surname($login){

        $query = 'SELECT surname FROM members WHERE mail=?';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(1, $login);
        $ps->execute();

        $ps->fetch();

        return $ps;
    }

     public function submit_new_member($insc){

        $query = 'INSERT INTO members (firstname, surname, numtel, mail, adress, bankid, pswd) VALUES(?, ?, ?, ?, ?, ?, ?)';
        $answ = $this->_db->prepare($query);
        $answ->bindValue(1, $insc['name']);
        $answ->bindValue(2, $insc['surname']);
        $answ->bindValue(3, $insc['numtel']);
        $answ->bindValue(4, $insc['email']);
        $answ->bindValue(5, $insc['adress']);
        $answ->bindValue(6, $insc['bankid']);
        $answ->bindValue(7, password_hash($insc['pswd'], PASSWORD_DEFAULT));
        $answ->execute();

        return true;
    } 

    public function rights_check($login, $rights){

        $query = 'SELECT rights FROM members WHERE mail=?';
        $rw = $this->_db->prepare($query);
        $rw->bindValue(1,$login);
        $rw->execute();

        $rw = $rw->fetch()->rights;

        return ($rw>=$rights);
    }

    public function update_member($member){

        $query = 'UPDATE members SET firstname = ?, surname = ?, numtel = ?, mail = ?, adress = ?, bankid = ?, rights =?, pswd =? WHERE memberid = ?';
        $ud = $this->_db->prepare($query);
        $ud->bindValue(1, $member->firstname);
        $ud->bindValue(2, $member->surname);
        $ud->bindValue(3, $member->numtel);
        $ud->bindValue(4, $member->mail);
        $ud->bindValue(5, $member->adress);
        $ud->bindValue(6, $member->bankid);
        $ud->bindValue(7, $member->rights);
        $ud->bindValue(8, $member->pswd);
        $ud->bindValue(9, $member->memberid);
        $ud->execute();

        return true;

    }


    public function update_title($member){

        $query = 'UPDATE members SET title = ? WHERE memberid = ?';
        $qr = $this->_db->prepare($query);
        $qr->bindValue(1, $member->title);
        $qr->bindValue(2, $member->memberid);
        $qr->execute();

        return true;
    }



    public function submit_event($event){

        $query = 'INSERT INTO events (title, description, price, event_date, localisation, photoURL) VALUES(?, ?, ?, ?, ?, ?)';
        $insert = $this->_db->prepare($query);
        $insert->bindValue(1,$event['title']);
        $insert->bindValue(2,$event['description']);
        $insert->bindValue(3,$event['price']);
        $insert->bindValue(4,$event['event_date']);
        $insert->bindValue(5,$event['localisation']);
        $insert->bindValue(6,$event['photo']);

        $insert->execute();

        $query = 'SELECT eventid FROM events WHERE title=?';
        $select = $this->_db->prepare($query);
        $select->bindValue(1,$event['title']);
        $select->execute();

        $select = $select->fetch();

        return $select;
    }

    public function event_add_driveUrl($event){

        $query = 'UPDATE events SET driveURL = ? WHERE eventid = ?';
        $pdt = $this->_db->prepare($query);
        $pdt->bindValue(1, $event->drive_url);
        $pdt->bindValue(2, $event->eventid);

        $pdt->execute();

        return true;
    }

    public function select_all_members(){

        $query ='SELECT * FROM members';
        $ps = $this->_db->prepare($query);
        $ps->execute();

        while($row = $ps->fetch()){

            $array[] = new Member($row->memberid, $row->firstname, $row->surname, $row->numtel, $row->mail, $row->adress, $row->bankid, $row->trainingid, $row->rights, $row->title, $row->pswd);
        }

        return $array;

    }

   public function select_all_events(){

        $query = 'SELECT * FROM events';
        $ps = $this->_db->prepare($query);
        $ps->execute();

        while($row = $ps->fetch()){

            $array[] = new Event($row->eventid, $row->title, $row->description, $row->price, $row->event_date, $row->photoURL, $row->driveURL, $row->localisation);
        }

        return $array;
    }

    public function select_event($eventid){

        $query = 'SELECT title, description, photoURL, driveURL, price, event_date, localisation from events WHERE eventid=?';
        $se = $this->_db->prepare($query);
        $se->bindValue(1, $eventid);
        $se->execute();

        $se = $se->fetch(PDO::FETCH_BOTH);

        $event_title = $se[0];
        $event_description = $se[1];
        $event_photoURL = $se[2];
        $event_driveURL = $se[3];
        $event_price = $se[4];
        $event_date = $se[5];
        $event_localisation = $se[6];

        $event = new Event( $eventid, $event_title, $event_description, $event_price, $event_date, $event_photoURL, $event_driveURL, $event_localisation);

        return $event;
    }
}
?>