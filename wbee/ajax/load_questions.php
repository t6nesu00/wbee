<?php 

include '../resources/config.php';

$question_no = "";
$question = "";
$opt1 = "";
$opt2 = "";
$opt3 = "";
$opt4 = "";
$answer = "";
$count = 0;
$ans = "";

$qnumber = $_GET["questionNo"];

if(isset($_SESSION["answer"][$qnumber]))
{
    $ans = $_SESSION["answer"][$qnumber];
}


$sql = "SELECT * FROM questionTable WHERE category = '$_SESSION[exam_category]' && question_no = $_GET[questionNo]";
$stmt = $connect->query($sql);
$count = $stmt->rowCount($stmt);

if($count == 0) 
{
    echo "over";
}
else {
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $question_no = $row["question_no"];
        $question = $row["question"];
        $opt1 = $row["opt1"];
        $opt2 = $row["opt2"];
        $opt3 = $row["opt3"];
        $opt4 = $row["opt4"];    
    
    }

    ?>
    <br>

    <table>
        <tr>
            <td style="font-weight: bold; font-size: 18px; margin-left: 15px; padding: 5px;">
             <?php echo "(".$question_no.")"."&nbsp;".$question; ?>
            </td>
        </tr>
    </table>
    
    <table>
        <tr>
            <td>
            <!-- for radio button -->
                <input type="radio" name="r1" value="<?php echo $opt1; ?>" style="margin-left: 10px;" onclick="radioclick(this.value, <?php echo $question_no ?>)"
                <?php
                if($ans == $opt1) {
                    echo "checked";
                }
                ?>>
            </td>

            <td style="padding-left: 10px;">
                <?php echo $opt1; ?>
            </td>
        </tr>

        <tr>
            <td>
                <input type="radio" name="r1" value="<?php echo $opt2; ?>" style="margin-left: 10px;" onclick="radioclick(this.value, <?php echo $question_no ?>)"
                <?php
                if($ans == $opt2) {
                    echo "checked";
                }
                ?>>
            </td>
            <td style="padding-left: 10px;">
                <?php echo $opt2; ?>
            </td>
        </tr>

        <tr>
            <td>
                <input type="radio" name="r1" value="<?php echo $opt3; ?>" style="margin-left: 10px;" onclick="radioclick(this.value, <?php echo $question_no ?>)"
                <?php
                if($ans == $opt3) {
                    echo "checked";
                }
                ?>>
            </td>
            <td style="padding-left: 10px;">
                <?php echo $opt3; ?>
            </td>
        </tr>

        <tr>
            <td>
                <input type="radio" name="r1" value="<?php echo $opt4; ?>" style="margin-left: 10px;" onclick="radioclick(this.value, <?php echo $question_no ?>)"
                <?php
                if($ans == $opt4) {
                    echo "checked";
                }
                ?>>
            </td>
            <td style="padding-left: 10px;">
                <?php echo $opt4; ?>
            </td>
        </tr>
    </table>
  <?php
}

?>