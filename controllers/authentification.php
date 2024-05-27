<!-- logique des données:  vérification de mot de passe -->

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
        $processedData[$key] = ($key == 'password') ? trim($value) : (($key != 'web_languages') ? htmlspecialchars(stripslashes(trim($value))) : $value);
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
        include('./views/confirm.php');
    } else {
        // afficher erreurs
        foreach ($errors as $error) {
            echo "<p class='text-danger'>$error</p>";
        }
        include('./views/form.php');
    }
} else {
    include('./views/form.php');
}

?>