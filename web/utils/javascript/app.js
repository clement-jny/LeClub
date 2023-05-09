$(document).ready(function() {

    /* Récupère le titre du document affiché dans l'onglet */
    $title = document.title;

    /* Récupère l'url et sépare l'url en deux avec '=' et prend l'élèment à l'index 1 pour '$page' et l'index 2 pour '$gestion' */
    $page = document.URL.split("=")[1];
    $gestion = document.URL.split("=")[2];


    if ($page == undefined) {
        $page = "accueil";
    } else if ($page.includes("&gestion")) {
        $page = $page.split("&")[0];
    }

    switch ($page) {
        case "accueil":
            $(document).attr("title", $title + " - Accueil");
            $(".contenu").removeClass("flex");
            break;
        case "inscription":
            $f = $page.substr(0, 1).toUpperCase() + $page.substr(1);

            $(document).attr("title", $title + " - " + $f);
            $(".contenu").addClass("flex");
            break;
        case "connexion":
            $f = $page.substr(0, 1).toUpperCase() + $page.substr(1);

            $(document).attr("title", $title + " - " + $f);
            $(".contenu").addClass("flex");
            break;
        case "espaceMembre":
            $split = $page.replace(/([a-z0-9])([A-Z])/g, '$1 $2');
            $f = $split.substr(0, 1).toUpperCase() + $split.substr(1);

            $(document).attr("title", $title + " - " + $f);
            $(".contenu").removeClass("flex");
            break;
        case "deconnexion":
            $f = $page.substr(0, 1).toUpperCase() + $page.substr(1);

            $(document).attr("title", $title + " - " + $f);
            $(".contenu").removeClass("flex");
            break;

        case "listeSports":
            $split = $page.replace(/([a-z0-9])([A-Z])/g, '$1 $2');
            $f = $split.substr(0, 1).toUpperCase() + $split.substr(1);

            $(document).attr("title", $title + " - " + $f);
            $(".contenu").removeClass("flex");
            break;
        case "informationsSport":
            $split = $page.replace(/([a-z0-9])([A-Z])/g, '$1 $2');
            $f = $split.substr(0, 1).toUpperCase() + $split.substr(1);

            $(document).attr("title", $title + " - " + $f);
            $(".contenu").removeClass("flex");
            break;
        case "inscriptionSport":
            $split = $page.replace(/([a-z0-9])([A-Z])/g, '$1 $2');
            $f = $split.substr(0, 1).toUpperCase() + $split.substr(1);

            $(document).attr("title", $title + " - " + $f);
            $(".contenu").removeClass("flex");
            break;

        case "gestionUtilisateurs":
            $split = $page.replace(/([a-z0-9])([A-Z])/g, '$1 $2');
            $f = $split.substr(0, 1).toUpperCase() + $split.substr(1);

            $(document).attr("title", $title + " - " + $f);
            $(".contenu").removeClass("flex");

            switch ($gestion) {
                case "ajouter":
                    $(".contenu").addClass("flex");
                    break;
                case "modifier":
                    $(".contenu").addClass("flex");
                    break;

                case "supprimer":
                    $(".contenu").removeClass("flex");
                    break;
            
                default:
                    $(".contenu").removeClass("flex");
                    break;
            }

            break;


        case "message":
            $f = $page.substr(0, 1).toUpperCase() + $page.substr(1);

            $(document).attr("title", $title + " - " + $f);
            $(".contenu").removeClass("flex");
            break;

        default:
            $(document).attr("title", $title + " - Accueil");
            $(".contenu").removeClass("flex");
            break;
    }
});

