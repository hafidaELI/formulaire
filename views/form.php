<h1 class="text-center">Formulaire de renseignement</h1>
<form action="" method="post" enctype="multipart/form-data" novalidate>

    <div class="form-group fw-semibold">
        <label for="email">E-mail :</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>
        <div id="emailError" class="text-danger"></div>
    </div>

    <div class="fw-semibold">
        <label for="password" class="form-label">Mot de passe :</label>
        <div class="d-flex justify-content-between align-items-center form-input">
            <input type="password" class="flex-grow-1 custom-form-control" id="password" name="password" required>
            <i class="fa-solid fa-eye" id="togglePassword" style="cursor: pointer;"></i>
        </div>
        <div id="passwordError" class="text-danger"></div>
    </div>

    <div class="form-group">
        <label class="fw-semibold">Civilité :</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="mr" name="civility" value="Mr" required>
            <label class="form-check-label" for="mr">Mr</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="mme" name="civility" value="Mme" required>
            <label class="form-check-label" for="mme">Mme</label>
        </div>
    </div>

    <div class="form-group fw-semibold">
        <label for="name">Nom :</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" required>
        <div id="nameError" class="text-danger"></div>
    </div>

    <div class="form-group fw-semibold">
        <label for="dob">Date de naissance :</label>
        <input type="date" class="form-control" id="dob" name="dob" required>
    </div>

    <div class="form-group fw-semibold">
        <label for="birth_country">Pays de naissance :</label>
        <select class="form-control" id="birth_country" name="birth_country" required>
            <?php
            foreach ($countries as $key => $country) : ?>

                <option value="<?= $country ?>" <?= $key == $birth_country ? 'selected' : '' ?>><?= $country ?></option>

            <?php endforeach; ?>

        </select>
    </div>

    <div class="form-group fw-semibold">
        <label for="postal_code">Code postal :</label>
        <input type="text" class="form-control" id="postalCode" name="postalCode" value="<?= $postalCode ?>" required>
        <div id="pcError" class="text-danger"></div>
    </div>

    <div class="form-group fw-semibold">
        <label for="profile_picture">Photo de profil :</label>
        <input type="file" class="form-control-file" id="profile_picture" name="profile_picture" accept="image/*">
    </div>

    <div class="form-group fw-semibold">
        <label for="linkedinUrl">URL compte LinkedIn :</label>
        <input type="url" class="form-control" id="linkedinUrl" name="linkedinUrl" value="<?= $linkedinUrl ?>">
        <div id="urlError" class="text-danger"></div>
    </div>

    <div class="form-group">
        <label class="fw-semibold">Quels langages web connaissez-vous ?</label><br>
        <?php
        foreach ($languages as $key => $language) :
        ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id=<?= $language ?> name="web_languages[]" value=<?= $language ?>>
                <label class="form-check-label" for=<?= $language ?>><?= $language ?></label>
            </div>
        <?php endforeach ?>

    </div>

    <div class="form-group fw-semibold">
        <label for="experience">Racontez une expérience avec la programmation et/ou l'informatique que vous auriez pu avoir :</label>
        <textarea class="form-control" id="experience" name="experience" rows="5"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>