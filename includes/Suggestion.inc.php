<?php
    include_once 'dbh.inc.php';
class Suggestion extends Connection{

    private $title, $suggest;

    public function __construct($title, $suggest)
    {
        # cnstruct new Suggeestion as an Object
        parent::__construct();
        $this->title = $title;
        $this->suggest = $suggest;

    }

    public function makeSuggestion()
    {
        # build a suggestion and insert into railway database 
        $sql = "INSERT INTO suggestion(SuggesId,Title,Suggestion,markAsRead, suggestTime) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmts = $this->connect()->prepare($sql);
        $stmts->execute([$this->title,$this->suggest,'0']);
        return "success";
    }
}
?>