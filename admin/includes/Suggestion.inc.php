<?php
    include_once 'dbh.inc.php';
class Suggestion extends Connection{

    private $title, $suggest;

    public static function getNoSuggestion():int
    {
        # return No fo suggestion in datas
        $stmt = (new parent)->connect()->prepare(" SELECT SuggesId FROM suggestion");
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function viewSuggestionAsTbl()
    {
        # retry all Suggestion Quesris as Table
        $sql = "SELECT * FROM suggestion";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $tabQuery = "";
        foreach ($results as $result) {
            $tabQuery = $tabQuery."<tr>
            <td>".$result['SuggesId']."</td>
            <td>".$result['Title']."</td>
            <td>".$result['Suggestion']."</td>
            <td>".$result['suggestTime']."</td>
            <td><button type='button' class='btn cur-p btn-outline-danger' onclick='deleteDetail(\"".$result['SuggesId']."\",\""."suggestion"."\")'><i class='ti-trash'></i></button></td>
            </tr>";
        }
        return $tabQuery;
    }

    public function deleteSuggestion($deleteid)
    {
        /*delete Suggestion from  database*/
        $sql = "DELETE FROM suggestion WHERE SuggesId = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$deleteid]);
    }
}
?>