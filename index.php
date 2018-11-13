<?php
include 'inc/header.php';
include 'classes/dice.php';
include 'classes/player.php';
$tieCounter = 0;
$diceRounds = 10;
$player1Dice = new Dice(6);
$player2Dice = new Dice(6);
$player1 = new Players('Player 1', 'player1-color');
$player2 = new Players('Player 2', 'player2-color');

if (!array_key_exists('name1', $_GET) ||
    !array_key_exists('name2', $_GET) ||
    !array_key_exists('rounds', $_GET) ||
    !array_key_exists('sides', $_GET)) { ?>
<p class="text-center text-white">Please enter game information here</p>
<?php 
} ?>
<div class="container player-form">
    <form method="get">
        <table>
            <tr>
            <td><label for="name1">Player 1 Name:</label></td>
            <td><input type="text" name="name1"></td>
            </tr>
            <tr>
            <td><label for="name2">Player 2 Name:</label></td>
            <td><input type="text" name="name2"></td>
            </tr>
            <tr>
            <tr>
            <td><label for="sides">How many side should the dice have?</label></td>
            <td><input class="w-50" type="text" name="sides"></td>
            </tr>
            <tr>
            <tr>
            <td><label for="rounds">How many rounds should be played?</label></td>
            <td><input class="w-50" type="text" name="rounds"></td>
            </tr>
            <tr>
            <td><input class="btn btn-primary" type="submit" value="Roll!"></td>
            <td></td>
            </tr>
        </table>
    </form>
</div>

<?php
if (!empty($_GET['name1'])) {
    $player1->setName($_GET['name1']);
}
if (!empty($_GET['name2'])) {
    $player2->setName($_GET['name2']);
}
if (!empty($_GET['rounds'])) {
    $diceRounds = intval($_GET['rounds']);
}
if (!empty($_GET['sides'])) {
    $player1Dice->setSides(intval($_GET['sides']));
    $player2Dice->setSides(intval($_GET['sides']));
}
?>

</div>
<table border=1>
    <tr>
        <th class="bg-primary">
            Roll #
        </th>
        <th class="player1-color">
            <?= $player1->getName() ?> Rolled
        </th>
        <th class="player2-color">
            <?= $player2->getName() ?> Rolled
        </th>
        <th class="bg-primary">
            Winner
        </th>
    </tr>

<?php
// Roll two dice # of times from form
for ($i = 1; $i <= $diceRounds; $i++) {
    $player1Dice->roll();
    $player2Dice->roll();
    ?>

    <tr>
    <td>
    <span class="badge badge-warning">
        <?= $i ?>
    </span>
    </td>
    <td>
        <?= $player1Dice->get_face_value() ?>
    </td>
    <td>
        <?= $player2Dice->get_face_value() ?>
    </td>

    <?php
    if ($player1Dice->get_face_value() > $player2Dice->get_face_value()) { ?>
    <td class="<?= $player1->getColor() ?>">
        <?= $player1->getName() ?>
    </td>
        <?php $player1Dice->score += 1; ?>

<?php

} else if ($player1Dice->get_face_value() == $player2Dice->get_face_value()) { ?>
    <td class="tie-color">
        Tie!
    </td>
        <?php $tieCounter += 1; ?>
<?php

} else { ?>
    <td class="<?= $player2->getColor() ?>">
        <?= $player2->getName() ?>
    </td>
        <?php $player2Dice->score += 1 ?>

<?php

} ?>
    </tr>
    <?php

} ?>
</table>
<!-- Score Board Displays Here -->
<div class="score">
    <h4><?= $player1->getName() ?> score was 
    <span class="badge badge-primary"><?= $player1Dice->score ?></span></h4>
    <h4><?= $player2->getName() ?> score was 
    <span class="badge badge-primary"><?= $player2Dice->score ?></span></h4>
    <h4>There was <?= $tieCounter ?> Ties this round!</h4>
<?php
if ($player1Dice->score > $player2Dice->score) { ?>
    <h4>The winner is 
    <span class="badge badge-success">
    <?= $player1->getName() ?>
    </span>
    </h4>
<?php

} else if ($player1Dice->score == $player2Dice->score) { ?>
     <h4>This was a 
     <span class="badge badge-danger">
     Tie
     </span>
     </h4>
<?php

} else { ?>
     <h4>The winner is 
     <span class="badge badge-success">
     <?= $player2->getName() ?>
     </span>
     </h4>
<?php

}
?>
</div>
<?php
include 'inc/footer.php';
?>