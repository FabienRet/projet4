<?php $this->title = "Mon Espace"; ?>
<h1>Mon espace membre</h1>


BTN mes données</br>
pseudo</br>
mail</br>
date création</br>
modifier les donnees</br>
En construction

<?php var_dump($_SESSION); ?>
<ul>
    <li>Pseudo : <?= $session['name'];?></li>
    <li>Email : <?=$session['email'];?></li>
    <li>Création du compte : <?=$session['created_at'];?></li>
</ul>