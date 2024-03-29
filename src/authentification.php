<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page d'accueil">
    <meta name="author" content="BALLEUR, ESMILAIRE, DONIKIAN, DI-MEO">
    <title>Page d'accueil</title>

    <link rel="icon" href="../ressources/images/logo.webp" type="image/webp">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script type="module" src="../scripts/header-footer.js"></script>

    <style>
        .accordion-button:focus {
            box-shadow: none !important;
        }
    </style>
    </head>

    <body>
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <h2 class="mt-5">Authentifiez vous !</h2>

        <div class="accordion w-50 my-3" id="authenticationAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="loginHeading">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#loginCollapse" aria-expanded="true" aria-controls="loginCollapse">
                        Se connecter
                    </button>
                </h2>

                <div id="loginCollapse" class="accordion-collapse collapse show m-3" aria-labelledby="loginHeading" data-bs-parent="#authenticationAccordion">
                    <form id="accordion-body login-form" action="/login" method="POST">
                        <div class="form-group">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" id="username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Se connecter</button>
                    </form>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="registerHeading">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#registerCollapse" aria-expanded="false" aria-controls="registerCollapse">
                        Créer un compte
                    </button>
                </h2>
        
                <div id="registerCollapse" class="accordion-collapse collapse m-3" aria-labelledby="registerHeading" data-bs-parent="#authenticationAccordion">
                    <form id="accordion-body register-form">

                        <div class="form-group">
                            <label for="new-username">Nom d'utilisateur</label>
                            <input type="text" id="new-username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="new-password">Mot de passe</label>
                            <input type="password" id="new-password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Confirmer le mot de passe</label>
                            <input type="password" id="confirm-password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Créer un compte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="form-validation.js"></script>
</body>
</html>