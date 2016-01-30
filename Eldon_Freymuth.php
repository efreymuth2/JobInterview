<!--
Eldon Freymuth
1/29/2016

Program Requirements:
-presents a web form
-provides user the ability to input any number or emails separated by whitespace
-processes the submitted values containing the emails
-and presents a unique list of email domains.

Example output:
Number          Domain
1               example.com
2               test.com
3               hank.co.uk
4               fun.co.uk
5               america.edu

-->

<?php echo '
<style>
    .standardButton
    {
        border-radius:10px;
        width:100px;
        height:30px;
        margin:10px auto 10px auto;
        border-width:2px;
        border-style:inset;   
    } 
</style>

    <form action="Eldon_Freymuth.php" method="POST" name="emailForm">
        <table style="text-align:center">
            <tr>
                <td><textarea type="text" cols="30" rows="15" autofocus="true"
                    placeholder="Please enter any number of email address seperated by a space"
                    id="emailAddressesID" class="standardTextbox" name="emailAddressesName"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Submit" id="submitEmailButtonID" class="standardButton" name="submitEmailButtonName"></td>
            </tr>
            <tr>
                <td colspan="2">'?><?php displayEmailAddresses(); ?><?php echo '</td>
            </tr>
        </table>
    </form>'
?>

<?php
function displayEmailAddresses()
{
    if(!empty($_POST['submitEmailButtonName']))//don't process the form until the button is pressed.
    {
        $array = Array();
        $foundEmail = $_POST['emailAddressesName'];//get the contents of the textbox as a variable for manipulation
        echo "<br>";//provide a break for readability
        $singleEmailAddress = explode(" ",$foundEmail);//adds strings to array when a space is found
        $eldonCount = count($singleEmailAddress);//count the number of email addresses
        echo "<table><tr><td>Number</td><td>Domain</td></tr>";//create the table and set the first row
        for($i = 0; $i < $eldonCount; $i++)
        {
            
            $atSymbolLocation = strpos($singleEmailAddress[$i], "@");//find number value location of '@' symbol for substring event
            if($atSymbolLocation > 0)
            {
                $array[] = substr($singleEmailAddress[$i], $atSymbolLocation+1);//gets the substring of array element starting at the position after the '@' symbol to end
                $array = array_values(array_unique($array));//array_values removes any blanks after array_unique removes duplicate values
            }
        }
        for($j = 0; $j < count($array); $j++)//use the new count for unique array to print the values into the table
        {
            echo "<tr><td>".($j+1)."</td><td>".$array[$j]."</td></tr>";
        }
        echo "</table>";//close the table
    }
}


?>