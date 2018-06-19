<?php

class ImageManager extends Manager
{
// Constantes
    const TARGET = ROOT . '/Public/images/thumbnails/';    // Repertoire cible
    const MAX_SIZE = 5242880;    // Taille max en octets du fichier
    const WIDTH_MAX = 10000;    // Largeur max de l'image en pixels
    const HEIGHT_MAX = 10000;    // Hauteur max de l'image en pixels


// Tableaux de donnees

    private $tabExt = array('jpg', 'gif', 'png', 'jpeg');    // Extensions autorisees
    private $infosImg;
    private $nomImage;


    public function uploadImage()
    {
        // Variables
        $extension = '';
        $message = '';
        $nomImage = '';

        // Recuperation de l'extension du fichier
        $extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
        // On verifie l'extension du fichier
        if (in_array(strtolower($extension), $this->tabExt)) {
            // On recupere les dimensions du fichier
            $this->infosImg = getimagesize($_FILES['fichier']['tmp_name']);

            // On verifie le type de l'image
            if ($this->infosImg[2] >= 1 && $this->infosImg[2] <= 14) {
                // On verifie les dimensions et taille de l'image
                if (($this->infosImg[0] <= self::WIDTH_MAX) && ($this->infosImg[1] <= self::HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= self::MAX_SIZE)) {
                    // Parcours du tableau d'erreurs
                    if (isset($_FILES['fichier']['error']) && UPLOAD_ERR_OK === $_FILES['fichier']['error']) {
                        // On renomme le fichier
                        $this->nomImage = $this->changeNameImage($_FILES['fichier']['name']);

                        // Si c'est OK, on teste l'upload
                        if (move_uploaded_file($_FILES['fichier']['tmp_name'], self::TARGET . $this->nomImage)) {
                            return 'success';
                        } else {
                            // Sinon on affiche une erreur systeme
                            return 'Problème lors de l\'upload !';
                        }
                    } else {
                        return 'Une erreur interne a empêché l\'uplaod de l\'image';
                    }
                } else {
                    // Sinon erreur sur les dimensions et taille de l'image
                    return 'Erreur dans les dimensions de l\'image !';
                }
            } else {
                // Sinon erreur sur le type de l'image
                return 'Le fichier à uploader n\'est pas une image !';
            }
        } else {
            // Sinon on affiche une erreur pour l'extension
            return 'L\'extension du fichier est incorrecte !';
        }

    }

    public function deleteImage($image_name)
    {
        if (file_exists(self::TARGET . $image_name)) {
            unlink(self::TARGET . $image_name);
        }
    }

    public function changeNameImage($file)
    {
        $addTime = explode('.', $file);
        array_splice($addTime, -1, 1, array(time()));
        //on ajoute le timstanmp a la suite du nom et on rajoute l'extension
        return implode('', $addTime) . '.' . pathinfo($file, PATHINFO_EXTENSION);

    }

    public function getImageName()
    {
        return $this->nomImage;
    }

}
