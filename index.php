<form action="/" method="post">
    Title: <input type="text" name="title"><br>
    From: <input type="datetime-local" name="from"><br>
    To: <input type="datetime-local" name="to"><br>
    Description: <input type="text" name="description"><br>
    Address: <input type="text" name="address"><br>
    <input type="radio" id="google" name="system" value="google" checked>
    <label for="google">Google</label><br>
    <input type="radio" id="yahoo" name="system" value="yahoo">
    <label for="yahoo">Yahoo</label><br>
    <input type="submit">
</form>
<?php

require_once("vendor/autoload.php");

use Spatie\CalendarLinks\Link;

if (isset($_POST['title']) && isset($_POST['from']) && isset($_POST['to']) && isset($_POST['system']))
{
    $dateFrom = str_replace("T", " ", $_POST['from']);
    $from = DateTime::createFromFormat('Y-m-d H:i', $dateFrom);

    $dateTo = str_replace("T", " ", $_POST['to']);
    $to = DateTime::createFromFormat('Y-m-d H:i', $dateTo);

    $link = Link::create($_POST['title'], $from, $to)
        ->description($_POST['description'])
        ->address($_POST['address']);

    echo "<a href='" . $link->{$_POST['system']}() . "' target='_blank'>Link</a>";
}
?>
