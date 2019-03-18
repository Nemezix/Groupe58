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

        $query = 'SELECT memberid, name, lastname, state, rights, image, pswd FROM members WHERE mail=?';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(1, $login);
        $ps->execute();

        $ps = $ps->fetch(PDO::FETCH_BOTH);

        $member_id = $ps[0];
        $name = $ps[1];
        $last_name = $ps[2];
        $user_mail = $login;
        $user_state = $ps[3];
        $user_rights = $ps[4];
        $user_image = $ps[5]
        $user_pswd = $ps[6];

        $user = new Member($member_id, $name, $last_name, $user_mail, $user_state, $user_rights, $user_pswd);

        return $user;
    }
    
    public function retrieve_surname($login){

        $query = 'SELECT name FROM members WHERE mail=?';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(1, $login);
        $ps->execute();

        $ps->fetch();

        return $ps;
    }

     public function submit_new_member($insc){

        $query = 'INSERT INTO members (name, lastname, mail, state, pswd) VALUES(?, ?, ?, ?, ?)';
        $answ = $this->_db->prepare($query);
        $answ->bindValue(1, $insc['name']);
        $answ->bindValue(2, $insc['lastname']);
        $answ->bindValue(3, $insc['email']);
        $answ->bindValue(4, 'Active');
        $answ->bindValue(5, password_hash($insc['pswd'], PASSWORD_DEFAULT));
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

        $query = 'UPDATE members SET name = ?, lastname = ?, mail = ?, rights =?, pswd =? WHERE memberid = ?';
        $ud = $this->_db->prepare($query);
        $ud->bindValue(1, $member->name);
        $ud->bindValue(2, $member->lastname);
        $ud->bindValue(3, $member->mail);
        $ud->bindValue(4, $member->rights);
        $ud->bindValue(5, $member->pswd);
        $ud->bindValue(6, $member->memberid);
        $ud->execute();

        return true;

    }


    public function update_state($member){

        $query = 'UPDATE members SET state = ? WHERE memberid = ?';
        $qr = $this->_db->prepare($query);
        $qr->bindValue(1, $member->state);
        $qr->bindValue(2, $member->memberid);
        $qr->execute();

        return true;
    }



    public function submit_question($question){

        $query = 'INSERT INTO questions (title, subject, categoryid, ownerid, creationdate, state) VALUES(?, ?, ?, ?, ?, ?)';
        $insert = $this->_db->prepare($query);
        $insert->bindValue(1,$question['title']);
        $insert->bindValue(2,$question['subject']);
        $insert->bindValue(3,$question['categoryid']);
        $insert->bindValue(4,$question['ownerid']);
        $insert->bindValue(5,$question['creationdate']);
        $insert->bindValue(6,$question['state']);

        $insert->execute();

        $query = 'SELECT questionid FROM questions WHERE title=?';
        $select = $this->_db->prepare($query);
        $select->bindValue(1,$question['title']);
        $select->execute();

        $select = $select->fetch();

        return $select;
    }

    public function select_all_members(){

        $query ='SELECT * FROM members';
        $ps = $this->_db->prepare($query);
        $ps->execute();

        while($row = $ps->fetch()){

            $array[] = new Member($row->memberid, $row->name, $row->lastname, $row->mail, $row->state, $row->rights, $row->image, $row->pswd);
        }

        return $array;

    }

   public function select_all_questions(){

        $query = 'SELECT * FROM questions';
        $ps = $this->_db->prepare($query);
        $ps->execute();

        while($row = $ps->fetch()){

            $array[] = new Event($row->questionid, $row->title, $row->subject, $row->categoryid, $row->ownerid, $row->creationdate, $row->state, $row->likes);
        }

        return $array;
    }

    public function select_question($questionid){

        $query = 'SELECT title, subject, categoryid, ownerid, creationdate, state, likes from questions WHERE questionid=?';
        $se = $this->_db->prepare($query);
        $se->bindValue(1, $questionid);
        $se->execute();

        $se = $se->fetch(PDO::FETCH_BOTH);

        $question_title = $se[0];
        $question_subject = $se[1];
        $question_categoryid = $se[2];
        $question_ownerid = $se[3];
        $question_creationdate = $se[4];
        $question_state = $se[5];
        $question_likes = $se[6];

        $question = new Question( $questionid, $question_title, $question_subject, $question_categoryid, $question_ownerid $question_creationdate, $question_state, $question_likes);

        return $question;
    }
}
?>