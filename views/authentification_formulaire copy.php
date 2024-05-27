<!-- affiche le formulaire simple:  -->
<?php
// VARIABLES
$countries = [1 => 'France', 'Belgique', 'Suisse', 'Luxembourg', 'Allemagne', 'Italie'];
$languages = [1 => 'HTML/CSS', 'PHP', 'Javascript', 'Python', 'Autres'];
$email = "";
$password = "";
$name = "";
$postalCode = "";
$linkedinUrl = "";
$birth_country = "";


// Fonction de validation et de nettoyage des données
function validate_input($data)
{
    $processedData = [];

    foreach ($data as $key => $value) {
        $processedData[$key] = $key == 'password' ? trim($value) : htmlspecialchars(stripslashes(trim($value)));
    }

    return $processedData;
}

$errors = [];
$submitted_data = [];

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sanitazedData = validate_input($_POST);


    extract($sanitazedData);

    // Regex
    $name_regex = "/^[a-zA-ZÀ-ÿ\s\-]{2,}$/";
    $email_regex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $postal_code_regex = "/^\d{5}$/";
    $url_regex = "/^https?:\/\/[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}.*$/";
    $password_regex = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";



    // Email validation
    if (!preg_match($email_regex, $email)) {
        $errors[] = "Email invalide.";
    }

    // Mot de passe validation
    if (!preg_match($password_regex, $password)) {
        $errors[] = "Mot de passe invalide.";
    }
    // Nom validation
    if (!preg_match($name_regex, $name)) {
        $errors[] = "Nom invalide.";
    }

    // Code postal validation
    if (!preg_match($postal_code_regex, $postalCode)) {
        $errors[] = "Code postal invalide.";
    }

    // URL validation (si fourni)
    if (!empty($submitted_data['linkedin_url']) && !preg_match($url_regex, $linkedin_url)) {
        $errors[] = "URL invalide.";
    }

    // Si pas d'erreur, traite les données
    if (empty($errors)) {
        // Process the data
        // 
        foreach ($_POST as $key => $value) {
            echo " 
            <div class='recap text-center'>
                <li class=''>$key : $value </li>
            </div>";
        }
    } else {
        // afficher erreurs
        foreach ($errors as $error) {
            echo "<p class='text-danger'>$error</p>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulaire</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <div class="container mt-5 border border-dark">
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
                        <input class="form-check-input" type="checkbox" id=<?= $language ?> name="web_languages" value=<?= $language ?>>
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
    </div>
    <script></script>
    <script src="../public/assets/js/form.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>