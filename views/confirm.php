<div class='recap text-center'>
    <p>Formulaire envoyé</p>
</div>
<h1>Récapitulatif</h1>

<div class="recap">
    <ul class="">
        <?php foreach ($_POST as $key => $value) :
            if ($key == 'web_languages') {
                foreach ($value as $language) : ?>
                    <li><?= $key ?> : <?= $language ?></li>
                <?php endforeach;
            } else { ?>
                <li><?= $key ?> : <?= $value ?></li>
        <?php }
        endforeach ?>
        <?php if (isset($_FILES['profile_picture'])) : ?>
            <li>profile_picture : <?= htmlspecialchars($_FILES['profile_picture']['name']) ?></li>
        <?php endif; ?>
    </ul>
</div>


<!-- // recuperer la photo
// if (condition) {
// # code...
// }

// if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
// $file_name = $_FILES['file']['name'];
// $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
// echo "<p>Nom du fichier: $file_name</p>";
// echo "<p>Extension du fichier: $file_extension</p>";
// } else {
// echo "<p>Aucun fichier téléchargé.</p>";
// }
?> -->